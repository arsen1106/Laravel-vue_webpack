<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;
    protected $notificationType;

    CONST TYPE_RESET = 'reset';
    CONST TYPE_VERIFY = 'verify';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $type , $model )
    {
        $this->notificationType = $type;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $user = User::where('email',$this->model->email)->first();
            if( $this->notificationType == self::TYPE_RESET )
                $user->notify(new ResetPassword($this->model->token));
            if( $this->notificationType == self::TYPE_VERIFY )
                $user->notify(new VerifyEmail());

        }catch(\Exception $exception){

        }
    }
}
