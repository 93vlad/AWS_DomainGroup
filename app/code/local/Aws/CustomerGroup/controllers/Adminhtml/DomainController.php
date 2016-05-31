<?php

class Aws_CustomerGroup_Adminhtml_DomainController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {

        $this->_title($this->__('Customers'))->_title($this->__('Customers Domain Group'));
        $this->loadLayout();
        $this->_setActiveMenu('customer');
        $this->_addContent($this->getLayout()->createBlock('aws_customerGroup/adminhtml_domainGroup'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__('Edit Domain Group'));
        $productId = $this->getRequest()->getParam('id');
        $domainGroup = Mage::getModel('aws_customerGroup/domainGroup');
        if ($productId) {
            try {
                $domainGroup->load($productId);
            } catch (Exception $e) {
                $domainGroup->setTypeId(Mage_Catalog_Model_Product_Type::DEFAULT_TYPE);
                Mage::logException($e);
            }
        }
        Mage::register('current_domainGroup', $domainGroup);
        $this->loadLayout();
        $editDomain = $this->getLayout()->createBlock('aws_customerGroup/adminhtml_domainGroup_edit');
        $this->_addContent($editDomain)->renderLayout();
    }

    public function saveAction()
    {
        $postData = $this->getRequest()->getPost();
        $data = Mage::register('current_domainGroup');
        $this->_redirect('*/*/');
        return;
    }
}