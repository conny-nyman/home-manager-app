<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 20/08/2018
 * Time: 19.20
 *
 */

use SilverStripe\Admin\ModelAdmin;

class HouseManagerAdmin extends ModelAdmin
{
    private static $managed_models = [
        ManagementGroup::class
    ];

    private static $url_segment = 'house-manager';
    private static $menu_title = 'House manager';
}
