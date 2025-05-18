<?php
namespace Magento\Framework\Acl\AclResource\TreeBuilder;

/**
 * Interceptor class for @see \Magento\Framework\Acl\AclResource\TreeBuilder
 */
class Interceptor extends \Magento\Framework\Acl\AclResource\TreeBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $resourceList)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'build');
        return $pluginInfo ? $this->___callPlugins('build', func_get_args(), $pluginInfo) : parent::build($resourceList);
    }
}
