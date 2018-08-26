<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 21/08/2018
 * Time: 19.12
 *
 */

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;

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
    private static $allowed_actions = [
        'savePayment',
        'saveCategory',
        'saveType',
        'saveStore'
    ];

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getCategories()
    {
        return Category::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getTypes()
    {
        return Type::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getStores()
    {
        return Store::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getPayments()
    {
        if (Security::getCurrentUser()->isDefaultAdmin()) {
            return Payment::get();
        }

        /** @var HouseMember $member */
        $member = HouseMember::get()->byID(Security::getCurrentUser()->ID);
        return $member->Payments();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public function getUsers()
    {
        return HouseMember::get();
    }

    public function saveCategory()
    {
        /** @var \SilverStripe\Control\HTTPRequest $request */
        $request = $this->getRequest();
        if ($request->isPOST()) {
            /** @var stdClass $requestData */
            $data = $this->getRequestDataAsJson($request);

            $category = Category::create();
            $category->Title = $data;
            $category->write();

            return 'success';
        }

        return $this->httpError(405, 'Method Not Allowed');
    }

    public function saveType()
    {
        /** @var \SilverStripe\Control\HTTPRequest $request */
        $request = $this->getRequest();
        if ($request->isPOST()) {
            /** @var stdClass $requestData */
            $data = $this->getRequestDataAsJson($request);

            $type = Type::create();
            $type->Title = $data;
            $type->write();

            return 'success';
        }

        return $this->httpError(405, 'Method Not Allowed');
    }

    public function saveStore()
    {
        /** @var \SilverStripe\Control\HTTPRequest $request */
        $request = $this->getRequest();
        if ($request->isPOST()) {
            /** @var stdClass $requestData */
            $data = $this->getRequestDataAsJson($request);

            $store = Store::create();
            $store->Title = $data;
            $store->write();

            return 'success';
        }

        return $this->httpError(405, 'Method Not Allowed');
    }

    public function savePayment()
    {
        /** @var \SilverStripe\Control\HTTPRequest $request */
        $request = $this->getRequest();
        if ($request->isPOST()) {
            /** @var stdClass $requestData */
            $data = $this->getRequestDataAsJson($request);
            $this->createNewPayment($data);
            return 'success';
        }

        return $this->httpError(405, 'Method Not Allowed');

    }

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return mixed
     */
    private function getRequestDataAsJson($request)
    {
        return json_decode($request->getBody());
    }

    private function createNewPayment($data)
    {
        /** @var Payment $payment */
        $payment = Payment::create();
        $payment->Sum = $data->sum;
        self::addPaymentManyManyRelations($payment, $data);

        return $this->writePaymentToDB($payment);
    }

    private static function addPaymentManyManyRelations($payment, $data)
    {
        $houseMember = HouseMember::get()->byID(Security::getCurrentUser()->ID);
        $payment->HouseMembers()->add($houseMember);

        $categories = DataObject::get(Category::class)->filter('ID', $data->categoryIds);
        $payment->Categorys()->addMany($categories);

        $types = DataObject::get(Type::class)->filter('ID', $data->categoryIds);
        $payment->Types()->addMany($types);

        $stores = DataObject::get(Store::class)->filter('ID', $data->categoryIds);
        $payment->Stores()->addMany($stores);
    }

    /**
     * @param $ClassName
     * @param $IDArr
     * @return \SilverStripe\ORM\DataList
     */
    private static function getDataObjectsWithID($ClassName, $IDArr)
    {
        return DataObject::get($ClassName)->filter('ID', array_values($IDArr));
    }

    /**
     * @param $payment
     * @return bool|void
     * @throws \SilverStripe\Control\HTTPResponse_Exception
     */
    private function writePaymentToDB($payment)
    {
        try {
            // TODO: Add validation on the Payment DataObject.
            $payment->write();
            return true;
        } catch (Exception $e) {
            return $this->httpError(400, $e);
        }
    }

}
