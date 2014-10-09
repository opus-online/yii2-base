<?php
/**
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @date 9.10.2014
 */

namespace opus\base\behaviors;


use yii\base\Behavior;
use yii\base\Controller;
use yii\base\Event;
use yii\base\InvalidParamException;
use yii\web\Request;
use yii\web\Response;

/**
 * Class ResponseFormatBehavior
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @package opus\base\behaviors
 */
class ResponseFormatBehavior extends Behavior
{
    /**
     * @var string Request component name
     */
    public $request = 'request';

    /**
     * @var string Response component name
     */
    public $response = 'response';

    /**
     * @var string helper for holding response format
     */
    public $responseFormat;

    /**
     * @inheritdoc
     * @param Controller $owner
     */
    public function attach($owner)
    {
        if (false === ($owner instanceof Controller)) {
            throw new InvalidParamException('ResponseFormatBehavior can only be attached to ' .
                'instances of Controller');
        }
        parent::attach($owner);
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => [$this, 'checkIsAjaxRequest'],
            Controller::EVENT_AFTER_ACTION => [$this, 'setResponseFormat']
        ];
    }

    /**
     * Sets formatType to JSON if response is array and sets the actual response component value
     * @param $event
     */
    public function setResponseFormat(Event $event)
    {
        // force json if not specified an in array format
        if (null === $this->responseFormat && is_array($event->result)) {
            $this->responseFormat = Response::FORMAT_JSON;
        }
        if (isset($this->responseFormat)) {
            $this->getResponse()->format = $this->responseFormat;
        }
    }

    /**
     * Sets response format to JSON if ajax request
     */
    public function checkIsAjaxRequest()
    {
        if (array_key_exists(
            'application/json',
            $this->getRequest()->getAcceptableContentTypes()
        )
        ) {
            $this->responseFormat = Response::FORMAT_JSON;
        }
    }

    /**
     * @return Request
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequest()
    {
        return \Yii::$app->get($this->request);
    }

    /**
     * @return Response
     * @throws \yii\base\InvalidConfigException
     */
    private function getResponse()
    {
        return \Yii::$app->get($this->response);
    }
}
