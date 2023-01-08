<?php

namespace App\Jobs\Backend;

use App\Models\Backend\Article;
use App\Models\Backend\ArticleLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticleLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article , $action, $discussion;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article , string $action , string $discussion = "")
    {
        $this->article = $article;
        $this->action = $action;
        $this->discussion = $discussion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->article->articleLog()->create([
            "actor" => auth()->user()->id,
            "action" => $this->action,
            "task_status" => $this->article->task_status,
            "log_at"=> carbon(),
            "article" => Article::where("id",$this->article->id)->with("category")->select("title","slug","body","category_id")->first(),
            "discussion" => $this->discussion
        ]);
    }
}
