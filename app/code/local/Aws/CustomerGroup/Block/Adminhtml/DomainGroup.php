<?php

class Aws_CustomerGroup_Block_Adminhtml_DomainGroup extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct(){
        $this->_blockGroup = 'aws_customerGroup';
        $this->_controller = 'adminhtml_domainGroup';
        $this->_headerText = Mage::helper('aws_customerGroup')->__('Domain Group');

        parent::__construct();
        $this->_removeButton('add');
    }
}