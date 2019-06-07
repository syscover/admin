<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use Syscover\Admin\Services\ReportService;
use Syscover\Admin\Models\Report;

class ReportGraphQLService extends CoreGraphQLService
{
    public function __construct(Report $model, ReportService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

    public function run($root, array $args)
    {
        $report         = Report::find($args['id']);
        $report->file   = ReportService::executeReport($report);

        return $report;
    }
}
