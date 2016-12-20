<?php

namespace Litepie\Page\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Litepie\Page\Http\Requests\PageAdminWebRequest;
use Litepie\Page\Interfaces\PageRepositoryInterface;
use Litepie\Page\Models\Page;

/**
 * Admin web controller class.
 */
class PageAdminController extends AdminController
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
        parent::__construct();
        $this->repository = $page;

    }

    /**
     * Display a list of page.
     *
     * @return Response
     */
    public function index(PageAdminWebRequest $request)
    {

        $pageLimit = $request->input('pageLimit');

        if ($request->wantsJson()) {
            $pages = $this->repository
                ->setPresenter('\\Litepie\\Page\\Repositories\\Presenter\\PageListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $pages['recordsTotal']    = $pages['meta']['pagination']['total'];
            $pages['recordsFiltered'] = $pages['meta']['pagination']['total'];
            $pages['request']         = $request->all();
            return response()->json($pages, 200);

        }

        $this->theme->prependTitle(trans('page::page.names') . ' :: ');
        return $this->theme->of('page::admin.page.index')->render();
    }

    /**
     * Display page.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(PageAdminWebRequest $request, Page $page)
    {

        if (!$page->exists) {
            return response()->view('page::admin.page.new', compact($page));
        }

        Form::populate($page);
        return response()->view('page::admin.page.show', compact('page'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PageAdminWebRequest $request)
    {

        $page = $this->repository->newInstance([]);

        Form::populate($page);

        return response()->view('page::admin.page.create', compact('page'));

    }

    /**
     * Create new page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PageAdminWebRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $page                  = $this->repository->create($attributes);

            return response()->json(
                [
                    'message'  => trans('messages.success.updated', ['Module' => trans('page::page.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/page/page/' . $page->getRouteKey()),
                ],
                201);

        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'code'    => 400,
                ],
                400);
        }

    }

    /**
     * Show page for editing.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(PageAdminWebRequest $request, Page $page)
    {
        Form::populate($page);
        return response()->view('page::admin.page.edit', compact('page'));
    }

    /**
     * Update the page.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PageAdminWebRequest $request, Page $page)
    {
        try {

            $attributes = $request->all();

            $page->update($attributes);

            return response()->json(
                [
                    'message'  => trans('messages.success.updated', ['Module' => trans('page::page.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/page/page/' . $page->getRouteKey()),
                ],
                201);

        } catch (Exception $e) {

            return response()->json(
                [
                    'message'  => $e->getMessage(),
                    'code'     => 400,
                    'redirect' => trans_url('/admin/page/page/' . $page->getRouteKey()),
                ],
                400);

        }

    }

    /**
     * Remove the page.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(PageAdminWebRequest $request, Page $page)
    {

        try {

            $t = $page->delete();

            return response()->json(
                [
                    'message'  => trans('messages.success.deleted', ['Module' => trans('page::page.name')]),
                    'code'     => 202,
                    'redirect' => trans_url('/admin/page/page/0'),
                ],
                202);

        } catch (Exception $e) {

            return response()->json(
                [
                    'message'  => $e->getMessage(),
                    'code'     => 400,
                    'redirect' => trans_url('/admin/page/page/' . $page->getRouteKey()),
                ],
                400);
        }

    }

}
