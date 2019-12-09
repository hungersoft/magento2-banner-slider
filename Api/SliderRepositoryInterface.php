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

interface SliderRepositoryInterface
{
    /**
     * Save Slider.
     *
     * @param \HS\BannerSlider\Api\Data\SliderInterface $slider
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \HS\BannerSlider\Api\Data\SliderInterface $slider
    );

    /**
     * Retrieve Slider.
     *
     * @param string $sliderId
     *
     * @return \HS\BannerSlider\Api\Data\SliderInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sliderId);

    /**
     * Retrieve Slider matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \HS\BannerSlider\Api\Data\SliderSearchResultsInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Slider.
     *
     * @param \HS\BannerSlider\Api\Data\SliderInterface $slider
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \HS\BannerSlider\Api\Data\SliderInterface $slider
    );

    /**
     * Delete Slider by ID.
     *
     * @param string $sliderId
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sliderId);
}
