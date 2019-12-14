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

namespace HS\BannerSlider\Api;

use HS\BannerSlider\Api\Data\BannerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use HS\BannerSlider\Api\Data\BannerSearchResultsInterface;

interface BannerRepositoryInterface
{
    /**
     * Save Banner.
     *
     * @param BannerInterface $banner
     *
     * @return BannerInterface
     *
     * @throws LocalizedException
     */
    public function save(BannerInterface $banner);

    /**
     * Retrieve Banner.
     *
     * @param string $bannerId
     *
     * @return BannerInterface
     *
     * @throws LocalizedException
     */
    public function get($bannerId);

    /**
     * Retrieve Banner matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return BannerSearchResultsInterface
     *
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Banner.
     *
     * @param BannerInterface $banner
     *
     * @return bool true on success
     *
     * @throws LocalizedException
     */
    public function delete(BannerInterface $banner);

    /**
     * Delete Banner by ID.
     *
     * @param string $bannerId
     *
     * @return bool true on success
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($bannerId);
}
