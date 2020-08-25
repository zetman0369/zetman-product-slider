<?php
namespace Zetman\ProductSlider\Ui\Component\Listing\Column\Group;

use Magento\Framework\Escaper;
use Zetman\ProductSlider\Model\GroupFactory as ProductGroupFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
/**
 * Class Options
 */
class Options extends AbstractSource
{
    /**
     * Escaper
     *
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var ProductGroupFactory
     */
    protected $productGroupFactory;

    /**
     * @var array
     */
    protected $options;
    /**
     * Constructor
     *
     * @param BannerGroupFactory $systemStore
     * @param Escaper $escaper
     */
    public function __construct(ProductGroupFactory $productGroupFactory, Escaper $escaper)
    {
        $this->productGroupFactory = $productGroupFactory;
        $this->escaper = $escaper;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->options = $this->getAvailableGroups();

        return $this->options;
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
