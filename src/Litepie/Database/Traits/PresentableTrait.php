<?php

namespace Litepie\Database\Traits;

use Illuminate\Support\Arr;
use Litepie\Contracts\Database\Presenter;

/**
 * Class PresentableTrait.
 */
trait PresentableTrait
{
    /**
     * @var Presenter
     */
    protected $presenter = null;

    /**
     * @param \Litepie\Contracts\Database\Presenter $presenter
     *
     * @return $this
     */
    public function setPresenter(Presenter $presenter)
    {
        $this->presenter = $presenter;

        return $this;
    }

    /**
     * @return $this|mixed
     */
    public function presenter()
    {
        if ($this->hasPresenter()) {
            return $this->presenter->present($this);
        }

        return $this;
    }

    /**
     * @param $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function present($key, $default = null)
    {
        if ($this->hasPresenter()) {
            $data = $this->presenter()['data'];

            return Arr::get($data, $key, $default);
        }

        return $default;
    }

    /**
     * @return bool
     */
    protected function hasPresenter()
    {
        return isset($this->presenter) && $this->presenter instanceof Presenter;
    }
}
