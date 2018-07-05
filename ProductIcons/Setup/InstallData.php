<?php

namespace TPB\ProductIcons\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
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
        $attributes = [
            Yarn::class,
            Gauge::class,
            ManufactureLocation::class,
            HandLinked::class,
            Length::class,
            Construction::class,
        ];

        foreach($attributes as $attribute) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Product::ENTITY,
                $attribute::ATTR_CODE,
                $attribute::getAttributeInstallConfig()
            );
        }
    }
}