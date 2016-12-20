<?php

namespace Litepie\Block\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Block\Interfaces\BlockRepositoryInterface;
use Litepie\Block\Interfaces\CategoryRepositoryInterface;

class BlockController extends BaseController
{

    /**
     * Constructor.
     *
     * @param type \Litepie\Block\Interfaces\BlockRepositoryInterface $block
     *
     * @return type
     */
    public function __construct(BlockRepositoryInterface $block, CategoryRepositoryInterface $category)
    {
        $this->middleware('web');
        $this->setupTheme(config('theme.themes.public.theme'), config('theme.themes.public.layout'));
        $this->repository = $block;
        $this->category = $category;
        parent::__construct();
    }

    /**
     * Show block's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {

        $blocks = $this->repository
            ->pushCriteria(new \Litepie\Block\Repositories\Criteria\BlockPublicCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();
        $categories = $this->category->pushCriteria(new \Litepie\Block\Repositories\Criteria\CategoryPublicCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('name', 'Asc');
            })->all();

        return $this->theme->of('block::public.block.index', compact('blocks', 'categories'))->render();
    }

    /**
     * Show block.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $block = $this->repository->scopeQuery(function ($query) use ($slug) {
            return $query->whereSlug($slug);
        })->first(['*']);
        $categories = $this->category->pushCriteria(new \Litepie\Block\Repositories\Criteria\CategoryPublicCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('name', 'Asc');
            })->all();

        return $this->theme->of('block::public.block.show', compact('block', 'categories'))->render();
    }

    /**
     * show category
     * @param type $category
     * @return type
     */
    protected function category($slug)
    {

        $category = $this->category
            ->scopeQuery(function ($query) use ($slug) {
                return $query->with('block')->orderBy('name', 'Asc')->whereSlug($slug);
            })->first(['*']);
        $categories = $this->category->pushCriteria(new \Litepie\Block\Repositories\Criteria\CategoryPublicCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('name', 'Asc');
            })->all();
        return $this->theme->of('block::public.block.category', compact('category', 'categories'))->render();
    }
}
