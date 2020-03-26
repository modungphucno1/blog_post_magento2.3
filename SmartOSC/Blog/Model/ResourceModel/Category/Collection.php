<?php


namespace SmartOSC\Blog\Model\ResourceModel\Category;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'category_id';
    protected $_eventPrefix = 'smart_blog_category';
    protected $_eventObject = 'category_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SmartOSC\Blog\Model\Category', 'SmartOSC\Blog\Model\ResourceModel\Category');
    }
}
