<?php

namespace TPB\ProductIcons\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use TPB\ProductIcons\Attributes\AttributeConfig;
use TPB\ProductIcons\Attributes\Construction;
use TPB\ProductIcons\Attributes\Gauge;
use TPB\ProductIcons\Attributes\HandLinked;
use TPB\ProductIcons\Attributes\Length;
use TPB\ProductIcons\Attributes\ManufactureLocation;
use TPB\ProductIcons\Attributes\Yarn;

class InstallData implements InstallDataInterface
{
    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface   $context
    ) {
        foreach(AttributeConfig::getAttributeConfig() as $attribute) {
            $class = $attribute['class'];

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Product::ENTITY,
                $class::ATTR_CODE,
                $class::getAttributeInstallConfig()
            );
        }
    }
}