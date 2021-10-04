<?php

namespace Litepie\Form\Field;

use Closure;
use Illuminate\Support\Str;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait Attributes
{
    /**
     * Attribute values for the elements.
     *
     * @var array
     */
    private $_attributes = [];

    /**
     * Sets attribute for the field.
     *
     * @param string $label A label
     * @param string $name  A field name
     *
     * @return false|null A label and a field name
     */
    private function initAttributes()
    {
        $attributes = config('form.' . $this->framework() . '.attributes.class.default');
        $attribute['element']['class'] = $attributes['element'];
        $attribute['label']['class'] = $attributes['label'];
        $attribute['wrapper']['class'] = $attributes['wrapper'];
        $this->_attributes = $attribute;
    }

    /**
     * Ponders a label and a field name, and tries to get the best out of it.
     *
     * @param string $label A label
     * @param string $name  A field name
     *
     * @return false|null A label and a field name
     */
    private function attribute($name, $value, $target = 'element')
    {
        $attribute = Str::snake($name, '-');
        if ($attribute == 'attributes') {
            return $this->_attrubute($value);
        }
        $target = empty($target) ? 'element' : $target;
        $this->_attributes[$target][$attribute] = $value;

        return $this;
    }

    /**
     * Ponders a label and a field name, and tries to get the best out of it.
     *
     * @param string $label A label
     * @param string $name  A field name
     *
     * @return false|null A label and a field name
     */
    private function _attribute($attributes)
    {
        foreach ($attributes as $key => $val) {
            foreach ($val as $$k => $v) {
                $this->_attributes[$key][$k] = $v;
            }
        }
        return $this;
    }

    /**
     * Ponders a label and a field name, and tries to get the best out of it.
     *
     * @return false|null A label and a field name
     */
    private function prepapareAttribute()
    {
        $attributes = [
            'element.attribute' => null,
            'element.class' => null,
            'label.attribute' => null,
            'label.class' => null,
            'wrapper.attribute' => null,
            'wrapper.class' => null,
        ];

        $attr = @$this->_attributes['element'];
        if (!empty($attr)) {
            if (!empty($attr['class'])) {
                $attributes['element.class'] = $attr['class'];
                unset($attr['class']);
            }
            $attributes['element.attribute'] = implode(' ', array_map(
                function ($k, $v) {
                    if ($v === false) {
                        return;
                    }

                    if ($v === true) {
                        return $k;
                    }

                    if (is_array($v)) {
                        return;
                    }

                    return $k . '="' . htmlspecialchars($v) . '"';
                },
                array_keys($attr),
                $attr
            ));
        }

        $attr = @$this->_attributes['label'];
        if (!empty($attr)) {
            if (!empty($attr['class'])) {
                $attributes['label.class'] = $attr['class'];
                unset($attr['class']);
            }
            $attributes['label.attribute'] = implode(' ', array_map(
                function ($k, $v) {return $k . '="' . htmlspecialchars($v) . '"';},
                array_keys($attr),
                $attr
            ));
        }

        $attr = @$this->_attributes['wrapper'];
        if (!empty($attr)) {
            if (!empty($attr['class'])) {
                $attributes['wrapper.class'] = $attr['class'];
                unset($attr['class']);
            }
            $attributes['wrapper.attribute'] = implode(' ', array_map(
                function ($k, $v) {return $k . '="' . htmlspecialchars($v) . '"';},
                array_keys($attr),
                $attr
            ));
        }

        return $attributes;
    }

    /**
     * Ponders a label and a field name, and tries to get the best out of it.
     *
     * @param string $label A label
     * @param string $name  A field name
     *
     * @return false|null A label and a field name
     */
    public function addClass($class, $target = 'element')
    {
        if (!empty($this->_attributes[$target]['class'])) {
            $framework = strtolower(config('form.framework', 'bootstrap4') . '.');
            $this->_attributes[$target]['class'] = config('form.' . $framework);
        }
        $this->_attributes[$target]['class'] = $class;

        return $this;
    }

    /**
     * Process data attribute for the input.
     *
     * @param array $data for data attribute.
     *
     * @return null
     */
    public function data($data = [])
    {
        if (!empty($data) || !is_array($data)) {
            return;
        }

        foreach ($data as $key => $val) {
            if ($val instanceof Closure) {
                $val = $val();
            }
            if (is_array($val)) {
                $val = json_encode($val);
            }
            $this->_attributes['element']['data-' . $key] = $val;
        }

        return;
    }

}
