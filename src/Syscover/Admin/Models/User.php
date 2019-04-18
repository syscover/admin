<?php namespace Syscover\Admin\Models;

use Illuminate\Foundation\Auth\User as BaseUser;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;
use Syscover\Admin\Traits\Langable;
use Syscover\Core\Traits\CanManageCrud;
use Syscover\Core\Traits\CanManageDataLang;

/**
 * Class User
 * @package Syscover\Admin\Models
 */
class User extends BaseUser
{
    use CanManageCrud, CanManageDataLang;
    use Notifiable, HasApiTokens;
    use Langable;

    protected $table        = 'admin_user';
    protected $fillable     = ['id', 'name', 'surname', 'email', 'lang_id', 'active', 'profile_id', 'user', 'password'];
    protected $casts        = [
        'active' => 'boolean'
    ];
    public $with            = ['profile', 'lang'];
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
        return $query
            ->join('admin_profile', 'admin_user.profile_id', '=', 'admin_profile.id')
            ->addSelect('admin_profile.*', 'admin_user.*', 'admin_profile.name as admin_profile_name', 'admin_user.name as admin_user_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_user.id'));
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
}
