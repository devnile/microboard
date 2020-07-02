<?php

namespace Microboard\Tests;

class ResourcePolicyCommandTest extends TestCase
{
    /** @test **/
    public function it_creates_a_policy()
    {
        $this->artisan('microboard:policy', [
            'name' => 'ArticlePolicy',
            '--model' => '\\Microboard\\Tests\\App\\Article',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/Policies/ArticlePolicy.php');
        $this->assertStringContainsString('class ArticlePolicy', $content = file_get_contents($path));
        $this->assertStringContainsString('use Microboard\\Tests\\App\\Article;', $content);
        $this->assertStringContainsString('\'articles-', $content);
        $this->assertStringContainsString('public function viewAny', $content);
        $this->assertStringContainsString('public function view', $content);
        $this->assertStringContainsString('public function create', $content);
        $this->assertStringContainsString('public function update', $content);
        $this->assertStringContainsString('public function delete', $content);
    }

    /** @test **/
    public function it_creates_a_policy_with_provided_abilities()
    {
        $this->artisan('microboard:policy', [
            'name' => 'ArticlePolicy',
            '--model' => '\\Microboard\\Tests\\App\\Article',
            '--abilities' => 'viewAny, view',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/Policies/ArticlePolicy.php');
        $this->assertStringContainsString('class ArticlePolicy', $content = file_get_contents($path));
        $this->assertStringContainsString('use Microboard\\Tests\\App\\Article;', $content);
        $this->assertStringContainsString('public function viewAny', $content);
        $this->assertStringContainsString('public function view', $content);
        $this->assertStringNotContainsString('public function create', $content);
        $this->assertStringNotContainsString('public function update', $content);
        $this->assertStringNotContainsString('public function delete', $content);
    }
}
