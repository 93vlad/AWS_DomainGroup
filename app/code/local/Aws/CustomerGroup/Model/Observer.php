<?php

class AWS_CustomerGroup_Model_Observer
{
    public function addDomainGroup($observer){
        $customer = $observer->getCustomer();
        $groupTable = Mage::getResourceModel('aws_customerGroup/domainGroup');
        $domen = substr(strstr($customer->getEmail(), '@'), 1);
        $groupTable->setEntityId($customer->getId());
        $groupTable->setDomen($domen);
        $groupTable->setStatus(0);
        $groupTable->save();






        Mage::register('isSecureArea', true);
        $tempDelete = Mage::getModel('customer/customer')->load($customer->getId());
        $tempDelete->setIsDeleteable(true);
        $tempDelete->delete();
        Mage::unregister('isSecureArea');
        Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/create'))->sendResponse();
        exit;
    }
}