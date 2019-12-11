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
use Magento\Framework\View\Result\PageFactory;
use HS\BannerSlider\Model\SliderFactory;

class Edit extends Slider
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var SliderFactory
     */
    private $sliderFactory;

    /**
     * @param Context     $context
     * @param Registry    $registry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $resultPageFactory,
        SliderFactory $sliderFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->sliderFactory = $sliderFactory;
        parent::__construct($context, $registry);
    }

    /**
     * Edit action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('slider_id');
        $slider = $this->sliderFactory->create();

        if ($id) {
            $slider->load($id);
            if (!$slider->getSliderId()) {
                $this->messageManager->addErrorMessage(__('This Slider no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->registry->register('hs_banner_slider_slider', $slider);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Slider') : __('New Slider'),
            $id ? __('Edit Slider') : __('New Slider')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sliders'));
        $resultPage->getConfig()->getTitle()->prepend(
            $slider->getSliderId() ? __('Edit Slider %1', $slider->getSliderId()) : __('New Slider')
        );

        return $resultPage;
    }
}
