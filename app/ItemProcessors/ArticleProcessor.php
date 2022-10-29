<?php

namespace App\ItemProcessors;

use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;
use App\Services\Articles\ArticleService;
use Illuminate\Support\Facades\Log;


class ArticleProcessor implements ItemProcessorInterface
{
    use Configurable;


    public function __construct(
        private ArticleService $article_service
    ) {
    }

    public function processItem(ItemInterface $item): ItemInterface
    {


        $this->article_service->saveArticles($item->all());

        Log::info('Articles scraped and saved successfully');
        return $item;
    }
}
