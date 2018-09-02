<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 26/08/2018
 * Time: 14.51
 *
 * @property \HouseManagerSiteConfig $owner
 * @property string $SaveCategory
 * @property string $SaveType
 * @property string $SaveStore
 * @property string $SavePayment
 */

use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Extension;

class HouseManagerSiteConfig extends Extension
{
    // Endpoints
    const SAVE_CATEGORY = 'SaveCategory';
    const SAVE_TYPE = 'SaveType';
    const SAVE_STORE = 'SaveStore';
    const SAVE_PAYMENT = 'SavePayment';

    private static $db = [
        self::SAVE_CATEGORY => DBConstants::VARCHAR_255,
        self::SAVE_TYPE => DBConstants::VARCHAR_255,
        self::SAVE_STORE => DBConstants::VARCHAR_255,
        self::SAVE_PAYMENT => DBConstants::VARCHAR_255
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fieldUtil = new CMSFieldsUtil();

        $endpointsTextFields = [
            self::SAVE_CATEGORY => 'Endpoint - saveCategory',
            self::SAVE_TYPE => 'Endpoint - saveType',
            self::SAVE_STORE => 'Endpoint - saveStore',
            self::SAVE_PAYMENT => 'Endpoint - savePayment'
        ];

        $fieldUtil->addTextFieldsToCMS($fields, $endpointsTextFields, 'Root.Endpoints');

        return $fields;
    }

}
