<?php

class AWS_CustomerGroup_Model_Observer
{
    public function addDomainGroup($observer)
    {
        $customer = $observer->getCustomer();
        /*Mage::register('isSecureArea', true); // TODO remove code about delete customer
        $tempDelete = Mage::getModel('customer/customer')->load($customer->getId());
        $tempDelete->setIsDeleteable(true);
        $tempDelete->delete();
        Mage::unregister('isSecureArea');*/
        $domain = substr(strstr($customer->getEmail(), '@'), 1);
        $groupTable = Mage::getResourceModel('aws_customerGroup/domainGroup_collection')
            ->addFieldToSelect('domain')
            ->load();
        $domains = array();
        foreach($groupTable as $item){
            $domains[] = $item->getDomain();
        }
        if(!in_array($domain, $domains)) {
            Mage::getModel('aws_customerGroup/domainGroup')
                ->setData('domain', $domain)
                ->setData('status', 0)
                ->save();
        }
        Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/create'))->sendResponse(); // TODO remove redirect
        exit;
    }

    public function checkAccessPage($observer)
    {
        $customer = Mage::getSingleton('customer/session');
        if(!$customer->isLoggedIn())
            return;
        $customer = $customer->getCustomer();
        $domain = substr(strstr($customer->getEmail(), '@'), 1);
        $groupTable = Mage::getResourceModel('aws_customerGroup/domainGroup_collection')->load();
        foreach($groupTable as $item){
            if($item->getStatus() === "0")
                continue;
            if($item->getDomain() === $domain){
                $page = Mage::app()->getRequest()->getParams('page_id');
                $allowedpages = unserialize($item->getAllowedPages());
                if(!in_array($page['page_id'], $allowedpages) && !is_null($page['page_id'])){
                    Mage::app()->getResponse()->setRedirect(Mage::getUrl('cms/index'))->sendResponse();
                }
            }
        }
    }
}