<?php
/**
 * Adds action options to sitetree.
 * This lets us inherit the options from the
 * page if not defined in the object itself.
 *
 * @package silverstripe
 * @subpackage silverstripe-actions
 */
class ActionSiteTreeExtension extends DataExtension
{
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
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
            'Root.Actions',
            array(
                UploadField::create(
                    'ActionImage',
                    _t('Actions.IMAGE', 'Image')
                ),
                TextareaField::create(
                    'ActionSummary',
                    _t('Actions.SUMMARY', 'Summary')
                )->setRows(3),
                TextField::create(
                    'ActionLabel',
                    _t('Actions.LABEL', 'More')
                )
            )
        );
        return $fields;
    }
}
