<?php namespace Syscover\Admin\Controllers;

use function GuzzleHttp\Psr7\mimetype_from_extension;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Services\AttachmentService;

class AttachmentController extends BaseController
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

        // tale attachment family to get sizes
        $attachmentFamily = AttachmentFamily::find($parameters['attachment']['family_id']);

        // TODO: Manejar error 500 por llegar al límite de memoria (php_value memory_limit 256M)
        /**
         * config http://image.intervention.io with imagemagick
         */
        Image::configure(['driver' => 'imagick']);
        $image = Image::make($parameters['attachment']['attachment_library']['base_path'] . '/' . $parameters['attachment']['attachment_library']['file_name']);

        if(! empty($parameters['attachment_family']['format']))
        {
            $image = $image->encode($parameters['attachment_family']['format'], 100); // set format image

            $parameters['attachment']['file_name']  = basename($parameters['attachment']['file_name'], '.' . $parameters['attachment']['extension']) . '.' . $parameters['attachment_family']['format'];
            $parameters['attachment']['extension']  = $parameters['attachment_family']['format']; // change extension file

            // change extension file of url
            $url = pathinfo($parameters['attachment']['url']);
            $parameters['attachment']['url']    = $url['dirname'] . '/' . $url['filename'] . '.' . $parameters['attachment_family']['format'];
            // get mime type
            $parameters['attachment']['mime']   = mimetype_from_extension($parameters['attachment']['extension']);
        }


        $image->crop($parameters['crop']['width'], $parameters['crop']['height'], $parameters['crop']['x'], $parameters['crop']['y']);
        $image->resize($attachmentFamily->width, $attachmentFamily->height);
        $image->save(
            $parameters['attachment']['base_path'] . '/' . $parameters['attachment']['file_name'],
            ! empty($parameters['attachment_family']['quality'])? 90 : $parameters['attachment_family']['quality'] // set quality image
        );

        // get new properties from image cropped
        $parameters['attachment']['width']  = $image->width();
        $parameters['attachment']['height'] = $image->height();
        $parameters['attachment']['size']   = $image->filesize();
        $parameters['attachment']['data']   = ['exif' => $image->exif()];

        $response['status'] = "success";
        $response['data'] = $parameters;

        return response()->json($response);
    }

    /**
     * this function is called when delete only one attachment
     * from attachmentLibrary component
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $attachmentInput = $request->input('attachment');

        if(
            ! empty($attachmentInput['id']) &&
            ! empty($attachmentInput['lang_id'])
        )
        {
            $attachment = Attachment::where('id', $attachmentInput['id'])
                ->where('lang_id', $attachmentInput['lang_id'])
                ->first();

            // delete attachment file
            if(File::delete($attachment->base_path . '/' . $attachment->file_name))
            {
                // if has sizes, delete your files
                if(isset($attachment->data['sizes']))
                {
                    foreach ($attachment->data['sizes'] as $size)
                    {
                        File::delete($size['base_path'] . '/' . $size['file_name']);
                    }
                }

                if(count(File::files($attachment->base_path)) === 0)
                {
                    // delete directory if has not any file
                    File::deleteDirectory($attachment->base_path);
                }

                // delete attachment from database
                Attachment::where('id', $attachment->id)
                    ->where('lang_id', $attachment->lang_id)
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
            // delete attachment file, use properties from input,
            // because it may not to be created in database
            if(
                File::delete($attachmentInput['base_path'] . '/' . $attachmentInput['file_name']) &&
                File::delete($attachmentInput['attachment_library']['base_path'] . '/' . $attachmentInput['attachment_library']['file_name'])
            )
            {
                $response['status']             = "success";
                $response['data']['attachment'] = $attachmentInput;
            }
            else
            {
                $response['status']             = "error";
                $response['data']['attachment'] = $attachmentInput;
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