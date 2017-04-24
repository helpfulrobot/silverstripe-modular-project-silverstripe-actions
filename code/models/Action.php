<?php
/**
 * Action
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Action extends Link
{
    /**
     * Singular name for CMS
     * @var string
     */
    private static $singular_name = 'Action';

    /**
     * Plural name for CMS
     * @var string
     */
    private static $plural_name = 'Actions';

    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'ActionSummary' => 'Text',
        'ActionLabel' => 'Varchar(255)'
    );

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = array(
        'ActionImage' => 'Image'
    );

    /**
     * Define the default values for all the $db fields
     * @var array
     */
    private static $defaults = array(
        'ActionLabel' => 'Read more'
    );

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'LinkURL' => 'Link'
    );

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab(
            'Root.Main',
            array(
                UploadField::create(
                    'ActionImage',
                    _t('Actions.IMAGE', 'Image')
                )
                ->setAllowedExtensions(array('jpg','png','gif')),
                TextareaField::create(
                    'ActionSummary',
                    _t('Actions.SUMMARY', 'Summary')
                )->setRows(3),
                TextField::create(
                    'ActionLabel',
                    _t('Actions.LABEL', 'Label')
                )
            ),
            'Type'
        );

        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Return image from current object if available
     * or fall back the sitetree image.
     * @return String
     */
    public function getImage()
    {
        if ($this->ActionImage()) {
            return $this->ActionImage();
        }
        if ($this->Type == 'SiteTree') {
            return $this->SiteTree()->ActionImage();
        }
    }

    /**
     * Return summary from current object if available
     * or fall back the sitetree summary.
     * @return String
     */
    public function getSummary()
    {
        if ($this->ActionSummary) {
            return $this->obj('ActionSummary');
        }
        if ($this->Type == 'SiteTree') {
            return $this->SiteTree()->obj('ActionSummary');
        }
    }

    /**
     * Return label from current object if available
     * or fall back the sitetree label.
     * @return String
     */
    public function getLabel()
    {
        if ($this->ActionSummary) {
            return $this->obj('ActionLabel');
        }
        if ($this->Type == 'SiteTree') {
            return $this->SiteTree()->obj('ActionLabel');
        }
    }
}
