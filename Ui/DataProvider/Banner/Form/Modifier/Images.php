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

namespace HS\BannerSlider\Ui\DataProvider\Banner\Form\Modifier;

use Magento\Framework\Registry;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use HS\BannerSlider\Model\Banner;
use HS\BannerSlider\Helper\Data as BannerSliderHelper;

class Images implements ModifierInterface
{
    const FIELD_LABEL_DESKTOP_IMAGE = 'desktop_image';
    const FIELD_LABEL_MOBILE_IMAGE = 'mobile_image';
    const FIELD_LABEL_THUMB = 'thumb';

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var Banner
     */
    private $banner;

    /**
     * @var BannerSliderHelper
     */
    private $helper;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry, BannerSliderHelper $helper)
    {
        $this->registry = $registry;
        $this->helper = $helper;
    }

    /**
     * @return Banner
     *
     * @throws NotFoundException
     */
    public function getBanner()
    {
        if (null !== $this->banner) {
            return $this->banner;
        }

        if ($banner = $this->registry->registry('hs_banner_slider_banner')) {
            return $this->banner = $banner;
        }

        throw new NotFoundException(__("The banner wasn't registered."));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        $bannerId = $this->getBanner()->getBannerId();
        if (isset($data[$bannerId][self::FIELD_LABEL_DESKTOP_IMAGE])) {
            $imageName = $data[$bannerId][self::FIELD_LABEL_DESKTOP_IMAGE];
            $data[$bannerId][self::FIELD_LABEL_DESKTOP_IMAGE] = [[
                'name' => $imageName,
                'url' => $this->helper->getImageUrl($imageName),
            ]];
        }

        if (isset($data[$bannerId][self::FIELD_LABEL_MOBILE_IMAGE])) {
            $imageName = $data[$bannerId][self::FIELD_LABEL_MOBILE_IMAGE];
            $data[$bannerId][self::FIELD_LABEL_MOBILE_IMAGE] = [[
                'name' => $imageName,
                'url' => $this->helper->getImageUrl($imageName),
            ]];
        }

        if (isset($data[$bannerId][self::FIELD_LABEL_THUMB])) {
            $imageName = $data[$bannerId][self::FIELD_LABEL_THUMB];
            $data[$bannerId][self::FIELD_LABEL_THUMB] = [[
                'name' => $imageName,
                'url' => $this->helper->getImageUrl($imageName),
            ]];
        }

        return $data;
    }
}
