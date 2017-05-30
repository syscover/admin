<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Services\AttachmentService;

class AttachmentUploadController extends BaseController
{
    public function index(Request $request)
    {
        $files = $request->file('files');

        $attachmentsLibraryTmp   = $this->storeAttachmentsLibraryTmp($files);
        $attachmentsTmp          = $this->storeAttachmentsTmp($attachmentsLibraryTmp);

        $response['status'] = "success";
        $response['data'] = [
            'attachmentsLibraryTmp'  => $attachmentsLibraryTmp,
            'attachmentsTmp'         => $attachmentsTmp
        ];

        return response()->json($response);
    }

    public function crop(Request $request)
    {
        $parameters = $request->input('parameters');

        // TODO: Manejar error 500 por llegar al límite de memoria (php_value memory_limit 256M)
        $image = Image::make($parameters['attachment']['attachment_library']['base_path'] . '/' . $parameters['attachment']['attachment_library']['file_name']);
        $image->crop($parameters['crop']['width'], $parameters['crop']['height'], $parameters['crop']['x'], $parameters['crop']['y']);
        $image->save($parameters['attachment']['base_path'] . '/' . $parameters['attachment']['file_name']);

        // get new properties from image cropped
        $parameters['attachment']['width'] = $image->width();
        $parameters['attachment']['height'] = $image->height();
        $parameters['attachment']['size'] = $image->filesize();
        $parameters['attachment']['data'] = ['exif' => $image->exif()];

        $response['status'] = "success";
        $response['data'] = $parameters;

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $attachment = $request->input('attachment');

        if(
            ! empty($attachment['id']) &&
            ! empty($attachment['lang_id'])
        )
        {
            $attachment = Attachment::where('id', $attachment['id'])
                ->where('lang_id', $attachment['lang_id'])
                ->first();

            // delete attachment file
            if(File::delete($attachment['base_path'] . '/' . $attachment['file_name']))
            {
                if(count(File::files($attachment['base_path'])) === 0)
                {
                    // delete directory if has not any file
                    File::deleteDirectory($attachment['base_path']);
                }

                // delete attachment from database
                Attachment::where('id', $attachment['id'])
                    ->where('lang_id', $attachment['lang_id'])
                    ->delete();

                $response['status']             = "success";
                $response['data']['attachment'] = $attachment;
            }
            else
            {
                $response['status'] = "error";
                $response['data']['attachment'] = $attachment;
            }

            return response()->json($response);
        }
        else
        {
            // delete attachment file
            if(
                File::delete($attachment['base_path'] . '/' . $attachment['file_name']) &&
                File::delete($attachment['attachment_library']['base_path'] . '/' . $attachment['attachment_library']['file_name'])
            )
            {
                $response['status']             = "success";
                $response['data']['attachment'] = $attachment;
            }
            else
            {
                $response['status']             = "error";
                $response['data']['attachment'] = $attachment;
            }

            return response()->json($response);
        }
    }

    /**
     * Store attachments in tmp directory
     *
     * @param   $files
     * @return  array
     */
    private function storeAttachmentsLibraryTmp($files)
    {
        if(! is_array($files))
            $files = [$files];

        $attachmentsLibraryTmp = [];
        foreach ($files as $file)
        {
            $file->store('public/tmp');   // save file in library directory, if no exist laravel create directory
            $mime = $file->getMimeType();   // get mime type

            $attachment = [
                'name'      => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),
                'extension' => $file->extension(),
                'base_path' => base_path('storage/app/public/tmp'),
                'url'       => asset('storage/tmp/' . $file->hashName()),
                'mime'      => $mime,
                'size'      => $file->getSize(),
                'sort'      => null
            ];

            // check if is image
            if(is_image($mime))
            {
                /**
                 * config http://image.intervention.io with imagemagick
                 */
                Image::configure(['driver' => 'imagick']);
                $image = Image::make(storage_path('app/public/tmp/' . $file->hashName()));

                // set image properties
                $attachment['width']    = $image->width();
                $attachment['height']   = $image->height();
                $attachment['data']     = ['exif' => $image->exif()];
            }

            $attachmentsLibraryTmp[] = $attachment;
        }

        return $attachmentsLibraryTmp;
    }

    private function storeAttachmentsTmp($attachmentsLibraryTmp)
    {
        $attachmentsTmp = [];
        foreach ($attachmentsLibraryTmp as $attachmentLibraryTmp)
        {
            $newFileName = AttachmentService::getRamdomFilename($attachmentLibraryTmp['extension']);

            // copy files to create attachments files from attachment library
            File::copy($attachmentLibraryTmp['base_path'] . '/' . $attachmentLibraryTmp['file_name'], $attachmentLibraryTmp['base_path'] . '/' . $newFileName);

            $attachmentLibraryTmp['attachment_library'] = $attachmentLibraryTmp;
            $attachmentLibraryTmp['file_name'] = $newFileName;
            $attachmentLibraryTmp['url'] = asset('storage/tmp/' . $newFileName);

            $attachmentsTmp[] = $attachmentLibraryTmp;
        }

        return $attachmentsTmp;
    }
}