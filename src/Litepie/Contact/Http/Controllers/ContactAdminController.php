<?php

namespace Litepie\Contact\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Contact\Http\Requests\ContactRequest;
use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Litepie\Contact\Models\Contact;

/**
 * Admin web controller class.
 */
class ContactAdminController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public $guard = 'admin.web';

    
    /**
     * Initialize contact controller.
     *
     * @param type ContactRepositoryInterface $contact
     *
     * @return type
     */
    public $home = 'admin';

    public function __construct(ContactRepositoryInterface $contact)
    {
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        $this->repository = $contact;
        parent::__construct();
    }

    /**
     * Display a list of contact.
     *
     * @return Response
     */
    public function index(ContactRequest $request)
    {
        $pageLimit = $request->input('pageLimit');
        if ($request->wantsJson()) {
            $contacts  = $this->repository
                ->setPresenter('\\Litepie\\Contact\\Repositories\\Presenter\\ContactListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $contacts['recordsTotal']    = $contacts['meta']['pagination']['total'];
            $contacts['recordsFiltered'] = $contacts['meta']['pagination']['total'];
            $contacts['request']         = $request->all();
            return response()->json($contacts, 200);

        }

        $this   ->theme->prependTitle(trans('contact::contact.names').' :: ');
        return $this->theme->of('contact::admin.contact.index')->render();
    }

    /**
     * Display contact.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return Response
     */
    public function show(ContactRequest $request, Contact $contact)
    {
        if (!$contact->exists) {
            return response()->view('contact::admin.contact.new', compact('contact'));
        }

        Form::populate($contact);
        return response()->view('contact::admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for creating a new contact.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ContactRequest $request)
    {

        $contact = $this->repository->newInstance([]);

        Form::populate($contact);

        return response()->view('contact::admin.contact.create', compact('contact'));

    }

    /**
     * Create new contact.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ContactRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $attributes['user_type'] = user_type();
            $contact          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('contact::contact.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/contact/contact/'.$contact->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show contact for editing.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return Response
     */
    public function edit(ContactRequest $request, Contact $contact)
    {
        Form::populate($contact);
        return  response()->view('contact::admin.contact.edit', compact('contact'));
    }

    /**
     * Update the contact.
     *
     * @param Request $request
     * @param Model   $contact
     *
     * @return Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {

            $attributes = $request->all();

            $contact->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('contact::contact.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/contact/contact/'.$contact->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/contact/contact/'.$contact->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the contact.
     *
     * @param Model   $contact
     *
     * @return Response
     */
    public function destroy(ContactRequest $request, Contact $contact)
    {

        try {

            $t = $contact->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('contact::contact.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/contact/contact/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/contact/contact/'.$contact->getRouteKey()),
            ], 400);
        }
    }
}
