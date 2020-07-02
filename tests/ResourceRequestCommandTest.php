<?php

namespace Microboard\Tests;

class ResourceRequestCommandTest extends TestCase
{
    /** @test * */
    public function it_creates_a_form_request()
    {
        $this->artisan('microboard:request', [
            'name' => 'Article\\StoreFormRequest',
            '--model' => 'Microboard\\Tests\\App\\Article',
            '--columns' => 'column',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/Http/Requests/Article/StoreFormRequest.php');
        $this->assertStringContainsString('class StoreFormRequest', $content = file_get_contents($path));
        $this->assertStringContainsString('\'column\' => [\'required\', \'string\']', $content);
    }
}
