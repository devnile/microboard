<?php

namespace Microboard\Tests;

class ResourceCommandTest extends TestCase
{
    /** @test **/
    public function it_creates_a_controller_with_datatable_and_form_requests()
    {
        $this->artisan('microboard:resource', [
            'model' => 'Article',
            '--model-namespace' => 'Microboard\\Tests\\App',
            '--only' => 'controller',
            '--base_path' => './tests/tmp',
        ]);

        $this->assertFileExists('./tests/tmp/app/Http/Controllers/Admin/ArticleController.php');
        $this->assertFileExists('./tests/tmp/app/Http/Requests/Article/StoreFormRequest.php');
        $this->assertFileExists('./tests/tmp/app/Http/Requests/Article/UpdateFormRequest.php');
        $this->assertFileExists('./tests/tmp/app/DataTables/ArticleDataTable.php');
    }

    /** @test **/
    public function it_creates_a_datatable_class_if_there_is_viewAny_ability()
    {
        $this->artisan('microboard:resource', [
            'model' => 'Article',
            '--model-namespace' => 'Microboard\\Tests\\App',
            '--only' => 'controller',
            '--abilities' => 'create',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileNotExists('./tests/tmp/app/DataTables/ArticleDataTable.php');
    }

    /** @test **/
    public function it_creates_forms_requests_if_needed()
    {
        $this->artisan('microboard:resource', [
            'model' => 'Article',
            '--model-namespace' => 'Microboard\\Tests\\App',
            '--only' => 'controller',
            '--abilities' => 'create, update',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/Http/Requests/Article/StoreFormRequest.php');
        $this->assertFileExists($path = './tests/tmp/app/Http/Requests/Article/UpdateFormRequest.php');
    }

    /** @test * */
    public function it_creates_a_policy_and_permissions()
    {
        $this->artisan('microboard:resource', [
            'model' => 'Article',
            '--model-namespace' => 'Microboard\\Tests\\App',
            '--only' => 'policy',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertDatabaseCount('permissions', 19);
        $this->assertStringContainsString(
            'class ArticlePolicy',
            file_get_contents('./tests/tmp/app/Policies/ArticlePolicy.php')
        );
    }

    /** @test **/
    public function it_creates_views_and_lang_files()
    {
        $this->artisan('microboard:resource', [
            'model' => 'Article',
            '--model-namespace' => 'Microboard\\Tests\\App',
            '--only' => 'views',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/resources/views/admin/articles/form.blade.php');
        $this->assertStringContainsString('Form::argonInput(\'column\', \'text\', $article->column', $content = file_get_contents($path));
        $this->assertStringContainsString('Form::argonInput(\'hidden\', \'text\', $article->hidden', $content);

        $this->assertFileExists($path = './tests/tmp/resources/views/admin/articles/table.blade.php');
        $this->assertStringContainsString('<td>{{ $article->column }}</td>', $content = file_get_contents($path));
        $this->assertStringNotContainsString('<td>{{ $article->hidden }}</td>', $content);

        $this->assertFileExists($path = './tests/tmp/resources/lang/ar/articles.php');
        $this->assertStringContainsString('\'column\' => \'Column\',', $content = file_get_contents($path));
    }
}
