<?php

if (! function_exists('base_lang')) {
    /**
     * Get base lang object from session.
     *
     * @return \Syscover\Admin\Models\Lang
     */
    function base_lang()
    {
        if(session('baseLang') === null)
            session(['baseLang' => \Syscover\Admin\Models\Lang::getBaseLang()]);

        return session('baseLang');
    }
}
