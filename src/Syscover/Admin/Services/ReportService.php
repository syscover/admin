<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
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

        if(! empty($object['emails'])) $object['emails'] = json_encode($object['emails']);

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

    /**
     * @param Report $report
     * @return \Symfony\Component\HttpFoundation\File\File|null
     */
    public static function executeReport(Report $report)
    {
        // Execute query from report task
        $response = DB::select(DB::raw($report->sql));

        if (count($response) === 0) return null;

        $response = Excel::download(new ReportExport($response), $report->filename . $report->extension);

        return $response->getFile();

        // $response = self::castingNumericData($response);

        // format response to manage with collections
//        $response = collect(array_map(function($item) {
//            return collect($item);
//        }, $response));


//        $spreadsheet = new Spreadsheet();
//
//        // set properties
//        $spreadsheet->getProperties()
//            ->setTitle($report->subject)
//            ->setCreator('DH2');
//
//
//        // header style
//        $headerStyle = new Style();
//        $headerStyle->applyFromArray([
//            'font' => [
//                'bold' => true
//            ],
//            'fill' => [
//                'fillType' => Fill::FILL_SOLID,
//                'color' => ['rgb' => '204204204'],
//            ]
//        ]);
//
//        // set data headers from array
//        $worksheet = $spreadsheet->getActiveSheet()
//            ->fromArray($response->first()->keys()->toArray(), null, 'A1', true);
//
//        // set data headers from array
//        $worksheet->duplicateStyle($headerStyle, 'A1:' . $worksheet->getHighestDataColumn() . '1')
//            ->fromArray($response->toArray(), null, 'A2', true);
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

/**
 * Class to export from collection
 *
 * Class ReportExport
 * @package Syscover\Admin\Services
 */
class ReportExport implements FromCollection
{
    private $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function collection()
    {
        return collect($this->report);
    }
}