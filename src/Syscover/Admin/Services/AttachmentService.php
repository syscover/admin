<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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

                Attachment::create([
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
            }
            else
            {
                if($action === 'update')
                {
                    Attachment::where('id', $attachment['id'])->where('lang_id', $attachment['lang_id'])->update([
                        'family_id'             => empty($attachment['family_id'])? null: $attachment['family_id'],
                        'sort'                  => $attachment['sort'],
                        'name'                  => $attachment['name'],
                        'size'                  => $attachment['size'],
                        'width'                 => $attachment['width'],
                        'height'                => $attachment['height'],
                        'data'                  => json_encode($attachment['data'])
                    ]);
                }
                elseif($action === 'store')
                {
                    $newFileName = AttachmentService::getRamdomFilename($attachment['extension']);

                    // move file from temp file to attachment directory
                    File::copy($attachment['base_path'] . '/' . $attachment['file_name'], $attachment['base_path'] . '/' . $newFileName);

                    // store new lang attachment that previous exist in database
                    Attachment::create([
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
                }
            }
        }
    }

    public static function getRamdomFilename($extension)
    {
        return Str::random(40) . '.' . $extension;
    }












    /**
     *  Function to get attachment element with json string to new element
     *
     * @access	public
     * @param   string      $routesConfigFile
     * @param   string      $resource
     * @param   integer     $objectId
     * @param   string      $lang
     * @param   boolean     $copyAttachment
     * @return  array       $response
     */
    public static function getRecords($routesConfigFile, $resource, $objectId, $lang, $copyAttachment = false)
    {
        $response['attachments'] = Attachment::getRecords([
            'lang_id_016'       => $lang,
            'resource_id_016'   => $resource,
            'object_id_016'     => $objectId,
            'orderBy'           => ['column' => 'sorting_016', 'order' => 'asc']
        ]);
        $attachmentsInput = [];

        foreach($response['attachments'] as &$attachment)
        {
            $tmpFileName = null;

            if($copyAttachment)
            {
                // function to duplicate files if we create a new lang object
                // copy attachments base lang article to temp directory
                $tmpFileName = uniqid();
                File::copy(public_path() . config($routesConfigFile . '.attachmentFolder') . '/' . $objectId . '/' . base_lang()->id_001 . '/' . $attachment->file_name_016, public_path() . config($routesConfigFile . '.tmpFolder') . '/' . $tmpFileName);
                // store tmp file name in attachment to know temporal name
                $attachment['tmp_file_name_016'] = $tmpFileName;
            }

            // get json data from attachment
            $attachmentData = json_decode($attachment->data_016);

            $attachmentsInput[] = [
                'id'                => $attachment->id_016,
                'family'            => $attachment->family_id_016,
                'type'              => ['id' => $attachment->type_id_016, 'name' => $attachment->type_text_016, 'icon' => $attachmentData->icon],
                'mime'              => $attachment->mime_016,
                'name'              => $attachment->name_016,
                'folder'            => $copyAttachment? config($routesConfigFile . '.tmpFolder') : config($routesConfigFile . '.attachmentFolder') . '/' . $attachment->object_id_016 . '/' . $attachment->lang_id_016,
                'tmpFileName'       => $tmpFileName,
                'fileName'          => $attachment->file_name_016,
                'width'             => $attachment->width_016,
                'height'            => $attachment->height_016,
                'library'           => $attachment->library_id_016,
                'libraryFileName'   => $attachment->library_file_name_016,
                'sorting'           => $attachment->sorting_016,
            ];
        }

        $response['attachmentsInput'] = json_encode($attachmentsInput);

        return $response;
    }

    /**
     *  Function to delete attachment
     *
     * @access	public
     * @param   string      $routesConfigFile
     * @param   string      $resource
     * @param   integer     $objectId
     * @param   string      $lang
     * @return  boolean     $response
     */
    public static function deleteAttachment($routesConfigFile, $resource, $objectId, $lang = null)
    {
        Attachment::deleteAttachment([
            'lang_id_016'       => $lang,
            'resource_id_016'   => $resource,
            'object_id_016'     => $objectId
        ]);

        if(isset($lang))
        {
            if(!empty($objectId) &&  !empty($lang))
            {
                // delete all attachments from this object
                $response = File::deleteDirectory(public_path() . config($routesConfigFile . '.attachmentFolder') . '/' . $objectId. '/' . $lang);
            }
            else
            {
                throw new InvalidArgumentException('Object Id, is not defined to delete attachment files');
            }

        }
        else
        {
            if(!empty($objectId))
            {
                // delete all attachments from this object
                $response = File::deleteDirectory(public_path() . config($routesConfigFile . '.attachmentFolder') . '/' . $objectId);
            }
            else
            {
                throw new InvalidArgumentException('Object Id, is not defined to delete attachment files');
            }
        }

        return $response;
    }
}