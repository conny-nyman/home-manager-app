<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 26/08/2018
 * Time: 14.54
 */

use SilverStripe\Forms\DropdownField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\View\SSViewer;

class CMSFieldsUtil
{
    /**
     * @param FieldList $fields
     * @param array $newFields
     * @param string $tab
     */
    public function addTextFieldsToCMS($fields, array $newFields, $tab = null)
    {
        if (!$tab) {
            $tab = 'Root.Main';
        }

        foreach ($newFields as $key => $value) {
            $fields->addFieldToTab($tab, TextField::create($key, $value));
        }
    }

    /**
     * @param FieldList $fields
     * @param array $newFields
     * @param string $tab
     */
    public function addDateFieldsToCMS($fields, array $newFields, $tab = 'Root.Main')
    {
        foreach ($newFields as $key => $value) {
            $fields->addFieldToTab($tab, DateField::create($key, $value));
        }
    }

    /**
     * @param FieldList $fields
     * @param array $newFields
     * @param string $tab
     */
    public function addDatetimeFieldsToCMS($fields, array $newFields, $tab = 'Root.Main')
    {
        foreach ($newFields as $key => $value) {
            $fields->addFieldToTab($tab, DatetimeField::create($key, $value));
        }
    }

    /**
     * @param FieldList $fields
     * @param string $relation
     * @param string $desc
     * @param $data
     */
    public function addGridFieldToCMS($fields, $tab, $relation, $desc, $data)
    {
        $fields->addFieldToTab($tab, GridField::create(
            $relation,
            $desc,
            $data,
            GridFieldConfig_RecordEditor::create()
        ));
    }

    /**
     * @param FieldList $fields
     * @param array $newFields
     * @param string $tab
     */
    public function removeCMSFields($fields, array $fieldsToRemove, $tab = 'Root.Main')
    {
        $fields->removeFieldsFromTab($tab, $fieldsToRemove);
    }

}
