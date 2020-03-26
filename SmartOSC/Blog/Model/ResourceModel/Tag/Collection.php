<?php


namespace SmartOSC\Blog\Model\ResourceModel\Tag;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'tag_id';
    protected $_eventPrefix = 'smart_blog_tag';
    protected $_eventObject = 'tag_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SmartOSC\Blog\Model\Tag', 'SmartOSC\Blog\Model\ResourceModel\Tag');
    }
}
