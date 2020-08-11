<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laratalks\Validator\Exceptions\ValidationException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Validators\UserValidator;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable , SoftDeletes , UserValidator;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const STATUS_APPROVED_NAME = 'Approved';
    const STATUS_PENDING_NAME = 'Pending';
    const STATUS_APPROVED = '1';
    const STATUS_PENDING = '0';

    CONST GENDER_MALE_NAME = 'Male';
    CONST GENDER_FEMALE_NAME = 'Female';
    CONST GENDER_MALE = '1';
    CONST GENDER_FEMALE = '0';

    CONST ROLE_USER = '0';
    CONST ROLE_ADMIN = '1';
    CONST ROLE_SUPER_ADMIN = '-1';

    CONST SCENARIO_CREATE = 'creating';
    const SCENARIO_UPDATE = 'updating';

    private $specificUser;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public static function statuses()
    {
        return [
            self::STATUS_PENDING => self::STATUS_PENDING_NAME,
            self::STATUS_APPROVED => self::STATUS_APPROVED_NAME
        ];
    }

    public static function genders()
    {
        return [
            self::GENDER_MALE => self::GENDER_MALE_NAME,
            self::GENDER_FEMALE => self::GENDER_FEMALE_NAME
        ];
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function getStatus()
    {
        return self::statuses()[$this->status];
    }

    public function getGender()
    {
        return self::genders()[$this->gender];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function social()
    {
        return $this->hasOne( SocialAccount::class ,'user_id' ,'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return$this->hasMany(ContactUs::class,'user_id','id');
    }

    /**
     * Get all messages with specific user send by me
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentByMeMessages()
    {
        $query = $this->hasMany(Chat::class,'from_user_id','id')
            ->whereNull('chats.deleted_at');
        if( !is_null($this->specificUser) )
            $query->where('to_user_id',$this->specificUser->id);
        return $query;
    }

    /**
     * Get all messages with specific user sent to me
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentToMeMessages()
    {
        $query = $this->hasMany(Chat::class,'to_user_id','id')
            ->whereNull('chats.deleted_at');
        if( !is_null($this->specificUser) )
            $query->where('from_user_id',$this->specificUser->id);
        return $query;
    }

    /**
     * Return All Messages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return Chat::where([['from_user_id',$this->id], ['to_user_id',$this->specificUser->id]])
            ->orWhere([['from_user_id',$this->specificUser->id], ['to_user_id',$this->id]])
            ->whereNull('chats.deleted_at');
    }

    /**
     * @param User $user
     * @return User
     */
    public function putUser( User $user)
    {
       return $this->specificUser = $user;
    }

    /**
     * @param $model
     */
    public function beforeSave( $model )
    {
        $model->password = $model->password
            ? Hash::make($model->password)
            : Hash::make(Str::random(8));
    }


    public static function boot()
    {
        parent::boot();
        static::creating( function( $model ) {
            $model->beforeSave( $model );
        });
    }
}
