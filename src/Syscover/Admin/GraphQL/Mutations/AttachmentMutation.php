<?php namespace Syscover\Admin\GraphQL\Mutations;

use Illuminate\Support\Facades\File;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Core\GraphQL\ScalarTypes\ObjectType;
use function GuzzleHttp\Psr7\mimetype_from_extension;

class AttachmentMutation extends Mutation
{
    public function type()
    {
        return app(ObjectType::class);
    }
}

class CropAttachmentMutation extends AttachmentMutation
{
    protected $attributes = [
        'name'          => 'cropAttachment',
        'description'   => 'Crop image'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(app(ObjectType::class))
            ]
        ];
    }

    // execute crop function across GraphQL
    public function resolve($root, $args)
    {
        // tale attachment family to get sizes
        $attachmentFamily = AttachmentFamily::find($args['object']['attachment']['family_id']);

        // TODO: Manejar error 500 por llegar al límite de memoria (php_value memory_limit 256M)
        /**
         * config http://image.intervention.io with imagemagick
         */
        Image::configure(['driver' => 'imagick']);
        $image = Image::make($args['object']['attachment']['attachment_library']['base_path'] . '/' . $args['object']['attachment']['attachment_library']['file_name']);

        if(! empty($args['object']['attachment_family']['format']) && mimetype_from_extension($args['object']['attachment_family']['format']) !== $args['object']['attachment']['mime'])
        {
            $image = $image->encode($args['object']['attachment_family']['format'], 100); // set format image

            $args['object']['attachment']['file_name']  = basename($args['object']['attachment']['file_name'], '.' . $args['object']['attachment']['extension']) . '.' . $args['object']['attachment_family']['format'];
            $args['object']['attachment']['extension']  = $args['object']['attachment_family']['format']; // change extension file

            // change extension file of url
            $url = pathinfo($args['object']['attachment']['url']);
            $args['object']['attachment']['url']    = $url['dirname'] . '/' . $url['filename'] . '.' . $args['object']['attachment_family']['format'];
            // get mime type
            $args['object']['attachment']['mime']   = mimetype_from_extension($args['object']['attachment']['extension']);
        }


        $image->crop($args['object']['crop']['width'], $args['object']['crop']['height'], $args['object']['crop']['x'], $args['object']['crop']['y']);
        $image->resize($attachmentFamily->width, $attachmentFamily->height);
        $image->save(
            $args['object']['attachment']['base_path'] . '/' . $args['object']['attachment']['file_name'],
            ! empty($args['object']['attachment_family']['quality'])? 90 : $args['object']['attachment_family']['quality'] // set quality image
        );

        //File::delete($attachment->base_path . '/' . $attachment->file_name);

        // get new properties from image cropped
        $args['object']['attachment']['width']  = $image->width();
        $args['object']['attachment']['height'] = $image->height();
        $args['object']['attachment']['size']   = $image->filesize();
        $args['object']['attachment']['data']   = ['exif' => $image->exif()];

        return $args['object'];
    }
}

class DeleteAttachmentMutation extends AttachmentMutation
{
    protected $attributes = [
        'name' => 'deleteAttachment',
        'description' => 'Delete attachment'
    ];

    public function args()
    {
        return [
            'attachment' => [
                'name' => 'attachment',
                'type' => GraphQL::type('AdminAttachmentInput')
            ]
        ];
    }

    public function resolve($root, $args)
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
