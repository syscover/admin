<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentMime
 * @package Syscover\Admin\Models
 */

class AttachmentMime extends CoreModel
{
	protected $table        = 'attachment_mime';
    protected $fillable     = ['id', 'resource_id', 'mime'];
    public $incrementing    = false;
    public $timestamps      = false;

    private static $rules   = [
        'resource_id'   =>  'required|between:2,30',
        'mime'          =>  'required|between:2,255'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('resource', 'attachment_mime.resource_id', '=', 'resource.id')
            ->select('attachment_mime.*', 'resource.*', 'attachment_mime.id as attachment_mime_id', 'resource.id as resource_id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}