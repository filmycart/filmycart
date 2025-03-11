<?php
/**
 *
 * SM Shop By - Version 2.0.1
 * Copyright (c) 2017 YouTech Company. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: YouTech Company
 * Websites: http://www.magentech.com
 */

namespace Sm\ShopBy\Plugin\CatalogSearch\Advanced;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\CatalogSearch\Model\Advanced as ModelAdvanced;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\UrlFactory;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Result
{
	protected $_objectManager;
    /**
     * Url factory
     *
     * @var UrlFactory
     */
    protected $_urlFactory;

    /**
     * Catalog search advanced
     *
     * @var ModelAdvanced
     */
    protected $_catalogSearchAdvanced;
	
	protected $_resultJsonFactory;
	
	protected $_resultPageFactory;

    /**
     * Construct
     *
     * @param Context $context
     * @param ModelAdvanced $catalogSearchAdvanced
     * @param UrlFactory $urlFactory
     */
    public function __construct(
		ObjectManagerInterface $objectManager,
        ModelAdvanced $catalogSearchAdvanced,
        UrlFactory $urlFactory,
		PageFactory $resultPageFactory,
		JsonFactory $resultJsonFactory
    ) {
		$this->_objectManager = $objectManager;
        $this->_catalogSearchAdvanced = $catalogSearchAdvanced;
        $this->_urlFactory = $urlFactory;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_resultJsonFactory = $resultJsonFactory;
    }

    public function aroundExecute(\Magento\CatalogSearch\Controller\Advanced\Result $subject, \Closure $method){
		if($subject->getRequest()->getParam('ajax') == 1){
			$subject->getRequest()->getQuery()->set('ajax', null);
			$requestUri = $subject->getRequest()->getRequestUri();
			$requestUri = preg_replace('/(\?|&)ajax=1/', '', $requestUri);
			$subject->getRequest()->setRequestUri($requestUri);
			$this->_catalogSearchAdvanced->addFilters($subject->getRequest()->getQueryValue());
			$_layout  = $this->_objectManager->get('Magento\Framework\View\LayoutInterface');
			$resultsBlockHtml = $this->_resultPageFactory->create()->getLayout()->getBlock('catalogsearch_advanced_result');
			$resultsBlockHtml = !empty($resultsBlockHtml) ? $resultsBlockHtml->toHtml() : '';
			$leftNavBlockHtml = '';
			return $this->_resultJsonFactory->create()->setData(['success' => true, 'html' => [
				'products_list' => $resultsBlockHtml,
				'filters' => $leftNavBlockHtml
			]]);
		}else{
			return $method();
		}
    }
}