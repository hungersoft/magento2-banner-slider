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

namespace HS\BannerSlider\Ui\Component\Slider\Form\Element;

use Magento\Framework\Data\ValueSourceInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Framework\Serialize\JsonValidator;
use Magento\Framework\App\ObjectManager;

/**
 * Class UseConfigSettings sets default value from configuration.
 */
class UseConfigSettings extends Checkbox
{
    /**
     * @var Json
     */
    private $serializer;

    /**
     * @var JsonValidator
     */
    private $jsonValidator;

    /**
     * Constructor.
     *
     * @param ContextInterface   $context
     * @param array              $components
     * @param array              $data
     * @param Json|null          $serializer
     * @param JsonValidator|null $jsonValidator
     */
    public function __construct(
        ContextInterface $context,
        $components = [],
        array $data = [],
        Json $serializer = null,
        JsonValidator $jsonValidator = null
    ) {
        parent::__construct($context, $components, $data);
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(Json::class);
        $this->jsonValidator = $jsonValidator ?: ObjectManager::getInstance()->get(JsonValidator::class);
    }

    /**
     * Prepare component configuration.
     */
    public function prepare()
    {
        $config = $this->getData('config');
        if (isset($config['keyInConfiguration'])
            && isset($config['valueFromConfig'])
            && $config['valueFromConfig'] instanceof ValueSourceInterface
        ) {
            $keyInConfiguration = $config['valueFromConfig']->getValue($config['keyInConfiguration']);
            if (!empty($config['unserialized']) && is_string($keyInConfiguration)) {
                if ($this->jsonValidator->isValid($keyInConfiguration)) {
                    $keyInConfiguration = $this->serializer->unserialize($keyInConfiguration);
                }
            }
            $config['valueFromConfig'] = $keyInConfiguration;
        }
        $this->setData('config', (array) $config);

        parent::prepare();
    }
}
