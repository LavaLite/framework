<?php

namespace Litepie\Http\Response;

use Form;
use Litepie\Http\Traits\RequestTrait;
use Litepie\Http\Traits\ThemeTrait;
use Litepie\Http\Traits\ViewTrait;

abstract class AbstractResponse
{
    use ViewTrait;
    use RequestTrait;
    use ThemeTrait;

    /**
     * @var store the response data.
     */
    protected $data = null;

    /**
     * @var Response message for the response.
     */
    protected $message = null;

    /**
     * @var Response status for the response.
     */
    protected $status = null;

    /**
     * @var Response code for the response.
     */
    protected $code = null;

    /**
     * @var Url for the redirect response.
     */
    protected $url = null;

    /**
     * @var Url for the redirect response.
     */
    protected $populate = true;

    /**
     * Return the type of response for the current request.
     *
     * @return string
     */
    protected function getType()
    {
        if ($this->type) {
            return $this->type;
        }

        if (request()->wantsJson() || request()->is('api/*')) {
            return 'json';
        }

        if (request()->ajax()) {
            return 'ajax';
        }

        return 'http';
    }

    /**
     * Return json array for  json response.
     *
     * @return json string
     */
    protected function json()
    {
        return response()->json($this->getData(), 200);
    }

    /**
     * Return view for the ajax response.
     *
     * @return view
     */
    protected function ajax()
    {
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache'); // HTTP/1.0
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past

        if ($this->populate) {
            Form::populate($this->getFormData());
        }

        $view = $this->getView();

        if (!is_array($view)) {
            return view($this->getView(), $this->getData());
        }

        return view()->first($this->getView(), $this->getData());
    }

    /**
     * Return  whole page for the http request.
     *
     * @return theme page
     */
    protected function http()
    {
        if ($this->populate) {
            Form::populate($this->getFormData());
        }

        $this->theme->prependTitle($this->getTitle());

        return $this->theme->of($this->getView(), $this->getData())->render();
    }

    /**
     * Return  whole page for the http request.
     *
     * @return theme page
     */
    public function redirect()
    {
        if ($this->typeIs('json')) {
            return response()->json([
                'data'    => $this->getFormData(),
                'message' => $this->getMessage(),
                'code'    => $this->getCode(),
                'status'  => $this->getStatus(),
                'url'     => $this->getUrl(),
            ], $this->getStatusCode());
        }

        if ($this->typeIs('ajax')) {
            return response()->json([
                'data'    => $this->getFormData(),
                'message' => $this->getMessage(),
                'code'    => $this->getCode(),
                'status'  => $this->getStatus(),
                'url'     => $this->getUrl(),
            ], $this->getStatusCode());
        }

        return redirect($this->url)
            ->withData($this->getData())
            ->withMessage($this->getMessage())
            ->withStatus($this->getStatus())
            ->withCode($this->getCode());
    }

    /**
     * Return the output for the current response.
     *
     * @return theme page
     */
    public function output()
    {
        if ($this->typeIs('json')) {
            return $this->json();
        }

        if ($this->typeIs('ajax')) {
            return $this->ajax();
        }

        return $this->http();
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     *
     * @return self
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function status($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status == 'success' ? 201 : 400;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function code($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function populate($status)
    {
        $this->populate = $status;

        return $this;
    }

    /**
     * @return View for the request
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param View for the request $url
     *
     * @return self
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param store the response type $this->getData()
     *
     * @return self
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param store the response data $data
     *
     * @return self
     */
    public function getData()
    {
        return is_array($this->data) ? $this->data : [];
    }

    /**
     * @param store the response data $data
     *
     * @return self
     */
    public function getFormData()
    {
        if (isset($this->data['data']) && is_array($this->data['data'])) {
            return $this->data['data'];
        }

        if (is_array($this->data)) {
            return $this->data;
        }

        return [];
    }

    /**
     * Return auth guard for the current route.
     *
     * @return type
     */
    protected function getGuard()
    {
        return getenv('guard');
    }

    /**
     * Handle dynamic method calls.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $callable = preg_split('|[A-Z]|', $method);

        if (in_array($callable[0], ['set', 'prepend', 'append', 'has', 'get'])) {
            $value = lcfirst(preg_replace('|^'.$callable[0].'|', '', $method));
            array_unshift($parameters, $value);
            call_user_func_array([$this->theme, $callable[0]], $parameters);
        }

        return $this;
    }
}
