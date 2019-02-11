<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Action
 * @package Syscover\Admin\Models
 */

class Action extends CoreModel
{
	protected $table        = 'admin_action';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['id', 'name'];
}
