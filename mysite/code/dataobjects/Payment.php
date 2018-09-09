<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.06
 *
 * @property float $Sum
 * @property string $DateOfPayment
 * @method \SilverStripe\ORM\ManyManyList|\Category[] Categories()
 * @method \SilverStripe\ORM\ManyManyList|\Type[] Types()
 * @method \SilverStripe\ORM\ManyManyList|\Store[] Stores()
 * @method \SilverStripe\ORM\ManyManyList|\HouseMember[] HouseMembers()
 */

use SilverStripe\ORM\DataObject;

class Payment extends DataObject
{
    const SUM = 'Sum';
    const DATE_OF_PAYMENT = 'DateOfPayment';
    const TYPES = Type::class . 's';
    const CATEGORIES = 'Categories';
    const STORES = Store::class . 's';
    const HOUSE_MEMBERS = HouseMember::class . 's';

    private static $db = [
        self::SUM => DBConstants::FLOAT,
        self::DATE_OF_PAYMENT => DBConstants::DATETIME
    ];

    private static $many_many = [
        self::CATEGORIES => Category::class,
        self::TYPES => Type::class,
        self::STORES => Store::class
    ];

    private static $belongs_many_many = [
        self::HOUSE_MEMBERS => HouseMember::class
    ];

    private static $summary_fields = [
        self::SUM,
        'PaymentCategoryTitles' => 'Categories',
        'PaymentTypeTitles' => 'Types',
        'PaymentStoreTitles' => 'Stores',
    ];

    public function PaymentCategoryTitles()
    {
        $categories = $this->Categories();
        return self::buildTitleStr($categories);
    }

    public function PaymentTypeTitles()
    {
        $types = $this->Types();
        return self::buildTitleStr($types);
    }

    public function PaymentStoreTitles()
    {
        $stores = $this->Stores();
        return self::buildTitleStr($stores);
    }

    private static function buildTitleStr($list)
    {
        if (!$list->exists()) {
            return '';
        }

        $titles = '';
        foreach ($list as $item) {
            if ($titles === '') {
                $titles .= $item->Title;
            } else {
                $titles .= ', ' . $item->Title;
            }
        }
        return $titles;
    }

    /**
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();
        $dateNow = date('Y-m-d H:i:s');

        if (empty($this->Sum)) {
            $result->addError('Sum cannot be zero');
        }

        if (empty($this->DateOfPayment)) {
            $result->addError('Date of payment cannot be empty');
        } else if (strtotime($this->DateOfPayment) > strtotime($dateNow)) {
            $result->addError('Date of payment cannot greater than today, DateOfPayment:' . $this->DateOfPayment . ', Now: ' . $dateNow);
        }

        if (!$this->Categories()->exists()) {
            $result->addError('Please select a category');
        } else if (!$this->Types()->exists()) {
            $result->addError('Please select a type');
        } else if (!$this->Stores()->exists()) {
            $result->addError('Please select a store');
        } else if (!$this->HouseMembers()->exists()) {
            $result->addError('Your account does not belong to a group, please notify the admin.');
        }

        return $result;
    }
}
