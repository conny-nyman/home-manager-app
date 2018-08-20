<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 18.30
 *
 * @property string $Name
 * @method \SilverStripe\ORM\DataList|\HouseMember[] HouseMembers()
 */

use SilverStripe\ORM\DataObject;

class ManagementGroup extends DataObject
{
    const NAME = 'Name';
    const HOUSE_MEMBERS = HouseMember::class . 's';

    private static $db = [
        self::NAME => DBConstants::VARCHAR_255
    ];

    private static $has_many = [
        self::HOUSE_MEMBERS => HouseMember::class
    ];
}
