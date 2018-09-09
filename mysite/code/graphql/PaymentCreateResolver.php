<?php
/**
 * Created by PhpStorm.
 * User: Conan
 * Date: 08/09/2018
 * Time: 12.34
 */

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;
use SilverStripe\Security\Security;

class PaymentCreateResolver implements ResolverInterface
{
    /**
     * @param \SilverStripe\ORM\DataObjectInterface $object
     * @param array $args
     * @param array $context
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     * @return mixed|Payment
     * @throws \SilverStripe\ORM\ValidationException
     */
    public function resolve($object, $args, $context, $info)
    {
        // This is probably not the preferred GraphQL way to create objects with has_many relations, currently experimenting with different solutions.
        $categoryIDS = GraphqlResolverUtil::strIDsToArray($args, 'CategoryIDs');
        $typeIDS = GraphqlResolverUtil::strIDsToArray($args, 'TypeIDs');
        $storeIDS = GraphqlResolverUtil::strIDsToArray($args, 'StoreIDs');

        /** @var Payment $payment */
        $payment = Payment::create();
        $payment->Sum = $args['Input']['Sum'];
        $payment->DateOfPayment = $args['Input']['DateOfPayment'];

        // Save *_many relations
        $payment->HouseMembers()->add(HouseMember::get()->byID(Security::getCurrentUser()->ID)->ID);
        $payment->Categories()->addMany($categoryIDS);
        $payment->Types()->addMany($typeIDS);
        $payment->Stores()->addMany($storeIDS);

        $payment->write();
        return $payment;
    }

}

