<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\FieldValue;
use Syscover\Admin\Services\FieldValueService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class FieldValueGraphQLService extends CoreGraphQLService
{
    protected $model = FieldValue::class;
    protected $service = FieldValueService::class;
}