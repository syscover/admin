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
        return config('pulsar-admin.base_lang');
    }
}

if (! function_exists('cestn'))
{
    /**
     * convert empty string to null
     *
     * @return string | null
     */
    function cestn($value)
    {
        return is_string($value) && $value === '' ? null : $value;
    }
}

if (! function_exists('array_cestn'))
{
    /**
     * convert empty string to null in all array
     *
     * @return array
     */
    function array_cestn($array)
    {
        foreach ($array as &$item)
            $item = cestn($item);

        return $array;
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

if (! function_exists('get_territorial_area_id'))
{
    /**
     * get territorial area id from country zone
     *
     * @return string
     */
    function get_territorial_area_id($zone)
    {
        switch ($zone) {
            case 'territorial_areas_1':
                return 'territorial_area_1_id';
                break;
            case 'territorial_areas_2':
                return 'territorial_area_2_id';
                break;
            case 'territorial_areas_3':
                return 'territorial_area_3_id';
                break;
        }
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

        $biggestWidth = $sizes->last()['width'];
        $srcset = '';
        foreach ($sizes as $size)
        {
            $srcset .= $size['url'] . ' ' . $size['width'] . 'w' . ($biggestWidth === $size['width']? null : ', ');
        }

        return $srcset;
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
        if(! is_object($attachment))
            $attachment = (object)$attachment;

        if(! isset($attachment->data['sizes']) || (isset($attachment->data['sizes']) && ! is_array($attachment->data['sizes'])))
            return null;

        $src    = get_src($attachment->data['sizes']);    // set original image, for older browsers
        $srcset = get_srcset($attachment->data['sizes']);

        return 'src="' . $src . '" srcset="' . $srcset . '"';
    }
}

if (! function_exists('get_src_srcset_alt_title'))
{
    /**
     * get get_src_srcset for responsive images
     *
     * @param   $attachment
     * @return  string
     * @throws  Exception
     */
    function get_src_srcset_alt_title($attachment)
    {
        if(is_object($attachment) && get_class($attachment) === 'Syscover\Admin\Models\Attachment')
        {
            $value = get_src_srcset($attachment);
            return $value . ' alt="' . $attachment->alt . '" title="' . $attachment->title . '"';
        }

        throw new Exception('attachment has to be a object from Syscover\Admin\Models\Attachment class');
    }
}

if (! function_exists('get_src'))
{
    /**
     * get smaller image
     *
     * @param $sizes
     * @return string
     */
    function get_src($sizes)
    {
        $sizes = collect($sizes)->sortBy('width');

        return $sizes->last()['url']; // set original image, for older browsers
    }
}
