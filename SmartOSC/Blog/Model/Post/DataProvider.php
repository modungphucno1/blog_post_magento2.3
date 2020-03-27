<?phpnamespace SmartOSC\Blog\Model\Post;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use SmartOSC\Blog\Model\Post;
use SmartOSC\Blog\Model\ResourceModel\Post\Collection;
use SmartOSC\Blog\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{    /**     * @var Collection     */
    protected $collection;
    /**                 * @var DataPersistorInterface                 */
    protected $dataPersistor;
    /**                 * @var array                 */
    protected $loadedData;
    /**                 * Constructor                 *                 * @param string $name                 * @param string $primaryFieldName                 * @param string $requestFieldName                 * @param CollectionFactory $postCollectionFactory                 * @param DataPersistorInterface $dataPersistor                 * @param array $meta                 * @param array $data                 * @param PoolInterface|null $pool                 */
    public function __construct($name,        $primaryFieldName,        $requestFieldName,        CollectionFactory $postCollectionFactory,        DataPersistorInterface $dataPersistor,        array $meta = [],        array $data = [],        PoolInterface $pool = null)
    {
        $this->collection = $postCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }
    /**                 * Get data                 *                 * @return array                 */
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
