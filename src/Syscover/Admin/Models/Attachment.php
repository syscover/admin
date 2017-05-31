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
    protected $fillable     = ['id', 'lang_id', 'object_id', 'object_type', 'family_id', 'sort', 'name', 'base_path', 'file_name', 'url', 'mime', 'extension', 'size', 'width', 'height', 'library_id', 'library_file_name', 'data_lang', 'data'];
    public $incrementing    = false;
    public $timestamps      = false;
    protected $casts        = [
        'data' => 'array'
    ];
    public $with            = ['family', 'attachmentLibrary'];

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

    public function family()
    {
        return $this->belongsTo(AttachmentFamily::class, 'family_id');
    }

    public function attachmentLibrary()
    {
        return $this->hasOne(AttachmentLibrary::class, 'id', 'library_id');
    }
}