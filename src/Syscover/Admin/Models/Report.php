<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;

/**
 * Class Report
 * @package Syscover\Pulsar\Models
 */

class Report extends CoreModel
{
    protected $table        = 'admin_report';
    protected $fillable     = ['id', 'subject', 'emails', 'cc', 'schedule_frequency', 'filename', 'extension', 'sql'];
}