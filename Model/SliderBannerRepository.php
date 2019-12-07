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

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use HS\BannerSlider\Api\SliderBannerRepositoryInterface;
use HS\BannerSlider\Model\ResourceModel\SliderBanner\CollectionFactory as SliderBannerCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use HS\BannerSlider\Api\Data\SliderBannerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use HS\BannerSlider\Model\ResourceModel\SliderBanner as ResourceSliderBanner;
use HS\BannerSlider\Api\Data\SliderBannerSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class SliderBannerRepository implements SliderBannerRepositoryInterface
{
    protected $dataObjectHelper;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataSliderBannerFactory;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $sliderBannerFactory;

    protected $sliderBannerCollectionFactory;

    /**
     * @param ResourceSliderBanner                      $resource
     * @param SliderBannerFactory                       $sliderBannerFactory
     * @param SliderBannerInterfaceFactory              $dataSliderBannerFactory
     * @param SliderBannerCollectionFactory             $sliderBannerCollectionFactory
     * @param SliderBannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper                          $dataObjectHelper
     * @param DataObjectProcessor                       $dataObjectProcessor
     * @param StoreManagerInterface                     $storeManager
     * @param CollectionProcessorInterface              $collectionProcessor
     * @param JoinProcessorInterface                    $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter             $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceSliderBanner $resource,
        SliderBannerFactory $sliderBannerFactory,
        SliderBannerInterfaceFactory $dataSliderBannerFactory,
        SliderBannerCollectionFactory $sliderBannerCollectionFactory,
        SliderBannerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->sliderBannerFactory = $sliderBannerFactory;
        $this->sliderBannerCollectionFactory = $sliderBannerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSliderBannerFactory = $dataSliderBannerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
    ) {
        /* if (empty($sliderBanner->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $sliderBanner->setStoreId($storeId);
        } */

        $sliderBannerData = $this->extensibleDataObjectConverter->toNestedArray(
            $sliderBanner,
            [],
            \HS\BannerSlider\Api\Data\SliderBannerInterface::class
        );

        $sliderBannerModel = $this->sliderBannerFactory->create()->setData($sliderBannerData);

        try {
            $this->resource->save($sliderBannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sliderBanner: %1',
                $exception->getMessage()
            ));
        }

        return $sliderBannerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($sliderBannerId)
    {
        $sliderBanner = $this->sliderBannerFactory->create();
        $this->resource->load($sliderBanner, $sliderBannerId);
        if (!$sliderBanner->getId()) {
            throw new NoSuchEntityException(__('SliderBanner with id "%1" does not exist.', $sliderBannerId));
        }

        return $sliderBanner->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sliderBannerCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \HS\BannerSlider\Api\Data\SliderBannerInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
    ) {
        try {
            $sliderBannerModel = $this->sliderBannerFactory->create();
            $this->resource->load($sliderBannerModel, $sliderBanner->getSliderbannerId());
            $this->resource->delete($sliderBannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SliderBanner: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sliderBannerId)
    {
        return $this->delete($this->get($sliderBannerId));
    }
}
