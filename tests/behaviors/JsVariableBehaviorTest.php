<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.09.2014
 */

namespace tests\behaviors;


use opus\base\behaviors\JsVariablesBehavior;
use yii\base\Event;
use yii\web\View;

/**
 * Class TimestampBehaviourTest
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package tests\behaviors
 */
class JsVariablesBehaviorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \opus\base\behaviors\JsVariablesBehavior::events
     */
    public function testEventAttached()
    {
        // TODO: TBD
    }

    /**
     * @return array
     */
    private function getTestData()
    {
        $object = new \stdClass();
        $object->publicParam = 'test';

        return [
            'test' => 'string',
            'testFloat' => 23.22,
            'testInt' => 3,
            'testNull' => null,
            'testBool' => false,
            'testArray' => [
                'nested1' => 'val1'
            ],
            'testObject' => $object,
        ];
    }

    /**
     * @covers \opus\base\behaviors\JsVariablesBehavior::registerJsVariables
     * @covers \opus\base\behaviors\JsVariablesBehavior::outputJsVariables
     */
    public function testSerializeNormal()
    {
        $return = 'var _var = {"firstSet":"value2","test":"string","testFloat":23.22,"testInt":3,"testNull":null,"testBool":false,"testArray":{"nested1":"val1"},"testObject":{"publicParam":"test"},"var":"val","0":"otherNamespace"};';
        $behavior = new JsVariablesBehavior();


        $behavior->registerJsVariables(['firstSet' => 'value']);
        // override
        $behavior->registerJsVariables(['firstSet' => 'value2']);

        $behavior->registerJsVariables($this->getTestData());
        $behavior->registerJsVariables(['var' => 'val', 'otherNamespace']);

        $view = $this->getMock(View::class, ['registerJs']);
        $view->expects($this->once())->method('registerJs')->with($return, View::POS_HEAD);

        $event = new Event();
        $event->sender = $view;

        $behavior->outputJsVariables($event);
    }

    /**
     * @covers \opus\base\behaviors\JsVariablesBehavior::registerJsVariables
     * @covers \opus\base\behaviors\JsVariablesBehavior::outputJsVariables
     */
    public function testOptions()
    {
        $return = 'var _var = {"var":"val","0":"otherNamespace"};var _var=_var||{};_var.test="string";_var.testFloat=23.22;_var.testInt=3;_var.testNull=null;_var.testBool=false;_var.testArray={"nested1":"val1"};_var.testObject={"publicParam":"test"};';
        $behavior = new JsVariablesBehavior();

        $behavior->registerJsVariables($this->getTestData(), '_var', JSON_FORCE_OBJECT);
        $behavior->registerJsVariables(['var' => 'val', 'otherNamespace']);

        $view = $this->getMock(View::class, ['registerJs']);
        $view->expects($this->once())->method('registerJs')->with($return, View::POS_HEAD);

        $event = new Event();
        $event->sender = $view;

        $behavior->outputJsVariables($event);
    }
}
