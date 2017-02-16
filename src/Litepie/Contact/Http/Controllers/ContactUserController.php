<?php

namespace Litepie\Contact\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Contact\Http\Requests\ContactRequest;
use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Litepie\Contact\Models\Contact;

class ContactUserController extends BaseController
{
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
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Contact\Repositories\Criteria\ContactUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ContactRequest $request)
    {
        $contacts = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('contact::contact.names'));

        return $this->theme->of('contact::user.contact.index', compact('contacts'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Contact $contact
     *
     * @return Response
     */
    public function show(ContactRequest $request, Contact $contact)
    {
        Form::populate($contact);

        return $this->theme->of('contact::user.contact.show', compact('contact'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ContactRequest $request)
    {

        $contact = $this->repository->newInstance([]);
        Form::populate($contact);

        $this->theme->prependTitle(trans('contact::contact.names'));
        return $this->theme->of('contact::user.contact.create', compact('contact'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ContactRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $contact = $this->repository->create($attributes);

            return redirect(trans_url('/user/contact/contact'))
                -> with('message', trans('messages.success.created', ['Module' => trans('contact::contact.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Contact $contact
     *
     * @return Response
     */
    public function edit(ContactRequest $request, Contact $contact)
    {

        Form::populate($contact);
        $this->theme->prependTitle(trans('contact::contact.names'));

        return $this->theme->of('contact::user.contact.edit', compact('contact'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Contact $contact
     *
     * @return Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {
            $this->repository->update($request->all(), $contact->getRouteKey());

            return redirect(trans_url('/user/contact/contact'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('contact::contact.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(ContactRequest $request, Contact $contact)
    {
        try {
            $this->repository->delete($contact->getRouteKey());
            return redirect(trans_url('/user/contact/contact'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('contact::contact.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
