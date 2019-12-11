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

namespace HS\BannerSlider\Controller\Adminhtml\Slider;

use HS\BannerSlider\Controller\Adminhtml\Slider;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
use HS\BannerSlider\Model\SliderFactory;
use HS\BannerSlider\Block\Adminhtml\Slider\Tab\Banner as SliderBannersGrid;

class Grid extends Slider
{
    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var SliderFactory
     */
    private $sliderFactory;

    /**
     * @param Context       $context
     * @param Registry      $registry
     * @param RawFactory    $resultRawFactory
     * @param LayoutFactory $layoutFactory
     * @param SliderFactory $sliderFactory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        RawFactory $resultRawFactory,
        LayoutFactory $layoutFactory,
        SliderFactory $sliderFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        $this->sliderFactory = $sliderFactory;

        parent::__construct($context, $registry);
    }

    /**
     * Initialize requested slider and put it into registry.
     *
     * @return \HS\BannerSlider\Model\Slider|false
     */
    protected function initSlider()
    {
        $sliderId = (int) $this->getRequest()->getParam('slider_id', false);
        $slider = $this->sliderFactory->create();

        if ($sliderId) {
            $slider->load($sliderId);
        }

        $this->registry->register('hs_banner_slider_slider', $slider);

        return $slider;
    }

    /**
     * Grid Action
     * Display list of products related to current category.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $slider = $this->initSlider();
        if (!$slider) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('hs_banner_slider/*/', ['_current' => true, 'id' => null]);
        }

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();

        return $resultRaw->setContents(
            $this->layoutFactory->create()->createBlock(
                SliderBannersGrid::class,
                'hs_banner_slider.slider.banner.grid'
            )->toHtml()
        );
    }
}
