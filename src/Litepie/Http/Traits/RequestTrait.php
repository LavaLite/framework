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

    /**
     * Return the type of response for the current request.
     *
     * @return string
     */
    protected function isJson()
    {
        if (request()->wantsJson()) {
            return true;
        }
    }

    /**
     * Return the type of response for the current request.
     *
     * @return string
     */
    protected function isApi()
    {
        if (request()->is('api/*')) {
            return true;
        }
    }

    /**
     * Return the type of response for the current request.
     *
     * @return string
     */
    protected function isAjax()
    {
        if (request()->ajax()) {
            return true;
        }
    }

}
