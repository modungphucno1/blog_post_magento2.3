<?php


namespace SmartOSC\Blog\Model\ResourceModel\Post;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'smart_blog_post';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SmartOSC\Blog\Model\Post', 'SmartOSC\Blog\Model\ResourceModel\Post');
    }
}
