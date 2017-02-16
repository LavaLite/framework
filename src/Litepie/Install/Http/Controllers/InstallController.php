<?php

namespace Litepie\Install\Http\Controllers;

use App\Http\Controllers\PublicController as PublicController;
use Form;
use Response;
use Illuminate\Http\Request;
use Litepie\Install\Http\Controllers\InstallCommands;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;
use Validator;

class InstallController extends PublicController
{
    use InstallCommands;


    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $this->theme->prependTitle(trans('Welcome to lavalite instalation wizard.'));


        return $this->theme->layout('install')->of('install::index')->render();
    }


    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function getDb(Request $request)
    {

        $this->theme->prependTitle('Database setup:: Installation (step 1 of 4)');
        return $this->theme->layout('install')->of('install::db')->render();
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function postDb(Request $request, Filesystem $finder)
    {
        $attributes = $request->all();
        $this->write($finder, $attributes['database'], $attributes['user'], $attributes['password'], $attributes['host']);
        $this->dbMigrate();
        $this->dbSeed();
        //$this->setAppKey();

        return redirect('install/publish');
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function getPublish(Request $request)
    {

        $this->theme->prependTitle('Publish files:: Installation (step 2 of 4)');


        return $this->theme->layout('install')->of('install::publish')->render();
    }


    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function postPublish(Request $request)
    {
        $attributes = array_only($request->all(), $this->tags);
        foreach ($attributes as $key => $value) {
            $this->publish($key);
        }

        return redirect('install/user');
    }


    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function getUser(Request $request)
    {
        $this->theme->prependTitle('User setup:: Installation (step 3 of 4)');

        return $this->theme->layout('install')->of('install::user')->render();
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function postUser(Request $request)
    {
        $attributes     = $request->all();
        $validator      = Validator::make($attributes, [
                                'user.*.email' => 'required|email',
                                'user.*.password' => 'min:6|max:30'
                            ]);

        if ($validator->fails()) {
            return redirect()->back()->withCode(400)->withMessage($validator->errors());
        }
        
        $data = array_only($attributes['user'], ['superuser', 'admin', 'user', 'client']);
        foreach ($data as $key => $value) {
            $this->setCredentials($value, $this->model[$key]);
        }

        return redirect('install/finished');
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function finished(Request $request)
    {
        $this->theme->prependTitle('Finished:: Installation (step 1 of 4)');

        return $this->theme->layout('install')->of('install::finished')->render();
    }




}
