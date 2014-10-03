<?php
/**
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @date 2.10.2014
 */

namespace tests\behaviors;

use opus\base\behaviors\QueryLanguageBehaviour;
use yii\base\Controller;

/**
 * Class QueryLanguageBehaviourTest
 *
 * @author Mihkel Viilveer <mihkel@opus.ee>
 * @package tests\behaviors
 */
class QueryLanguageBehaviourTest extends \PHPUnit_Framework_TestCase
{
    /** @var Controller|QueryLanguageBehaviourTest|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(Controller::class, [], ['mock', null]);

        $this->mock->attachBehavior('queryLanguage', [
            'class' => QueryLanguageBehaviour::class,
        ]);
    }

    /**
     * @covers \opus\base\behaviors\QueryLanguageBehaviour::getQueryLanguage
     */
    public function testGetQueryLanguage()
    {
        // TODO: TBD
    }

    /**
     * @covers \opus\base\behaviors\QueryLanguageBehaviour::createQueryLanguageUrl
     */
    public function testCreateQueryLanguageUrl()
    {
        // TODO: TBD
    }
} 