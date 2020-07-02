<?php

namespace Microboard\Tests;

class ResourceControllerCommandTest extends TestCase
{
    /** @test **/
    public function it_creates_a_controller()
    {
        $this->artisan('microboard:controller', [
            'name' => 'ArticleController',
            '--model' => '\\Microboard\\Tests\\App\\Article',
            '--namespaced' => true,
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/Http/Controllers/ArticleController.php');
        $this->assertStringContainsString('class ArticleController', $content = file_get_contents($path));
        $this->assertStringContainsString('use Microboard\\Tests\\App\\Article;', $content);
        $this->assertStringContainsString('protected function getModel()', $content);
    }

    /** @test **/
    public function it_add_get_model_method_only_if_model_not_in_app_folder()
    {
        $this->artisan('microboard:controller', [
            'name' => 'UserController',
            '--model' => 'App\\User',
            '--base_path' => './tests/tmp'
        ])
            ->expectsConfirmation('A App\User model does not exist. Do you want to generate it?');

        $this->assertFileExists($path = './tests/tmp/app/Http/Controllers/UserController.php');
        $this->assertStringNotContainsString('use App\\User;', $content = file_get_contents($path));
        $this->assertStringNotContainsString('protected function getModel()', $content);
    }
}
