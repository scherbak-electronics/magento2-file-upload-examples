<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model;

use Magento\Framework\UrlInterface as MagentoUrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Shch\Document\Api\ConfigInterface;

class ConfigProvider implements ConfigInterface
{
    private StoreManagerInterface $storeManager;

    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    public function getMediaUrl(?string $file): ?string
    {
        if (!$file) {
            return null;
        }
        $url = $this->storeManager
                ->getStore()
                ->getBaseUrl(MagentoUrlInterface::URL_TYPE_MEDIA) . $this::DATASHEET_FILES_FOLDER;
        $url .= $file;
        return $url;
    }
}
