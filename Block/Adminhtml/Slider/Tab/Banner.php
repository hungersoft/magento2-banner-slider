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

/**
 * Banners in slider grid.
 */

namespace HS\BannerSlider\Block\Adminhtml\Slider\Tab;

use Magento\Framework\Registry;
use Magento\Backend\Block\Widget\Grid;
use Magento\Backend\Block\Widget\Grid\Column;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\App\ObjectManager;
use HS\BannerSlider\Model\BannerFactory;
use Magento\Backend\Helper\Data as BackendHelper;
use Magento\Backend\Block\Template\Context;

class Banner extends Extended
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $bannerFactory;

    /**
     * @var Yesno
     */
    private $yesno;

    /**
     * @param Context       $context
     * @param BackendHelper $backendHelper
     * @param BannerFactory $bannerFactory
     * @param Registry      $coreRegistry
     * @param array         $data
     * @param Yesno|null    $yesno
     */
    public function __construct(
        Context $context,
        BackendHelper $backendHelper,
        BannerFactory $bannerFactory,
        Registry $coreRegistry,
        array $data = [],
        Yesno $yesno = null
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->yesno = $yesno ?: ObjectManager::getInstance()->get(Yesno::class);
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('hs_banner_slider_slider_banners');
        $this->setDefaultSort('banner_id');
        $this->setUseAjax(true);
    }

    /**
     * @return array|null
     */
    public function getSlider()
    {
        return $this->_coreRegistry->registry('hs_banner_slider_slider');
    }

    /**
     * @param Column $column
     *
     * @return $this
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in category flag
        if ($column->getId() == 'in_slider') {
            $bannerIds = $this->_getSelectedBanners();
            if (empty($bannerIds)) {
                $bannerIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('banner_id', ['in' => $bannerIds]);
            } elseif (!empty($bannerIds)) {
                $this->getCollection()->addFieldToFilter('banner_id', ['nin' => $bannerIds]);
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }

    /**
     * @return Grid
     */
    protected function _prepareCollection()
    {
        if ($this->getSlider()->getSliderId()) {
            $this->setDefaultFilter(['in_slider' => 1]);
        }
        $collection = $this->bannerFactory->create()->getCollection()->addFieldToSelect(
            'name'
        )->addFieldToSelect(
            'desktop_image'
        )->addFieldToSelect(
            'active'
        )->getSelect()->joinLeft(
            ['hbs_sb' => 'hs_banner_slider_slider_banner'],
            'main_table.banner_id = hbs_sb.banner_id AND slider_id='.(int) $this->getRequest()->getParam('id', 0)
        );
        // $storeId = (int)$this->getRequest()->getParam('store', 0);
        // if ($storeId > 0) {
        //     $collection->addStoreFilter($storeId);
        // }
        $this->setCollection($collection);

        if ($this->getSlider()->getBannersReadonly()) {
            $bannerIds = $this->_getSelectedBanners();
            if (empty($bannerIds)) {
                $bannerIds = 0;
            }
            $this->getCollection()->addFieldToFilter('banner_id', ['in' => $bannerIds]);
        }

        return parent::_prepareCollection();
    }

    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        if (!$this->getSlider()->getBannersReadonly()) {
            $this->addColumn(
                'in_banner',
                [
                    'type' => 'checkbox',
                    'name' => 'in_banner',
                    'values' => $this->_getSelectedBanners(),
                    'index' => 'banner_id',
                    'header_css_class' => 'col-select col-massaction',
                    'column_css_class' => 'col-select col-massaction',
                ]
            );
        }
        $this->addColumn(
            'banner_id',
            [
                'header' => __('ID'),
                'sortable' => true,
                'index' => 'banner_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn('name', ['header' => __('Name'), 'index' => 'name']);

        $this->addColumn(
            'active',
            [
                'header' => __('Active'),
                'index' => 'active',
                'type' => 'options',
                'options' => $this->yesno->toOptionArray(),
            ]
        );

        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'type' => 'number',
                'index' => 'position',
                'editable' => !$this->getSlider()->getBannersReadonly(),
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('hs_banner_slider/slider/grid', ['_current' => true]);
    }

    /**
     * @return array
     */
    protected function _getSelectedBanners()
    {
        $banners = $this->getRequest()->getPost('selected_banners');
        if ($banners === null) {
            $banners = $this->getSlider()->getBannersPosition();

            return array_keys($banners);
        }

        return $banners;
    }
}
