<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Test
 * @package Syscover\Pulsar\Models
 */

class Test extends CoreModel
{
	protected $table        = 'test';
    protected $fillable     = ['id', 'name', 'data'];
    public $timestamps      = false;
    protected $casts        = [
        'data'    => 'array'
    ];
}