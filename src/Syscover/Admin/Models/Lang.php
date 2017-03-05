<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Lang
 * @package Syscover\Admin\Models
 */

class Lang extends CoreModel
{
    protected $table        = 'lang';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'        => 'required|alpha|size:2|unique:001_001_lang,id_001',
        'name'      => 'required|between:2,255',
        'sorting'   => 'min:0|numeric',
        'image'     => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|alpha|size:2';
        if(isset($specialRules['imageRule']) && $specialRules['imageRule']) static::$rules['image'] = 'required|mimes:jpg,jpeg,gif,png|max:1000';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query;
    }
}