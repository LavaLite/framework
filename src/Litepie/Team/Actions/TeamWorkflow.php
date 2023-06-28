<?php

namespace Litecms\Advert\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Litecms\Advert\Models\Advert;
use Litepie\Actions\Concerns\AsAction;

class AdvertWorkflow
{
    use AsAction;

    private $model;
    private $namespace = 'litecms.advert.advert';
    private $transition;
    protected $eventClass = \Litecms\Advert\Events\AdvertWorkflow::class;
    private $function;
    private $request;

    public function handle(string $transition, Advert $advert, array $request = [])
    {
        $this->model = $advert;
        $this->request = $request;
        $this->transition = $transition;
        $this->function = Str::camel($transition);
        $this->executeWorkflow();
        return $this->model;
    }

    public function activate()
    {
        $this->model->status = 'Active';
        $this->model->save();
        return $this->model;
    }

    public function deactivate()
    {
        $this->model->status = 'Inactive';
        $this->model->save();
        return $this->model;
    }

}
