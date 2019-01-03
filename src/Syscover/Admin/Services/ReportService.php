<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Report;

class ReportService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return Report::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        Report::where('id', $object['id'])->update(self::builder($object));

        return Report::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only([
            'subject',
            'emails',
            'filename',
            'extension',
            'frequency_id',
            'sql'
        ])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['subject']))       throw new \Exception('You have to define a subject field to create a report');
        if(empty($object['emails']))        throw new \Exception('You have to define a emails field to create a report');
        if(empty($object['filename']))      throw new \Exception('You have to define a filename field to create a report');
        if(empty($object['extension']))     throw new \Exception('You have to define a extension field to create a report');
        if(empty($object['frequency_id']))  throw new \Exception('You have to define a frequency_id field to create a report');
        if(empty($object['sql']))           throw new \Exception('You have to define a sql field to create a report');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))    throw new \Exception('You have to define a id field to update a report');
    }
}