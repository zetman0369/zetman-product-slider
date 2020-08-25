<?php
namespace Zetman\ProductSlider\Model\Group;

use Zetman\ProductSlider\Model\ResourceModel\Group\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Zetman\ProductSlider\Model\ResourceModel\Group\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $groupCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $groupCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $groupCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Zetman\ProductSlider\Model\Group $group */
        foreach ($items as $group) {
            $this->loadedData[$group->getId()] = $group->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('group_products_slider');
        if (!empty($data)) {
            $group = $this->collection->getNewEmptyItem();
            $group->setData($data);
            $this->loadedData[$group->getId()] = $group->getData();
            $this->dataPersistor->clear('group_products_slider');
        }

        return $this->loadedData;
    }
}
