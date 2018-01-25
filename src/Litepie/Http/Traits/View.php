<?php

namespace Litepie\http\Traits;

trait View
{

    /**
     * @var  View for the response.
     */
    protected $view = null;

    /**
     * @return  View for the request
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param  view for the request $view
     *
     * @return self
     */
    public function view($view, $includeFolder = null)
    {

        $this->view = $view;

        return $this;
    }

}
