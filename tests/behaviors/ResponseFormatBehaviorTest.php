<?php
/**
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @date 9.10.2014
 */

namespace tests\behaviors;

use opus\base\behaviors\ResponseFormatBehavior;
use yii\base\Controller;

/**
 * Class ResponseFormatBehaviorTest
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @package tests\behaviors
 */
class ResponseFormatBehaviorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Controller|ResponseFormatBehaviorTest|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(Controller::class, [], ['mock', null]);

        $this->mock->attachBehavior('responseFormat', [
            'class' => ResponseFormatBehavior::class,
        ]);
    }

    /**
     * @covers \opus\base\behaviors\ResponseFormatBehavior::setResponseFormat
     */
    public function testSetResponseFormat()
    {
        // TODO: TBD
    }

    /**
     * @covers \opus\base\behaviors\ResponseFormatBehavior::checkIsAjaxRequest
     */
    public function testCheckIsAjaxRequest()
    {
        // TODO: TBD
    }
}