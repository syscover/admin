<?php namespace Syscover\Admin\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Syscover\Admin\Models\Report;

class CronService
{
    public static function checkDailyReports()
    {
        info('Call Syscover\Admin\Services\CronService::checkDailyReports function');

        $reports = Report::builder()->where('frequency_id', 2)->get();

        foreach ($reports as $report)
        {
            ReportService::executeReport($report);
        }
    }

    public static function checkWeeklyReports()
    {
        info('Call Syscover\Admin\Services\CronService::checkWeeklyReports function');
    }

    public static function checkMonthlyReports()
    {

    }

    public static function checkQuarterlyReports()
    {

    }

    public static function checkYearlyReports()
    {

    }
}