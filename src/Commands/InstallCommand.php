<?php

namespace Microboard\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Facades\Microboard\Factory;
use Microboard\Models\Role;
use Microboard\Models\User;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'microboard:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It\'s publish the package assets, and migrate the database.';

    /**
     * The created admin.
     *
     * @var User
     */
    private $admin = null;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->output->progressStart(4);
        $this->output->newLine();

        // Publish the assets (config, routes file, css and js files, database migrations)
        $this->publishAssets();
        $this->output->progressAdvance();
        $this->output->newLine();

        // Migrate the database
        $this->migrateDatabase();
        $this->output->progressAdvance();
        $this->output->newLine();

        // Create admin
        if ($this->confirm('Create new admin?', false)) {
            $this->askToCreateAdmin();
        }
        $this->output->progressAdvance();
        $this->output->newLine();

        // Create Permissions and roles
        $this->createRolesAndPermissions();
        $this->output->progressAdvance();
        $this->output->newLine();

        $this->info('All done.');
        $this->info('Do something awesome!');
    }

    private function publishAssets()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Microboard\\Providers\\MicroboardServiceProvider'
        ]);
        $this->call('vendor:publish', [
            '--provider' => 'Microboard\\Providers\\ViewServiceProvider'
        ]);
        $this->info('All assets has been published');
    }

    private function migrateDatabase()
    {
        $this->call('migrate');
        $this->info('Database has been migrated');
    }

    private function askToCreateAdmin()
    {
        $name = $this->ask('What is the admin name?');
        $email = $this->ask('What is email?');
        $password = $this->secret('What is password?');
        $passwordConfirmation = $this->secret('Please confirm the password');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation
        ], [
            'name' => ['required', 'string', 'min:2', 'max:200'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:4', 'max:200', 'confirmed'],
        ]);

        if ($validator->fails()) {
            $this->error('Admin not created, See error messages below');
            $errors = [];

            foreach (['name', 'email', 'password'] as $field) {
                if ($validator->errors()->has($field)) {
                    $errors[] = [ucfirst($field), $validator->errors()->first($field)];
                }
            }

            $this->output->table(['Field', 'Message'], $errors);

            return $this->askToCreateAdmin();
        }

        $this->admin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $this->info('Admin creates successfully');
    }

    private function createRolesAndPermissions()
    {
        $adminRole = Role::updateOrCreate(['name' => 'admin', 'display_name' => 'Administrator']);
        Role::updateOrCreate(['name' => 'user', 'display_name' => 'Normal user']);

        $this->info('Default roles has created/updated successfully');

        Factory::createResourcesPermissionsFor($adminRole, [
            'dashboard' => ['view'],
            'users' => [],
            'roles' => []
        ]);

        $this->info('Default permissions has created/updated successfully');

        if ($this->admin) {
            $adminRole->users()->save($this->admin);
        }
    }
}
