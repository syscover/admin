<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\Mail;
use Syscover\Admin\Mail\ReportMail;
use Syscover\Admin\Models\Report;

class CronService
{
    public static function checkReports($frequency)
    {
        $reports = Report::builder()->where('frequency_id', $frequency)->get();

        info('Call Syscover\Admin\Services\CronService::checkReports function with frequency: ' . $frequency . ', get ' . $reports->count() . ' reports');

        foreach ($reports as $report)
        {
            $response = ReportService::executeReport($report);

            Mail::to($report->emails)->queue(new ReportMail($response));
        }
    }
}
