<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 1.09.2014
 */

namespace opus\base\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * Overridden to inject value before validation and only if the field exists
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\base\behaviors
 */
class BlameableBehavior extends Behavior
{
    /**
     * @var string the attribute that will receive current user ID value
     * Set this property to be null if you do not want to record the creator ID.
     */
    public $createdByAttribute = 'created_by';
    /**
     * @var string the attribute that will receive current user ID value
     * Set this property to be null if you do not want to record the updater ID.
     */
    public $updatedByAttribute = 'updated_by';

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => [$this, 'inject']
        ];
    }

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     */
    public function inject()
    {
        if (\Yii::$app->has('user')) {
            $user = !\Yii::$app->user->isGuest ? \Yii::$app->user->id : null;
        }
        if ($this->owner instanceof ActiveRecord && isset($user)) {
            if ($this->owner->getIsNewRecord()) {
                $attribute = $this->createdByAttribute;
            } else {
                $attribute = $this->updatedByAttribute;
            }
            if ($this->owner->hasAttribute($attribute)) {
                $this->owner->setAttribute($attribute, $user);
            }
        }
    }
} 
