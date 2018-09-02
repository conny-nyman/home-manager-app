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

        // Default, filter only this month's payments.
        if (!isset($args['allMonths'])) {
            $list = $list->filter('Created:GreaterThanOrEqual', date('01-m-Y'));
        }

        // TODO: Support filter by HouseMember

        $categoryIDS = self::strIDsToArray($args, 'CategoryIDs');
        $typeIDS = self::strIDsToArray($args, 'TypeIDs');
        $storeIDS = self::strIDsToArray($args, 'StoreIDs');

        // Filter only if not null.
        $list = self::appendToFilterIfNotNull('Categorys.ID', $categoryIDS, $list);
        $list = self::appendToFilterIfNotNull('Types.ID', $typeIDS, $list);
        $list = self::appendToFilterIfNotNull('Stores.ID', $storeIDS, $list);

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
