<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 21/08/2018
 * Time: 19.12
 *
 */

class Dashboard extends Page
{

}

/**
 * Class \DashboardController
 *
 * @property \Dashboard dataRecord
 * @method \Dashboard data()
 * @mixin \Dashboard dataRecord
 */
class DashboardController extends PageController
{
    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getCategories()
    {
        return PaymentController::getCategories();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getTypes()
    {
        return PaymentController::getTypes();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getStores()
    {
        return PaymentController::getStores();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getPayments()
    {
        return PaymentController::getPayments();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getUsers()
    {
        return PaymentController::getUsers();
    }
}
