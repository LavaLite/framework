<?php

namespace Litepie\Install\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Litepie\Http\Controllers\PublicController;
use Response;
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
        $this->response->title(trans('Welcome to lavalite instalation wizard.'));

        return $this->theme->layout('install')->of('install::index')->output();
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function getDb(Request $request)
    {
        $this->response->title('Database setup:: Installation (step 1 of 4)');

        return $this->theme->layout('install')->of('install::db')->output();
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
        $this->response->title('Publish files:: Installation (step 2 of 4)');

        return $this->theme->layout('install')->of('install::publish')->output();
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function postPublish(Request $request)
    {
        $attributes = Arr::only($request->all(), $this->tags);
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
        $this->response->title('User setup:: Installation (step 3 of 4)');

        return $this->theme->layout('install')->of('install::user')->output();
    }

    /**
     * Display the first configuration checking view.
     *
     * @return Response
     */
    public function postUser(Request $request)
    {
        $attributes = $request->all();
        $validator = Validator::make($attributes, [
            'user.*.email'    => 'required|email',
            'user.*.password' => 'min:6|max:30',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withCode(400)->withMessage($validator->errors());
        }

        $data = Arr::only($attributes['user'], ['superuser', 'admin', 'user', 'client']);
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
        $this->response->title('Finished:: Installation (step 1 of 4)');

        return $this->theme->layout('install')->of('install::finished')->output();
    }
}
