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

if (! function_exists('get_src'))
{
    /**
     * get bigest image
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

if (! function_exists('get_size_src'))
{
    /**
     * get images with determinate $width and $height pixels
     *
     * @param   $attachment
     * @param   int $width
     * @param   int $height
     * @return  null|string
     */
    function get_size_src($attachment, int $width, int $height = 0)
    {
        if(! is_object($attachment))
            $attachment = (object)$attachment;

        if(! isset($attachment->data['sizes']) || (isset($attachment->data['sizes']) && ! is_array($attachment->data['sizes'])))
            return null;

        $sizes = collect($attachment->data['sizes'])->sortBy('width');

        foreach ($sizes as $size)
        {
            if($size['width'] >= $width && $size['height'] >= $height) {
                return $size['url'];
            }
        }

        return $sizes->last()['url'];
    }
}

if (! function_exists('get_srcset'))
{
    /**
     * get get_srcset from sizes
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
        if(! is_object($attachment) || (is_object($attachment) && get_class($attachment) !== 'Syscover\Admin\Models\Attachment'))
        {
            if(! is_object($attachment)) $attachment = (object)$attachment;
            if(! property_exists($attachment, 'alt')) throw new Exception('attachment has to be a object with alt property');
            if(! property_exists($attachment, 'title')) throw new Exception('attachment has to be a object with title property');
            if(! property_exists($attachment, 'data')) throw new Exception('attachment has to be a object with data property');
        }

        $value = get_src_srcset($attachment);
        return $value . ' alt="' . $attachment->alt . '" title="' . $attachment->title . '"';
    }
}


if (! function_exists('has_scout'))
{
    /**
     * function to know if scout is configured
     *
     * @return  boolean
     */
    function has_scout()
    {
        return  config('scout.driver') === 'algolia' || config('scout.driver') === 'pulsar-search';
    }
}

if (! function_exists('package_version'))
{
    /**
     * function to know if scout is configured
     *
     * @return  boolean
     */
    function package_version(\Syscover\Admin\Models\Package $package)
    {
        // get path of version file
        $path = env('APP_ENV') === 'production' ?
            'vendor/syscover/pulsar-' . $package->root . '/src/version.php' :
            'workbench/syscover/pulsar-' . $package->root . '/src/version.php';

        if (file_exists(base_path($path)))
        {
            $version = require base_path($path);
            return $version['version'];
        }

        return null;
    }
}
