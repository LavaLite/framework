<?php

namespace Litepie\Form\Field\Types;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait InputGroup
{
    /**
     * Whether the Field is self-closing or not.
     *
     * @var bool
     */
    public $append = null;

    /**
     * Value name for the group field.
     *
     * @var text
     */
    public $prepend = null;

    /**
     * Sets attribute for the field.
     *
     * @param  array options
     *
     * @return object|this This object instance
     */
    public function append($append)
    {
        if (!empty($append)) {
            $this->append[] = $append;
        }

        return $this;
    }

    /**
     * Sets attribute for the field.
     *
     * @param  array options
     *
     * @return object|this This object instance
     */
    public function prepend($prepend)
    {
        if (!empty($append)) {
            $this->prepend[] = $prepend;
        }

        return $this;
    }

    /**
     * Sets attribute for the field.
     *
     * @return array options
     */
    public function isInputGroup()
    {
        if (empty($this->append) && empty($this->prepend)) {
            return false;
        }

        return true;
    }
}
