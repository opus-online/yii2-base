<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.09.2014
 */

namespace tests\behaviors;


use opus\base\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class TimestampBehaviourTest
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package tests\behaviors
 */
class TimestampBehaviorTest extends \PHPUnit_Framework_TestCase
{
    /** @var ActiveRecord|TimestampBehaviorTest|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(ActiveRecord::class, ['save', 'hasAttribute', 'getIsNewRecord', 'setAttribute']);
        $this->mock->attachBehavior('ts', [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => 'cr',
            'updatedAtAttribute' => 'up',
        ]);
    }

    public function testCreate()
    {
        $now = new Expression('NOW()');

        $this->mock->expects($this->once())->method('getIsNewRecord')->will($this->returnValue(true));
        $this->mock->expects($this->any())->method('hasAttribute')->will($this->returnValue(true));
        $this->mock->expects($this->once())->method('setAttribute')->with('cr', $now);
        $this->mock->validate();
    }

    public function testUpdate()
    {
        $now = new Expression('NOW()');

        $this->mock->expects($this->once())->method('getIsNewRecord')->will($this->returnValue(false));
        $this->mock->expects($this->any())->method('hasAttribute')->will($this->returnValue(true));
        $this->mock->expects($this->once())->method('setAttribute')->with('up', $now);
        $this->mock->validate();
    }

}
