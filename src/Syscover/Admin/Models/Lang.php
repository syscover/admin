<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Lang
 * @package Syscover\Admin\Models
 */

class Lang extends CoreModel
{
    protected $table        = 'admin_lang';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix' ,'id', 'name', 'icon', 'sort', 'active'];
    protected $casts        = [
        'active' => 'boolean'
    ];
}
