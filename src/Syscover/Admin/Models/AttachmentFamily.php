<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class AttachmentMime
 * @package Syscover\Admin\Models
 */

class AttachmentFamily extends CoreModel
{
	protected $table        = 'attachment_family';
    protected $fillable     = ['id', 'resource_id', 'name', 'width', 'height', 'sizes'];
    public $timestamps      = false;
    protected $casts        = [
        'sizes' => 'array'
    ];
    public $with            = ['resource'];

    private static $rules   = [
        'resource_id'   =>  'required',
        'name'          =>  'required|between:2,255'
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