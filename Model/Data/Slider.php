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

use HS\BannerSlider\Api\Data\SliderInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Slider extends AbstractExtensibleObject implements SliderInterface
{
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
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setSliderId($sliderId)
    {
        return $this->setData(self::SLIDER_ID, $sliderId);
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\SliderExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\SliderExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\SliderExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get active.
     *
     * @return string|null
     */
    public function getActive()
    {
        return $this->_get(self::ACTIVE);
    }

    /**
     * Set active.
     *
     * @param string $active
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * Get effect.
     *
     * @return string|null
     */
    public function getEffect()
    {
        return $this->_get(self::EFFECT);
    }

    /**
     * Set effect.
     *
     * @param string $effect
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setEffect($effect)
    {
        return $this->setData(self::EFFECT, $effect);
    }

    /**
     * Get use_global_config.
     *
     * @return string|null
     */
    public function getUseGlobalConfig()
    {
        return $this->_get(self::USE_GLOBAL_CONFIG);
    }

    /**
     * Set use_global_config.
     *
     * @param string $useGlobalConfig
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setUseGlobalConfig($useGlobalConfig)
    {
        return $this->setData(self::USE_GLOBAL_CONFIG, $useGlobalConfig);
    }

    /**
     * Get responsive.
     *
     * @return string|null
     */
    public function getResponsive()
    {
        return $this->_get(self::RESPONSIVE);
    }

    /**
     * Set responsive.
     *
     * @param string $responsive
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setResponsive($responsive)
    {
        return $this->setData(self::RESPONSIVE, $responsive);
    }

    /**
     * Get loop.
     *
     * @return string|null
     */
    public function getLoop()
    {
        return $this->_get(self::LOOP);
    }

    /**
     * Set loop.
     *
     * @param string $loop
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setLoop($loop)
    {
        return $this->setData(self::LOOP, $loop);
    }

    /**
     * Get auto_width.
     *
     * @return string|null
     */
    public function getAutoWidth()
    {
        return $this->_get(self::AUTO_WIDTH);
    }

    /**
     * Set auto_width.
     *
     * @param string $autoWidth
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoWidth($autoWidth)
    {
        return $this->setData(self::AUTO_WIDTH, $autoWidth);
    }

    /**
     * Get auto_height.
     *
     * @return string|null
     */
    public function getAutoHeight()
    {
        return $this->_get(self::AUTO_HEIGHT);
    }

    /**
     * Set auto_height.
     *
     * @param string $autoHeight
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoHeight($autoHeight)
    {
        return $this->setData(self::AUTO_HEIGHT, $autoHeight);
    }

    /**
     * Get controls.
     *
     * @return string|null
     */
    public function getControls()
    {
        return $this->_get(self::CONTROLS);
    }

    /**
     * Set controls.
     *
     * @param string $controls
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setControls($controls)
    {
        return $this->setData(self::CONTROLS, $controls);
    }

    /**
     * Get nav.
     *
     * @return string|null
     */
    public function getNav()
    {
        return $this->_get(self::NAV);
    }

    /**
     * Set nav.
     *
     * @param string $nav
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setNav($nav)
    {
        return $this->setData(self::NAV, $nav);
    }

    /**
     * Get nav_as_thumbnails.
     *
     * @return string|null
     */
    public function getNavAsThumbnails()
    {
        return $this->_get(self::NAV_AS_THUMBNAILS);
    }

    /**
     * Set nav_as_thumbnails.
     *
     * @param string $navAsThumbnails
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setNavAsThumbnails($navAsThumbnails)
    {
        return $this->setData(self::NAV_AS_THUMBNAILS, $navAsThumbnails);
    }

    /**
     * Get autoplay.
     *
     * @return string|null
     */
    public function getAutoplay()
    {
        return $this->_get(self::AUTOPLAY);
    }

    /**
     * Set autoplay.
     *
     * @param string $autoplay
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoplay($autoplay)
    {
        return $this->setData(self::AUTOPLAY, $autoplay);
    }

    /**
     * Get autoplay_timeout.
     *
     * @return string|null
     */
    public function getAutoplayTimeout()
    {
        return $this->_get(self::AUTOPLAY_TIMEOUT);
    }

    /**
     * Set autoplay_timeout.
     *
     * @param string $autoplayTimeout
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setAutoplayTimeout($autoplayTimeout)
    {
        return $this->setData(self::AUTOPLAY_TIMEOUT, $autoplayTimeout);
    }

    /**
     * Get lazyload.
     *
     * @return string|null
     */
    public function getLazyload()
    {
        return $this->_get(self::LAZYLOAD);
    }

    /**
     * Set lazyload.
     *
     * @param string $lazyload
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     */
    public function setLazyload($lazyload)
    {
        return $this->setData(self::LAZYLOAD, $lazyload);
    }
}
