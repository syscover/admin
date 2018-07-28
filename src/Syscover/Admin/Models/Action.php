<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Action
 * @package Syscover\Pulsar\Models
 */

class Action extends CoreModel
{
	protected $table        = 'admin_action';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'name'];

    private static $rules   = [
        'id'    => 'required|between:2,25|unique:action,id',
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,25';

        return Validator::make($data, static::$rules);
	}
}