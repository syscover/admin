<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\AttachmentLibrary;

class AttachmentUploadController extends BaseController
{
    public function index(Request $request)
    {
        $files = $request->file('files');

        $attachmentLibrary  = $this->storeAttachmentLibrary($files);
       // $attachments        = $this->storeAttachment($files, $request->input('folder'));

        $response['status'] = "success";
        $response['data'] = [
            'library'       => $attachmentLibrary,
            //'attachments'   => $attachments
        ];

        return response()->json($response);
    }

    private function storeAttachment($files, $folder)
    {
        if(! is_array($files))
            $files = [$files];

        $attachments = [];
        foreach ($files as $file)
        {
            $file->store('public/' . $folder); // save file in folder
            $mime = $file->getMimeType();   // get mime type

            $attachment = [
                'name'      => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),
                'mime'      => $mime,
                'size'      => $file->getSize()
            ];
        }
    }

    private function storeAttachmentLibrary($files)
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

}