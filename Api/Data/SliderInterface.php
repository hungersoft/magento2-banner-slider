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

interface SliderInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const EFFECT = 'effect';
    const USE_GLOBAL_CONFIG = 'use_global_config';
    const AUTOPLAY_TIMEOUT = 'autoplay_timeout';
    const AUTO_HEIGHT = 'auto_height';
    const NAV = 'nav';
    const LOOP = 'loop';
    const NAME = 'name';
    const AUTOPLAY = 'autoplay';
    const AUTO_WIDTH = 'auto_width';
    const SLIDER_ID = 'slider_id';
    const RESPONSIVE = 'responsive';
    const CONTROLS = 'controls';
    const ACTIVE = 'active';
    const LAZYLOAD = 'lazyload';
    const NAV_AS_THUMBNAILS = 'nav_as_thumbnails';

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
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setSliderId($sliderId);

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\SliderExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\SliderExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\SliderExtensionInterface $extensionAttributes
    );

    /**
     * Get active.
     *
     * @return string|null
     */
    public function getActive();

    /**
     * Set active.
     *
     * @param string $active
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setActive($active);

    /**
     * Get effect.
     *
     * @return string|null
     */
    public function getEffect();

    /**
     * Set effect.
     *
     * @param string $effect
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setEffect($effect);

    /**
     * Get use_global_config.
     *
     * @return string|null
     */
    public function getUseGlobalConfig();

    /**
     * Set use_global_config.
     *
     * @param string $useGlobalConfig
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setUseGlobalConfig($useGlobalConfig);

    /**
     * Get responsive.
     *
     * @return string|null
     */
    public function getResponsive();

    /**
     * Set responsive.
     *
     * @param string $responsive
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setResponsive($responsive);

    /**
     * Get loop.
     *
     * @return string|null
     */
    public function getLoop();

    /**
     * Set loop.
     *
     * @param string $loop
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setLoop($loop);

    /**
     * Get auto_width.
     *
     * @return string|null
     */
    public function getAutoWidth();

    /**
     * Set auto_width.
     *
     * @param string $autoWidth
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoWidth($autoWidth);

    /**
     * Get auto_height.
     *
     * @return string|null
     */
    public function getAutoHeight();

    /**
     * Set auto_height.
     *
     * @param string $autoHeight
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoHeight($autoHeight);

    /**
     * Get controls.
     *
     * @return string|null
     */
    public function getControls();

    /**
     * Set controls.
     *
     * @param string $controls
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setControls($controls);

    /**
     * Get nav.
     *
     * @return string|null
     */
    public function getNav();

    /**
     * Set nav.
     *
     * @param string $nav
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setNav($nav);

    /**
     * Get nav_as_thumbnails.
     *
     * @return string|null
     */
    public function getNavAsThumbnails();

    /**
     * Set nav_as_thumbnails.
     *
     * @param string $navAsThumbnails
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setNavAsThumbnails($navAsThumbnails);

    /**
     * Get autoplay.
     *
     * @return string|null
     */
    public function getAutoplay();

    /**
     * Set autoplay.
     *
     * @param string $autoplay
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoplay($autoplay);

    /**
     * Get autoplay_timeout.
     *
     * @return string|null
     */
    public function getAutoplayTimeout();

    /**
     * Set autoplay_timeout.
     *
     * @param string $autoplayTimeout
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoplayTimeout($autoplayTimeout);

    /**
     * Get lazyload.
     *
     * @return string|null
     */
    public function getLazyload();

    /**
     * Set lazyload.
     *
     * @param string $lazyload
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setLazyload($lazyload);

    /**
     * Get created_at.
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at.
     *
     * @param string $createdAt
     *
     * @return \HS\BannerSliderPro\Api\Data\SliderInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at.
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at.
     *
     * @param string $updatedAt
     *
     * @return \HS\BannerSliderPro\Api\Data\SliderInterface
     */
    public function setUpdatedAt($updatedAt);
}
