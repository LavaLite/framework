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
    // use ContactWorkflow;
    /**
     * Initialize contact controller.
     *
     * @param type ContactRepositoryInterface $contact
     *
     * @return type
     */
    public function __construct(ContactRepositoryInterface $contact)
    {
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
        $this->theme->asset()->container('footer')->add('gmap','https://maps.googleapis.com/maps/api/js?key=AIzaSyCHM_z0TION52zp4ufPuVfedSAcjGOyW9M');
        
         $this->theme->asset()->container('footer')->usepath()->add('gmap3','packages/gmap3/js/gmap3.min.js');
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('contact::contact.names').' :: ');
        return $this->theme->of('contact::admin.contact.index')->render();
    }

    /**
     * Display a list of contact.
     *
     * @return Response
     */
    public function getJson(ContactRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $contacts  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Contact\\Repositories\\Presenter\\ContactListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $contacts['recordsTotal']    = $contacts['meta']['pagination']['total'];
        $contacts['recordsFiltered'] = $contacts['meta']['pagination']['total'];
        $contacts['request']         = $request->all();
        return response()->json($contacts, 200);

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
