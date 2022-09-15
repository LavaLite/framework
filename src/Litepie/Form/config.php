<?php

return [

    // Markup
    ////////////////////////////////////////////////////////////////////

    // Whether labels should be automatically computed from name
    'automatic_label' => true,

    // The default form type
    'default_form_type' => 'horizontal',

    // The default form type
    'default_coordinates' => [
        'lat' => '37.402473',
        'lng' => '-122.3212843',
    ],

    // Validation
    ////////////////////////////////////////////////////////////////////

    // Whether Former should fetch errors from Session
    'fetch_errors' => true,

    // Whether Former should automatically fetch error messages and
    // display them next to the matching fields
    'error_messages' => true,

    // Checkables
    ////////////////////////////////////////////////////////////////////

    // Whether checkboxes should always be present in the POST data,
    // no matter if you checked them or not
    'push_checkboxes' => false,

    // The value a checkbox will have in the POST array if unchecked
    'unchecked_value' => 0,

    // Required fields
    ////////////////////////////////////////////////////////////////////

    // The class to be added to required fields
    'required_class' => 'required',

    // A facultative text to append to the labels of required fields
    'required_text' => '<sup>*</sup>',

    // Whether text that comes out of the translated
    // should be capitalized (ex: email => Email) automatically
    'capitalize_translations' => true,

    // Attributes for the input and form elements
    'attributes' => [
        'accept', 'alt', 'autocomplete', 'autofocus', 'checked', 'dirname', 'disabled', 'form', 'formaction',
        'formenctype', 'formmethod', 'formnovalidate', 'formtarget', 'height', 'list', 'max', 'maxlength',
        'min', 'minlength', 'multiple', 'name', 'pattern', 'placeholder', 'readonly', 'required', 'size',
        'src', 'step', 'type', 'value', 'width', 'data',
    ],

    // Input types for the form
    'types' => [
        'button', 'checkbox', 'color', 'date', 'datetime-local', 'email', 'file', 'hidden', 'image',
        'month', 'number', 'password', 'radio', 'range', 'reset', 'search', 'submit', 'tel', 'text',
        'time', 'url', 'week',
    ],

    // Framework
    ////////////////////////////////////////////////////////////////////

    // The framework to be used by Former
    'framework' => 'bootstrap4',

];
