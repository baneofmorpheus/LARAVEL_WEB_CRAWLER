<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use App\ItemProcessors\ArticleProcessor;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

class ArticleSpider extends BasicSpider
{




    public array $startUrls = [
        'https://www.spiegel.de/politik/deutschland'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        [
            ArticleProcessor::class,
            [],
        ],
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $article_nodes = $response->filter('div[data-area=article-teaser-list] article[data-sara-article-id]');


        $articles = [];
        $article_nodes->each(function (Crawler $node, $i) use (&$articles) {

            $article_header_node = $node->filter('header h2 a[title] span:nth-child(2)');

            /**
             * Checks if there's a present header for the article
             * title ,if yes then we know this is a valid node
             * and can proceed to get the rest of the fields.
             * if no then exit
             */

            if ($article_header_node->count() < 0) {
                return;
            }

            $article = [

                'title' => '',
                'link' => '',
                'date' => '',
                'excerpt' => '',
                'image_url' => '',


            ];


            $date = null;

            $date_node = $node->filter('footer > span:first-child');

            $date_class = $date_node->attr('class');


            /**
             * Handle inconsistency in html structure for date
             */
            if (isset($date_class)) {

                $date_node = $date_node->filter('span:first-child');
            }
            $date = $date_node->text();


            $article['title'] = $article_header_node->text();
            $article['link'] = $node->filter('header h2 a[title]')->attr('href');
            $article['excerpt'] = $node->filter('section > a[title]')->text();
            $article['date'] = $date;
            $article['image_url'] = $node->filter('figure noscript > img')->attr('src');

            $article['created_at'] = Carbon::now();
            $article['updated_at'] = Carbon::now();
            $articles[$i] = $article;
        });



        yield $this->item($articles);
    }
}
