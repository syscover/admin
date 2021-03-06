<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentLibrary
 * @package Syscover\Admin\Models
 */

class Attachment extends CoreModel
{
	protected $table        = 'admin_attachment';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix' ,'id', 'lang_id', 'object_id', 'object_type', 'family_id', 'sort', 'alt', 'title', 'base_path', 'file_name', 'url', 'mime', 'extension', 'size', 'width', 'height', 'library_id', 'library_file_name', 'data_lang', 'data'];
    protected $casts        = [
        'data' => 'array'
    ];
    public $with            = ['family', 'attachment_library'];

    private static $rules   = [
        'resource_id'   =>  'required',
        'file_name'     =>  'required',
        'url'           =>  'required',
        'mime'          =>  'required',
        'size'          =>  'required'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function family()
    {
        return $this->belongsTo(AttachmentFamily::class, 'family_id');
    }

    public function attachment_library()
    {
        return $this->hasOne(AttachmentLibrary::class, 'id', 'library_id');
    }
}