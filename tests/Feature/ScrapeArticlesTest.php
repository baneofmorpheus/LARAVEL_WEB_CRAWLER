<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use RoachPHP\Roach;
use App\Console\Commands\ScrapeArticles;
use App\Spiders\ArticleSpider;

class ScrapeArticlesTest extends TestCase
{
    /**
     *Test that crawler/scraper starts with no
     *errors
     *
     * @return void
     */
    public function testWebScraper()
    {
        $runner = Roach::fake();
        $this->artisan('articles:scrape')->assertSuccessful();

        $runner->assertRunWasStarted(ArticleSpider::class);
    }
}
