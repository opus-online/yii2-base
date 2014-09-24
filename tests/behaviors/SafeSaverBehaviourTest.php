<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.09.2014
 */

namespace tests\behaviors;


use opus\base\behaviors\SafeSaverBehaviour;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;

/**
 * Class SafeSaverBehaviourTest
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package tests\behaviors
 */
class SafeSaverBehaviourTest extends \PHPUnit_Framework_TestCase
{
    /** @var ActiveRecord|SafeSaverBehaviour|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(ActiveRecord::class, ['save', 'validate']);
        $this->mock->attachBehavior('safeSaver', SafeSaverBehaviour::class);
    }

    public function testSaveOk()
    {
        $this->mock->expects($this->once())->method('save');
        $this->mock->expects($this->any())->method('validate')->will($this->returnValue(true));
        $this->mock->saveSafe();
    }

    public function testSaveFail()
    {
        $this->mock->expects($this->any())->method('save')->will($this->returnValue(false));
        $this->setExpectedException(InvalidParamException::class);
        $this->mock->saveSafe();
    }

    public function testSaveArgs()
    {
        $args = ['arg1', 'arg2'];

        $this->mock->expects($this->once())->method('save')->with(true, $args);
        $this->mock->saveSafe($args);
    }

    public function testFaulyAttach()
    {
        $behavior = new SafeSaverBehaviour();
        $this->setExpectedException(InvalidParamException::class);
        $behavior->attach($this);
    }
}
