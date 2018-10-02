<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Field;
use Syscover\Admin\Services\FieldService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class FieldGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Field::class;
    protected $serviceClassName = FieldService::class;
}