<?php
namespace Nate\Helloworld\Model\Post\Attribute;
use \Nate\Helloworld\Model\PostFactory;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param PostFactory $postFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Nate\Helloworld\Model\PostFactory $postFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getCollection();
        $this->loadedData = array();
        foreach ($items as $post) {
            $this->loadedData[$post->getId()]['post'] = $post->getData();
        }


        return $this->loadedData;

    }
}