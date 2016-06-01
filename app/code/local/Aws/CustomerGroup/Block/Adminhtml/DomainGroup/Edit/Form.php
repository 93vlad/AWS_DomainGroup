<?php

class Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {

        $helper     = Mage::helper('aws_customerGroup');
        $pages      = Mage::getResourceModel('cms/page_collection')->load();
        $groups     = Mage::getResourceModel('customer/group_collection')->load();
        $domainGroup = Mage::registry('current_domainGroup');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array(
                    '_current' => true,
                    'continue' => 1,
                )
            ),
            'method' => 'post',
        ));

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $domainGroup->getData('domain'),
            )
        );

        $fieldset->addField('entity_id', 'hidden', array(
            'name'      => 'domain_id',
            'value'     => $domainGroup->getId()
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => $helper->__('Status'),
            'title'     => $helper->__('Status'),
            'required'  => true,
            'options'   => $helper->toOptionArray(array('Disabled', 'Enabled')),
        ));

        $fieldset->addField('allowed_pages', 'multiselect', array(
            'name'      => 'allowed_pages',
            'label'     => $helper->__('Allowed Pages'),
            'title'     => $helper->__('Allowed Pages'),
            'required'  => true,
            'values'    => $this->_prepareCollection($pages, 'title'),
        ));

        $fieldset->addField('assign_group', 'multiselect', array(
            'name'      => 'assign_group',
            'label'     => $helper->__('Assign Group'),
            'title'     => $helper->__('Assign Group'),
            'required'  => true,
            'values'    => $this->_prepareCollection($groups, 'customer_group_code'),
        ));

        $form->setValues($domainGroup->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function _prepareCollection($collection, $title)
    {
        $array = array();
        foreach($collection as $item){
            $array[] = array(
                'label' => $item->getData($title),
                'value' => $item->getId(),
            );
        }
        return $array;
    }
}