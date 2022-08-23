<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $web_title = getSettingValue('website_title') ?? 'Test Website';
        $logo = asset(getSettingValue('logo') ?? '');
        $sameAs = [];
        if (getSettingType('social-media')) {
            foreach (getSettingType('social-media') as $key => $media) {
                $sameAs[] = $media->value;
            }
        }
        $localBusiness = Schema::organization()
            ->settype('Business')
            ->name($web_title)
            ->logo($logo)
            ->url(url('/'))
            ->if(getSettingValue('contact_email'), function (Organization $schema) {
                $schema->email(getSettingValue('contact_email'));
            })
            ->if(count($sameAs), function (Organization $schema) use ($sameAs) {
                $schema->sameAs($sameAs);
            });

        WebSetting::updateOrCreate(
            [
                'key' => 'org_schema',
                'type' => 'branding',
            ],
            [
                'value' => $localBusiness->toJson(),
            ],
        );
    }
}
