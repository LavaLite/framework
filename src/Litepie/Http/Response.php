<?php

namespace Litepie\http;

use Form;
use Theme;

class Response
{
    /**
     * @var store the response type.
     */
    protected $type = null;

    /**
     * @var store the response data.
     */
    protected $data = null;

    /**
     * @var Store the page title.
     */
    protected $title = null;

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
     * @var  View for the response.
     */
    protected $view = null;

    /**
     * @var  Url for the redirect response.
     */
    protected $url = null;

    /**
     * @var  Theme for the request.
     */
    public $theme = null;

    /**
     * @var  Theme for the request.
     */
    protected $layout = null;

    /**
     * Return the type of response for the current request.
     *
     * @return  string
     */
    protected function getType()
    {

        if ($this->type) {
            return $this->type;
        }

        if (request()->wantsJson()) {
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
     *
     */
    public function type($type)
    {
        $this->type = in_array($type, ['json', 'ajax', 'http']) ? $type : null;
    }

    /**
     * Return json array for  json response.
     *
     * @return json string
     *
     */
    public function typeIs($type)
    {
        return $this->getType() == $type;
    }

    /**
     * Return json array for  json response.
     *
     * @return json string
     *
     */
    protected function json()
    {
        return response()->json($this->getData(), 200);
    }

    /**
     * Return view for the ajax response.
     *
     * @return view
     *
     */
    protected function ajax()
    {
        Form::populate($this->getFormData());
        return response()->view($this->getView(), $this->getData());
    }

    /**
     * Return  whole page for the http request.
     *
     * @return theme page
     *
     */
    protected function http()
    {
        Form::populate($this->getFormData());
        $this->theme->prependTitle($this->getTitle());
        return $this->theme->of($this->getView(), $this->getData())->render();
    }

    /**
     * Return  whole page for the http request.
     *
     * @return theme page
     *
     */
    public function redirect()
    {

        if ($this->typeIs('json')) {
            return response()->json([
                'message' => $this->getMessage(),
                'code'    => $this->getCode(),
                'status'  => $this->getStatus(),
                'url'     => $this->getUrl(),
            ], $this->getStatusCode());
        }

        if ($this->typeIs('ajax')) {
            return response()->json([
                'message' => $this->getMessage(),
                'code'    => $this->getCode(),
                'status'  => $this->getStatus(),
                'url'     => $this->getUrl(),
            ], $this->getStatusCode());
        }

        return redirect($this->url)
            ->withMessage($this->getMessage())
            ->withStatus($this->getStatus())
            ->withCode($this->getCode());
    }

    /**
     * Return the output for the current response.
     *
     * @return theme page
     *
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
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
    public function view($view)
    {

        $this->view = $view;

        return $this;
    }

    /**
     * @return  View for the request
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param  View for the request $url
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
     * @param  View for the request $theme
     *
     * @return self
     */
    public function theme($theme)
    {

        $this->theme = Theme::uses($theme);

        return $this;
    }

    /**
     * @return  View for the request
     */
    public function getTheme()
    {
        return $this->theme;
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

        if (is_array($this->data)) {
            return current($this->data);
        }

        return [];
    }

    /**
     * @param  Theme for the request $layout
     *
     * @return self
     */
    public function layout($layout)
    {
        $this->theme->layout($layout);

        return $this;
    }

    /**
     * @return  Theme for the request
     */
    public function getLayout()
    {
        return $this->layout;
    }

}
