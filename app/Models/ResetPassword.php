<?php

namespace App\Models;

use App\Jobs\SendEmail as SendEmailJob;

class ResetPassword extends Model
{
    const UPDATED_AT = null;

    protected $table = 'password_resets';
    protected $guarded = [];

    public function afterSave($model)
    {
        SendEmailJob::dispatch( 'reset' , $model );
        parent::afterSave($model); // TODO: Change the autogenerated stub
    }
}