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

if (! function_exists('set_srcset')) {

    /**
     * get set_srcset for responsive images
     *
     * @param $attachment
     * @return string
     */
    function set_srcset($attachment)
    {
        if(! isset($attachment->data['sizes']) && is_array($attachment->data['sizes']))
            return null;

        $sizes = collect($attachment->data['sizes'])->sortBy('width');

        $srcset = '';
        $src = '';
        $indexSmallerImg = $sizes->count() -1;
        foreach ($sizes as $key => $size)
        {
            // set src
            if($key === $indexSmallerImg)
            {
                $src .= $size['url'];
            }
            else
            {
                $srcset .= $size['url'] . ' ' . $size['width'] . 'w, ';
            }
        }

        // set biggest image
        $srcset .= $attachment->url . ' ' . $attachment->width . 'w';

        return 'src="' . $src . '" srcset="' . $srcset . '"';
    }
}
