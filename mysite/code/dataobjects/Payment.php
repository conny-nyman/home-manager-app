<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.06
 *
 * @property int $Sum
 * @property string $DateOfPayment
 * @method \SilverStripe\ORM\ManyManyList|\Category[] Categorys()
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
    const CATEGORYS = Category::class . 's';
    const STORES = Store::class . 's';
    const HOUSE_MEMBERS = HouseMember::class . 's';

    private static $db = [
        self::SUM => DBConstants::INT,
        self::DATE_OF_PAYMENT => DBConstants::DATETIME
    ];

    private static $many_many = [
        self::CATEGORYS => Category::class,
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
        $categories = $this->Categorys();
        if ($this->ID === 0 || !$categories) {
            return 'Missing categories';
        }

        $titles = '';
        foreach ($categories as $category) {
            if ($titles === '') {
                $titles .= $category->Title;
            } else {
                $titles .= ', ' . $category->Title;
            }
        }
        return $titles;
    }

    public function PaymentTypeTitles()
    {
        $types = $this->Types();
        if ($this->ID === 0 || !$types) {
            return 'Missing types';
        }

        $titles = '';
        foreach ($types as $type) {
            if ($titles === '') {
                $titles .= $type->Title;
            } else {
                $titles .= ', ' . $type->Title;
            }
        }
        return $titles;
    }

    public function PaymentStoreTitles()
    {
        $types = $this->Stores();
        if ($this->ID === 0 || !$types) {
            return 'Missing stores';
        }

        $titles = '';
        foreach ($types as $type) {
            if ($titles === '') {
                $titles .= $type->Title;
            } else {
                $titles .= ', ' . $type->Title;
            }
        }
        return $titles;
    }
}
