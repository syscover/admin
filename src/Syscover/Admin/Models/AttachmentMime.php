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
        return $query->join('resource', 'attachment_mime.resource_id', '=', 'resource.id')
            ->select('resource.*', 'attachment_mime.*', 'resource.name as resource_name');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}