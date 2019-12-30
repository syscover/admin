<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Report
 * @package Syscover\Admin\Models
 */

class Report extends CoreModel
{
    protected $table        = 'admin_report';
    protected $fillable     = ['id', 'subject', 'emails', 'profiles', 'filename', 'extension', 'frequency_id', 'statement', 'sql', 'filter', 'wildcards'];
    protected $casts        = [
        'emails'        => 'array',
        'profiles'      => 'array',
        'wildcards'     => 'array'
    ];
}
