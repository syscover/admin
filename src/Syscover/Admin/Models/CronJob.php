<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class CronJob
 * @package Syscover\Admin\Models
 */

class CronJob extends CoreModel
{
	protected $table        = 'admin_cron_job';
    protected $fillable     = ['id', 'name', 'package_id', 'cron_expression', 'command', 'last_run', 'next_run', 'active'];
    protected $casts        = [
        'active'    => 'boolean'
    ];

    private static $rules   = [
        'name'              =>  'required|between:2,100',
        'package'           =>  'not_in:null',
        'cronExpression'    =>  'required|between:9,255|CronExpression',
        'command'           =>  'required|between:2,255'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query
            ->join('admin_package', 'admin_cron_job.package_id', '=', 'admin_package.id')
            ->select('admin_package.*', 'admin_cron_job.*', 'admin_package.name as package_name', 'admin_cron_job.name as cron_job_name');
    }

    public static function getCronJobsToRun($timestamp)
    {
        return CronJob::where('next_run', '<=', $timestamp)->where('active', true)->get();
    }
}