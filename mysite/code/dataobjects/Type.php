<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.38
 *
 * @property string $Title
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\ORM\DataObject;

class Type extends DataObject
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
