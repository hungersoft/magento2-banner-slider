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

namespace HS\BannerSlider\Model\Source;

use Magento\Framework\Data\ValueSourceInterface;
use HS\BannerSlider\Helper\Data as BannerSliderHelper;

/**
 * Class StockConfiguration.
 */
class SliderConfiguration implements ValueSourceInterface
{
    /**
     * @var StockConfigurationInterface
     */
    private $helper;

    /**
     * @param BannerSliderHelper $helper
     */
    public function __construct(BannerSliderHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($name)
    {
        $value = $this->helper->getDefaultConfigValue($name);

        return is_numeric($value) ? (float) $value : $value;
    }
}
