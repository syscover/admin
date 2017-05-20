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
    protected $fillable     = ['id', 'resource_id', 'url', 'file_name', 'mime', 'size', 'type_id', 'type_text', 'width', 'height', 'data'];
    public $incrementing    = false;
    public $timestamps      = false;
    public $with            = ['resource'];

    private static $rules   = [
        'resource_id'   =>  'required',
        'file_name'     =>  'required|between:2,1020'
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