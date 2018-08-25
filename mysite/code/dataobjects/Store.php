<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 25/08/2018
 * Time: 12.22
 *
 * @property string $Title
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\ORM\DataObject;

class Store extends DataObject
{
    const TITLE = 'Title';
    const PAYMENTS = Payment::class . 's';

    private static $db = [
        self::TITLE => DBConstants::VARCHAR_255
    ];

    private static $belongs_many_many = [
        self::PAYMENTS => Payment::class
    ];
}
