<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 08/09/2018
 * Time: 12.58
 */

class GraphqlResolverUtil
{
    /**
     * @param $args
     * @param string $key
     * @return array
     */
    public static function strIDsToArray($args, $key)
    {
        if (isset($args[$key]) && !empty($args[$key])) {
            return explode(" ", $args[$key]);
        }
        return [];
    }
}
