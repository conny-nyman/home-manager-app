<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 26/08/2018
 * Time: 13.25
 */

use SilverStripe\Security\Security;

class PermissionUtil
{
    public static function isDefaultAdmin($member = null)
    {
        if (Security::getCurrentUser() != null) {
            return Security::getCurrentUser()->isDefaultAdmin();
        }
        return false;
    }

    public static function isMemberLoggedIn()
    {
        if (Security::getCurrentUser() != null) {
            return true;
        }
        return false;
    }
}
