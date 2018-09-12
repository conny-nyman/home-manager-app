<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 26/08/2018
 * Time: 13.25
 */

use SilverStripe\Security\Security;
use SilverStripe\Security\Member;

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
        if (!Security::getCurrentUser()) {
            if (!self::getMemberFromBasicAuth()) {
                // no member logged in, cannot get MemberGroup.
                return 0;
            }
        }

        $mGroup = ManagementGroup::get()->filter('HouseMembers.ID', Security::getCurrentUser()->ID);
        if ($mGroup->exists()) {
            return $mGroup->first();
        }
    }

    /**
     * Used during development only, need to implement JSON Web Token authentication
     */
    private static function getMemberFromBasicAuth()
    {
        $basicAuth = $_SERVER['HTTP_AUTHORIZATION'];
        if ($basicAuth && !empty($basicAuth)) {
            $loginCredentials = self::getLoginCredentials($basicAuth);

            // The same authorization credentials passed the base controller auth, so email and pass should be valid.
            $member = Member::get()->filter('Email', $loginCredentials[0])->first();

            if ($member->exists()) {
                Security::setCurrentUser($member);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $basicAuth
     * @return array
     */
    private static function getLoginCredentials($basicAuth)
    {
        $emailAndPass = explode('Basic ', $basicAuth)[1];
        return explode(':', base64_decode($emailAndPass));
    }
}
