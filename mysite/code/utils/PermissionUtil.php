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
    /**
     * @param null $member
     * @return bool
     */
    public static function isDefaultAdmin($member = null)
    {
        if (Security::getCurrentUser() != null) {
            return Security::getCurrentUser()->isDefaultAdmin();
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function isMemberLoggedIn()
    {
        if (Security::getCurrentUser() != null) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public static function getCurrentGroupMembers()
    {
        $mGroup = self::getCurrentMemberGroup();
        return $mGroup->HouseMembers();
    }

    /**
     * @return \SilverStripe\ORM\DataObject
     */
    public static function getCurrentMemberGroup()
    {
        $mGroup = ManagementGroup::get()->filter('HouseMembers.ID', Security::getCurrentUser()->ID);
        if ($mGroup->exists()) {
            return $mGroup->first();
        }
    }
}
