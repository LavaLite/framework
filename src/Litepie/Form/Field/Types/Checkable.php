<?php

namespace Litepie\Form\Field\Types;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait Checkable
{
    /**
     * Value name for the check field.
     *
     * @var text
     */
    public $check_value = 'value';

    /**
     * Key name for the check field.
     *
     * @var text
     */
    public $check_text = 'text';

    /**
     * Key name for the check field.
     *
     * @var text
     */
    public $inline = true;

    /**
     * Group element name for the field.
     *
     * @var array
     */
    protected $checkElements = ['radio', 'radios', 'checkbox', 'checkboxs'];

    /**
     * Sets attribute for the field.
     *
     * @param  array options
     *
     * @return object|this This object instance
     */
    public function inline($inline = true)
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    public function prepareCheckbox($options)
    {
        return $this->prepareChecks($options);
    }

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    public function prepareRadio($options)
    {
        return $this->prepareChecks($options);
    }

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    private function prepareChecks($options)
    {
        $options = $this->prepareOptionsArray($options, $this->check_value, $this->check_text);
        data_fill($options, '*.checked', false);
        data_fill($options, '*.checked', false);
        data_fill($options, '*.'.$this->check_value, '');
        data_fill($options, '*.'.$this->check_text, '');
        if (!is_array($this->value)) {
            return $options;
        }

        foreach ($options as $option) {
            if ($option[$this->check_value] == $this->value) {
                $options[$option]['checked'] = true;
            } else {
                $options[$option]['checked'] = false;
            }
        }

        return $options;
    }
}
