<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Syscover\Admin\Notifications\ResetPassword as ResetPasswordNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package Syscover\Admin\Models
 */

class User extends CoreModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;

    protected $table        = 'admin_user';
    protected $fillable     = ['id', 'lang_id', 'profile_id', 'access', 'user', 'password', 'email', 'name', 'surname'];
    protected $casts        = [
        'access' => 'boolean'
    ];
    public $with            = ['profile'];
    protected $hidden       = ['password', 'remember_token'];

    private static $rules   = [
        'name'      => 'required|between:2,255',
        'surname'   => 'required|between:2,255',
        'email'     => 'required|between:2,255|email|unique:user,email',
        'lang'      => 'not_in:null',
        'profile'   => 'not_in:null',
        'user'      => 'required|between:2,255|unique:user,user',
        'password'  => 'required|between:4,50|same:repassword'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['emailRule']) && $specialRules['emailRule']) static::$rules['email']     = 'required|between:2,255|email';
        if(isset($specialRules['userRule']) && $specialRules['userRule'])   static::$rules['user']      = 'required|between:2,255';
        if(isset($specialRules['passRule']) && $specialRules['passRule'])   static::$rules['password']  = '';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('admin_profile', 'admin_user.profile_id', '=', 'admin_profile.id')
            ->select('admin_profile.*', 'admin_user.*', 'admin_profile.name as profile_name', 'admin_user.name as user_name');
    }

    /**
     * Get profile from user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return $this->toArray();
    }
}