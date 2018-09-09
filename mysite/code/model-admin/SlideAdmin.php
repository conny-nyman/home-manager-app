<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 09/09/2018
 * Time: 14.50
 *
 */


use SilverStripe\Admin\ModelAdmin;

class SlideAdmin extends ModelAdmin
{
    private static $managed_models = [
        Slide::class,
    ];

    private static $url_segment = 'slides';
    private static $menu_title = 'Slides';
}
