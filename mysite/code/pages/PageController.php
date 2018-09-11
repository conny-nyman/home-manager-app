<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;

/**
 * Class \PageController
 *
 * @property \Page dataRecord
 * @method \Page data()
 * @mixin \Page dataRecord
 */
class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    protected function init()
    {
        parent::init();
//        Require these in subPage?
//        Requirements::css('resources/themes/connyman/dist/app.css');
//        Requirements::css('resources/themes/connyman/dist/editor.css');
//        Requirements::javascript('resources/themes/connyman/dist/app.js');
    }
}
