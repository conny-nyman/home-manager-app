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

class AvailableOptionsAdmin extends ModelAdmin
{
    private static $managed_models = [
        Category::class,
        Type::class,
        Store::class,
    ];

    private static $url_segment = 'available-options';
    private static $menu_title = 'Available options';
}
