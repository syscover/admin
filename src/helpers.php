<?php

if (! function_exists('base_lang'))
{
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

if (! function_exists('is_image'))
{
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

if (! function_exists('get_src_srcset'))
{
    /**
     * get get_src_srcset for responsive images
     *
     * @param $attachment
     * @return string
     */
    function get_src_srcset($attachment)
    {
        if(! isset($attachment->data['sizes']) && is_array($attachment->data['sizes']))
            return null;

        $sizes = collect($attachment->data['sizes'])->sortBy('width');

        $smallerWidth = $sizes->first()['width'];
        $biggestWidth = $sizes->last()['width'];
        $srcset = '';
        $src = '';
        foreach ($sizes as $size)
        {
            // set src
            if($size['width'] === $smallerWidth)
                $src = $size['url'];
            else
                $srcset .= $size['url'] . ' ' . $size['width'] . 'w' . ($biggestWidth === $size['width']? null : ', ');

        }

        return 'src="' . $src . '" srcset="' . $srcset . '"';
    }


}

if (! function_exists('get_src'))
{
    /**
     * get get_src from sizes
     *
     * @param $sizes
     * @return string
     */
    function get_src($sizes)
    {
        $sizes = collect($sizes)->sortBy('width');

        return $sizes->first()['url'];
    }
}

if (! function_exists('get_srcset'))
{
    /**
     * get get_src from sizes
     *
     * @param $sizes
     * @return string
     */
    function get_srcset($sizes)
    {
        $sizes = collect($sizes)->sortBy('width');

        $smallerWidth = $sizes->first()['width'];
        $biggestWidth = $sizes->last()['width'];
        $srcset = '';
        foreach ($sizes as $size)
        {
            // set src
            if($size['width'] !== $smallerWidth)
                $srcset .= $size['url'] . ' ' . $size['width'] . 'w' . ($biggestWidth === $size['width']? null : ', ');
        }

        return $srcset;
   }
}
