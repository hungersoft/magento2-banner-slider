<?php
/**
 * Copyright 2019 Hungersoft (http://www.hungersoft.com).
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace HS\BannerSlider\Helper;

use Magento\Store\Model\Store;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const CONFIG_ENABLED = 'hs_banner_slider/general/enabled';

    /**
     * Product labels media directory path.
     *
     * @var string
     */
    protected $mediaDir = '/hs/banner_slider';

    /**
     * Currently selected store ID if applicable.
     *
     * @var int
     */
    protected $_storeId = null;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(Context $context, StoreManagerInterface $storeManager, Store $store)
    {
        $this->storeManager = $storeManager;
        $this->store = $store;
        parent::__construct($context);
    }

    /**
     * Get config value by path.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function getConfigValue($path, $storeId = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Get config flag by path.
     *
     * @param string $path
     *
     * @return bool
     */
    public function getConfigFlag($path)
    {
        return $this->scopeConfig->isSetFlag($path, ScopeInterface::SCOPE_STORE, $this->_storeId);
    }

    /**
     * Return true if active and false otherwise.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->getConfigFlag(self::CONFIG_ENABLED);
    }

    /**
     * Retrieves absolute image url.
     *
     * @param $path
     *
     * @return string
     */
    public function getImageUrl($path)
    {
        if (false === strpos($path, $this->mediaDir)) {
            $path = $this->mediaDir.'/'.$path;
        }

        return $this->store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA).$path;
    }
}
