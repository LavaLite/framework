<?php

namespace Litepie\Http\Traits;

trait RequestTrait
{
    /**
     * @var store the response type.
     */
    protected $type = null;

    /**
     * Return json array for  json response.
     *
     * @return json string
     */
    public function type($type)
    {
        $this->type = in_array($type, ['json', 'ajax', 'http']) ? $type : null;
    }

    /**
     * Return json array for  json response.
     *
     * @return json string
     */
    public function typeIs($type)
    {
        return $this->getType() == $type;
    }
}
