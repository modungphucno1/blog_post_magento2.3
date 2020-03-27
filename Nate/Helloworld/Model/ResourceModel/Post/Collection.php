<?php
namespace Nate\Helloworld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'nate_helloworld_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Nate\Helloworld\Model\Post', 'Nate\Helloworld\Model\ResourceModel\Post');
    }

}

