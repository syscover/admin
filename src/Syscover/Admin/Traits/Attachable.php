<?php namespace Syscover\Admin\Traits;

use Syscover\Admin\Services\AttachmentService;

trait Attachable
{
    public static function createAttachments($attachments, $directory, $urlBase, $objecType, $objectId, $langId = null)
    {
        if(isset($attachments) && is_array($attachments))
        {
            // first save libraries to get id
            $attachments = AttachmentService::storeAttachmentsLibrary($attachments);

            // then save attachments
            AttachmentService::storeAttachments($attachments, $directory, $urlBase, $objecType, $objectId, $langId ? $langId : base_lang());
        }
    }

    public static function updateAttachments($attachments, $directory, $urlBase, $objecType, $objectId, $langId = null)
    {
        if(isset($attachments) && is_array($attachments))
        {
            // first save libraries to get id
            $attachments = AttachmentService::storeAttachmentsLibrary($attachments);

            // then save attachments
            AttachmentService::updateAttachments($attachments, $directory, $urlBase, $objecType, $objectId, $langId ? $langId : base_lang());
        }
    }
}
