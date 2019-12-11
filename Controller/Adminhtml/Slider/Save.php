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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * [__construct description].
     *
     * @param Context                $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(Context $context, DataPersistorInterface $dataPersistor)
    {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('slider_id');

            $slider = $this->_objectManager->create(\HS\BannerSlider\Model\Slider::class)->load($id);
            if (!$slider->getSliderId() && $id) {
                $this->messageManager->addErrorMessage(__('This Slider no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }

            $slider->setData($data);
            if (isset($data['slider_banners'])
                && is_string($data['slider_banners'])
                && !$slider->getBannersReadonly()
            ) {
                $banners = json_decode($data['slider_banners'], true);
                $slider->setPostedBanners($banners);
            }

            try {
                $slider->save();
                $this->messageManager->addSuccessMessage(__('You saved the Slider.'));
                $this->dataPersistor->clear('hs_banner_slider_slider');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['slider_id' => $slider->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Slider.'));
            }

            $this->dataPersistor->set('hs_banner_slider_slider', $data);

            return $resultRedirect->setPath('*/*/edit', ['slider_id' => $this->getRequest()->getParam('slider_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
