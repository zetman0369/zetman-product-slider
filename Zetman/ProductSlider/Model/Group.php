<?php
namespace Zetman\ProductSlider\Model;

use Magento\Framework\Exception\LocalizedException;

class Group extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Group cache tag
     */
    const CACHE_TAG = 'zetman_products_slider_group';

    /**#@+
     * Banner's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Zetman\ProductSlider\Model\ResourceModel\Group');
    }

    /**
     * Processing object before save data
     *
     * @return $this
     */
    public function beforeSave()
    {
        $groupName = $this->getData('name');
        $groupId = (int)$this->getData('id');
        $collection = $this->getCollection()->addFieldToFilter('name', $groupName);
        if ($groupId) {
            $collection = $collection->addFieldToFilter('id', ['neq' => $groupId]);
        }
        $group = $collection->getFirstItem();
        if ($group->getId()) {
            throw new LocalizedException(__('The Group Name has already existed.'));
        }
        parent::beforeSave();
        return $this;
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
