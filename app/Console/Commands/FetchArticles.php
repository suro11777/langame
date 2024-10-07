<?php

namespace App\Console\Commands;

use App\Services\ArticleService;
use Illuminate\Console\Command;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles';

    /**
     * Execute the console command.
     */
    public function handle(ArticleService $service): void
    {
        $this->info('Start fetch articles');

        $service->fetchArticles();

        $this->newLine();
        $this->info('End fetch articles');

    }
}
