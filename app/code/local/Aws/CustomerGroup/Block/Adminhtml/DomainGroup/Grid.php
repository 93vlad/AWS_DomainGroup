<?php

class Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('inchoo_order_grid');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('aws_customerGroup/domainGroup_collection');

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('aws_customerGroup');

        $this->addColumn('entity_id', array(
            'header' => $helper->__('Entity_id'),
            'index'  => 'entity_id',
        ));

        $this->addColumn('domain', array(
            'header' => $helper->__('Domain'),
            'index'  => 'domain',
        ));

        $this->addColumn('allowed_pages', array(
            'header' => $helper->__('Allowed Pages'),
            'index'  => 'allowed_pages',
            'renderer' => 'Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Render',
        ));

        $this->addColumn('assign_group', array(
            'header' => $helper->__('Assign Group'),
            'index'  => 'assign_group',
            'renderer' => 'Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Render',
        ));

        $this->addColumn('status', array(
            'header'    => $helper->__('Status'),
            'index'     => 'status',
            'type'      => 'options',
            'options'   => $this->_toOptionArray(array('Disabled', 'Enabled'), $helper),
        ));

        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', array('id' => $item->getEntityId()));
    }

    protected function _toOptionArray(array $values, $helper){
        $array = array();
        foreach($values as $value){
            $array[] = $helper->__($value);
        }
        return $array;
    }
}