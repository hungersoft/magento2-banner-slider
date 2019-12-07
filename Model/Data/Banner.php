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

use HS\BannerSlider\Api\Data\BannerInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Banner extends AbstractExtensibleObject implements BannerInterface
{
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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setBannerId($bannerId)
    {
        return $this->setData(self::BANNER_ID, $bannerId);
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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\BannerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\BannerExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\BannerExtensionInterface $extensionAttributes
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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->_get(self::TYPE);
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Get desktop_image.
     *
     * @return string|null
     */
    public function getDesktopImage()
    {
        return $this->_get(self::DESKTOP_IMAGE);
    }

    /**
     * Set desktop_image.
     *
     * @param string $desktopImage
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setDesktopImage($desktopImage)
    {
        return $this->setData(self::DESKTOP_IMAGE, $desktopImage);
    }

    /**
     * Get html.
     *
     * @return string|null
     */
    public function getHtml()
    {
        return $this->_get(self::HTML);
    }

    /**
     * Set html.
     *
     * @param string $html
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setHtml($html)
    {
        return $this->setData(self::HTML, $html);
    }

    /**
     * Get thumb.
     *
     * @return string|null
     */
    public function getThumb()
    {
        return $this->_get(self::THUMB);
    }

    /**
     * Set thumb.
     *
     * @param string $thumb
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setThumb($thumb)
    {
        return $this->setData(self::THUMB, $thumb);
    }

    /**
     * Get url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->_get(self::URL);
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setUrl($url)
    {
        return $this->setData(self::URL, $url);
    }

    /**
     * Get open_new_window.
     *
     * @return string|null
     */
    public function getOpenNewWindow()
    {
        return $this->_get(self::OPEN_NEW_WINDOW);
    }

    /**
     * Set open_new_window.
     *
     * @param string $openNewWindow
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setOpenNewWindow($openNewWindow)
    {
        return $this->setData(self::OPEN_NEW_WINDOW, $openNewWindow);
    }

    /**
     * Get created_at.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at.
     *
     * @param string $createdAt
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at.
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at.
     *
     * @param string $updatedAt
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
