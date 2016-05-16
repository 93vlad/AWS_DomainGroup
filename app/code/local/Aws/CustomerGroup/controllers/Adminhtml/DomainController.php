<?php

class Aws_CustomerGroup_Adminhtml_DomainController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction(){

        $this->_title($this->__('Customers'))->_title($this->__('Customers Domain Group'));
        $this->loadLayout();
        $this->_setActiveMenu('customer');
        $this->_addContent($this->getLayout()->createBlock('aws_customerGroup/adminhtml_domainGroup'));
        $this->renderLayout();
    }

    public function gridAction(){

    }

}