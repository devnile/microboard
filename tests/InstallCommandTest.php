<?php

namespace Microboard\Tests;

use Illuminate\Support\Facades\Schema;

class InstallCommandTest extends TestCase
{
    protected function install()
    {
        return $this->artisan('microboard:install')
            ->expectsConfirmation('Create new admin?');
    }

    protected function installWithAdmin() {
        return $this->artisan('microboard:install')
            ->expectsConfirmation('Create new admin?', 'yes')
            ->expectsQuestion('Name', 'admin')
            ->expectsQuestion('Email', 'admin@system.app')
            ->expectsQuestion('Password', 'admin');
    }

    /** @test * */
    public function it_migrates_the_package_migrations()
    {
        $this->install()->expectsOutput('Database tables have migrated');

        $this->assertTrue(Schema::hasTable('settings'));
        $this->assertTrue(Schema::hasTable('roles'));
        $this->assertTrue(Schema::hasTable('permissions'));
        $this->assertTrue(Schema::hasTable('permission_role'));
        $this->assertTrue(Schema::hasColumns('users', [
            'role_id'
        ]));
    }

    /** @test * */
    public function it_publish_the_assets_files()
    {
        $this->install()->expectsOutput('Assets have published');
        $this->assertFileExists($this->app->basePath('/routes/microboard.php'));
        $this->assertFileExists($this->app->resourcePath('views/vendor/microboard/layouts/partials/navbar-links.blade.php'));
    }

    /** @test * */
    public function it_creates_admin_and_default_roles_and_permissions()
    {
        $this->installWithAdmin()->expectsOutput('Admin has created');

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
            ->expectsQuestion('Name', 'ad')
            ->expectsQuestion('Email', 'not_email@test')
            ->expectsQuestion('Password', '')
            ->expectsOutput('Admin was not created, see the following errors');

        $this->assertDatabaseCount('users', 0);

        $command->expectsConfirmation('Create new admin?', 'yes')
            ->expectsQuestion('Name', 'admin')
            ->expectsQuestion('Email', 'admin@system.app')
            ->expectsQuestion('Password', 'admin')
            ->expectsOutput('Admin has created');
    }

    /** @test * */
    public function it_creates_default_roles_and_permissions()
    {
        $this->install()->expectsOutput('Roles and permissions have created');

        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'user']);
        $this->assertDatabaseCount('permissions', 14);
        $this->assertDatabaseCount('permission_role', 14);
    }
}
