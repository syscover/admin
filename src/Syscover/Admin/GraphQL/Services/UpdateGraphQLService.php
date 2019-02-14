<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        $packageIds = Package::where('active', true)->get()->pluck('id');



        // comprobar en el servidor de versiones que si los paquetes tienen actualizaciones

        return true;
    }
}
