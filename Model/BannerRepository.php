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
use HS\BannerSlider\Api\BannerRepositoryInterface;
use HS\BannerSlider\Api\Data\BannerSearchResultsInterfaceFactory;
use HS\BannerSlider\Api\Data\BannerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use HS\BannerSlider\Model\ResourceModel\Banner as ResourceBanner;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\NoSuchEntityException;
use HS\BannerSlider\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;

class BannerRepository implements BannerRepositoryInterface
{
    protected $dataObjectHelper;

    private $storeManager;

    protected $bannerFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $dataBannerFactory;

    protected $bannerCollectionFactory;

    /**
     * @param ResourceBanner                      $resource
     * @param BannerFactory                       $bannerFactory
     * @param BannerInterfaceFactory              $dataBannerFactory
     * @param BannerCollectionFactory             $bannerCollectionFactory
     * @param BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper                    $dataObjectHelper
     * @param DataObjectProcessor                 $dataObjectProcessor
     * @param StoreManagerInterface               $storeManager
     * @param CollectionProcessorInterface        $collectionProcessor
     * @param JoinProcessorInterface              $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter       $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBanner $resource,
        BannerFactory $bannerFactory,
        BannerInterfaceFactory $dataBannerFactory,
        BannerCollectionFactory $bannerCollectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->bannerFactory = $bannerFactory;
        $this->bannerCollectionFactory = $bannerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBannerFactory = $dataBannerFactory;
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
        \HS\BannerSlider\Api\Data\BannerInterface $banner
    ) {
        /* if (empty($banner->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $banner->setStoreId($storeId);
        } */

        $bannerData = $this->extensibleDataObjectConverter->toNestedArray(
            $banner,
            [],
            \HS\BannerSlider\Api\Data\BannerInterface::class
        );

        $bannerModel = $this->bannerFactory->create()->setData($bannerData);

        try {
            $this->resource->save($bannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the banner: %1',
                $exception->getMessage()
            ));
        }

        return $bannerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($bannerId)
    {
        $banner = $this->bannerFactory->create();
        $this->resource->load($banner, $bannerId);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(__('Banner with id "%1" does not exist.', $bannerId));
        }

        return $banner->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->bannerCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \HS\BannerSlider\Api\Data\BannerInterface::class
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
        \HS\BannerSlider\Api\Data\BannerInterface $banner
    ) {
        try {
            $bannerModel = $this->bannerFactory->create();
            $this->resource->load($bannerModel, $banner->getBannerId());
            $this->resource->delete($bannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Banner: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($bannerId)
    {
        return $this->delete($this->get($bannerId));
    }
}
