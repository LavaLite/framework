<?php

namespace Litepie\Form\Field;

use Litepie\Form\Field\Types\Checkable;
use Litepie\Form\Field\Types\Files;
use Litepie\Form\Field\Types\InputGroup;
use Litepie\Form\Field\Types\Selectable;
use Litepie\Form\Field\Types\Map;
/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked
 */
trait Types
{
    use InputGroup;
    use Files;
    use Checkable;
    use Selectable;
    use Map;

    /**
     * Whether the Field is self-closing or not
     *
     * @var boolean
     */
    public $options = [];

    /**
     * Sets attribute for the field
     *
     * @param  array options
     *
     * @return object|this This object instance
     */
    public function options($options = [], $value = null)
    {
        if(!is_null($value)){
            $this->value = $value;
        }
        $this->options = $options;
        return $this;
    }

    /**
     * Sets attribute for the field
     *
     * @return array options
     */
    public function prepareOptions()
    {

        if (!in_array($this->element, $this->selectElements) && !in_array($this->element, $this->checkElements)) {
            return;
        }

        if (empty($this->options) || !is_array($this->options)) {
            $this->options = [];
            return;
        }

        $function = 'prepare' . ucfirst($this->element);
        $this->options = $this->$function($this->options);

    }

    protected function prepareOptionsArray($options, $value, $text)
    {
        if (is_string(current($options))) {
            foreach ($options as $key => $val) {
                $options[$key] = [
                    $value => $key,
                    $text => $val,
                ];
            }
        }
        return $options;
    }
}
