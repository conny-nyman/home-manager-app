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
 * @property int $BorrowerID
 * @method \HouseMember Lender()
 * @method \HouseMember Borrower()
 */

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;

class Loan extends DataObject
{
    const SUM = 'Sum';
    const DATE_OF_LOAN = 'DateOfLoan';
    const LENDER = 'Lender';
    const BORROWER = 'Borrower';

    private static $db = [
        self::SUM => DBConstants::FLOAT,
        self::DATE_OF_LOAN => DBConstants::DATETIME
    ];

    private static $has_one = [
        self::LENDER => HouseMember::class,
        self::BORROWER => HouseMember::class
    ];

    private static $summary_fields = [
        self::SUM,
        self::DATE_OF_LOAN => 'Date',
        self::BORROWER . '.FirstName' => self::BORROWER,
        self::LENDER . '.FirstName' => self::LENDER,
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
        $houseMembers = HouseMember::get();
        $lender = $houseMembers->byID($this->LenderID);
        $currentUser = $houseMembers->byID(Security::getCurrentUser()->ID);

        if (!$lender || !$currentUser) {
            return false;
        } else if ($lender->ID === $currentUser->ID) {
            return true;
        }

        return false;
    }

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->BorrowerID = Security::getCurrentUser()->ID;
    }
}