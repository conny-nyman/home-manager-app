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
 * @method \Loan Loan()
 * @method \SilverStripe\ORM\DataList|\Loan[] Loans()
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\Security\Member;

class HouseMember extends Member
{
    const FIRSTNAME = 'Firstname';
    const SURNAME = 'Surname';
    const MANAGEMENT_GROUP = ManagementGroup::class;
    const PAYMENTS = Payment::class . 's';
    const LOAN = Loan::class;
    const LOANS = Loan::class . 's';

    private static $has_one = [
        self::MANAGEMENT_GROUP => self::MANAGEMENT_GROUP
    ];

    private static $has_many = [
        self::LOANS => Loan::class . '.' . Loan::BORROWER
    ];

    private static $many_many = [
        self::PAYMENTS => Payment::class
    ];

    private static $belongs_to = [
        self::LOAN => Loan::class . '.' . Loan::LENDER
    ];

}
