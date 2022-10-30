<?php

namespace App\Services\Articles;

use App\Models\Article;

use Illuminate\Support\Facades\Log;

class ArticleService
{


    public function saveArticles(array $articles)
    {
        try {
            Article::insert($articles);
        } catch (\Throwable $th) {
            Log::error("Error saving articles", [
                "message" => $th->getMessage(),
                "location" => "ArticleService@saveArticles"

            ]);
        }
    }

    public function listArticles()
    {



        return  Article::all()->toArray();
    }
}
