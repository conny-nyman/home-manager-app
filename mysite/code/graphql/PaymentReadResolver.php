<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 02/09/2018
 * Time: 17.21
 */

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;

class PaymentReadResolver implements ResolverInterface
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
        // Always filter this.
        $list = Payment::get()->filter('HouseMembers.ManagementGroup.ID', PermissionUtil::getCurrentMemberGroup()->ID);

        $houseMemberIDS = GraphqlResolverUtil::strIDsToArray($args, 'HouseMemberIDs');
        $categoryIDS = GraphqlResolverUtil::strIDsToArray($args, 'CategoryIDs');
        $typeIDS = GraphqlResolverUtil::strIDsToArray($args, 'TypeIDs');
        $storeIDS = GraphqlResolverUtil::strIDsToArray($args, 'StoreIDs');

        $list = self::appendToFilterIfNotNull('HouseMembers.ID', $houseMemberIDS, $list);
        $list = self::appendToFilterIfNotNull('Categories.ID', $categoryIDS, $list);
        $list = self::appendToFilterIfNotNull('Types.ID', $typeIDS, $list);
        $list = self::appendToFilterIfNotNull('Stores.ID', $storeIDS, $list);

        $list = self::addDateFilters($list, $args);

        return $list;
    }

    /**
     * @param $list
     * @param $args
     * @return mixed
     */
    private static function addDateFilters($list, $args)
    {
        if (isset($args['StartDate']) && !empty($args['StartDate'])) {
            $startDate = date("d-m-Y", strtotime($args['StartDate']));
            $list = $list->filter('DateOfPayment:GreaterThanOrEqual', $startDate);
        }
        if (isset($args['EndDate']) && !empty($args['EndDate'])) {
            $endDate = date("d-m-Y", strtotime($args['EndDate']));
            $list = $list->filter('DateOfPayment:LessThanOrEqual', $endDate);
        }
        return $list;
    }

    /**
     * @param $filterKey
     * @param $filterData
     * @param $list
     * @return mixed
     */
    private static function appendToFilterIfNotNull($filterKey, $filterData, $list)
    {
        if ($filterData) {
            return $list->filter($filterKey, $filterData);
        }
        return $list;
    }

}
