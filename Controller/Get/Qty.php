<?php

declare(strict_types=1);

namespace Biotus\ProductQty\Controller\Get;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\InventorySalesApi\Api\Data\SalesChannelInterface;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;
use Magento\InventorySalesApi\Api\StockResolverInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Controller for the 'product_qty/get/index' URL route.
 * Returns the product quantity
 *
 * @class Biotus\ProductQty\Controller\Get\Qty
 */
class Qty extends Action implements HttpPostActionInterface
{
    /**
     * @param Context $context
     * @param GetProductSalableQtyInterface $getProductSalableQty
     * @param StockResolverInterface $stockResolver
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        private readonly GetProductSalableQtyInterface $getProductSalableQty,
        private readonly StockResolverInterface $stockResolver,
        private readonly StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
    }

    /**
     * Execute controller action.
     * @throws LocalizedException
     */
    public function execute()
    {
        $request = $this->getRequest();
        $productSku = $request->getParam('productSku');
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        if ($productSku) {
            $websiteCode = $this->storeManager->getWebsite()->getCode();
            $stockId = $this->stockResolver->execute(SalesChannelInterface::TYPE_WEBSITE, $websiteCode)
                ->getStockId();
            $qty = $this->getProductSalableQty->execute($productSku, $stockId);
            $response->setData(['qty' => $qty]);
        }
        return $response;
    }
}
