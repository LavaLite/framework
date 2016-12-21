<?php

namespace Litepie\Page\Http\Controllers;

use App\Http\Controllers\UserWebController as UserController;
use Litepie\Page\Http\Requests\PageUserRequest;
use Litepie\Page\Interfaces\PageRepositoryInterface;

/**
 *
 */
class PageUserController extends UserController
{
    /**
     * Initialize page controller.
     *
     * @param type PageRepositoryInterface $page
     *
     * @return type
     */
    public function __construct(PageRepositoryInterface $page)
    {
        $this->model = $page;
        $this->model->pushCriteria(new \Litepie\Page\Repositories\Criteria\UserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PageUserRequest $request)
    {
        dd($this->model->paginate());
        $this->theme->prependTitle(trans('page::page.names') . ' :: ');

        return $this->theme->of('page::admin.page.index')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(PageUserRequest $request, $id)
    {
        $page = $this->model->find($id);

        if (empty($page)) {

            if ($request->wantsJson()) {
                return [];
            }

            return view('page::admin.page.new');
        }

        if ($request->wantsJson()) {
            return $page;
        }

        Form::populate($page);

        return view('page::admin.page.show', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PageUserRequest $request)
    {
        $page = $this->model->findOrNew(0);

        Form::populate($page);

        return view('page::admin.page.create', compact('page'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PageUserRequest $request)
    {
        try {
            $attributes = $request->all();
            $page       = $this->model->create($attributes);

            return $this->success(trans('messages.success.created', ['Module' => 'Page']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(PageUserRequest $request, $id)
    {
        $page = $this->model->find($id);

        Form::populate($page);

        return view('page::admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PageUserRequest $request, $id)
    {
        try {
            $attributes = $request->all();
            $page       = $this->model->update($attributes, $id);

            return $this->success(trans('messages.success.updated', ['Module' => 'Page']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(PageUserRequest $request, $id)
    {
        try {
            $this->model->delete($id);

            return $this->success(trans('messages.success.deleted', ['Module' => 'Page']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

    }

}
