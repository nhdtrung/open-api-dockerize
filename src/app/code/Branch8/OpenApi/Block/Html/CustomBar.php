<?php

declare(strict_types=1);

namespace Branch8\OpenApi\Block\Html;

use Branch8\OpenApi\Helper\Config as OpenApiConfig;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CustomBar extends Template
{
    /**
     * @var openApiConfig
     */
    protected OpenApiConfig $openApiConfig;

    /**
     * Constructor.
     * @param Context $context
     * @param OpenApiConfig $openApiConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        OpenApiConfig $openApiConfig,
        array $data = []
    ) {
        $this->openApiConfig = $openApiConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get global price from API
     *
     * @return mixed
     */
    public function getPrice()
    {
        $priceData = $this->openApiConfig->getPrice();

        return json_decode($priceData, true);
    }

    /**
     * Get API config endpoint
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->openApiConfig->getApiUrl();
    }

    /**
     * Check is module enabled
     *
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        return $this->openApiConfig->isEnabled();
    }
}
