<?php
/**
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @date 2.10.2014
 */

namespace tests\behaviors;

use opus\base\behaviors\QueryLanguageBehavior;
use yii\base\Controller;

/**
 * Class QueryLanguageBehaviourTest
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @package tests\behaviors
 */
class QueryLanguageBehaviorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Controller|QueryLanguageBehaviourTest|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(Controller::class, [], ['mock', null]);

        $this->mock->attachBehavior('queryLanguage', [
            'class' => QueryLanguageBehavior::class,
        ]);
    }

    /**
     * @covers \opus\base\behaviors\QueryLanguageBehavior::getQueryLanguage
     */
    public function testGetQueryLanguage()
    {
        // TODO: TBD
    }

    /**
     * @covers \opus\base\behaviors\QueryLanguageBehavior::createQueryLanguageUrl
     */
    public function testCreateQueryLanguageUrl()
    {
        // TODO: TBD
    }
} 