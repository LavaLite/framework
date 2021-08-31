<?php

namespace Litepie\Form\Field\Types;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked
 */
trait Map
{
    /**
     * Default latitude.
     */
    public $latitude = 0;

    /**
     * Default longitude.
     *
     */
    public $longitude = 0;

    /**
     * Latitude field name
     *
     */
    public $latField = 'latitude';

    /**
     * Longitude field name
     *
     */
    public $lngField = 'longitude';

}
