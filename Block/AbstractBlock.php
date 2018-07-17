<?php

namespace TPB\ProductIcons\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use TPB\ProductIcons\Attributes\AttributeConfig;
use TPB\ProductIcons\Helper\Data;

class AbstractBlock extends Template
{
    /** @var Data */
    protected $helperData;
    /** @var Registry */
    protected $registry;

    protected $product;

    /** @var string */
    protected $blockCode = '';

    /**
     * ProductTopBarIcons constructor.
     *
     * @param Context  $context
     * @param Registry $registry
     * @param Data     $helperData
     */
    public function __construct(
        Context  $context,
        Registry $registry,
        Data     $helperData
    ) {
        $this->registry   = $registry;
        $this->helperData = $helperData;
        $this->product    = $this->getCurrentProduct();

        parent::__construct($context);
    }

    /**
     * @param string $attrCode
     *
     * @return bool
     */
    public function isDisplayAttribute(string $attrCode) :bool
    {
        if (empty($this->helperData->getGeneralConfig(AttributeConfig::getAttributeConfig()[$attrCode]['config_code'])) === true) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isBlockEnabled() :bool
    {
        if (empty($this->helperData->getGeneralConfig($this->blockCode)) === true) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @param string $code
     *
     * @return mixed
     */
    public function getAttributeData(string $code)
    {
        return $this->helperData->getAttributeData($code, $this->product);
    }

    /**
     * @return array
     */
    public function getAttrCodeList() :array
    {
        return AttributeConfig::getAttributeCodes();
    }

    /**
     * @param string $data
     * @param string $attrCode
     *
     * @return string
     */
    public function getIconFileNameByAttributeData(
        string $data,
        string $attrCode
    ) :string {
        foreach(AttributeConfig::getAttributeConfig() as $code => $configItem) {
            if ($code === $attrCode) {
                $class = $configItem['class'];
                return $class::getIconFileNameByAttributeLabel($data);
            }
        }

        return '';
    }
}