<?php
namespace Nate\Helloworld\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'nate_helloworld_post';

    protected $_cacheTag = 'nate_helloworld_post';

    protected $_eventPrefix = 'nate_helloworld_post';

    protected function _construct()
    {
        $this->_init('Nate\Helloworld\Model\ResourceModel\Post');
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