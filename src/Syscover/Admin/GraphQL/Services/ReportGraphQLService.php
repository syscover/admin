<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use Syscover\Admin\Services\ReportService;
use Syscover\Admin\Models\Report;

class ReportGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Report::class;
    protected $serviceClassName = ReportService::class;
}