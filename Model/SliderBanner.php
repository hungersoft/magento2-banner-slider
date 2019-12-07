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

use HS\BannerSlider\Api\Data\SliderBannerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use HS\BannerSlider\Api\Data\SliderBannerInterface;

class SliderBanner extends \Magento\Framework\Model\AbstractModel
{
    protected $dataObjectHelper;

    protected $_eventPrefix = 'hs_bannerslider_sliderbanner';
    protected $sliderbannerDataFactory;

    /**
     * @param \Magento\Framework\Model\Context                             $context
     * @param \Magento\Framework\Registry                                  $registry
     * @param SliderBannerInterfaceFactory                                 $sliderbannerDataFactory
     * @param DataObjectHelper                                             $dataObjectHelper
     * @param \HS\BannerSlider\Model\ResourceModel\SliderBanner            $resource
     * @param \HS\BannerSlider\Model\ResourceModel\SliderBanner\Collection $resourceCollection
     * @param array                                                        $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SliderBannerInterfaceFactory $sliderbannerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \HS\BannerSlider\Model\ResourceModel\SliderBanner $resource,
        \HS\BannerSlider\Model\ResourceModel\SliderBanner\Collection $resourceCollection,
        array $data = []
    ) {
        $this->sliderbannerDataFactory = $sliderbannerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve sliderbanner model with sliderbanner data.
     *
     * @return SliderBannerInterface
     */
    public function getDataModel()
    {
        $sliderbannerData = $this->getData();

        $sliderbannerDataObject = $this->sliderbannerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $sliderbannerDataObject,
            $sliderbannerData,
            SliderBannerInterface::class
        );

        return $sliderbannerDataObject;
    }
}
