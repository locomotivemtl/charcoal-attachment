<?php

namespace Charcoal\Admin\Ui\Label;

// From 'charcoal-admin'
use \Charcoal\Admin\Ui\Label\AttachmentLabeller;

/**
 * An Attachable Attachment Labeller
 */
class AttachmentLabeller extends AttachmentLabeller
{
    /**
     * The default data is defined in a JSON file.
     *
     * @return array
     */
    public function defaults()
    {
        $plural = [
            'en' => 'Attachments',
            'fr' => 'Attachements'
        ];

        $singular = [
            'en' => 'Attachment',
            'fr' => 'Attachement'
        ];

        $defaults = [
            'name'          => $plural,
            'singular_name' => $singular,
            'panel_heading' => null,
            'menu_name'     => null,
            'add_new'       => null,
            'add_new_item'  => [
                'en' => 'Add Attachment',
                'fr' => 'Ajouter un attachement'
            ],
            'new_item' => [
                'en' => 'New Attachment',
                'fr' => 'Nouvel attachement'
            ],
            'edit_item' => [
                'en' => 'Edit Attachment',
                'fr' => 'Modifier l’attachement'
            ],
            'view_item' => [
                'en' => 'View Attachment',
                'fr' => 'Voir l’attachement'
            ],
            'all_items' => [
                'en' => 'All Attachments',
                'fr' => 'Toutes les attachements'
            ],
            'search_items' => [
                'en' => 'Search Attachments',
                'fr' => 'Chercher dans les attachements'
            ],
            'not_found' => [
                'en' => 'No objects found',
                'fr' => 'Aucun attachement trouvé'
            ]
        ];

        return array_merge(parent::defaults(), $defaults);
    }

    /**
     * @return TranslationString|string|null
     */
    public function attachmentHeading()
    {
        if ($this->attachment_heading === null) {
            return $this['singular_name'];
        }

        $this->attachment_heading;
    }
}
