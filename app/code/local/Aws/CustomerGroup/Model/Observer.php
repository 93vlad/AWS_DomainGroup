<?php

class AWS_CustomerGroup_Model_Observer
{
    public function addDomainGroup($observer){
        $customer = $observer->getCustomer();
        Mage::register('isSecureArea', true);
        $tempDelete = Mage::getModel('customer/customer')->load($customer->getId());
        $tempDelete->setIsDeleteable(true);
        $tempDelete->delete();
        Mage::unregister('isSecureArea');
        $domen = substr(strstr($customer->getEmail(), '@'), 1);
        $groupTable = Mage::getResourceModel('aws_customerGroup/domainGroup_collection')
            ->addFieldToSelect('domen')
            ->load();
        $domens = array();
        foreach($groupTable as $item){
            $domens[] = $item->getDomen();
        }
        if(!in_array($domen, $domens)) {
            Mage::getModel('aws_customerGroup/domainGroup')
                ->setData('domen', $domen)
                ->setData('status', 0)
                ->save();
        }
        Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/create'))->sendResponse();
        exit;
    }
}