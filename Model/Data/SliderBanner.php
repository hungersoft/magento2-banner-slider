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

namespace HS\BannerSlider\Model\Data;

use HS\BannerSlider\Api\Data\SliderBannerInterface;

class SliderBanner extends \Magento\Framework\Api\AbstractExtensibleObject implements SliderBannerInterface
{
    /**
     * Get slider_banner_id.
     *
     * @return string|null
     */
    public function getSliderbannerId()
    {
        return $this->_get(self::SLIDERBANNER_ID);
    }

    /**
     * Set slider_banner_id.
     *
     * @param string $sliderbannerId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setSliderbannerId($sliderbannerId)
    {
        return $this->setData(self::SLIDERBANNER_ID, $sliderbannerId);
    }

    /**
     * Get slider_id.
     *
     * @return string|null
     */
    public function getSliderId()
    {
        return $this->_get(self::SLIDER_ID);
    }

    /**
     * Set slider_id.
     *
     * @param string $sliderId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setSliderId($sliderId)
    {
        return $this->setData(self::SLIDER_ID, $sliderId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get banner_id.
     *
     * @return string|null
     */
    public function getBannerId()
    {
        return $this->_get(self::BANNER_ID);
    }

    /**
     * Set banner_id.
     *
     * @param string $bannerId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setBannerId($bannerId)
    {
        return $this->setData(self::BANNER_ID, $bannerId);
    }
}
