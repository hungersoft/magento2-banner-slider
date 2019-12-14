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

use Magento\Framework\Registry;
use Magento\Framework\Model\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\ImageUploader;
use HS\BannerSlider\Api\Data\BannerInterfaceFactory;
use HS\BannerSlider\Model\ResourceModel\Banner as ResourceBanner;
use HS\BannerSlider\Model\ResourceModel\Banner\Collection as CollectionBanner;

class Banner extends AbstractModel
{
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var BannerInterfaceFactory
     */
    private $bannerDataFactory;

    /**
     * @var ImageUploader
     */
    private $imageUploader;

    protected $_eventPrefix = 'hs_banner_slider_banner';

    /**
     * @param Context                $context
     * @param Registry               $registry
     * @param BannerInterfaceFactory $bannerDataFactory
     * @param DataObjectHelper       $dataObjectHelper
     * @param ResourceBanner         $resource
     * @param CollectionBanner       $resourceCollection
     * @param array                  $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        BannerInterfaceFactory $bannerDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceBanner $resource,
        CollectionBanner $resourceCollection,
        ImageUploader $imageUploader,
        array $data = []
    ) {
        $this->bannerDataFactory = $bannerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->imageUploader = $imageUploader;

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

    /**
     * Processing object before save data.
     *
     * @return $this
     */
    public function beforeSave()
    {
        foreach (['desktop_image', 'mobile_image', 'thumb'] as $field) {
            $this->processImages($field);
        }

        return parent::beforeSave();
    }

    /**
     * Set uploaded images to save data.
     *
     * @param array  $data
     * @param string $fieldName
     *
     * @return array
     */
    protected function processImages($fieldName)
    {
        $data = $this->getData($fieldName);

        if (isset($data[0]['name']) && isset($data[0]['tmp_name'])) {
            $this->imageUploader->moveFileFromTmp($data[0]['name']);
            $this->setData($fieldName, $data[0]['name']);
        } elseif (isset($data[0]['name']) && !isset($data[0]['tmp_name'])) {
            $this->setData($fieldName, $data[0]['name']);
        } else {
            $this->setData($fieldName, null);
        }
    }
}
