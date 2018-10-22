<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 22/10/2018
 * Time: 21.01
 *
 * @property float $Sum
 * @property string $DateOfLoan
 * @property int $LenderID
 * @method \HouseMember Lender()
 * @method \SilverStripe\ORM\ManyManyList|\HouseMember[] HouseMembers()
 */

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;

class Loan extends DataObject
{
    const SUM = 'Sum';
    const DATE_OF_LOAN = 'DateOfLoan';
    const LENDER = 'Lender';
    const HOUSE_MEMBERS = HouseMember::class . 's';

    private static $db = [
        self::SUM => DBConstants::FLOAT,
        self::DATE_OF_LOAN => DBConstants::DATETIME
    ];

    private static $has_one = [
        self::LENDER => HouseMember::class
    ];

    private static $belongs_many_many = [
        self::HOUSE_MEMBERS => HouseMember::class
    ];

    /**
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();

        ValidateUtil::validateThatFieldIsSet('Sum', $this->Sum, $result);
        ValidateUtil::validateThatFieldIsSet('DateOfLoan', $this->DateOfLoan, $result);
        $lenderIsSet = ValidateUtil::validateThatFieldIsSet('Lender', $this->LenderID, $result);

        if ($lenderIsSet) {
            if ($this->isLenderSameAsCurrentUser()) {
                $result->addError('Lender cannot be the same as the borrower (current user).');
            }
        }

        return $result;
    }

    private function isLenderSameAsCurrentUser()
    {
        if (HouseMember::get()->byID($this->LenderID)->ID === Security::getCurrentUser()->ID) {
            return true;
        }
        return false;
    }

}