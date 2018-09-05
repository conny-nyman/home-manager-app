<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 05/09/2018
 * Time: 20.18
 */

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;

class HouseMemberReadResolver implements ResolverInterface
{
    /**
     * @param \SilverStripe\ORM\DataObjectInterface $object
     * @param array $args
     * @param array $context
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     * @return mixed|\SilverStripe\ORM\DataList
     */
    public function resolve($object, $args, $context, $info)
    {
        $list = HouseMember::get()->filter('ManagementGroupID', PermissionUtil::getCurrentMemberGroup()->ID);
        return $list;
    }
}
