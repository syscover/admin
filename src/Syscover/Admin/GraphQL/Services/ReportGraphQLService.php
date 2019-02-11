<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use Syscover\Admin\Services\ReportService;
use Syscover\Admin\Models\Report;

class ReportGraphQLService extends CoreGraphQLService
{
    protected $model = Report::class;
    protected $service = ReportService::class;

    public function run($root, array $args)
    {
        $report = Report::find($args['id']);
        $file = ReportService::executeReport($report);
        $report->file = [
            'pathname'  => $file->getPathname(),
            'mime'      => $file->getMimeType(),
            'size'      => $file->getSize()
        ];

        return $report;
    }
}
