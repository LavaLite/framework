<?php

namespace Litepie\Filer\Form;

class Forms
{
    /**
     * Number of files can be uploaded.
     */
    private $count = 10;

    /**
     * Path to the view for displaying the files.
     */
    private $view = null;

    /**
     * Path to the configuration file for displaying the files.
     */
    private $config = null;

    /**
     * Table's field.
     */
    private $field = null;

    /**
     * Array of files to be displayed.
     */
    private $files = null;

    /**
     * Mime type for upload files.
     */
    private $mime = null;

    /**
     * Upload url for file.
     */
    private $url = null;

    /**
     * Upload src for file.
     */
    private $src = null;

    /**
     * Image size config file path.
     */
    private $size = 'sm';

    /**
     * Build a new form element.
     *
     * @param type $field
     * @param type $files
     * @param type $config
     */
    public function __construct($field, $config, $files = [])
    {
        $this->field($field);
        $this->config($config);
        $this->files($files);
    }

    /**
     * Generate html to diaplay files.
     *
     * @return string
     */
    public function show()
    {
        $this->view('filer::show', false);

        return $this;
    }

    /**
     * Generate html to edit the images.
     *
     * @return string
     */
    public function editor()
    {
        $this->view('filer::editor', false);

        return $this;
    }

    /**
     * Generate html to crop the images.
     *
     * @return string
     */
    public function cropper($src = null)
    {
        $this->view('filer::cropper', false);
        $this->src($src, false);

        return $this;
    }

    /**
     * Generate html to upload files.
     *
     * @return type
     */
    public function dropzone($url = null)
    {
        $this->url($url, false);
        $this->view('filer::dropzone', false);
        $this->mime('image/*', false);

        return $this;
    }

    /**
     * Generate html to upload files.
     *
     * @return type
     */
    public function input()
    {
        $this->view('filer::input', false);
        $this->mime('image/*', false);

        return $this;
    }

    /**
     * Generate html to upload files.
     *
     * @return type
     */
    public function uploader($url = null)
    {
        $this->url($url, false);
        $this->view('filer::dropzone', false);
        $this->mime('image/*', false);

        return $this;
    }

    /**
     * Render the output.
     *
     * @return type
     */
    public function render()
    {
        $view = $this->getView();
        $field = $this->getField();
        $files = $this->getFiles();
        $mime = $this->getMime();
        $config = $this->getConfig();
        $url = $this->getUrl();
        $src = $this->getSrc();
        $count = $this->getCount();
        $size = $this->getSize();

        return view($view, compact('count', 'url', 'src', 'config', 'field', 'files', 'size', 'mime'))->render();
    }

    /**
     * Render the output.
     *
     * @return type
     */
    public function __tostring()
    {
        return $this->render();
    }

    /**
     * Gets the Number of files can be uploaded.
     *
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Sets the Number of files can be uploaded.
     *
     * @param mixed $count the count
     *
     * @return self
     */
    public function count($count)
    {
        if (is_numeric($count) && $count > 0) {
            $this->count = $count;
        }

        return $this;
    }

    /**
     * Gets the Path to the view for displaying the files.
     *
     * @return mixed
     */
    public function getView()
    {
        return is_null($this->view) ? 'filer::show' : $this->view;
    }

    /**
     * Sets the Path to the view for displaying the files.
     *
     * @param mixed $view the view
     *
     * @return self
     */
    public function view($view, $force = true)
    {
        if (is_null($this->view) || $force) {
            $this->view = $view;
        }

        return $this;
    }

    /**
     * Gets the Path to the configuration file for displaying the files.
     *
     * @return mixed
     */
    public function getConfig()
    {
        return preg_replace('~\.(?!.*\.)~', '/', $this->config);
    }

    /**
     * Sets the Path to the configuration file for displaying the files.
     *
     * @param mixed $config the config
     *
     * @return self
     */
    public function config($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Gets the Table's field.
     *
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Sets the Table's field.
     *
     * @param mixed $field the field
     *
     * @return self
     */
    public function field($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Gets the Array of files to be displayed.
     *
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Sets the Array of files to be displayed.
     *
     * @param mixed $files the files
     *
     * @return self
     */
    public function files($files)
    {
        if (!is_array($files) && !is_object($files)) {
            $files = json_decode($files, true);
        }

        if (empty($files)) {
            $files = [];
        }

        if (is_object($files)) {
            $files = (array) $files;
        }

        $this->files = $files;

        return $this;
    }

    /**
     * Gets the Mime type for upload files.
     *
     * @return mixed
     */
    public function getMime()
    {
        if (is_array($this->mime)) {
            return '.'.implode(', .', $this->mime);
        }

        return $this->mime;
    }

    /**
     * Sets the Mime type for upload files.
     *
     * @param mixed $mime the mime
     *
     * @return self
     */
    public function mime($mime, $force = true)
    {
        if (is_null($this->mime) || $force) {
            $this->mime = $mime;
        }

        return $this;
    }

    /**
     * Gets the Upload url for file.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the Upload url for file.
     *
     * @param mixed $url the url
     *
     * @return self
     */
    public function url($url, $force = true)
    {
        if (is_null($this->url) || $force) {
            $this->url = $url;
        }

        return $this;
    }

    /**
     * Gets the Upload url for file.
     *
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Sets the Upload url for file.
     *
     * @param mixed $url the url
     *
     * @return self
     */
    public function src($src, $force = true)
    {
        if (is_null($this->src) || $force) {
            $this->src = $src;
        }

        return $this;
    }

    /**
     * Gets the Image size config file path.
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the Image size config file path.
     *
     * @param mixed $size the size
     *
     * @return self
     */
    public function size($size)
    {
        $this->size = $size;

        return $this;
    }
}
