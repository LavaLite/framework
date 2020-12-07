<?php

namespace Litepie\Install\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Litepie\Http\Controllers\PublicController;
use Litepie\Install\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;
use Validator;

class EnvironmentController extends PublicController
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
        parent::__construct();
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return $this->response
            ->setMetaTitle(trans('install::messages.environment.menu.templateTitle'))
            ->layout('blank')
            ->view('install::environment')
            ->output();
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return $this->response
            ->setMetaTitle(trans('install::messages.environment.wizard.templateTitle'))
            ->layout('blank')
            ->view('install::environment-wizard')
            ->data(compact('envConfig'))
            ->output();
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return $this->response
            ->setMetaTitle(trans('install::messages.environment.classic.templateTitle'))
            ->layout('blank')
            ->view('install::environment-classic')
            ->data(compact('envConfig'))
            ->output();
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param Request    $input
     * @param Redirector $redirect
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $input, Redirector $redirect)
    {
        $message = $this->EnvironmentManager->saveFileClassic($input);

        event(new EnvironmentSaved($input));

        return $redirect->route('LaravelInstaller::environmentClassic')
            ->with(['message' => $message]);
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request    $request
     * @param Redirector $redirect
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
        $rules = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => trans('install::messages.environment.wizard.form.name_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->response
                ->setMetaTitle(trans('install::messages.environment.classic.templateTitle'))
                ->layout('blank')
                ->view('install::environment-wizard')
                ->data(compact('errors', 'envConfig'))
                ->output();
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));

        return $redirect->route('LaravelInstaller::database')
            ->with(['results' => $results]);
    }
}
