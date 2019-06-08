<?php namespace Syscover\Admin\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Syscover\Admin\Models\Report;

class CronService
{
    public static function checkReports($frequency)
    {
        info('Call Syscover\Admin\Services\CronService::checkReports function with frequency: ' . $frequency);

        $reports = Report::builder()->where('frequency_id', $frequency)->get();
        foreach ($reports as $report)
        {
            ReportService::executeReport($report);
        }
    }
}
