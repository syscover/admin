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
     * @param $mime mime type
     * @return bool
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

if (! function_exists('srcset')) {

    /**
     * get srcset for responsive images
     *
     * @param $attachment
     * @return string
     */
    function srcset($attachment)
    {
        $srcset = $attachment->url . ' ' . $attachment->width . 'w';

        if(isset($attachment->data['sizes']) && is_array($attachment->data['sizes']))
        {
            foreach ($attachment->data['sizes'] as $size)
            {
                $srcset .= ' ,' . $size['url'] . ' ' .  $size['width'] . 'w';
            }
        }

        return $srcset;
    }
}
