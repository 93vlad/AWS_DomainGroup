<?php

class Aws_CustomerGroup_Model_Resource_DomainGroup extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct()
    {
        $this->_init('aws_customerGroup/domainGroup', 'entity_id');
    }
}