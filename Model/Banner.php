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

use HS\BannerSlider\Api\Data\BannerInterfaceFactory;
use HS\BannerSlider\Api\Data\BannerInterface;
use Magento\Framework\Api\DataObjectHelper;

class Banner extends \Magento\Framework\Model\AbstractModel
{
    protected $dataObjectHelper;

    protected $bannerDataFactory;

    protected $_eventPrefix = 'hs_bannerslider_banner';

    /**
     * @param \Magento\Framework\Model\Context                       $context
     * @param \Magento\Framework\Registry                            $registry
     * @param BannerInterfaceFactory                                 $bannerDataFactory
     * @param DataObjectHelper                                       $dataObjectHelper
     * @param \HS\BannerSlider\Model\ResourceModel\Banner            $resource
     * @param \HS\BannerSlider\Model\ResourceModel\Banner\Collection $resourceCollection
     * @param array                                                  $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BannerInterfaceFactory $bannerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \HS\BannerSlider\Model\ResourceModel\Banner $resource,
        \HS\BannerSlider\Model\ResourceModel\Banner\Collection $resourceCollection,
        array $data = []
    ) {
        $this->bannerDataFactory = $bannerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve banner model with banner data.
     *
     * @return BannerInterface
     */
    public function getDataModel()
    {
        $bannerData = $this->getData();

        $bannerDataObject = $this->bannerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $bannerDataObject,
            $bannerData,
            BannerInterface::class
        );

        return $bannerDataObject;
    }
}
