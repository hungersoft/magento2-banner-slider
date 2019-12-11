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

namespace HS\BannerSlider\Block\Adminhtml\Slider\Tab\Render;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use HS\BannerSlider\Helper\Data as BannerSliderHelper;

/**
 * Class GridImage.
 */
class Image extends AbstractRenderer
{
    /**
     * @var BannerSliderHelper
     */
    private $helper;

    /**
     * @param Context            $context
     * @param BannerSliderHelper $helper
     * @param array              $data
     */
    public function __construct(
        Context $context,
        BannerSliderHelper $helper,
        array $data = []
    ) {
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    /**
     * Render Banner Image.
     *
     * @param DataObject $row
     *
     * @return string
     */
    public function render(DataObject $row)
    {
        if ($row->getData($this->getColumn()->getIndex())) {
            $imageUrl = $this->helper->getImageUrl($row->getData($this->getColumn()->getIndex()));

            return '<img src="'.$imageUrl.'" width=\'150\' class="admin__control-thumbnail"/>';
        }

        return '';
    }
}
