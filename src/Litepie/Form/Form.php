<?php

namespace Litepie\Form;

use Illuminate\Container\Container;
use Illuminate\Support\Str;

/**
 * Construct and manages the form wrapping all fields.
 */
class Form extends Fields
{
    /**
     * The current environment.
     *
     * @var \Illuminate\Container\Container
     */
    public $app;

    /**
     * The Fields.
     *
     * @var Fields
     */
    protected $fields;

    /**
     * The Form type.
     *
     * @var string
     */
    protected $orientation = 'horizontal';

    /**
     * The destination of the current form.
     *
     * @var string
     */
    protected $action;

    /**
     * The form method.
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * The form element.
     *
     * @var string
     */
    protected $element = 'input';

    /**
     * The form has tile upload.
     *
     * @var bool
     */
    public $hasFile = false;

    ////////////////////////////////////////////////////////////////////
    /////////////////////////// CORE METHODS ///////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Build a new Form instance.
     *
     * @param UrlGenerator $url
     */
    public function __construct(
        Container $app,
        Fields $fields,
        Lists $lists
    ) {
        $this->app = $app;
        $this->fields = $fields;
        $this->lists = $lists;
    }

    /**
     * Opens up magically a form.
     *
     * @param array $parameters Parameters passed
     *
     * @return Form A form opening tag
     */
    public function open($attr = [])
    {
        $this->element = 'form-open';
        if (isset($attr['action'])) {
            $this->action($attr['action']);
        }

        if (isset($attr['method'])) {
            $this->method = strtoupper($attr['method']);
        }

        if (isset($attr['files'])) {
            $this->files($attr['files']);
        }

        return $this;
    }

    /**
     * Opens up magically a form.
     *
     * @param array $parameters Parameters passed
     *
     * @return Form A form opening tag
     */
    public function list($array = [])
    {
        $this->element = 'lists';

        foreach ($array as $key => $value) {
            if ($value instanceof Closure) {
                $value = $value();
            }
            if (method_exists($this->lists, $key)) {
                $this->lists->$key($value);
            } elseif (property_exists($this->lists, $key)) {
                $this->lists->$key = $value;
            } else {
                $this->lists->attribute($key, $value);
            }
        }

        return $this;
    }

    /**
     * Closes a Form.
     *
     * @return string A closing <form> tag
     */
    public function close()
    {
        $this->element = 'form-close';

        return $this;
    }

    /**
     * Open a Form.
     *
     * @return string A closing <form> tag
     */
    public function formOpen()
    {
        return '<form '.
        "class='form-".$this->orientation."' ".
        "id='".$this->id."' ".
        "method='POST' ".
        "action='".$this->action."' ".
        ($this->hasFile ? "enctype='multipart/form-data'" : '').">
        <input type='hidden' name='_method' value='".$this->method."'>
        <input type='hidden' name='_token' value='".csrf_token()."'>";
    }

    /**
     * Open a Form.
     *
     * @return string A closing <form> tag
     */
    public function formClose()
    {
        return "<input type='hidden' name='_token' value='".csrf_token()."' />
        </form>";
    }

    ////////////////////////////////////////////////////////////////////
    /////////////////////////////// SETTER /////////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Change the form's action.
     *
     * @param string $action The new action
     *
     * @return $this
     */
    public function action($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Change the form's method.
     *
     * @param string $method The method to use
     *
     * @return $this
     */
    public function method($method)
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Change the form's attributes.
     *
     * @param string $attributes The attributes to use
     *
     * @return $this
     */
    public function attributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Change the form's attributes.
     *
     * @param string $attributes The attributes to use
     *
     * @return $this
     */
    public function addAttributes($attribute, $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Outputs the current form opened.
     *
     * @return string A <form> opening tag
     */
    public function __toString()
    {
        switch ($this->element) {
            case 'form-open':
                $this->element = null;

                return $this->formOpen();
                break;
            case 'form-close':
                $this->element = null;

                return $this->formClose();
                break;
            case 'lists':
                $this->element = null;

                return $this->lists->__toString();
                break;
            default:
                return $this->fields->__toString();
        }
    }

    /**
     * Specify whether the form has file attachements.
     *
     * @return string A <form> opening tag
     */
    public function files($files = true)
    {
        $this->hasFile = $files;

        return $this;
    }

    /**
     * Call toString specificaly for the form object.
     *
     * @return string html for the element
     */
    public function render()
    {
        return $this->__toString();
    }

    ////////////////////////////////////////////////////////////////////
    ////////////////////////// PUBLIC HELPERS //////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Set the field as floating label.
     */
    public function floatingLabel($isFloatingLabel = true)
    {
        $this->floatingLabel = $isFloatingLabel;

        return $this;
    }

    /**
     * Redirect calls to the group if necessary.
     *
     * @param string $method
     */
    public function __call($method, $parameters)
    {
        if (Str::contains($method, 'open')) {
            $this->element = 'form-open';
            $this->orientation = Str::remove('_open', $method);

            return $this->open(@$parameters[0]);
        }

        if ($this->element == 'form-open') {
            return $this->addAttributes($method, @$parameters[0]);
        }

        if ($this->element != 'form-open') {
            return $this->fields->field($method, $parameters);
        }
    }
}
