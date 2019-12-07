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

interface SliderBannerRepositoryInterface
{
    /**
     * Save SliderBanner.
     *
     * @param \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
    );

    /**
     * Retrieve SliderBanner.
     *
     * @param string $sliderbannerId
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sliderbannerId);

    /**
     * Retrieve SliderBanner matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \HS\BannerSlider\Api\Data\SliderBannerSearchResultsInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SliderBanner.
     *
     * @param \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \HS\BannerSlider\Api\Data\SliderBannerInterface $sliderBanner
    );

    /**
     * Delete SliderBanner by ID.
     *
     * @param string $sliderbannerId
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sliderbannerId);
}
