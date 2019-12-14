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

use HS\BannerSlider\Api\Data\SliderInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use HS\BannerSlider\Api\Data\SliderSearchResultsInterface;

interface SliderRepositoryInterface
{
    /**
     * Save Slider.
     *
     * @param SliderInterface $slider
     *
     * @return SliderInterface
     *
     * @throws LocalizedException
     */
    public function save(SliderInterface $slider);

    /**
     * Retrieve Slider.
     *
     * @param string $sliderId
     *
     * @return SliderInterface
     *
     * @throws LocalizedException
     */
    public function get($sliderId);

    /**
     * Retrieve Slider matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return SliderSearchResultsInterface
     *
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Slider.
     *
     * @param SliderInterface $slider
     *
     * @return bool true on success
     *
     * @throws LocalizedException
     */
    public function delete(SliderInterface $slider);

    /**
     * Delete Slider by ID.
     *
     * @param string $sliderId
     *
     * @return bool true on success
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($sliderId);
}
