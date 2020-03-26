<?php


namespace SmartOSC\Blog\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Tag extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'smart_blog_tag';

    protected $_cacheTag = 'smart_blog_tag';

    protected $_eventPrefix = 'smart_blog_tag';

    protected function _construct()
    {
        $this->_init('SmartOSC\Blog\Model\ResourceModel\Tag');
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


