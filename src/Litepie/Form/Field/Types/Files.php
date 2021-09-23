<?php

namespace Litepie\Form\Field\Types;

/**
 * Abstracts general fields parameters (type, value, name) and
 * reforms a correct form field depending on what was asked.
 */
trait Files
{
    /**
     * Number of files can be uploaded.
     */
    public $count = 10;

    /**
     * The app instance.
     *
     * @var object
     */
    public $url = null;

    /**
     * The size of the image.
     *
     * @var string
     */
    public $thumbSize = 'xs';

    /**
     * The size of the image.
     *
     * @var string
     */
    public $largeSize = 'lg';

    /**
     * Instance count for files.
     *
     * @var int
     */
    public $fileInstanceCount = 1;

    /**
     * Mime type for upload files.
     */
    public $mime = 'audio/*,image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';

    /**
     * Redirect calls to the group if necessary.
     *
     * @param string $method
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Redirect calls to the group if necessary.
     *
     * @param string $method
     */
    public function incrementFileInstanceCount($count = 1)
    {
        if ($this->element == 'file') {
            $this->fileInstanceCount += $count;
        }
    }

    /**
     * Set the thumbnail size.
     *
     * @param string $size
     */
    public function thumbSize($size)
    {
        $this->thumbSize = $size;
    }

    /**
     * Set the thumbnail size.
     *
     * @param string $size
     */
    public function largeSize($size)
    {
        $this->largeSize = $size;
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
     * set the upload url for the file field.
     *
     * @param mixed $count the count
     *
     * @return self
     */
    public function setUrl()
    {
        if ($this->element != 'file' || $this->url != null) {
            return;
        }
        $populator = $this->form ? $this->form->getPopulator() : $this->app['form.populator'];
        $uploadUrl = @$populator->get('meta')['upload_url'];
        $uploadUrl = str_replace('//file', '/'.$this->name.'/file', $uploadUrl);
        $this->url($uploadUrl);
    }
}
