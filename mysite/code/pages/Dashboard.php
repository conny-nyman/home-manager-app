<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 21/08/2018
 * Time: 19.12
 *
 */

/**
 * Class Dashboard
 *
 */
class Dashboard extends Page
{

}

use SilverStripe\View\Requirements;

/**
 * Class DashboardController
 *
 * @property \Dashboard dataRecord
 * @method \Dashboard data()
 * @mixin \Dashboard dataRecord
 */
class DashboardController extends PageController
{
    protected function init()
    {
        parent::init();
        Requirements::css('resources/themes/connyman/dist/app.css');
        Requirements::css('resources/themes/connyman/dist/editor.css');
        Requirements::javascript('resources/themes/connyman/dist/app.js');
    }
}
