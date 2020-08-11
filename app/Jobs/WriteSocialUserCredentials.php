<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WriteSocialUserCredentials implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $socialUser)
    {
        $this->user = $socialUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $destinationPath = resource_path() . '/js/helper/social.js';
        if(File::exists($destinationPath)){
            File::delete($destinationPath);
        }
        File::put($destinationPath,sprintf("window.socialUserToken='%s' ",$this->user->social->token));
    }
}
