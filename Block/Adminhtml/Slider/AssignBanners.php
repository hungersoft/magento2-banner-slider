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

namespace HS\BannerSlider\Block\Adminhtml\Slider;

use Magento\Framework\Registry;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Json\EncoderInterface;
use HS\BannerSlider\Block\Adminhtml\Slider\Tab\Banner;

class AssignBanners extends Template
{
    /**
     * Block template.
     *
     * @var string
     */
    protected $_template = 'HS_BannerSlider::slider/edit/assign_banners.phtml';

    /**
     * @var Banner
     */
    protected $blockGrid;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * AssignBanners constructor.
     *
     * @param Context          $context
     * @param Registry         $registry
     * @param EncoderInterface $jsonEncoder
     * @param array            $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        EncoderInterface $jsonEncoder,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve instance of grid block.
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(Banner::class, 'hs_banner_slider.slider.banner.grid');
        }

        return $this->blockGrid;
    }

    /**
     * Return HTML of grid block.
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    /**
     * @return string
     */
    public function getBannersJson()
    {
        $banners = $this->getSlider()->getBannersPosition();
        if (!empty($banners)) {
            return $this->jsonEncoder->encode($banners);
        }

        return '{}';
    }

    /**
     * Retrieve current slider instance.
     *
     * @return array|null
     */
    public function getSlider()
    {
        return $this->registry->registry('hs_banner_slider_slider');
    }
}
