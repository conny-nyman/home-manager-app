<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.06
 *
 * @property int $Sum
 * @method \SilverStripe\ORM\ManyManyList|\Category[] Categorys()
 * @method \SilverStripe\ORM\ManyManyList|\Type[] Types()
 * @method \SilverStripe\ORM\ManyManyList|\HouseMember[] HouseMembers()
 */

use SilverStripe\ORM\DataObject;

class Payment extends DataObject
{
    const SUM = 'Sum';
    const TYPES = Type::class . 's';
    const CATEGORYS = Category::class . 's';
    const HOUSE_MEMBERS = HouseMember::class . 's';

    private static $db = [
        self::SUM => DBConstants::INT
    ];

    private static $many_many = [
        self::CATEGORYS => Category::class,
        self::TYPES => Type::class
    ];

    private static $belongs_many_many = [
        self::HOUSE_MEMBERS => HouseMember::class
    ];

    private static $summary_fields = [
        self::SUM,
        'PaymentCategoryTitles' => 'Categories',
        'PaymentTypeTitles' => 'Types',
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
            return 'Missing categories';
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
