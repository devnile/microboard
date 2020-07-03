<?php

namespace Microboard\Tests;

class ResourceDatatableCommandTest extends TestCase
{
    /** @test * */
    public function it_creates_a_datatable()
    {
        $this->artisan('microboard:datatable', [
            'name' => 'Article',
            '--model' => 'Microboard\\Tests\\App\\Article',
            '--columns' => 'column',
            '--base_path' => './tests/tmp'
        ]);

        $this->assertFileExists($path = './tests/tmp/app/DataTables/ArticleDataTable.php');
        $this->assertStringContainsString('class ArticleDataTable', $content = file_get_contents($path));
        $this->assertStringContainsString('use Microboard\\Tests\\App\\Article;', $content);
        $this->assertStringContainsString('Column::make(\'column\')->title(trans(\'articles.fields.column\')),', $content);
    }
}
