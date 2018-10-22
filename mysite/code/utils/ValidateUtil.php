<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 22/10/2018
 * Time: 21.38
 */

class ValidateUtil
{
    /**
     * @param $field
     * @param $value
     * @param $result
     * @return bool
     */
    public static function validateThatFieldIsSet($field, $value, &$result)
    {
        if (!empty($value)) {
            return true;
        }
        $result->addError($field . ' cannot be empty');
        return false;
    }
}