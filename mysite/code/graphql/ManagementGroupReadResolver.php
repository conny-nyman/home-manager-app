<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 01/09/2018
 * Time: 10.21
 */

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;

class ManagementGroupReadResolver implements ResolverInterface
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
        // TODO: skip limitations for default admins..
        $list = ManagementGroup::get()->filter('ID', PermissionUtil::getCurrentMemberGroup()->ID);
//        if (isset($args['Name'])) {
//            $list = $list->filter([
//                'Name:PartialMatch' => $args['Name']
//            ]);
//        }
        return $list;
    }
}
