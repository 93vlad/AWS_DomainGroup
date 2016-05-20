<?php

class Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup  = 'aws_customerGroup';
        $this->_controller  = 'adminhtml_domainGroup';
        $this->_mode        = 'edit';
        $this->_headerText  = $this->__('Edit Domain Group');
    }
}