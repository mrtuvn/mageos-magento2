<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\TestModuleAdminAdobeIms\Model;

use Magento\AdminAdobeIms\Service\ImsConfig;
use Magento\AdobeIms\Model\GetToken;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Mock Ims Connection implementation
 */
class ImsConnection extends \Magento\AdminAdobeIms\Model\ImsConnection
{

    /**
     * @var MockResponseBodyLoader
     */
    private MockResponseBodyLoader $mockResponseBodyLoader;
    /**
     * @var Json
     */
    private Json $json;

    /**
     * @param CurlFactory $curlFactory
     * @param ImsConfig $imsConfig
     * @param Json $json
     * @param GetToken $token
     * @param MockResponseBodyLoader $mockResponseBodyLoader
     */
    public function __construct(
        CurlFactory $curlFactory,
        ImsConfig $imsConfig,
        Json $json,
        GetToken $token,
        MockResponseBodyLoader $mockResponseBodyLoader
    ) {
        parent::__construct($curlFactory, $imsConfig, $json, $token);
        $this->mockResponseBodyLoader = $mockResponseBodyLoader;
        $this->json = $json;
    }

    /**
     * @inheritdoc
     */
    public function getProfile(string $code)
    {
        $responseBody = $this->mockResponseBodyLoader->loadForRequest();
        return $this->json->unserialize($responseBody);
    }
}
