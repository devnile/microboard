<?php

namespace Microboard\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Microboard\Factory;
use Microboard\Models\Role;

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
     * @var Factory
     */
    protected $microboard;

    public function __construct(Factory $microboard)
    {
        parent::__construct();

        $this->microboard = $microboard;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        $this->output->progressStart(4);
        $this->output->newLine();

        $this->callSilent('storage:link');

        // Migrate the database
        $this->callSilent('migrate');
        $this->info('Database tables have migrated');
        $this->output->progressAdvance();
        $this->output->newLine();

        // Publishes the assets
        $this->publishesAssets();
        $this->output->progressAdvance();
        $this->output->newLine();

        // Create default roles and permissions
        $admin = $this->createDefaultRolesAndPermissions();
        $this->output->progressAdvance();
        $this->output->newLine();

        // Create new admin
        $this->askForCreatingNewAdmin($admin);
        $this->output->progressAdvance();
        $this->output->newLine();

        $this->info('All done.');
        $this->info('Do something awesome!');
    }

    /**
     *
     */
    private function publishesAssets()
    {
        $this->callSilent('vendor:publish', [
            '--provider' => 'Microboard\\Providers\\MicroboardServiceProvider'
        ]);
        $this->callSilent('vendor:publish', [
            '--provider' => 'Microboard\\Providers\\ViewServiceProvider'
        ]);
        $this->callSilent('vendor:publish', [
            '--provider' => 'Yajra\DataTables\ButtonsServiceProvider'
        ]);
        $this->callSilent('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--tag' => 'config'
        ]);

        $this->info('Assets have published');
    }

    /**
     * Create default roles and permissions
     *
     * @throws Exception
     */
    private function createDefaultRolesAndPermissions()
    {
        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ], ['display_name' => 'Administrator']);

        Role::firstOrCreate([
            'name' => 'user'
        ], ['display_name' => 'Normal user']);

        if (config('microboard.resources.default_role', 'admin') === 'admin') {
            $role = $admin;
        } else {
            $role = Role::where('name', config('microboard.roles.default', 'admin'))->firstOrFail();
        }

        $this->microboard->createResourcesPermissionsFor($role, [
            'dashboard' => ['viewAny'],
            'settings' => ['viewAny', 'create', 'update'],
            'users' => null,
            'roles' => null
        ]);

        $this->info('Roles and permissions have created');

        return $admin;
    }

    /**
     * ask for creating a new admin
     *
     * @param Role $role
     * @return void
     */
    private function askForCreatingNewAdmin(Role $role)
    {
        if ($this->confirm('Create new admin?', false)) {
            $data = [
                'name' => $this->ask('Name'),
                'email' => $this->ask('Email'),
                'password' => $this->secret('Password')
            ];

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'min:2', 'max:200'],
                'email' => ['required', 'string', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:4', 'max:200']
            ]);

            if ($validator->fails()) {
                $this->error('Admin was not created, see the following errors');
                $errors = [];

                foreach (['name', 'email', 'password'] as $field) {
                    if ($validator->errors()->has($field)) {
                        $errors[] = [ucfirst($field), $validator->errors()->first($field)];
                    }
                }

                $this->output->table(['Field', 'Message'], $errors);

                $this->askForCreatingNewAdmin($role);

                return;
            }

            $role->users()->create($data);

            $this->info('Admin has created');
        }
    }
}
