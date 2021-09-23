<?php

namespace Litepie\Notification\Messages;

class WhatsAppMessage
{
    public $namespace;

    public $template;

    public $to;

    public $params = [];

    public function __constructor(
        string $namespace,
        string $template
    ) {
        $this->namespace = $namespace;
        $this->template = $template;
    }

    public function addTextParameter($text, $number)
    {
        $this->params[$number]['type'] = 'text';
        $this->params[$number]['text'] = $text;
    }

    public function addTextParametes($array)
    {
        foreach ($array as $key => $value) {
            $this->params[$key]['type'] = 'text';
            $this->params[$key]['text'] = $value;
        }
    }

    public function to($number = null)
    {
        if (empty($number)) {
            return $this->to;
        }
        $number = preg_replace('/[^0-9]/', '', $number);
        $this->to = $number;

        return $this;
    }

    public function template($template = null)
    {
        if (empty($template)) {
            return $this->template;
        }
        $this->template = $template;

        return $this;
    }

    public function namespace($namespace = null)
    {
        if (empty($namespace)) {
            return $this->namespace;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function params($params = null)
    {
        if (empty($params)) {
            return $this->params;
        }
        $this->params = $params;

        return $this;
    }
}
