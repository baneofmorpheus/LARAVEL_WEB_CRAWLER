<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class ScrapeArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape articles from a page using https://roach-php.dev
    and save to db ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        try {
            $this->info('starting scraping service');
            $this->call('roach:run', ['spider' => 'ArticleSpider']);
            $this->info('Articles scraped and saved successfully');
            return Command::SUCCESS;
        } catch (Exception $e) {

            $this->error("Error ::: " . $e->getMessage());
        }
    }
}
