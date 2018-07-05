<?php

namespace TPB\ProductIcons\Attributes;

class AttributeConfig
{
    /** @var array */
    const ATTR_CONFIG = [
        Size::ATTR_CODE => [
            'class'       => Size::class,
            'config_code' => Size::ATTR_CONFIG_CODE,
        ],
    ];

    /**
     * @return array
     */
    public static function getAttributeCodes() :array
    {
        return array_keys(self::ATTR_CONFIG);
    }

    /**
     * @return array
     */
    public static function getAttributeConfig() :array
    {
        return self::ATTR_CONFIG;
    }
}