<?php
namespace Litepie\Actions;

use Illuminate\Support\Facades\Auth;

class Action
{
    protected $name = null;
    protected $roles = null;
    protected $type = [];
    protected $meta = [];
    protected $form = [];

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function roles(array $roles = [])
    {
        if (!empty($roles)) {
            $this->roles = $roles;
        }
        return $this->roles;
    }

    public function name(string $name = null): string
    {
        if (!empty($name)) {
            $this->name = $name;
        }
        return $this->name;
    }

    public function meta(string $meta = null): string
    {
        if (!empty($meta)) {
            $this->meta = $meta;
        }
        return $this->meta;
    }

    public function type(array $types = [])
    {
        if (is_array($types)) {
            foreach ($types as $type) {
                $this->type[] = ActionType::tryFrom($type);
            }
        }
        return $this->type;
    }

    public function form(array $form = null)
    {
        if (!empty($form)) {
            return $this->form = $form;
        }

        if (empty($this->form)) {
            return null;
        }
        foreach ($this->form as $key => $val) {
            $this->form[$key]['label'] = trans($val['label']);
            $this->form[$key]['placeholder'] = trans($val['placeholder']);
        }

        return $this->form;
    }

    public function authorized()
    {
        if (!isset($this->roles)) {
            return true;
        }

        if (isset($this->roles['permission'])
            && Auth::user()->can($this->roles['permission'])) {
            return true;
        }

        if (isset($this->roles['user'])
            && Auth::user()->hasRole($this->roles['user'])) {
            return true;
        }

        if (isset($this->roles['team']) && method_exists(Auth::user(), 'teams')
            && Auth::user()->teams()?->hasRole($this->roles['team'])) {
            return true;
        }

        return false;
    }

    public function isType($type = ActionType::List)
    {
        if (in_array($type, $this->type())) {
            return true;
        }

        return false;
    }

}
