<?php

namespace HS\BannerSlider\Controller\Adminhtml\Banner;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Catalog\Model\ImageUploader;

class Upload extends Action
{
    /**
     * Image uploader.
     *
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * Upload constructor.
     *
     * @param Context       $context
     * @param ImageUploader $imageUploader
     */
    public function __construct(Context $context, ImageUploader $imageUploader)
    {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * Upload file controller action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $imageUploadId = $this->_request->getParam('param_name', 'banner_image');

        try {
            $imageResult = $this->imageUploader->saveFileToTmpDir($imageUploadId);
            $imageResult['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (Exception $e) {
            $imageResult = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
    }
}
