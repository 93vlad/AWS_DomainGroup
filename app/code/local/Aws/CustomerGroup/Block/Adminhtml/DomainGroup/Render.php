<?php

class Aws_CustomerGroup_Block_Adminhtml_DomainGroup_Render 
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $index = $this->getColumn()->getIndex();
        switch($index){
            case 'allowed_pages':
                $model = 'cms/page';
                $field = 'page_id';
                $title = 'title';
                break;
            case 'assign_group':
                $model = 'customer/group';
                $field = 'customer_group_id';
                $title = 'customer_group_code';
                break;
            default:
                break;
        }
        $ids = unserialize($row->getData($index));
        if($ids === false)
            return;
        $titleFields = $this->_getTitleOfField($model, $field, $ids, $title);
        return $titleFields;
    }

    protected function _getTitleOfField($model, $field, $ids, $title)
    {
        $collection = Mage::getResourceModel($model . '_collection')->addFieldToFilter($field,
            array(
                'in' => $ids,
            ))->load();
        foreach($collection as $item){
            $titles[] = $isNull = $item->getData($title);
        }
        return implode(', ', $titles);
    }
}