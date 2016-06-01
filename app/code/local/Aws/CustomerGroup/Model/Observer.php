<?php

class AWS_CustomerGroup_Model_Observer
{
    public function addDomainGroup($observer)
    {
        $customer = $observer->getCustomer();
        $domain = substr(strstr($customer->getEmail(), '@'), 1);
        $domainTable = Mage::getModel('aws_customerGroup/domainGroup')
            ->load($domain, 'domain');
        if(!$domainTable->hasData()){
            Mage::getModel('aws_customerGroup/domainGroup')
                ->setData('domain', $domain)
                ->setData('status', 0)
                ->save();
        }
    }

    public function checkAccessPage($observer)
    {
        $customerSession = Mage::getSingleton('customer/session');
        if(!$customerSession->isLoggedIn())
            return;
        $customer = $customerSession->getCustomer();
        $domain = substr(strstr($customer->getEmail(), '@'), 1);
        $domainTable = Mage::getModel('aws_customerGroup/domainGroup')
            ->load($domain, 'domain');
        if((int)$domainTable->getStatus() == null) {
            return;
        }
        $page = Mage::app()->getRequest()->getParams('page_id');
        $allowedpages = unserialize($item->getAllowedPages());
        if(!in_array($page['page_id'], $allowedpages) && !is_null($page['page_id'])){
            $customerSession->addError('Sorry, you don\'t have permission to go that page');
            session_write_close(); // TODO don't forget see into, why messages not send without this code!!!!
            Mage::app()->getResponse()->setRedirect(Mage::getUrl('cms/index'));
        }
    }
}