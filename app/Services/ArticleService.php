<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Models\Article;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ArticleService
{
    public function fetchArticles(): void
    {
        try {
            $client = new Client;
            $response = $client->get(config('settings.news_api_url'), [
                'query' => [
                    'country' => config('settings.news_api_country'),
                    'apiKey' => config('settings.news_api_key'),
                ],
            ]);

            $news = json_decode($response->getBody()->getContents(), true);

            foreach ($news['articles'] as $article) {
                Article::create([
                    'title' => $article['title'],
                    'content' => $article['content'],
                    'published_at' => Carbon::parse($article['publishedAt']),
                    'source' => $article['source']['name'],
                ]);
                event(new UserRegistered('', 'new article created'));
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
