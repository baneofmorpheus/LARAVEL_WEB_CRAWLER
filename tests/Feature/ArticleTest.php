<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;
use App\Services\Articles\ArticleService;

class ArticleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListArticleService()
    {



        $created_articles = Article::factory()->count(10)->create()->toArray();

        $article_service = new ArticleService();

        $listed_articles = $article_service->listArticles();

        $this->assertEquals($created_articles, $listed_articles);
    }


    public function testSaveArticleService()
    {



        $created_articles = Article::factory()->count(10)->make()->toArray();

        $article_service = new ArticleService();
        $article_service->saveArticles($created_articles);
        $this->assertDatabaseCount('articles', 10);
    }
}
