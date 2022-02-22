<?php

declare(strict_types=1);

namespace Branch8\OpenApi\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const XML_PATH_IS_ENABLED = 'branch8/openapi/enabled';
    public const XML_PATH_API_URL = 'branch8/openapi/api_url';

    /**
     * Check is current module enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get API config endpoint
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_API_URL, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get price from API endpoint
     *
     * @return bool|string
     */
    public function getPrice()
    {
        return $this->executeGET($this->getApiUrl());
    }

    /**
     * Execute curl to get global price
     *
     * @param string $url
     * @return bool|string
     */
    public function executeGET(string $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
