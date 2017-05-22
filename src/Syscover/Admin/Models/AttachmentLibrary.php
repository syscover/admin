<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentLibrary
 * @package Syscover\Admin\Models
 */

class AttachmentLibrary extends CoreModel
{
	protected $table        = 'attachment_library';
    protected $fillable     = ['id', 'name', 'file_name', 'url', 'mime', 'size', 'width', 'height', 'data'];
    public $timestamps      = false;
    protected $casts        = [
        'data' => 'array'
    ];

    private static $rules   = [
        'name'          =>  'required',
        'file_name'     =>  'required',
        'url'           =>  'required',
        'mime'          =>  'required',
        'size'          =>  'required'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query;
    }
}