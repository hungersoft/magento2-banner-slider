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

namespace HS\BannerSlider\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Backend\App\Action;

abstract class Slider extends Action
{
    const ADMIN_RESOURCE = 'HS_BannerSlider::Banner';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Context  $context
     * @param Registry $registry
     */
    public function __construct(Context $context, Registry $registry)
    {
        $this->registry = $registry;
        parent::__construct($context);
    }

    /**
     * Init page.
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('HS'), __('HS'))
            ->addBreadcrumb(__('Slider'), __('Slider'));

        return $resultPage;
    }
}
