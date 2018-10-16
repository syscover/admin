<?php namespace Syscover\Admin\GraphQL\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Services\AttachmentService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use function GuzzleHttp\Psr7\mimetype_from_extension;

class AttachmentGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Attachment::class;
    protected $serviceClassName = AttachmentService::class;

    public function crop($root, array $args)
    {
        // encode stdClass to change to array
        $args['payload'] = json_decode(json_encode($args['payload']), true);


        // TODO: Manejar error 500 por llegar al límite de memoria (php_value memory_limit 256M)
        /**
         * config http://image.intervention.io with imagemagick
         */
        Image::configure(['driver' => 'imagick']);
        $image = Image::make($args['payload']['attachment']['attachment_library']['base_path'] . '/' . $args['payload']['attachment']['attachment_library']['file_name']);

        // set format from attachment family
        // TODO este if se puede hacer una función, código usado en AttachmentService line 345
        if(! empty($args['payload']['attachment_family']['format']) && mimetype_from_extension($args['payload']['attachment_family']['format']) !== $args['payload']['attachment']['mime'])
        {
            $image = $image->encode($args['payload']['attachment_family']['format'], 100); // set format image

            $args['payload']['attachment']['file_name']  = basename($args['payload']['attachment']['file_name'], '.' . $args['payload']['attachment']['extension']) . '.' . $args['payload']['attachment_family']['format'];
            $args['payload']['attachment']['extension']  = $args['payload']['attachment_family']['format']; // change extension file

            // change extension file of url
            $url = pathinfo($args['payload']['attachment']['url']);
            $args['payload']['attachment']['url']    = $url['dirname'] . '/' . $url['filename'] . '.' . $args['payload']['attachment_family']['format'];
            // get mime type
            $args['payload']['attachment']['mime']   = mimetype_from_extension($args['payload']['attachment']['extension']);
        }


        // crop
        $image->crop($args['payload']['crop']['width'], $args['payload']['crop']['height'], $args['payload']['crop']['x'], $args['payload']['crop']['y']);

        // resize
        if($args['payload']['attachment_family']['width'] === null || $args['payload']['attachment_family']['height'] === null)
        {
            $image->resize($args['payload']['attachment_family']['width'], $args['payload']['attachment_family']['height'], function($constraint) {
                $constraint->aspectRatio(); // Constraint the current aspect-ratio of the image.
                $constraint->upsize(); // Keep image from being upsized.
            });
        }
        else
        {
            $image->resize($args['payload']['attachment_family']['width'], $args['payload']['attachment_family']['height']);
        }

        // save
        $image->save(
            $args['payload']['attachment']['base_path'] . '/' . $args['payload']['attachment']['file_name'],
            ! empty($args['payload']['attachment_family']['quality']) ? 90 : $args['payload']['attachment_family']['quality'] // set quality image
        );

        // get new properties from image cropped
        $args['payload']['attachment']['width']  = $image->width();
        $args['payload']['attachment']['height'] = $image->height();
        $args['payload']['attachment']['size']   = $image->filesize();
        $args['payload']['attachment']['data']   = ['exif' => collect($image->exif())->only(config('pulsar-core.exif_fields_allowed'))];

        return $args['payload'];
    }

    public function delete($root, array $args)
    {
        $attachmentInput = $args['attachment'];

        if(
            ! empty($attachmentInput['id']) &&
            ! empty($attachmentInput['lang_id'])
        )
        {
            $attachment = Attachment::where('id', $attachmentInput['id'])
                ->where('lang_id', $attachmentInput['lang_id'])
                ->first();

            // delete attachment file
            File::delete($attachment->base_path . '/' . $attachment->file_name);

            // if has sizes, delete your files
            if(isset($attachment->data['sizes']))
            {
                foreach ($attachment->data['sizes'] as $size)
                    File::delete($size['base_path'] . '/' . $size['file_name']);
            }

            if(count(File::files($attachment->base_path)) === 0)
                // delete directory if has not any file
                File::deleteDirectory($attachment->base_path);


            // delete attachment from database
            Attachment::where('id', $attachment->id)
                ->where('lang_id', $attachment->lang_id)
                ->delete();

            return $attachment;
        }
        else
        {
            // delete attachment file, use properties from input,
            // because it may not to be created in database
            File::delete($attachmentInput['base_path'] . '/' . $attachmentInput['file_name']);
            File::delete($attachmentInput['attachment_library']['base_path'] . '/' . $attachmentInput['attachment_library']['file_name']);

            return $attachmentInput;
        }
    }
}