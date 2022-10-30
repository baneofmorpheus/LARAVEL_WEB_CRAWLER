<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Exception;

class ArticleController extends Controller
{

    public $article_service;
    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    public function listArticles(Request $request)
    {
        try {

            $articles = $this->article_service->listArticles();


            return view('index')->with(['successful' => true, 'articles' => $articles,]);
        } catch (Exception $e) {
            Log::error("Error listing articles", [
                "message" => $e->getMessage(),
                "file" => $e->getFile(),
                "source" => 'ArticleController@listArticles',
            ]);
            return view('welcome')->with([
                'successful' => false,
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
