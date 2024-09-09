<?php

declare(strict_types=1);

namespace Biotus\ProductQty\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductTypes\ConfigInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Json\EncoderInterface as JsonEncoder;
use Magento\Framework\Locale\FormatInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Framework\Url\EncoderInterface;
use Magento\Store\Model\ScopeInterface as StoreScope;

/**
 * Block for showing the current product salable qty on the PDP
 * @class Biotus\ProductQty\Block\ProductQty
 */
class ProductQty extends View
{
    const IS_QTY_BLOCK_ENABLED_CONFIG_PATH = 'product_qty_block/general/enable';
    const CACHE_LIFETIME_CONFIG_PATH = 'product_qty_block/general/ttl';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param Context $context
     * @param EncoderInterface $urlEncoder
     * @param JsonEncoder $jsonEncoder
     * @param StringUtils $string
     * @param Product $productHelper
     * @param ConfigInterface $productTypeConfig
     * @param FormatInterface $localeFormat
     * @param Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        Context $context,
        EncoderInterface $urlEncoder,
        JsonEncoder $jsonEncoder,
        StringUtils $string,
        Product $productHelper,
        ConfigInterface $productTypeConfig,
        FormatInterface $localeFormat,
        Session $customerSession,
        ProductRepositoryInterface $productRepository,
        PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
    }

    /**
     * @return bool|int|null
     */
    protected function getCacheLifetime(): bool|int|null
    {
        if (!$this->scopeConfig->isSetFlag(self::IS_QTY_BLOCK_ENABLED_CONFIG_PATH, StoreScope::SCOPE_STORE)) {
            return parent::getCacheLifetime();
        }
        return (int) $this->scopeConfig->getValue(self::CACHE_LIFETIME_CONFIG_PATH, StoreScope::SCOPE_STORE);
    }
}
