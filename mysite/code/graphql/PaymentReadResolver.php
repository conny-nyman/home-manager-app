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

        $houseMemberIDS = self::strIDsToArray($args, 'HouseMemberIDs');
        $categoryIDS = self::strIDsToArray($args, 'CategoryIDs');
        $typeIDS = self::strIDsToArray($args, 'TypeIDs');
        $storeIDS = self::strIDsToArray($args, 'StoreIDs');

        $list = self::appendToFilterIfNotNull('HouseMembers.ID', $houseMemberIDS, $list);
        $list = self::appendToFilterIfNotNull('Categorys.ID', $categoryIDS, $list);
        $list = self::appendToFilterIfNotNull('Types.ID', $typeIDS, $list);
        $list = self::appendToFilterIfNotNull('Stores.ID', $storeIDS, $list);

        $list= self::addDateFilters($list, $args);

        return $list;
    }

    /**
     * @param $list
     * @param $args
     * @return mixed
     */
    private static function addDateFilters($list, $args)
    {
        if (isset($args['StartDate']) && isset($args['EndDate']) && !empty($args['StartDate']) && !empty($args['EndDate'])) {
            $startDate = date("d-m-Y", strtotime($args['StartDate']));
            $endDate = date("d-m-Y", strtotime($args['EndDate']));

            $list = $list->filter([
                'DateOfPayment:GreaterThanOrEqual' => $startDate,
                'DateOfPayment:LessThanOrEqual' => $endDate
            ]);
        } else {
            // Default, filter only this month's payments.
            $list = $list->filter('DateOfPayment:GreaterThanOrEqual', date('01-m-Y'));
        }
        return $list;
    }

    /**
     * @param $args
     * @param string $key
     * @return array
     */
    private static function strIDsToArray($args, $key)
    {
        if (isset($args[$key]) && !empty($args[$key])) {
            return explode(" ", $args[$key]);
        }
        return [];
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
