<?php namespace Syscover\Admin\Traits;

use Syscover\Admin\Models\FieldGroup;

trait CustomizableFields
{
    public function fieldGroup()
    {
        return $this->belongsTo(FieldGroup::class, 'field_group_id');
    }
}
