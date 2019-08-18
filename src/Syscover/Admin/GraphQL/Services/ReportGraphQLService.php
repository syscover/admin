<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Core\Services\SQLService;
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

    public function find($root, array $args)
    {
        $query = SQLService::getQueryFiltered($this->model->builder(), $args['sql'], $args['filters'] ?? null);

        // we need transform object to array
        $report = $query->first()->toArray();
        
        $reportRelations = collect(config('pulsar-admin.report_data_sources'));

        if (is_array($report['wildcards']))
        {
            foreach($report['wildcards'] as &$wildcard) 
            {
                $reportRelation = $reportRelations->firstWhere('id', $wildcard['data_source_id']);
    
                if ($wildcard['data_source_id'] ?? false && $reportRelation)
                {
                    if ($reportRelation->type === 'database')
                    {
                        $model = new $reportRelation->model();
                        $values = $model->all();
                    }
                    elseif($reportRelation->type === 'config')
                    {
                        $values = collect(config($reportRelation->model));
                    }
    
                    // set values for options
                    $wildcard['option_values'] = $values->map(function($value) use ($wildcard, $reportRelation)
                    {
                        return ['id' => $value->{$reportRelation->option_id}, 'name' => $value->{$reportRelation->option_name}];
                    });
                }
            }
        }
        
        return $report;
    }

    public function run($root, array $args)
    {
        $report = Report::find($args['id']);

        // replace wildcards
        foreach($report->wildcards as $wildcard) 
        {
            if (! empty($wildcard['value']))
            {
                $report->sql = str_replace('#' . $wildcard['name'] . '#', $wildcard['value'], $report->sql);
            }
        }

        return ReportService::executeReport($report);
    }
}
