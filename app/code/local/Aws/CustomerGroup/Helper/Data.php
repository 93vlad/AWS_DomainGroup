<?php

class Aws_CustomerGroup_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function toOptionArray(array $values){
        $array = array();
        foreach($values as $value){
            $array[] = $this->__($value);
        }
        return $array;
    }
}