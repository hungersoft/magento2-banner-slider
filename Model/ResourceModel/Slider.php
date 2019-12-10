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

namespace HS\BannerSlider\Model\ResourceModel;

use HS\BannerSlider\Model\Slider as SliderModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Slider extends AbstractDb
{
    /**
     * Slider banners table name.
     *
     * @var string
     */
    protected $sliderBannersTable;

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('hs_banner_slider_slider', 'slider_id');
    }

    /**
     * Category product table name getter.
     *
     * @return string
     */
    public function getSliderBannersTable()
    {
        if (!$this->sliderBannersTable) {
            $this->sliderBannersTable = $this->getTable('hs_banner_slider_slider_banner');
        }

        return $this->sliderBannersTable;
    }

    /**
     * Get positions of associated to slider banners.
     *
     * @param SliderModel $category
     *
     * @return array
     */
    public function getBannersPosition(SliderModel $slider)
    {
        $select = $this->getConnection()->select()->from(
            $this->getSliderBannersTable(),
            ['banner_id', 'position']
        )->where(
            'slider_id = :slider_id'
        );
        $bind = ['slider_id' => (int) $slider->getSliderId()];

        return $this->getConnection()->fetchPairs($select, $bind);
    }
}
