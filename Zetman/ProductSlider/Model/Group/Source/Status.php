<?php
namespace Zetman\ProductSlider\Model\Group\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Zetman\ProductSlider\Model\Group
     */
    protected $group;

    /**
     * Constructor
     *
     * @param \Zetman\ProudctSlider\Model\Gourp $group
     */
    public function __construct(\Zetman\ProductSlider\Model\Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->group->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
