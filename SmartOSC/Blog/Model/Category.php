<?php


namespace SmartOSC\Blog\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'smart_blog_category';

    protected $_cacheTag = 'smart_blog_category';

    protected $_eventPrefix = 'smart_blog_category';

    protected function _construct()
    {
        $this->_init('SmartOSC\Blog\Model\ResourceModel\Category');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
