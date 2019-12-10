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

namespace HS\BannerSlider\Model;

use Magento\Framework\Api\DataObjectHelper;
use HS\BannerSlider\Api\Data\SliderInterface;
use HS\BannerSlider\Api\Data\SliderInterfaceFactory;

class Slider extends \Magento\Framework\Model\AbstractModel
{
    protected $dataObjectHelper;

    protected $_eventPrefix = 'hs_banner_slider_slider';
    protected $sliderDataFactory;

    /**
     * @param \Magento\Framework\Model\Context                       $context
     * @param \Magento\Framework\Registry                            $registry
     * @param SliderInterfaceFactory                                 $sliderDataFactory
     * @param DataObjectHelper                                       $dataObjectHelper
     * @param \HS\BannerSlider\Model\ResourceModel\Slider            $resource
     * @param \HS\BannerSlider\Model\ResourceModel\Slider\Collection $resourceCollection
     * @param array                                                  $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SliderInterfaceFactory $sliderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \HS\BannerSlider\Model\ResourceModel\Slider $resource,
        \HS\BannerSlider\Model\ResourceModel\Slider\Collection $resourceCollection,
        array $data = []
    ) {
        $this->sliderDataFactory = $sliderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve slider model with slider data.
     *
     * @return SliderInterface
     */
    public function getDataModel()
    {
        $sliderData = $this->getData();

        $sliderDataObject = $this->sliderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $sliderDataObject,
            $sliderData,
            SliderInterface::class
        );

        return $sliderDataObject;
    }

    /**
     * Retrieve array of banner id's for slider.
     *
     * The array returned has the following format:
     * array($bannerId => $position)
     *
     * @return array
     */
    public function getBannersPosition()
    {
        if (!$this->getId()) {
            return [];
        }

        $array = $this->getData('banners_position');
        if ($array === null) {
            $array = $this->getResource()->getBannersPosition($this);
            $this->setData('banners_position', $array);
        }

        return $array;
    }
}
