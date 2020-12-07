<?php

namespace Litepie\Install\Http\Controllers;

use Litepie\Http\Controllers\PublicController;
use RachidLaasri\LaravelInstaller\Helpers\RequirementsChecker;

class RequirementsController extends PublicController
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
        parent::__construct();
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return $this->response
            ->setMetaTitle(trans('install::messages.requirements.templateTitle'))
            ->layout('blank')
            ->view('install::requirements')
            ->data(compact('requirements', 'phpSupportInfo'))
            ->output();
    }
}
