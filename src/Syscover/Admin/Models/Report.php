<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Report
 * @package Syscover\Pulsar\Models
 */

class Report extends CoreModel
{
    protected $table        = 'admin_report';
    protected $fillable     = ['id', 'subject', 'emails', 'filename', 'extension', 'frequency_id', 'sql'];
    protected $casts        = [
        'emails'    => 'array'
    ];
}