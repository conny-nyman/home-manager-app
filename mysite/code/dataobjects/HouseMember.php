<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 18.25
 *
 * @property int $ManagementGroupID
 * @method \ManagementGroup ManagementGroup()
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\Security\Member;

class HouseMember extends Member
{
    const FIRSTNAME = 'Firstname';
    const SURNAME = 'Surname';
    const MANAGEMENT_GROUP = ManagementGroup::class;
    const PAYMENTS = 'Payments';

    private static $has_one = [
        self::MANAGEMENT_GROUP => self::MANAGEMENT_GROUP
    ];

    private static $many_many = [
        self::PAYMENTS => Payment::class
    ];

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getCategories()
    {
        return PaymentController::getCategories();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getTypes()
    {
        return PaymentController::getTypes();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getStores()
    {
        return PaymentController::getStores();
    }
}
