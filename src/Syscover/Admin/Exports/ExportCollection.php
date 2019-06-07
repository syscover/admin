<?php namespace Syscover\Admin\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCollection implements FromCollection
{
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function collection()
    {
        return collect($this->collection);
    }
}
