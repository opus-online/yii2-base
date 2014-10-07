<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 1.10.2014
 */

namespace opus\base\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\helpers\Json;
use yii\web\View;

/**
 * Adds registerJsVariables method to the view
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\base\behaviors
 */
class JsVariablesBehavior extends Behavior
{
    private $vars = [];
    private $encodedVars = [];

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            View::EVENT_BEGIN_PAGE => [$this, 'outputJsVariables']
        ];
    }

    /**
     * "Normal" variables (with options = 0) will be added in batches (by namespaces).
     * Special variables (encoded with options) will be output separately
     *
     * @param Event $event
     */
    public function outputJsVariables(Event $event)
    {
        /** @var View $view */
        $view = $event->sender;
        $script = '';
        foreach ($this->vars as $ns => $variables) {
            $script .= sprintf(
                'var %s = %s;',
                $ns,
                Json::encode($variables)
            );
        }

        foreach ($this->encodedVars as $ns => $variables) {
            $script .= sprintf('var %1$s=%1$s||{};', $ns);
            foreach ($variables as $key => $variable) {
                $script .= sprintf("%s.%s=%s;", $ns, $key, $variable);
            }


        }
        $view->registerJs($script, View::POS_HEAD);
    }

    /**
     * @param array $variables
     * @param string $ns
     * @param int $options (to force object notation JSON_FORCE_OBJECT)
     */
    public function registerJsVariables(array $variables, $ns = '_var', $options = 0)
    {
        foreach ($variables as $key => $value) {
            if (0 === $options) {
                $this->vars[$ns][$key] = $value;
            } else {
                $this->encodedVars[$ns][$key] = Json::encode($value, $options);
            }
        }
    }
}