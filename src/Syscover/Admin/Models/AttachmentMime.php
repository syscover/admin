<?php namespace Syscover\Admin\Models;

use Illuminate\Support\Facades\DB;
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
        return $query
            ->join('admin_resource', 'admin_attachment_mime.resource_id', '=', 'admin_resource.id')
            ->addSelect('admin_resource.*', 'admin_attachment_mime.*', 'admin_resource.name as admin_resource_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_attachment_mime.id'));
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }
}