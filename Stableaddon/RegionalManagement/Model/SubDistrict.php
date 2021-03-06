<?php

namespace Stableaddon\RegionalManagement\Model;

/**
 * Class SubDistrict
 *
 * @package Stableaddon\RegionalManagement\Model
 */
class SubDistrict extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Stableaddon\RegionalManagement\Model\ResourceModel\SubDistrict::class);
    }
    /**
     * Retrieve region name
     *
     * If name is not declared, then default_name is used
     *
     * @return string
     */
    public function getName()
    {
        $name = $this->getData('name');
        if ($name === null) {
            $name = $this->getData('default_name');
        }
        return $name;
    }

    /**
     * Load region by code
     *
     * @param string $code
     * @param string $regionId
     * @return $this
     */
    public function loadByCode($code, $regionId)
    {
        if ($code) {
            $this->_getResource()->loadByCode($this, $code, $regionId);
        }
        return $this;
    }

    /**
     * Load region by name
     *
     * @param string $name
     * @param string $regionId
     * @return $this
     */
    public function loadByName($name, $regionId)
    {
        $this->_getResource()->loadByName($this, $name, $regionId);
        return $this;
    }
}
