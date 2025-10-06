<?php
namespace Sm\BasicProducts\Block\BasicProducts;

/**
 * Interceptor class for @see \Sm\BasicProducts\Block\BasicProducts
 */
class Interceptor extends \Sm\BasicProducts\Block\BasicProducts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resourceConnection, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Eav\Model\Config $eavConfig, \Magento\Catalog\Block\Product\Context $context, array $data = [], $attr = null)
    {
        $this->___init();
        parent::__construct($resourceConnection, $objectManager, $localeResolver, $eavConfig, $context, $data, $attr);
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        return $pluginInfo ? $this->___callPlugins('getImage', func_get_args(), $pluginInfo) : parent::getImage($product, $imageId, $attributes);
    }
}
