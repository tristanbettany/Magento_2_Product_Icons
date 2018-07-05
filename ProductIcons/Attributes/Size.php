<?php

namespace TPB\ProductIcons\Attributes;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class Size
{
    /** @var string */
    const ATTR_CODE        = 'size';
    /** @var string */
    const ATTR_LABEL       = 'Size';
    /** @var string */
    const ATTR_GROUP_NAME  = 'Product Icons';
    /** @var string */
    const ATTR_CONFIG_CODE = 'displaysize';

    /**
     * @return array
     */
    public static function getAttributeOptions() :array
    {
        $options = [
            'value' => [
                'option_0' => [
                    0 => 'Small',
                    1 => 'Small',
                ],
                'option_1' => [
                    0 => 'Medium',
                    1 => 'Medium',
                ],
                'option_2' => [
                    0 => 'Large',
                    1 => 'Large',
                ],
            ],
        ];

        return $options;
    }

    /**
     * @return array
     */
    public static function getAttributeInstallConfig() :array
    {
        $config = [
            'group'                   => self::ATTR_GROUP_NAME,
            'type'                    => 'int',
            'backend'                 => '',
            'frontend'                => '',
            'label'                   => self::ATTR_LABEL,
            'input'                   => 'select',
            'class'                   => '',
            'global'                  => ScopedAttributeInterface::SCOPE_STORE,
            'visible'                 => true,
            'required'                => false,
            'user_defined'            => true,
            'default'                 => '0',
            'searchable'              => true,
            'filterable'              => true,
            'comparable'              => false,
            'visible_on_front'        => true,
            'used_in_product_listing' => true,
            'unique'                  => false,
            'is_used_in_grid'         => true,
            'is_visible_in_grid'      => true,
            'is_filterable_in_grid'   => true,
            'option'                  => self::getAttributeOptions(),
        ];

        return $config;
    }

    /**
     * @param string $data
     * 
     * @return string
     */
    public static function getIconFileNameByAttributeLabel(string $data) :string
    {
        switch ($data) {
            case 'Small':
                return 'small.png';
                break;
            case 'Medium':
                return 'medium.png';
                break;
            case 'Large':
                return 'large.png';
                break;

            default:
                return '';
        }
    }
}