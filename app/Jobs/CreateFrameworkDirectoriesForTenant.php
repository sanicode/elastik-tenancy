<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Stancl\Tenancy\Contracts\Tenant;


class CreateFrameworkDirectoriesForTenant implements ShouldQueue
{
    use Queueable;

    protected $tenant;
    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        //
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $this->tenant->run(function ($tenant) {
            $storage_path = storage_path();

            mkdir("$storage_path/framework/cache", 0777, true);
        });
    }
}
