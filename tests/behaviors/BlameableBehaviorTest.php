<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.09.2014
 */

namespace tests\behaviors;


use opus\base\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * Class TimestampBehaviourTest
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package tests\behaviors
 */
class BlameableBehaviorTest extends \PHPUnit_Framework_TestCase
{
    /** @var ActiveRecord|BlameableBehaviorTest|\PHPUnit_Framework_MockObject_MockObject $mock */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMock(ActiveRecord::class, [
                'save',
                'hasAttribute',
                'getIsNewRecord',
                'setAttribute'
            ]);

        $this->mock->attachBehavior('bl', [
            'class' => BlameableBehavior::class,
        ]);
    }

    /**
     * @covers \opus\base\behaviors\BlameableBehavior::inject
     */
    public function testCreate()
    {
        // TODO: TBD
    }

    /**
     * @covers \opus\base\behaviors\BlameableBehavior::inject
     */
    public function testUpdate()
    {
       // TODO: TBD
    }

}
