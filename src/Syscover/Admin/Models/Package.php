<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Package
 * @package Syscover\Admin\Models
 */

class Package extends CoreModel
{
	protected $table        = 'admin_package';
    protected $fillable     = ['id', 'name', 'root', 'version', 'active', 'sort'];
    protected $casts        = [
        'active'            => 'boolean'
    ];
}
