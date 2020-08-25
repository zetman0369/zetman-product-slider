<?php
namespace Zetman\ProductSlider\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_status_attribute');
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_group_attribute');

        $statusOptions = 'Zetman\ProductSlider\Model\Config\Source\StatusOptions';
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'product_status_attribute',
            [
                'group' => 'Custom Slider Groups',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Product Status',
                'input' => 'select',
                'class' => '',
                'source' => $statusOptions,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'is_used_in_grid' => true,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );

        /**
         * Add attributes to the eav_attribute
         */
        $groupOptions = 'Zetman\ProductSlider\Ui\Component\Listing\Column\Group\Options';
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'product_group_attribute',
            [
                'group' => 'Custom Slider Groups',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Slider Group',
                'input' => 'select',
                'class' => '',
                'source' => $groupOptions,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'is_used_in_grid' => true,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );
    }
}