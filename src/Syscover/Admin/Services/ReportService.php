<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Syscover\Admin\Exports\ExportCollection;
use Syscover\Core\Services\Service;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Admin\Models\Report;

class ReportService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'subject'       => 'required|between:2,255',
            'emails'        => 'required|array',
            'profiles'      => 'required|array',
            'filename'      => 'required|between:2,255',
            'extension'     => 'required|between:2,255',
            'frequency_id'  => 'required|integer'
        ]);

        return Report::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'id'            => 'numeric',
            'subject'       => 'required|between:2,255',
            'emails'        => 'required|array',
            'profiles'      => 'required|array',
            'filename'      => 'required|between:2,255',
            'extension'     => 'required|between:2,255',
            'frequency_id'  => 'required|integer'
        ]);

        $object = Report::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }

    public static function executeReport(Report $report)
    {
        // Execute query from report task
        $response = DB::select(DB::raw($report->sql));

        if (count($response) === 0) return null;

        $filename = $report->filename . '-' . Str::uuid() . '.' . $report->extension;
        $filePath = 'public/admin/reports/' . $filename;

        Excel::store(new ExportCollection($response), $filePath, 'local');

        $pathname = 'app/' . $filePath;
        $absoluteRoute = storage_path($pathname);

        return [
            'url'       => asset('storage/admin/reports/' . $filename),
            'filename'  => $filename,
            'pathname'  => $pathname,
            'mime'      => mime_content_type($absoluteRoute),
            'size'      => filesize($absoluteRoute)
        ];
    }

    /**
     * Transform string data to number data, to operate with excel
     *
     * @param array $response
     * @return array
     */
    private static function castingNumericData(array $response)
    {
        foreach ($response as &$object)
        {
            $fields = get_object_vars($object);
            foreach ($fields as $key => $value)
            {
                if(is_numeric($value) && strpos($value, '.') === false)
                {
                    $object->{$key} = (int) $value;
                }
                elseif(is_numeric($value) && strpos($value, '.') !== false)
                {
                    $object->{$key} = (float) $value;
                }
            }
        }
        return $response;
    }
}
