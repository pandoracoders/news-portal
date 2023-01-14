<?php

namespace App\Jobs;

use App\Models\Backend\Article;
use App\Models\Backend\WebSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Schema;

class OrgSchema implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article = null)
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
        if ($this->article) {

        } else {

            WebSetting::updateOrCreate(
                [
                    'key' => 'org_schema',
                    'type' => 'branding',
                ],
                [
                    'value' => getHomePageSchema(),
                ],
            );
        }
    }
}
