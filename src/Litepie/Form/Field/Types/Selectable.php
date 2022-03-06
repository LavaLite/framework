<?php

namespace Litepie\Form\Field\Types;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait Selectable
{
    /**
     * Value name for the select field.
     *
     * @var text
     */
    public $select_value = 'value';

    /**
     * Key name for the select field.
     *
     * @var text
     */
    public $select_text = 'text';

    /**
     * Select element name for the field.
     *
     * @var array
     */
    protected $selectElements = ['select', 'tags'];

    /**
     * Select element name for the field.
     *
     * @var array
     */
    public $maxItems = 5;

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    public function prepareSelect($options)
    {
        $options = $this->prepareOptionsArray($options, $this->select_value, $this->select_text);
        data_fill($options, '*.selected', false);
        data_fill($options, '*.selected', false);
        data_fill($options, '*.' . $this->select_value, '');
        data_fill($options, '*.' . $this->select_text, '');

        $value = $this->value;
        if (empty($value)) {
            return $options;
        }
        if (!is_array($value)) {
            $value = [$value];
        }

        foreach ($options as $key => $option) {
            if (in_array($option[$this->select_value], $value)) {
                $options[$key]['selected'] = true;
            }
        }

        return $options;
    }
}
