<?php namespace Syscover\Admin\Services;

use function GuzzleHttp\Psr7\mimetype_from_extension;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Models\AttachmentLibrary;

/**
 * Class AttachmentService
 * @package Syscover\Admin\Service
 */
class AttachmentService
{
    const CROP_FIT = 1;
    const WIDTH_FIT = 2;
    const HEIGHT_FIT = 3;
    const WIDTH_FREE_CROP_FIT = 4;
    const HEIGHT_FREE_CROP_FIT = 5;

    /**
     * Function to store attachments library elements
     * @param $attachments array
     * @return mixed
     */
    public static function storeAttachmentsLibrary($attachments)
    {
        if(! File::exists(base_path('storage/app/public/library')))
        {
            File::makeDirectory(base_path('storage/app/public/library'), 0755, true);
        }

        foreach($attachments as &$attachment)
        {
            // only save new attachments in library
            if(! empty($attachment['uploaded'])  && $attachment['uploaded'] === true)
            {
                // get attachment library from attachment
                $attachmentLibrary = $attachment['attachment_library'];

                // move file from temp file to attachment directory
                File::move($attachmentLibrary['base_path'] . '/' . $attachmentLibrary['file_name'], base_path('storage/app/public/library/' . $attachmentLibrary['file_name']));

                $object = AttachmentLibrary::create([
                    'name'          => $attachmentLibrary['name'],
                    'base_path'     => base_path('storage/app/public/library'),
                    'file_name'     => $attachmentLibrary['file_name'],
                    'url'           => asset('storage/library/' . $attachmentLibrary['file_name']),
                    'mime'          => $attachmentLibrary['mime'],
                    'extension'     => $attachmentLibrary['extension'],
                    'size'          => $attachmentLibrary['size'],
                    'width'         => $attachmentLibrary['width'] ?? null,
                    'height'        => $attachmentLibrary['height'] ?? null,
                    'data'          => $attachmentLibrary['data'] ?? null
                ]);

                // set attachment library by reference
                $attachment['attachment_library']['id'] = $object->id;
            }
        }

        return $attachments;
    }

    public static function storeAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId)
    {
        self::manageAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId, 'store');
    }

    public static function updateAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId)
    {
        self::manageAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId, 'update');
    }

    /**
     *  Function to store attachment elements
     *
     * @access	public
     * @param   array       $attachments
     * @param   string      $directory
     * @param   string      $urlBase
     * @param   string      $objectType
     * @param   integer     $objectId
     * @param   string      $langId
     * @param   string      $action
     *
     */
    private static function manageAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId, $action)
    {
        if(! File::exists(base_path($directory . '/' . $objectId)))
        {
            File::makeDirectory(base_path($directory . '/' . $objectId), 0755, true);
        }

        foreach($attachments as $attachment)
        {
            // store new attachments, if is a store or update action
            if(! empty($attachment['uploaded']) && $attachment['uploaded'] === true)
            {
                $id = Attachment::max('id');
                $id++;

                // move file from temp file to attachment directory
                File::move($attachment['base_path'] . '/' . $attachment['file_name'], base_path($directory . '/' . $objectId . '/' . $attachment['file_name']));

                $attachmentObject = Attachment::create([
                    'id'                    => $id,
                    'lang_id'               => $langId,
                    'object_id'             => $objectId,
                    'object_type'           => $objectType,
                    'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                    'sort'                  => $attachment['sort'] ?? null,
                    'alt'                   => $attachment['alt'] ?? null,
                    'title'                 => $attachment['title'] ?? null,
                    'base_path'             => base_path($directory . '/' . $objectId),
                    'file_name'             => $attachment['file_name'],
                    'url'                   => asset($urlBase . '/' . $objectId . '/' . $attachment['file_name']),
                    'mime'                  => $attachment['mime'],
                    'extension'             => $attachment['extension'],
                    'size'                  => $attachment['size'],
                    'width'                 => $attachment['width'] ?? null,
                    'height'                => $attachment['height']  ?? null,
                    'library_id'            => $attachment['attachment_library']['id'] ?? null,
                    'library_file_name'     => $attachment['attachment_library']['file_name'] ?? null,
                    'data'                  => $attachment['data'] ?? null
                ]);


                // set fit attachment
                self::setAttachmentFit($attachmentObject);

                // create sizes from image
                self::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
            }
            else
            {
                // action is update object
                if($action === 'update')
                {
                    $attachmentOld = Attachment::where('id', $attachment['id'])
                        ->where('lang_id', $attachment['lang_id'])
                        ->first();

                    Attachment::where('id', $attachment['id'])
                        ->where('lang_id', $attachment['lang_id'])
                        ->update([
                            'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                            'sort'                  => $attachment ?? null,
                            'alt'                   => $attachment['alt'] ?? null,
                            'title'                 => $attachment['title'] ?? null,
                            'file_name'             => $attachment['file_name'],
                            'url'                   => $attachment['url'],
                            'mime'                  => $attachment['mime'],
                            'extension'             => $attachment['extension'],
                            'size'                  => $attachment['size'],
                            'width'                 => $attachment['width']  ?? null,
                            'height'                => $attachment['height']  ?? null,
                            'data'                  => is_array($attachment['data']) ?  json_encode(array_merge($attachment['data'], $attachmentOld->data)) : json_encode($attachmentOld->data)
                        ]);

                    // get attachment object to create sizes
                    $attachmentObject = Attachment::where('id', $attachment['id'])
                        ->where('lang_id', $attachment['lang_id'])
                        ->first();

                    if ($attachment['changed_image'] || ($attachmentOld->family_id !== $attachmentObject->family_id))
                    {
                        // set fit attachment
                        self::setAttachmentFit($attachmentObject);

                        // create sizes from image
                        self::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
                    }
                }
                // method to create attachment in new lang object
                elseif ($action === 'store')
                {
                    $newFileName = self::getRandomFilename($attachment['extension']);

                    // move file from temp file to attachment directory
                    File::copy($attachment['base_path'] . '/' . $attachment['file_name'], $attachment['base_path'] . '/' . $newFileName);

                    // store new lang attachment that previous exist in database
                    $attachmentObject = Attachment::create([
                        'id'                    => $attachment['id'],
                        'lang_id'               => $langId,
                        'object_id'             => $objectId,
                        'object_type'           => $objectType,
                        'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                        'sort'                  => $attachment['sort'] ?? null,
                        'alt'                   => $attachment['alt'] ?? null,
                        'title'                 => $attachment['title'] ?? null,
                        'base_path'             => $attachment['base_path'],
                        'file_name'             => $newFileName,
                        'url'                   => asset($urlBase . '/' . $objectId . '/' . $newFileName),
                        'mime'                  => $attachment['mime'],
                        'extension'             => $attachment['extension'],
                        'size'                  => $attachment['size'],
                        'width'                 => $attachment['width'] ?? null,
                        'height'                => $attachment['height'] ?? null,
                        'library_id'            => $attachment['attachment_library']['id'] ?? null,
                        'library_file_name'     => $attachment['attachment_library']['file_name'] ?? null,
                        'data'                  => $attachment['data'] ?? null
                    ]);

                    // set fit attachment
                    self::setAttachmentFit($attachmentObject);

                    // create sizes from image
                    self::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
                }
            }
        }
    }

    private static function setAttachmentFit($attachment)
    {
        if ($attachment->family && ($attachment->family->fit_type === self::WIDTH_FIT || $attachment->family->fit_type === self::HEIGHT_FIT))
        {
            // http://image.intervention.io with imagemagick
            Image::configure(['driver' => 'imagick']);
            $image = Image::make(base_path('storage/app/public/library') . '/' . $attachment->library_file_name);

            $proportion = $attachment->width / $attachment->height;

            if ($attachment->family->fit_type === self::WIDTH_FIT && $attachment->family->width > 0)
            {
                $attachment->width = $attachment->family->width;
                $attachment->height = $attachment->family->width / $proportion;

                $image->resize($attachment->width, $attachment->height);
            }
            elseif ($attachment->family->fit_type === self::HEIGHT_FIT && $attachment->family->height > 0)
            {
                $attachment->height = $attachment->family->height;
                $attachment->width = $attachment->family->height * $proportion;

                $image->resize($attachment->width, $attachment->height);
            }

            // save image
            $image->save($attachment->base_path . '/' . $attachment->file_name);

            // save attachment in database
            $attachment->save();
        }
    }

    /**
     * Manage responsive sizes and save in database
     *
     * @param $attachment
     * @param $urlBase
     * @param $objectId
     */
    private static function setAttachmentSizes($attachment, $urlBase, $objectId)
    {
        // check that attachment has family id and is a image
        if(! empty($attachment->family_id) && is_image($attachment->mime))
        {
            // get attachmentFamily
            $attachmentFamily = $attachment->family;

            if(is_array($attachmentFamily->sizes) && count($attachmentFamily->sizes) > 0)
            {
                // original size and biggest size
                $sizes[] = [
                    "size"      => 0,
                    "width"     => $attachment->width,
                    "height"    => $attachment->height,
                    "base_path" => $attachment->base_path,
                    "file_name" => $attachment->file_name,
                    "url"       => asset($urlBase . '/' . $objectId . '/' . $attachment->file_name)
                ];

                foreach ($attachmentFamily->sizes as $size)
                {
                    // calculate percentage that we need from image
                    $percentage = 100 - $size;

                    $width = intval(($attachment->width * $percentage) / 100);
                    $height = intval(($attachment->height * $percentage) / 100);

                    /**
                     * config http://image.intervention.io with imagemagick
                     */
                    Image::configure(['driver' => 'imagick']);
                    $image = Image::make($attachment->base_path . '/' . $attachment->file_name);
                    $image->resize($width, $height);
                    $image->save($attachment->base_path . '/' . $size . '@_' . $attachment->file_name);

                    $sizes[] = [
                        "size"      => $size,
                        "width"     => $width,
                        "height"    => $height,
                        "base_path" => $attachment->base_path,
                        "file_name" => $size . '@_' . $attachment->file_name,
                        "url"       => asset($urlBase . '/' . $objectId . '/' . $size . '@_' . $attachment->file_name)
                    ];
                }

                $dataAttachment = $attachment->data;
                $dataAttachment['sizes'] = $sizes;

                // overwrite sizes field
                Attachment::where('id', $attachment->id)
                    ->where('lang_id', $attachment->lang_id)
                    ->update([
                        'data' => json_encode($dataAttachment)
                    ]);
            }
        }
    }

    /**
     * @param $article
     * @param $directory
     * @param $urlBase
     * @param $id
     * @return null|string
     */
    public static function manageWysiwygAttachment($article, $directory, $urlBase, $id)
    {
        if(empty($article)) return null;

        // load element and get img tags
        $doc = new \DOMDocument();

        // set error level to avoid errors when links has & symbol
        $internalErrors = libxml_use_internal_errors(true);

        $doc->loadHTML($article);

        // Restore error level
        libxml_use_internal_errors($internalErrors);

        $tags = $doc->getElementsByTagName('img');
        $hasSaved = false;

        foreach ($tags as $tag)
        {
            // search class dh2-uploaded
            $classes = preg_split('/\s+/', $tag->getAttribute('class'));
            $newClasses = [];
            $uploaded = false;
            $attachmentFamilyClass = false;
            foreach ($classes as $class)
            {
                // know if has any image was uploaded
                if($class === 'dh2-uploaded')
                    $uploaded = true;
                elseif(strrpos($class, 'dh2-attachment-family') !== 0)
                    $newClasses[] = $class;

                // get attachement family class if has anyone
                if(strrpos($class, 'dh2-attachment-family') === 0)
                    $attachmentFamilyClass = $class;
            }

            if($uploaded)
            {
                // get data element insert in editor.component.ts line 112
                $attachment = json_decode($tag->getAttribute('data-dh2-image'));

                $sizes = self::setWysiwygAttachmentSizes($attachment, $directory, $urlBase, $id, $attachmentFamilyClass);

                $tag->setAttribute('src', get_src($sizes));
                $tag->setAttribute('srcset', get_srcset($sizes));
                $tag->removeAttribute('data-dh2-image');

                $tag->removeAttribute('style'); // delete all image styles

                // set max-width
                $sizes = collect($sizes)->sortBy('width');
                $tag->setAttribute('style', 'max-width:' . $sizes->last()['width'] . 'px; width:100%;');

                if($tag->hasAttribute('data-image')) $tag->removeAttribute('data-image'); // useless attribute added by Froala

                if($newClasses != null) $tag->setAttribute('class', implode(' ', $newClasses));
                $hasSaved = true;
            }
        }

        if($hasSaved)
            return $doc->saveHTML();

        return null;
    }


    private static function setWysiwygAttachmentSizes($attachment, $directory, $urlBase, $objectId, $attachmentFamilyClass, $inputSizes = [25, 50, 75])
    {
        // manage AttachmentFamily, format and resize image
        if($attachmentFamilyClass)
        {
            $attachmentFamily = AttachmentFamily::builder()
                ->where('admin_attachment_family.id', explode('-', $attachmentFamilyClass)[3])
                ->first();

            // set sizes from attachmentFamilies
            if(is_array($attachmentFamily->sizes) && count($attachmentFamily->sizes) > 0)
                $inputSizes = $attachmentFamily->sizes;
            else
                $inputSizes = []; // if has not sizes, reset sizes array

            /**
             * config http://image.intervention.io with imagemagick
             */
            Image::configure(['driver' => 'imagick']);
            $image = Image::make($attachment->base_path . '/' . $attachment->file_name);

            // set format from attachment family
            // TODO este if se puede hacer una función, código usado en AttachmentMutation line 50
            if(! empty($attachmentFamily->format) && mimetype_from_extension($attachmentFamily->format) !== $attachment->mime)
            {
                $image = $image->encode($attachmentFamily->format, 100); // set format image

                $attachment->file_name  = basename($attachment->file_name, '.' . $attachment->extension) . '.' . $attachmentFamily->format;
                $attachment->extension  = $attachmentFamily->format; // change extension file

                // change extension file of url
                $url = pathinfo($attachment->url);
                $attachment->url = $url['dirname'] . '/' . $url['filename'] . '.' . $attachmentFamily->format;
                // get mime type
                $attachment->mime   = mimetype_from_extension($attachment->extension);
            }

            // Resize image proportionally to given width
            $image->widen($attachmentFamily->width);
            $image->save(
                $attachment->base_path . '/' . $attachment->file_name,
                ! empty($attachmentFamily->quality)? 90 : $attachmentFamily->quality // set quality image
            );

            $attachment->width = $image->width();
            $attachment->height = $image->height();
            $attachment->size = $image->filesize();
            $attachment->data = ['exif' => collect($image->exif())->only(config('pulsar-core.exif_fields_allowed'))];
        }


        // make directory and sizes
        if(! File::exists(base_path($directory . '/' . $objectId . '/wysiwyg')))
        {
            File::makeDirectory(base_path($directory . '/' . $objectId . '/wysiwyg'), 0755, true);
        }

        // move file from temp file to attachment directory
        File::move($attachment->base_path . '/' . $attachment->file_name, base_path($directory . '/' . $objectId . '/wysiwyg/' . $attachment->file_name));

        // set new base_path in attachment
        $attachment->base_path = base_path($directory . '/' . $objectId . '/wysiwyg');

        // original size and biggest size
        $sizes[] = [
            "size"      => 0,
            "width"     => $attachment->width,
            "height"    => $attachment->height,
            "base_path" => $attachment->base_path,
            "file_name" => $attachment->file_name,
            "url"       => asset($urlBase . '/' . $objectId . '/wysiwyg/' . $attachment->file_name)
        ];

        foreach ($inputSizes as $size)
        {
            // calculate percentage that we need from image
            $percentage = 100 - $size;

            $width = intval(($attachment->width * $percentage) / 100);
            $height = intval(($attachment->height * $percentage) / 100);

            /**
             * config http://image.intervention.io with imagemagick
             */
            Image::configure(['driver' => 'imagick']);
            $image = Image::make($attachment->base_path . '/' . $attachment->file_name);
            $image->resize($width, $height);
            $image->save($attachment->base_path . '/' . $size . '@_' . $attachment->file_name);

            $sizes[] = [
                "size"      => $size,
                "width"     => $width,
                "height"    => $height,
                "base_path" => $attachment->base_path,
                "file_name" => $size . '@_' . $attachment->file_name,
                "url"       => asset($urlBase . '/' . $objectId . '/wysiwyg/' . $size . '@_' . $attachment->file_name)
            ];
        }

        return $sizes;
    }

    /**
     *  Function to delete all attachments from object.
     *  This function is called when any object is destroy
     *
     * @access	public
     * @param   integer     $objectId
     * @param   string      $objectType
     * @param   string      $lang
     */
    public static function deleteAttachments($objectId, $objectType, $lang = null)
    {
        $query =  Attachment::builder()
            ->where('object_id', $objectId)
            ->where('object_type', $objectType);

        if(! empty($lang) && base_lang() !== $lang)
            $query->where('lang_id', $lang);

        // get attachments to delete
        $attachments = $query->get();

        foreach ($attachments as $attachment)
        {
            if(! empty($lang) && base_lang() !== $lang)
            {
                // delete main file
                File::delete($attachment->base_path . '/' .  $attachment->file_name);

                // if has sizes, delete your files
                if(isset($attachment->data['sizes']))
                {
                    foreach ($attachment->data['sizes'] as $size)
                    {
                        File::delete($size['base_path'] . '/' . $size['file_name']);
                    }
                }
            }
            else
            {
                File::deleteDirectory($attachment->base_path);
                break;
            }
        }

        // delete attachments from database
        $query->delete();
    }

    public static function changeFileExtension($attachment, $attachmentFamily)
    {

    }

    public static function getRandomFilename($extension)
    {
        return Str::random(40) . '.' . $extension;
    }
}
