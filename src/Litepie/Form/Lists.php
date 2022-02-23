<?php

namespace Litepie\Form;

use Closure;
use Illuminate\Support\Str;
use View;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
class Lists
{
    /**
     * A label for the field (if not using Bootstrap).
     *
     * @var string
     */
    public $label;

    /**
     * The field's value.
     *
     * @var Value
     */
    public $value;

    /**
     * The field isRaw.
     *
     * @var isRaw
     */
    protected $isRaw = true;

    /**
     * The field's name.
     *
     * @var Name
     */
    public $name;

    /**
     * The field's default type.
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * The field's default type.
     *
     * @var string
     */
    public $attribute = [];

    /**
     * Apply the attributes to field's objects.
     *
     * @param array $attributes
     *
     * @return object $this
     */
    public function apply($attributes)
    {
        foreach ($attributes as $key => $value) {
            if ($value instanceof Closure) {
                $value = $value();
            }
            if (method_exists($this, $key)) {
                $this->$key($value);
            } elseif (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $this->attribute($key, $value);
            }
        }

        return $this;
    }

    /**
     * Apply the attributes to field's objects.
     *
     * @param array $attributes
     *
     * @return object $this
     */
    public function resets()
    {
        $this->isRaw = false;
        $this->label('');
        $this->value(null);
    }

    /**
     * Returns the compiled string
     *
     * @return string
     */
    public function render()
    {
        return $this->__toString();
    }

    /**
     * Prints out the field.
     *
     * @return string
     */
    public function __toString()
    {
        $data = [];
        $data = $this->toArray();
        $view = strtolower($this->framework());
        $element = View::first([
            "form::list." . $this->type,
            "form::list.text",
            "form::{$view}.list." . $this->type,
            "form::{$view}.list.text",
        ], $data)->render();

        if ($this->isRaw) {
            return $element;
        }

        $data['element'] = $element;

        $labeled = View::first([
            "form::list._label",
            "form::{$view}.list._label",
        ], $data)->render();

        if (!$this->wrap) {
            return $labeled;
        }
        $data['labeled'] = $labeled;

        return View::first([
            "form::list._wrapper",
            "form::{$view}.list._wrapper",
        ], $data)->render();
    }

    /**
     * Convert object to array representation.
     *
     * @return string
     */
    public function toArray()
    {

        $array = (array) $this;
        return $array;
    }

    ////////////////////////////////////////////////////////////////////
    ////////////////////////// PUBLIC INTERFACE ////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Return the current frame work used.
     *
     * @return string
     */
    public function framework()
    {
        return config('form.framework', 'Bootstrap4');
    }

    /**
     * Whether the current field is type of raw.
     *
     * @return object $this
     */
    public function raw($raw = true)
    {
        $this->isRaw = $raw;
        return $this;
    }

    /**
     * Whether the current field is type of raw.
     *
     * @return object $this
     */
    public function attribute($name, $value)
    {
        $this->attribute[$name] = $value;
        return $this;
    }

    /**
     * Adds a label to the group/field.
     *
     * @param string $text A label
     *
     * @return Field A field
     */
    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Adds a type to the group/field.
     *
     * @param string $$type A type
     *
     * @return Field A field
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Adds a wrap to the group/field.
     *
     * @param string $$wrap A wrap
     *
     * @return Field A field
     */
    public function wrap($wrap = true)
    {
        $this->wrap = $wrap;
        return $this;
    }

    /**
     * Adds a col to the group/field.
     *
     * @param string $$col A col
     *
     * @return Field A field
     */
    public function col($column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Classic setting of attribute, won't overwrite any populate() attempt.
     *
     * @param string $value A new value
     */
    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Change the field's name.
     *
     * @param string $name The new name
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

}
