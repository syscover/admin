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

    public static function executeReport(Report $report)
    {
        // Execute query from report task
        $response = DB::select(DB::raw($report->sql));

        if (count($response) === 0) return null;

        switch ($report->extension)
        {
            case 'csv':

                break;
            case 'xls':

                break;
            case 'xlsx':

                break;
        }

        $response = Excel::download(new ReportExport($report->sql), 'invoices.' . $report->extension);

        return $response->getFile();

        // dd($response->getFile()->getMimeType());
        // dd($response->getFile()->getPathname());

        // get MIME to define Content-Type
//        $mime = finfo_file(finfo_open (), 'image.jpg', FILEINFO_MIME_TYPE);
//        header('Content-Type: ' . $mime);
//        readfile('image.jpg');
//        exit();

//        $response = Excel::download(new ReportExport($report->sql), 'invoices.xlsx');
//        $response->trustXSendfileTypeHeader();
//        $response->setContentDisposition(\Symfony\Component\HttpFoundation\ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'invoices.xlsx', iconv('UTF-8', 'ASCII//TRANSLIT', 'invoices.xlsx'));
//
//        dd($response);
//        return $response;

        // dd($response);

        // $response = self::castingNumericData($response);

        // format response to manage with collections
//        $response = collect(array_map(function($item) {
//            return collect($item);
//        }, $response));


        // $report->operation_rows;
        //$filename = $report->filename . '-' . uniqid();


        // Excel::download();




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

    /*
     * Transform string data to number data, to operate with excel
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

class ReportExport implements FromCollection
{
    private $sql;

    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    public function collection()
    {
        $response = DB::select(DB::raw($this->sql));
        return collect($response);
    }
}