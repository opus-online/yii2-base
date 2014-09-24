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
use yii\db\Expression;

/**
 * Customized timestamp behavior - uses string values (not integers) and
 * executes before validation (not before save) to allow for required fields.
 * Also, works when the field does not exist in model
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\base\behaviors
 */
class TimestampBehavior extends Behavior
{
    /**
     * @var string the attribute that will receive timestamp value
     * Set this property to be null if you do not want to record the creation time.
     */
    public $createdAtAttribute = 'created_at';
    /**
     * @var string the attribute that will receive timestamp value.
     * Set this property to be null if you do not want to record the update time.
     */
    public $updatedAtAttribute = 'updated_at';

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
        if ($this->owner instanceof ActiveRecord) {
            $now = new Expression('NOW()');

            if ($this->owner->getIsNewRecord()) {
                $attribute = $this->createdAtAttribute;
            } else {
                $attribute = $this->updatedAtAttribute;
            }
            if ($this->owner->hasAttribute($attribute)) {
                $this->owner->setAttribute($attribute, $now);
            }
        }
    }
}
