<?php namespace Syscover\Admin\Services;

use Carbon\Carbon;
use Syscover\Admin\Models\CronJob;

class CronJobService
{
    /**
     * @param  array    $object     contain properties of cron job
     * @return \Syscover\Admin\Models\CronJob
     */
    public static function create($object)
    {
        $object['last_run'] = empty($object['last_run']) ? null : (new Carbon(preg_replace('/\(.*\)/','', $object['last_run']), config('app.timezone')))->toDateTimeString();
        $object['next_run'] = empty($object['next_run']) ? null : (new Carbon(preg_replace('/\(.*\)/','', $object['next_run']), config('app.timezone')))->toDateTimeString();

        return  CronJob::create($object)->fresh();
    }

    /**
     * @param array     $object     contain properties of cron job
     * @return \Syscover\Admin\Models\CronJob
     */
    public static function update($object)
    {
        $object = collect($object);

        CronJob::where('id', $object->get('id'))->update([
            'name'              => $object->get('name'),
            'package_id'        => $object->get('package_id'),
            'cron_expression'   => $object->get('cron_expression'),
            'command'           => $object->get('command'),
            'last_run'          => $object->has('last_run') ? (new Carbon(preg_replace('/\(.*\)/','', $object->get('last_run')), config('app.timezone')))->toDateTimeString() : null,
            'next_run'          => $object->has('next_run') ? (new Carbon(preg_replace('/\(.*\)/','', $object->get('next_run')), config('app.timezone')))->toDateTimeString() : null,
            'active'            => $object->get('active')
        ]);

        return CronJob::find($object->get('id'));
    }
}