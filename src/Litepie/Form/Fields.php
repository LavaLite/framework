<?php

namespace Litepie\Form;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Litepie\Form\Field\Attributes;
use Litepie\Form\Field\Types;
use View;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
class Fields
{
    use Attributes;

    use Types;

    /**
     * The app instance.
     *
     * @var object
     */
    public $app;

    /**
     * The form instance.
     *
     * @var object
     */
    public $form;

    /**
     * A label for the field (if not using Bootstrap).
     *
     * @var string
     */
    public $label;

    /**
     * The field's group.
     *
     * @var Group
     */
    protected $group;

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
    public $isRaw = false;

    /**
     * The field's placeholder.
     *
     * @var Placeholder
     */
    public $placeholder;

    /**
     * The field's name.
     *
     * @var Name
     */
    public $name;

    /**
     * The is the field wrap elements.
     *
     * @var wrap
     */
    private $wrap = false;

    /**
     * The icol Width for the field.
     *
     * @var column
     */
    public $column = 6;

    /**
     * The field's id.
     *
     * @var Id
     */
    public $id;

    /**
     * The field's default element.
     *
     * @var string
     */
    protected $element = 'input';

    /**
     * The field's default element.
     *
     * @var string
     */
    public $mode = null;

    /**
     * The field's default type.
     *
     * @var string
     */
    public $type = 'text';

    ////////////////////////////////////////////////////////////////////
    ///////////////////////////// INTERFACE ////////////////////////////
    ////////////////////////////////////////////////////////////////////
    /**
     * Set up a Field instance.
     *
     * @param string $type A field type
     */
    public function __construct(Container $app)
    {
        // Set base parameters
        $this->app = $app;
    }

    /**
     * Redirect calls to the group if necessary.
     *
     * @param string $method
     */
    public function field($method, $parameters)
    {
        // Set base parameters
        $this->resets();
        $this->name = @$parameters[0];
        $this->id = @$parameters[0];
        $this->value = @$parameters[1];
        $this->element($method);
        $this->setLabel(@$parameters[0], @$parameters[2]);

        // Repopulate field
        if (@$parameters['type'] != 'password' && @$parameters['name'] !== '_token') {
            $this->value = $this->repopulate();
        }

        return $this;
    }

    /**
     * Redirect calls to to the attributes array.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return object $this
     */
    public function __call($method, $parameters)
    {
        // Set base parameters
        $this->attribute($method, @$parameters[0], @$parameters[1]);

        return $this;
    }

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
        $this->options = [];
        $this->append = [];
        $this->prepend = [];
        $this->isRaw = false;

        $this->label('');
        $this->url(null);
        $this->mode(null);
        $this->initAttributes();
    }

    /**
     * Prints out the field.
     *
     * @return string
     */
    public function __toString()
    {
        $data = [];

        $view = strtolower($this->framework());
        $data = $this->toArray();
        $this->incrementFileInstanceCount();

        $element = View::first(["form::$view." . $this->element, "form::{$view}.input"], $data)->render();
        if ($this->isRaw || $this->element == 'hidden') {
            return $element;
        }

        $data['element'] = $element;
        $labeled = view("form::{$view}._label", $data)->render();

        if (!$this->wrap) {
            return $labeled;
        }
        $data['labeled'] = $labeled;

        return view("form::{$view}._wrapper", $data)->render();
    }

    /**
     * Convert object to array representation.
     *
     * @return string
     */
    public function toArray()
    {
        $this->prepareOptions();
        $this->setUrl();
        $array = (array) $this;
        $array['attributes'] = $this->prepapareAttribute();
        $array['isInputGroup'] = $this->isInputGroup();
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
     * Set display mode of the element.
     *
     *
     * @return object $this
     */
    public function mode($mode = null)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Check if the field get a floating label.
     *
     * @return bool
     */
    public function withFloatingLabel()
    {
        return $this->floatingLabel;
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
     * Adds a element to the group/field.
     *
     * @param string $element A element
     *
     * @return Field A field
     */
    public function element($element)
    {
        $this->element = $element;
        $this->type = $element;

        return $this;
    }

    /**
     * Adds a placeholder to the field.
     *
     * @param string $text A placeholder
     *
     * @return Field A field
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Set the Field value no matter what.
     *
     * @param string $value A new value
     */
    public function forceValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Classic setting of attribute, won't overwrite any populate() attempt.
     *
     * @param string $value A new value
     */
    public function value($value)
    {
        // Check if we already have a value stored for this field or in POST data
        $already = $this->repopulate();

        if (!$already) {
            $this->value = $value;
        }

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

        // Also relink the label to the new name
        $this->setLabel($name);
        $this->setId($name);

        return $this;
    }

    /**
     * Change the field's id.
     *
     * @param string $id The new id
     */
    public function id($id)
    {
        $this->id = Str::slug($id);

        return $this;
    }

    /**
     * Get the field's labels.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Retrurn the value of a field.
     *
     * @return string
     */
    public function getValue($field, $fallback = null)
    {
        // Get values from POST, populated, and manually set value
        $post = $this->getPost($field);

        // Assign a priority to each
        if (!is_null($post)) {
            return $post;
        }

        $populator = $this->form ? $this->form->getPopulator() : $this->app['form.populator'];
        $populate = $populator->get($field);

        if (!is_null($populate)) {
            return $populate;
        }
        return $fallback ?: $this->value;
    }

    ////////////////////////////////////////////////////////////////////
    //////////////////////////////// HELPERS ///////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Use values stored in Former to populate the current field.
     */
    private function repopulate($fallback = null)
    {
        // Get values from POST, populated, and manually set value
        $post = $this->getPost($this->name);

        // Assign a priority to each
        if (!is_null($post)) {
            return $post;
        }

        $populator = $this->form ? $this->form->getPopulator() : $this->app['form.populator'];
        $populate = $populator->get($this->name);

        if (!is_null($populate)) {
            return $populate;
        }

        return $fallback ?: $this->value;
    }

    /**
     * Fetch a field value from both the new and old POST array.
     *
     * @param string $name     A field name
     * @param string $fallback A fallback if nothing was found
     *
     * @return string The results
     */
    public function getPost($name, $fallback = null)
    {
        $name = str_replace(['[', ']'], ['.', ''], $name);
        $name = trim($name, '.');
        $oldValue = request()->old($name, $fallback);

        return request()->input($name, $oldValue, true);
    }

    /**
     * Ponders a label and a field name, and tries to get the best out of it.
     *
     * @param string $label A label
     * @param string $name  A field name
     *
     * @return false|null A label and a field name
     */
    private function setLabel($name = null, $label = null)
    {
        if (!empty($this->label)) {
            return;
        }

        // Check for the two possibilities
        if ($label && is_null($name)) {
            $name = Str::slug($label);
        } elseif (is_null($label) && $name) {
            $label = preg_replace('/\[\]$/', '', $name);
        }
        // Save values
        $this->label(ucfirst($label));
    }

    /**
     * Private function to set Id if it is empty.
     *
     * @param string $id Id of the element
     *
     * @return false|null
     */
    private function setId($id)
    {
        if (!empty($this->id)) {
            return;
        }

        $this->id = $id;
    }
}
