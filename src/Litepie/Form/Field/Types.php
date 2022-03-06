<?php

namespace Litepie\Form\Field;

use Litepie\Form\Field\Types\Checkable;
use Litepie\Form\Field\Types\Files;
use Litepie\Form\Field\Types\InputGroup;
use Litepie\Form\Field\Types\Map;
use Litepie\Form\Field\Types\Selectable;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait Types
{
    use InputGroup;
    use Files;
    use Checkable;
    use Selectable;
    use Map;

    /**
     * Whether the Field is self-closing or not.
     *
     * @var bool
     */
    public $options = [];

    /**
     * Sets attribute for the field.
     *
     * @param  array options
     *
     * @return object|this This object instance
     */
    public function options($options = [], $value = null)
    {
        if (!is_null($value)) {
            $this->value = $value;
        }
        $this->options = $options;

        return $this;
    }

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    public function prepareOptions()
    {

        if (empty($this->options) || !is_array($this->options)) {
            $this->options = [];

            return;
        }

        if (in_array($this->element, $this->selectElements)) {
            $this->options = $this->prepareSelect($this->options);
        }

        if (in_array($this->element, $this->checkElements)) {
            $this->options = $this->prepareChecks($this->options);
        }
        return;
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
