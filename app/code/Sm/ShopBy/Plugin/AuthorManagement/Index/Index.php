<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2019 Amasty (https://www.amasty.com)
 * @package Amasty_ShopbyBrand
 */


namespace Sm\ShopBy\Plugin\AuthorManagement\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\Page;

class Index
{
    protected $_resultJsonFactory;

    public function __construct(JsonFactory $resultJsonFactory){
        $this->_resultJsonFactory = $resultJsonFactory;
    }

    public function aroundExecute(\Sm\AuthorManagement\Controller\Index\Index $subject, \Closure $method){
        $response = $method();
        if($response instanceof Page){
            if($subject->getRequest()->getParam('ajax') == 1){
                $subject->getRequest()->getQuery()->set('ajax', null);
                $requestUri = $subject->getRequest()->getRequestUri();
                $requestUri = preg_replace('/(\?|&)ajax=1/', '', $requestUri);
                $subject->getRequest()->setRequestUri($requestUri);
                $productsBlockHtml = $response->getLayout()->getBlock('category.products');
				$productsBlockHtml = !empty($productsBlockHtml) ? $productsBlockHtml->toHtml() : '';
				$leftNavBlockHtml = $response->getLayout()->getBlock('catalog.leftnav');
				$leftNavBlockHtml = !empty($leftNavBlockHtml) ? $leftNavBlockHtml->toHtml() : '';
                return $this->_resultJsonFactory->create()->setData(['success' => true, 'html' => [
                    'products_list' => $productsBlockHtml,
                    'filters' => $leftNavBlockHtml
                ]]);
            }
        }
        return $response;
    }
}
