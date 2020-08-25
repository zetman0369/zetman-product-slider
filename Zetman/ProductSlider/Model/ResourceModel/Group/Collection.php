<?php
namespace Zetman\ProductSlider\Model\ResourceModel\Group;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Zetman\ProductSlider\Model\Group', 'Zetman\ProductSlider\Model\ResourceModel\Group');
    }
}
