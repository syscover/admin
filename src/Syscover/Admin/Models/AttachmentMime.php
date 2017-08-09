<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentMime
 * @package Syscover\Admin\Models
 */

class AttachmentMime extends CoreModel
{
	protected $table        = 'admin_attachment_mime';
    protected $fillable     = ['id', 'resource_id', 'mime'];
    public $timestamps      = false;
    public $with            = ['resource'];

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
        return $query->join('admin_resource', 'admin_attachment_mime.resource_id', '=', 'admin_resource.id')
            ->select('admin_resource.*', 'admin_attachment_mime.*', 'admin_resource.name as resource_name');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}