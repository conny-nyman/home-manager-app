<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.12
 *
 * @property string $Title
 * @method \SilverStripe\ORM\ManyManyList|\Payment[] Payments()
 */

use SilverStripe\ORM\DataObject;

class Category extends DataObject
{
    const TITLE = 'Title';
    const PAYMENTS = Payment::class . 's';

    private static $db = [
        self::TITLE => DBConstants::VARCHAR_255
    ];

    private static $belongs_many_many = [
        self::PAYMENTS => Payment::class
    ];

    /**
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();

        if (empty($this->Title)) {
            $result->addError('Title cannot be empty');
        }

        if (Category::get()->filter('Title', $this->Title)->exists()) {
            $result->addError('A Category already exist with Title: ' . $this->Title);
        }

        return $result;
    }
}
