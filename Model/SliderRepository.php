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
use HS\BannerSlider\Model\ResourceModel\Slider\CollectionFactory as SliderCollectionFactory;
use HS\BannerSlider\Api\Data\SliderSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use HS\BannerSlider\Model\ResourceModel\Slider as ResourceSlider;
use HS\BannerSlider\Api\Data\SliderInterfaceFactory;
use HS\BannerSlider\Api\SliderRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SliderRepository implements SliderRepositoryInterface
{
    protected $dataObjectHelper;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $sliderCollectionFactory;

    protected $sliderFactory;

    protected $dataSliderFactory;

    /**
     * @param ResourceSlider                      $resource
     * @param SliderFactory                       $sliderFactory
     * @param SliderInterfaceFactory              $dataSliderFactory
     * @param SliderCollectionFactory             $sliderCollectionFactory
     * @param SliderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper                    $dataObjectHelper
     * @param DataObjectProcessor                 $dataObjectProcessor
     * @param StoreManagerInterface               $storeManager
     * @param CollectionProcessorInterface        $collectionProcessor
     * @param JoinProcessorInterface              $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter       $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceSlider $resource,
        SliderFactory $sliderFactory,
        SliderInterfaceFactory $dataSliderFactory,
        SliderCollectionFactory $sliderCollectionFactory,
        SliderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->sliderFactory = $sliderFactory;
        $this->sliderCollectionFactory = $sliderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSliderFactory = $dataSliderFactory;
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
        \HS\BannerSlider\Api\Data\SliderInterface $slider
    ) {
        /* if (empty($slider->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $slider->setStoreId($storeId);
        } */

        $sliderData = $this->extensibleDataObjectConverter->toNestedArray(
            $slider,
            [],
            \HS\BannerSlider\Api\Data\SliderInterface::class
        );

        $sliderModel = $this->sliderFactory->create()->setData($sliderData);

        try {
            $this->resource->save($sliderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the slider: %1',
                $exception->getMessage()
            ));
        }

        return $sliderModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($sliderId)
    {
        $slider = $this->sliderFactory->create();
        $this->resource->load($slider, $sliderId);
        if (!$slider->getId()) {
            throw new NoSuchEntityException(__('Slider with id "%1" does not exist.', $sliderId));
        }

        return $slider->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sliderCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \HS\BannerSlider\Api\Data\SliderInterface::class
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
        \HS\BannerSlider\Api\Data\SliderInterface $slider
    ) {
        try {
            $sliderModel = $this->sliderFactory->create();
            $this->resource->load($sliderModel, $slider->getSliderId());
            $this->resource->delete($sliderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Slider: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sliderId)
    {
        return $this->delete($this->get($sliderId));
    }
}
