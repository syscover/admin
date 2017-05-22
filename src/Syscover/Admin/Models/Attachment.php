<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentLibrary
 * @package Syscover\Admin\Models
 */

class Attachment extends CoreModel
{
	protected $table        = 'attachment';
    protected $fillable     = ['id', 'lang_id', 'resource_id', 'object_id', 'family_id', 'sort', 'name', 'file_name', 'url', 'mime', 'size', 'width', 'height', 'library_id', 'library_file_name', 'data_lang', 'data'];
    public $incrementing    = false;
    public $timestamps      = false;
    protected $casts        = [
        'data' => 'array'
    ];
    public $with            = ['resource'];

    private static $rules   = [
        'resource_id'   =>  'required',
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

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}