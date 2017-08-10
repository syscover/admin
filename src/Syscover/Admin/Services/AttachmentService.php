<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Models\AttachmentLibrary;

/**
 * Class TaxRuleLibrary
 * @package Syscover\Market\Service
 */
class AttachmentService
{
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
                    'width'         => $attachmentLibrary['width'],
                    'height'        => $attachmentLibrary['height'],
                    'data'          => $attachmentLibrary['data']
                ]);

                // set attachment library by reference
                $attachment['attachment_library']['id'] = $object->id;
            }
        }

        return $attachments;
    }

    public static function storeAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId)
    {
        AttachmentService::manageAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId, 'store');
    }

    public static function updateAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId)
    {
        AttachmentService::manageAttachments($attachments, $directory, $urlBase, $objectType, $objectId, $langId, 'update');
    }

    /**
     *  Function to store attachment elements
     *
     * @access	public
     * @param   \Illuminate\Support\Facades\Request     $attachments
     * @param   string                                  $directory
     * @param   string                                  $urlBase
     * @param   string                                  $objectType
     * @param   integer                                 $objectId
     * @param   string                                  $langId
     * @param   string                                  $action
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
                    'sort'                  => $attachment['sort'],
                    'name'                  => $attachment['name'],
                    'base_path'             => base_path($directory . '/' . $objectId),
                    'file_name'             => $attachment['file_name'],
                    'url'                   => asset($urlBase . '/' . $objectId . '/' . $attachment['file_name']),
                    'mime'                  => $attachment['mime'],
                    'extension'             => $attachment['extension'],
                    'size'                  => $attachment['size'],
                    'width'                 => $attachment['width'],
                    'height'                => $attachment['height'],
                    'library_id'            => $attachment['attachment_library']['id'],
                    'library_file_name'     => $attachment['attachment_library']['file_name'],
                    'data'                  => $attachment['data']
                ]);

                // create sizes from image
                AttachmentService::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
            }
            else
            {
                // action is update object
                if($action === 'update')
                {
                    Attachment::where('id', $attachment['id'])
                        ->where('lang_id', $attachment['lang_id'])
                        ->update([
                            'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                            'sort'                  => $attachment['sort'],
                            'name'                  => $attachment['name'],
                            'file_name'             => $attachment['file_name'],
                            'url'                   => $attachment['url'],
                            'mime'                  => $attachment['mime'],
                            'extension'             => $attachment['extension'],
                            'size'                  => $attachment['size'],
                            'width'                 => $attachment['width'],
                            'height'                => $attachment['height'],
                            'data'                  => json_encode($attachment['data'])
                        ]);

                    // get attachment object to create sizes
                    $attachmentObject = Attachment::where('id', $attachment['id'])->where('lang_id', $attachment['lang_id'])->first();

                    // create sizes from image
                    AttachmentService::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
                }
                elseif($action === 'store')
                {
                    $newFileName = AttachmentService::getRandomFilename($attachment['extension']);

                    // move file from temp file to attachment directory
                    File::copy($attachment['base_path'] . '/' . $attachment['file_name'], $attachment['base_path'] . '/' . $newFileName);

                    // store new lang attachment that previous exist in database
                    $attachmentObject = Attachment::create([
                        'id'                    => $attachment['id'],
                        'lang_id'               => $langId,
                        'object_id'             => $objectId,
                        'object_type'           => $objectType,
                        'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                        'sort'                  => $attachment['sort'],
                        'name'                  => $attachment['name'],
                        'base_path'             => $attachment['base_path'],
                        'file_name'             => $newFileName,
                        'url'                   => asset($urlBase . '/' . $objectId . '/' . $newFileName),
                        'mime'                  => $attachment['mime'],
                        'extension'             => $attachment['extension'],
                        'size'                  => $attachment['size'],
                        'width'                 => $attachment['width'],
                        'height'                => $attachment['height'],
                        'library_id'            => $attachment['attachment_library']['id'],
                        'library_file_name'     => $attachment['attachment_library']['file_name'],
                        'data'                  => $attachment['data']
                    ]);

                    // create sizes from image
                    AttachmentService::setAttachmentSizes($attachmentObject, $urlBase, $objectId);
                }
            }
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

                    $width = (int)($attachment->width * $percentage) / 100;
                    $height = (int)($attachment->height * $percentage) / 100;

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
    public static function manageWysiwygAttachment($article, $directory, $urlBase, $id) {
        // load element and get img tags
        $doc = new \DOMDocument();
        $doc->loadHTML($article);
        $tags = $doc->getElementsByTagName('img');
        $hasSaved = false;

        foreach ($tags as $tag)
        {
            // search class ps-uploaded
            $classes = preg_split('/\s+/', $tag->getAttribute('class'));
            $newClasses = [];
            $uploaded = false;
            foreach ($classes as $class)
                if($class === 'ps-uploaded')
                    $uploaded = true;
                else
                    $newClasses[] = $class;


            if($uploaded)
            {
                // get data element insert in editor.component.ts line 112
                $attachment = json_decode($tag->getAttribute('data-ps-image'));

                $sizes = AttachmentService::setWysiwygAttachmentSizes($attachment, $directory, $urlBase, $id);

                $tag->setAttribute('src', get_src($sizes));
                $tag->setAttribute('srcset', get_srcset($sizes));
                $tag->removeAttribute('data-ps-image');

                if($newClasses != null) $tag->setAttribute('class', implode(' ', $newClasses));
                $hasSaved = true;
            }
        }

        if($hasSaved)
            return $doc->saveHTML();

        return null;
    }


    private static function setWysiwygAttachmentSizes($attachment, $directory, $urlBase, $objectId, $inputSizes = [25, 50, 75])
    {
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

            $width = (int)($attachment->width * $percentage) / 100;
            $height = (int)($attachment->height * $percentage) / 100;

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
     * @return  boolean     $response
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

    public static function getRandomFilename($extension)
    {
        return Str::random(40) . '.' . $extension;
    }
}