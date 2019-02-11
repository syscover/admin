<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\FieldValue;
use Syscover\Admin\Services\FieldValueService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use Syscover\Core\Services\SQLService;

class FieldValueGraphQLService extends CoreGraphQLService
{
    public function __construct(FieldValue $model, FieldValueService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

    public function delete($root, array $args)
    {
        $object = SQLService::deleteRecord($args['id'], get_class($this->model), $args['lang_id'] ?? null, null, ['field_id' => $args['field_id']]);

        return $object;
    }
}
