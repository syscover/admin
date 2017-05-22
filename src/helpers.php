<?php

if (! function_exists('base_lang')) {
    /**
     * Get base lang object from config file.
     *
     * @return string
     */
    function base_lang()
    {
        return config('pulsar.admin.base_lang');
    }
}

if (! function_exists('is_image')) {
    /**
     * check if is image by mime.
     *
     * @return string
     */
    function is_image($mime)
    {
        switch ($mime) {
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/png':
            case 'image/svg+xml':
                return true;
                break;
            default:
                return false;
        }
    }
}
