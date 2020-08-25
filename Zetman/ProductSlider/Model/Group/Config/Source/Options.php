<?php
namespace Zetman\ProductSlider\Model\Group\Config\Source;

use Magento\Framework\Escaper;
use Zetman\ProductSlider\Model\GroupFactory as ProductGroupFactory;

class Options implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var ProductGroupFactory
     */
    protected $productGroupFactory;

    /**
     * Escaper
     *
     * @var Escaper
     */
    protected $escaper;

    /**
     * Constructor
     *
     * @param ProductGroupFactory $systemStore
     * @param Escaper $escaper
     */
    public function __construct(ProductGroupFactory $productGroupFactory, Escaper $escaper)
    {
        $this->productGroupFactory = $productGroupFactory;
        $this->escaper = $escaper;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getAvailableGroups();
    }

    /**
     * Prepare groups
     *
     * @return array
     */
    private function getAvailableGroups()
    {
        $collection = $this->productGroupFactory->create()->getCollection();
        $result = [];
        $result[] = ['value' => ' ', 'label' => 'Select...'];
        foreach ($collection as $group) {
            $result[] = ['value' => $group->getId(), 'label' => $this->escaper->escapeHtml($group->getName())];
        }
        return $result;
    }
}
