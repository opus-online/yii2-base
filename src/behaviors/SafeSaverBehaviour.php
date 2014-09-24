<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 11.09.2014
 */

namespace opus\base\behaviors;


use yii\base\Behavior;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;

/**
 * Provides SafeSaver behaviour to ActiveRecord models - When save() fails, an
 * exception will be thrown.
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\base\behaviors
 */
class SafeSaverBehaviour extends Behavior
{
    /**
     * @inheritdoc
     * @param ActiveRecord $owner
     */
    public function attach($owner)
    {
        if (false === ($owner instanceof ActiveRecord)) {
            throw new InvalidParamException('SafeSaver can only be attached to ' .
                'instances of ActiveRecord');
        }
        parent::attach($owner);
    }

    /**
     * Saves entity and throws an exception if validation fails
     *
     * @param string[]|null $attributes
     *
     * @return bool
     */
    public function saveSafe($attributes = null)
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if (false === ($return = $model->save(true, $attributes))) {
            $message = 'Could not save model, unknown error';
            if (($errors = $model->getFirstErrors())) {
                $error = reset($errors);
                $message = 'Could not save model: ' . $error;
            }
            throw new InvalidParamException($message);
        }

        return $return;
    }
}
