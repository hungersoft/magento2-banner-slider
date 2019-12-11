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
use Magento\Framework\Model\AbstractModel;

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

    /**
     * Process slider data after save slider object
     * save related banner ids and update path value.
     *
     * @param AbstractModel $object
     *
     * @return $this
     */
    protected function _afterSave(AbstractModel $object)
    {
        $this->_saveSliderBanners($object);

        return parent::_afterSave($object);
    }

    /**
     * Save slider banners relation.
     *
     * @param SliderModel $slider
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _saveSliderBanners(SliderModel $slider)
    {
        $slider->setIsChangedBannerList(false);
        $id = $slider->getSliderId();

        /*
         * new slider-banner relationships
         */
        $banners = $slider->getPostedBanners();

        /*
         * Example re-save category
         */
        if ($banners === null) {
            return $this;
        }

        /*
         * old slider-banner relationships
         */
        $oldBanners = $slider->getBannersPosition();

        $insert = array_diff_key($banners, $oldBanners);
        $delete = array_diff_key($oldBanners, $banners);

        /*
         * Find banner ids which are presented in both arrays
         * and saved before (check $oldBanners array)
         */
        $update = array_intersect_key($banners, $oldBanners);
        $update = array_diff_assoc($update, $oldBanners);

        $connection = $this->getConnection();

        /*
         * Delete banners from slider
         */
        if (!empty($delete)) {
            $cond = ['banner_id IN(?)' => array_keys($delete), 'slider_id = ?' => $id];
            $connection->delete($this->getSliderBannersTable(), $cond);
        }

        /*
         * Add banner to slider
         */
        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $bannerId => $position) {
                $data[] = [
                    'slider_id' => (int) $id,
                    'banner_id' => (int) $bannerId,
                    'position' => (int) $position,
                ];
            }
            $connection->insertMultiple($this->getSliderBannersTable(), $data);
        }

        /*
         * Update banner positions in slider
         */
        if (!empty($update)) {
            $newPositions = [];
            foreach ($update as $bannerId => $position) {
                $delta = $position - $oldBanners[$bannerId];
                if (!isset($newPositions[$delta])) {
                    $newPositions[$delta] = [];
                }
                $newPositions[$delta][] = $bannerId;
            }

            foreach ($newPositions as $delta => $bannerIds) {
                $bind = ['position' => new \Zend_Db_Expr("position + ({$delta})")];
                $where = ['slider_id = ?' => (int) $id, 'banner_id IN (?)' => $bannerIds];
                $connection->update($this->getSliderBannersTable(), $bind, $where);
            }
        }

        if (!empty($insert) || !empty($delete)) {
            $productIds = array_unique(array_merge(array_keys($insert), array_keys($delete)));
            $this->_eventManager->dispatch(
                'hs_banner_slider_slider_banner_change_banners',
                ['slider' => $slider, 'banner_ids' => $bannerIds]
            );

            $slider->setChangedBannerIds($bannerIds);
        }

        if (!empty($insert) || !empty($update) || !empty($delete)) {
            $slider->setIsChangedBannerList(true);

            /*
             * Setting affected banners to slider for third party engine index refresh
             */
            $bannerIds = array_keys($insert + $delete + $update);
            $slider->setAffectedBannerIds($bannerIds);
        }

        return $this;
    }
}
