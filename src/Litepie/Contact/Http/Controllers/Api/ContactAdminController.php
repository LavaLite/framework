<?php

namespace Litepie\Contact\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Contact\Http\Requests\ContactAdminApiRequest;
use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Litepie\Contact\Models\Contact;

/**
 * Admin API controller class.
 */
class ContactAdminApiController extends BaseController
{
    

    /**
     * Initialize contact controller.
     *
     * @param type ContactRepositoryInterface $contact
     *
     * @return type
     */
    protected $guard = 'admin.api';

    public function __construct(ContactRepositoryInterface $contact)
    {
        $this->middleware('api');
        $this->middleware('jwt.auth:admin.api');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        $this->repository = $contact;
        parent::__construct();
    }


    /**
     * Display a list of contact.
     *
     * @return json
     */
    public function index(ContactAdminApiRequest $request)
    {
        $contacts  = $this->repository
            ->setPresenter('\\Litepie\\Contact\\Repositories\\Presenter\\ContactListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $contacts['code'] = 2000;
        return response()->json($contacts) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display contact.
     *
     * @param Request $request
     * @param Model   Contact
     *
     * @return Json
     */
    public function show(ContactAdminApiRequest $request, Contact $contact)
    {
        $contact         = $contact->presenter();
        $contact['code'] = 2001;
        return response()->json($contact)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new contact.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(ContactAdminApiRequest $request, Contact $contact)
    {
        $contact         = $contact->presenter();
        $contact['code'] = 2002;
        return response()->json($contact)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new contact.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(ContactAdminApiRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $attributes['user_type'] = user_type();
            $contact          = $this->repository->create($attributes);
            $contact          = $contact->presenter();
            $contact['code']  = 2004;

            return response()->json($contact)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }
    }

    /**
     * Show contact for editing.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return json
     */
    public function edit(ContactAdminApiRequest $request, Contact $contact)
    {
        $contact         = $contact->presenter();
        $contact['code'] = 2003;
        return response()-> json($contact)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the contact.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return json
     */
    public function update(ContactAdminApiRequest $request, Contact $contact)
    {
        try {

            $attributes = $request->all();

            $contact->update($attributes);
            $contact         = $contact->presenter();
            $contact['code'] = 2005;

            return response()->json($contact)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the contact.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return json
     */
    public function destroy(ContactAdminApiRequest $request, Contact $contact)
    {

        try {

            $t = $contact->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('contact::contact.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
