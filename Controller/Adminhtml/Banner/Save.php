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

namespace HS\BannerSlider\Controller\Adminhtml\Banner;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use HS\BannerSlider\Model\BannerFactory;
use Magento\Catalog\Model\ImageUploader;

class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var BannerFactory
     */
    private $bannerFactory;

    /**
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * @param Context                $context
     * @param DataPersistorInterface $dataPersistor
     * @param BannerFactory          $bannerFactory
     * @param ImageUploader          $imageUploader
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        BannerFactory $bannerFactory,
        ImageUploader $imageUploader
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->dataPersistor = $dataPersistor;
        $this->imageUploder = $imageUploader;

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
            $id = $this->getRequest()->getParam('banner_id');
            $banner = $this->bannerFactory->create()->load($id);
            if (!$banner->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Banner no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }

            foreach (['desktop_image', 'mobile_image', 'thumb'] as $field) {
                $data = $this->processImages($data, $field);
            }

            $banner->setData($data);

            try {
                $banner->save();
                $this->messageManager->addSuccessMessage(__('You saved the Banner.'));
                $this->dataPersistor->clear('hs_banner_slider_banner');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $banner->getBannerId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Banner.'));
            }

            $this->dataPersistor->set('hs_banner_slider_banner', $data);

            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Set uploaded images to save data.
     *
     * @param array  $data
     * @param string $fieldName
     *
     * @return array
     */
    protected function processImages($data, $fieldName)
    {
        if (isset($data[$fieldName][0]['name']) && isset($data[$fieldName][0]['tmp_name'])) {
            $data[$fieldName] = $data[$fieldName][0]['name'];
            $this->imageUploader->moveFileFromTmp($data[$fieldName]);
        } elseif (isset($data[$fieldName][0]['name']) && !isset($data[$fieldName][0]['tmp_name'])) {
            $data[$fieldName] = $data[$fieldName][0]['name'];
        } else {
            $data[$fieldName] = null;
        }

        return $data;
    }
}
