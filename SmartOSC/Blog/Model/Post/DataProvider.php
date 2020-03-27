<?php

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use SmartOSC\Blog\Model\Post;
use SmartOSC\Blog\Model\ResourceModel\Post\Collection;
use SmartOSC\Blog\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;
    /**
    protected $dataPersistor;
    /**
    protected $loadedData;
    /**
    public function __construct($name,
    {
        $this->collection = $postCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }
    /**
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var Post $block */
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }
        $data = $this->dataPersistor->get('smart_blog_post');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('smart_blog_post');
        }
        return $this->loadedData;
    }
}