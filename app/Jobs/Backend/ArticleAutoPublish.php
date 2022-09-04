<?php

namespace App\Jobs\Backend;

use App\Models\Backend\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticleAutoPublish implements ShouldQueue
{
    private $article;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        getSettingValue('facebook_token') ? $this->post_to_facebook() : null;
        getSettingValue('twitter_token') ? $this->post_to_twitter() : null;

        getSettingValue('pinterest_token') ? $this->post_to_pinterest() : null;

    }

    private function post_to_facebook(){

    }

    private function post_to_twitter(){

    }

    private function post_to_pinterest(){

    }
}
