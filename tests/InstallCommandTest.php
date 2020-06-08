<?php

namespace Microboard\Tests;

use Illuminate\Support\Facades\Schema;

class InstallCommandTest extends TestCase
{
    protected function install()
    {
        return $this->artisan('microboard:install')
            ->expectsConfirmation('Create new admin?', 'no');
    }

    protected function installWithAdmin() {
        return $this->artisan('microboard:install')
            ->expectsConfirmation('Create new admin?', 'yes')
            ->expectsQuestion('What is the admin name?', 'admin')
            ->expectsQuestion('What is email?', 'admin@system.app')
            ->expectsQuestion('What is password?', 'admin')
            ->expectsQuestion('Please confirm the password', 'admin');
    }

    /** @test * */
    public function it_publish_the_assets_files()
    {
        $this->install()->expectsOutput('All assets has been published');
    }

    /** @test * */
    public function it_migrates_the_package_migrations()
    {
        $this->install()->expectsOutput('Database has been migrated');

        $this->assertTrue(Schema::hasTable('settings'));
        $this->assertTrue(Schema::hasTable('roles'));
        $this->assertTrue(Schema::hasTable('permissions'));
        $this->assertTrue(Schema::hasTable('permission_role'));
        $this->assertTrue(Schema::hasColumns('users', [
            'avatar', 'role_id'
        ]));
    }

    /** @test * */
    public function it_creates_admin_and_default_roles_and_permissions()
    {
        $this->installWithAdmin()->expectsOutput('Admin creates successfully');

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'name' => 'admin',
            'email' => 'admin@system.app'
        ]);
    }

    /** @test * */
    public function it_cannot_create_new_admin_without_valid_data()
    {
        $command = $this->artisan('microboard:install');

        $command->expectsConfirmation('Create new admin?', 'yes')
            ->expectsQuestion('What is the admin name?', 'admin')
            ->expectsQuestion('What is email?', 'admin@system.app')
            ->expectsQuestion('What is password?', 'admin')
            ->expectsQuestion('Please confirm the password', 'not match')
            ->expectsOutput('Admin not created, See error messages below');

        $this->assertDatabaseCount('users', 0);

        $command->expectsQuestion('What is the admin name?', 'admin')
            ->expectsQuestion('What is email?', 'admin@system.app')
            ->expectsQuestion('What is password?', 'admin')
            ->expectsQuestion('Please confirm the password', 'admin')
            ->expectsOutput('Admin creates successfully');
    }

    /** @test * */
    public function it_creates_default_roles_and_permissions()
    {
        $this->installWithAdmin()
            ->expectsOutput('Default roles has created/updated successfully')
            ->expectsOutput('Default permissions has created/updated successfully');

        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'user']);
        $this->assertDatabaseCount('permissions', 15);
        $this->assertDatabaseCount('permission_role', 15);
    }
}
