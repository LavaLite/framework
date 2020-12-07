<?php

namespace Litepie\Install\Http\Controllers;

use Litepie\Http\Controllers\PublicController;
use RachidLaasri\LaravelInstaller\Helpers\PermissionsChecker;

class PermissionsController extends PublicController
{
    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
        parent::__construct();
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return $this->response
            ->setMetaTitle(trans('install::messages.requirements.templateTitle'))
            ->layout('blank')
            ->view('install::permissions')
            ->data(compact('permissions'))
            ->output();
    }
}
