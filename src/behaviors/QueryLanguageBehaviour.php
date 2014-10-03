<?php
/**
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @date 2.10.2014
 */

namespace opus\base\behaviors;

use yii\base\Behavior;
use yii\base\Controller;
use yii\base\InvalidParamException;
use yii\base\InvalidValueException;
use yii\web\Request;
use yii\helpers\Url;

/**
 * Class QueryLanguageBehaviour
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @package opus\base\behaviors
 */
class QueryLanguageBehaviour extends Behavior
{
    /**
     * Query param for language detection
     */
    const DATA_LANGUAGE_QUERY_PARAM = 'lang';

    /**
     * @var string
     */
    public $request = 'request';

    /**
     * @inheritdoc
     * @param Controller $owner
     */
    public function attach($owner)
    {
        if (false === ($owner instanceof Controller)) {
            throw new InvalidParamException('QueryLanguageBehaviour can only be attached to ' .
                'instances of Controller');
        }
        parent::attach($owner);
    }

    /**
     * Gets language from query parameter
     *
     * @return string
     */
    public function getQueryLanguage()
    {
        return $this->getRequest()->get(self::DATA_LANGUAGE_QUERY_PARAM, \Yii::$app->language);
    }

    /**
     * @param $url
     * @return string
     */
    public function createQueryLanguageUrl($url)
    {
        if (!is_array($url)) {
            throw new InvalidValueException('QueryLanguageBehaviour accepts only arrays');
        }
        $url[self::DATA_LANGUAGE_QUERY_PARAM] = $this->getRequest()->get(self::DATA_LANGUAGE_QUERY_PARAM);
        /** @var Url $url */
        $url = \Yii::createObject(Url::class);
        return $url::toRoute($url);
    }

    /**
     * @return Request
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequest()
    {
        return \Yii::$app->get($this->request);
    }
} 