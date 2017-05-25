<?php namespace Syscover\Admin\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\AttachmentLibrary;

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

    /**
     * Store attachments in tmp folder
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
            $file->store('public/tmp');   // save file in library folder
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
                $attachment['data']     = json_encode(['exif' => $image->exif()]);
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
            $copyFileName = $this->getRamdomFilename($attachmentLibraryTmp['extension']);

            File::copy($attachmentLibraryTmp['base_path'] . '/' . $attachmentLibraryTmp['file_name'], $attachmentLibraryTmp['base_path'] . '/' . $copyFileName);

            $attachmentLibraryTmp['library_file_name'] = $attachmentLibraryTmp['file_name'];
            $attachmentLibraryTmp['file_name'] = $copyFileName;

            $attachmentsTmp[] = $attachmentLibraryTmp;
        }

        return $attachmentsTmp;
    }

    /**
     * Store attachments in library folder
     *
     * @param   $files
     * @return  array
     */
    private function storeAttachmentsLibrary($files)
    {
        if(! is_array($files))
            $files = [$files];

        $attachmentLibrary = [];
        foreach ($files as $file)
        {
            $file->store('public/library'); // save file in library folder
            $mime = $file->getMimeType();   // get mime type

            $attachment = [
                'name'      => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),
                'url'       => asset('storage/library/' . $file->hashName()),
                'mime'      => $mime,
                'size'      => $file->getSize()
            ];

            // check if is image
            if(is_image($mime))
            {
                /**
                 * config http://image.intervention.io with imagemagick
                 */
                Image::configure(['driver' => 'imagick']);
                $image = Image::make(storage_path('app/public/library/' . $file->hashName()));

                // set image properties
                $attachment['width']    = $image->width();
                $attachment['height']   = $image->height();
                $attachment['data']     = json_encode(['exif' => $image->exif()]);
            }

            $attachmentLibrary[] = $attachment;
        }

        // save in database
        AttachmentLibrary::insert($attachmentLibrary);

        return $attachmentLibrary;
    }

    private function getRamdomFilename($extension)
    {
        return Str::random(40) . '.' . $extension;
    }

}