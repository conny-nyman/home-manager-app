<?php
/**
 * Created by PhpStorm.
 *
 * User: Conan
 * Date: 26/08/2018
 * Time: 13.31
 *
 */

use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

class PaymentController extends Controller
{
    private static $allowed_actions = [
        'savePayment',
        'saveCategory',
        'saveType',
        'saveStore',
        'getEndpoints'
    ];

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public static function getCategories()
    {
        return Category::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public static function getTypes()
    {
        return Type::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public static function getStores()
    {
        return Store::get();
    }

    /**
     * @return \SilverStripe\ORM\DataList
     */
    public static function getPayments()
    {
        if (PermissionUtil::isDefaultAdmin()) {
            return Payment::get();
        }

        return Payment::get()->filter('HouseMembers.ManagementGroup.ID', PermissionUtil::getCurrentMemberGroup()->ID)->filter('Created:GreaterThanOrEqual', date('01-m-Y'));
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
        if (Security::getCurrentUser() == null) {
            return $this->httpError(401, 'You need to be logged in, in order to save payments.');
        }

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
        $payment->DateOfPayment = $data->dateOfPayment;
        self::addPaymentManyManyRelations($payment, $data);

        return $this->writePaymentToDB($payment);
    }

    private static function addPaymentManyManyRelations($payment, $data)
    {
        $houseMember = HouseMember::get()->byID(Security::getCurrentUser()->ID);
        if (!$houseMember) {
            if (PermissionUtil::isDefaultAdmin()) {
                $houseMember = HouseMember::get()->filter('FirstName', 'Conny')->first();
            }
        }
        $payment->HouseMembers()->add($houseMember);

        $categories = DataObject::get(Category::class)->filter('ID', $data->categoryIds);
        $payment->Categorys()->addMany($categories);

        $types = DataObject::get(Type::class)->filter('ID', $data->typeIds);
        $payment->Types()->addMany($types);

        $stores = DataObject::get(Store::class)->filter('ID', $data->storeIds);
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

    public function getEndpoints()
    {
        $config = SiteConfig::current_site_config();
        $endpoints['saveCategory'] = $config->SaveCategory;
        $endpoints['saveType'] = $config->SaveType;
        $endpoints['saveStore'] = $config->SaveStore;
        $endpoints['savePayment'] = $config->SavePayment;

        return json_encode($endpoints, JSON_UNESCAPED_SLASHES);
    }
}
