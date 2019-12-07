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

namespace HS\BannerSlider\Api\Data;

interface SliderBannerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const SLIDERBANNER_ID = 'sliderbanner_id';
    const SLIDER_ID = 'slider_id';
    const BANNER_ID = 'banner_id';

    /**
     * Get sliderbanner_id.
     *
     * @return string|null
     */
    public function getSliderbannerId();

    /**
     * Set sliderbanner_id.
     *
     * @param string $sliderbannerId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setSliderbannerId($sliderbannerId);

    /**
     * Get slider_id.
     *
     * @return string|null
     */
    public function getSliderId();

    /**
     * Set slider_id.
     *
     * @param string $sliderId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setSliderId($sliderId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\SliderBannerExtensionInterface $extensionAttributes
    );

    /**
     * Get banner_id.
     *
     * @return string|null
     */
    public function getBannerId();

    /**
     * Set banner_id.
     *
     * @param string $bannerId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     */
    public function setBannerId($bannerId);
}
