<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class CronJob
 * @package Syscover\Admin\Models
 */

class CronJob extends CoreModel
{
	protected $table        = 'cron_job';
    public $timestamps      = false;

    private static $rules   = [
        'name'              =>  'required|between:2,100',
        'package'           =>  'not_in:null',
        'cronExpression'    =>  'required|between:9,255|CronExpression',
        'key'               =>  'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query
            ->join('package', 'cron_job.package_id', '=', 'package.id')
            ->select('package.*', 'cron_job.*', 'package.name as package_name', 'cron_job.name as cron_job_name');
    }

    public static function getCronJobsToRun($date)
    {
        return CronJob::builder()->where('next_run', '<=', $date)->where('active', true)->get();
    }
}