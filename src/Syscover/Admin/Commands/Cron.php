<?php namespace Syscover\Admin\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Cron\CronExpression;
use Syscover\Admin\Models\CronJob;

class Cron extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'cron {--v : Cron version}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command to run cron jobs';

    /**
     * Cron constructor.
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
        if($this->option('v'))
        {
            $this->line("Cron Version 1.3");
            exit;
        }

        $now        = Carbon::now(config('app.timezone'))->toDateTimeString();
        $cronJobs   = CronJob::getCronJobsToRun($now);

        foreach($cronJobs as $cronJob)
        {
			call_user_func($cronJob->command); // call to static method

            $cron = CronExpression::factory($cronJob->cron_expression);

            CronJob::where('id', $cronJob->id)->update([
                'last_run'  => $now,
                'next_run'  => $cron->getNextRunDate()->format('Y-m-d H:i:s')
            ]);
        }
	}
}