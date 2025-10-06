<?php
namespace Sm\Deals\Block\Deals;

/**
 * Interceptor class for @see \Sm\Deals\Block\Deals
 */
class Interceptor extends \Sm\Deals\Block\Deals implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resourceConnection, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Eav\Model\Config $eavConfig, \Magento\Catalog\Block\Product\Context $context, array $data = [], $attr = null)
    {
        $this->___init();
        parent::__construct($resourceConnection, $objectManager, $eavConfig, $context, $data, $attr);
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
