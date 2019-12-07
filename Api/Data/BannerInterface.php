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

interface BannerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const DESKTOP_IMAGE = 'desktop_image';
    const BANNER_ID = 'banner_id';
    const URL = 'url';
    const DESCRIPTION = 'description';
    const NAME = 'name';
    const HTML = 'html';
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const THUMB = 'thumb';
    const ACTIVE = 'active';
    const OPEN_NEW_WINDOW = 'open_new_window';
    const TYPE = 'type';

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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setBannerId($bannerId);

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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \HS\BannerSlider\Api\Data\BannerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \HS\BannerSlider\Api\Data\BannerExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \HS\BannerSlider\Api\Data\BannerExtensionInterface $extensionAttributes
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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setActive($active);

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setDescription($description);

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType();

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setType($type);

    /**
     * Get desktop_image.
     *
     * @return string|null
     */
    public function getDesktopImage();

    /**
     * Set desktop_image.
     *
     * @param string $desktopImage
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setDesktopImage($desktopImage);

    /**
     * Get html.
     *
     * @return string|null
     */
    public function getHtml();

    /**
     * Set html.
     *
     * @param string $html
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setHtml($html);

    /**
     * Get thumb.
     *
     * @return string|null
     */
    public function getThumb();

    /**
     * Set thumb.
     *
     * @param string $thumb
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setThumb($thumb);

    /**
     * Get url.
     *
     * @return string|null
     */
    public function getUrl();

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setUrl($url);

    /**
     * Get open_new_window.
     *
     * @return string|null
     */
    public function getOpenNewWindow();

    /**
     * Set open_new_window.
     *
     * @param string $openNewWindow
     *
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setOpenNewWindow($openNewWindow);

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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
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
     * @return \HS\BannerSlider\Api\Data\BannerInterface
     */
    public function setUpdatedAt($updatedAt);
}
