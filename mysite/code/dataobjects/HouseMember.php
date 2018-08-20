<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 18.25
 *
 * @property string $Firstname
 * @property string $Surname
 * @property int $ManagementGroupID
 * @method \ManagementGroup ManagementGroup()
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\ORM\DataObject;

class HouseMember extends DataObject
{
    const FIRSTNAME = 'Firstname';
    const SURNAME = 'Surname';
    const MANAGEMENT_GROUP = ManagementGroup::class;
    const PAYMENTS = 'Payments';

    private static $db = [
        self::FIRSTNAME => DBConstants::VARCHAR_255,
        self::SURNAME => DBConstants::VARCHAR_255
    ];

    private static $has_one = [
        self::MANAGEMENT_GROUP => self::MANAGEMENT_GROUP
    ];

    private static $many_many = [
        self::PAYMENTS => Payment::class
    ];

    private static $summary_fields = [
        self::FIRSTNAME
    ];

}
