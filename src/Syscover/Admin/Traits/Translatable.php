<?php namespace Syscover\Admin\Traits;

use Syscover\Admin\Models\Lang;

trait Translatable
{
    public function lang()
    {
        return $this->belongsTo(Lang::class, 'lang_id');
    }
}
