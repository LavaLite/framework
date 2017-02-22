<?php

namespace Litepie\Blog;

use User;

class Blog
{
    /**
     * $blog object.
     */
    protected $blog;
    /**
     * $category object.
     */
    protected $category;

    /**
     * Constructor.
     */
    public function __construct(
        \Litepie\Blog\Interfaces\BlogRepositoryInterface         $blog,
        \Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface $category
    ) {
        $this->blog     = $blog;
        $this->category = $category;
    }

/**
 * Returns count of blog or category.
 *
 * @param array $filter
 *
 * @return int
 */
    public function count($module = 'blog')
    {

        if (User::hasRole('user')) {
            $this->blog->pushCriteria(new \Litepie\Blog\Repositories\Criteria\BlogUserCriteria());

        }

        if ($module == 'blog') {
            return $this->blog
                ->scopeQuery(function ($query) {
                    return $query;
                })
                ->count();
        }

        if ($module == 'category') {
            return $this->category
                ->scopeQuery(function ($query) {
                    return $query;
                })->count();
        }

        return $this->blog
            ->pushCriteria(new \Litepie\Blog\Repositories\Criteria\BlogPublicCriteria())
            ->scopeQuery(function ($query) {
                return $query;
            })->count();
    }

    /**
     * take latest blogs for public side
     * @param type $count
     * @param type|string $view
     * @return type
     */

    public function latest($count = 3, $view = 'public.blog.latest')
    {
        $blog = $this->blog->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('posted_on', 'DESC')->take($count);
        })->all();
        return view('blog::' . $view, compact('blog'))->render();
    }

    /**
     * take blog category
     * @return array
     */

    public function selectCategories()
    {
        $temp       = [];
        $categories = $this->category->scopeQuery(function ($query) {
            return $query->orderBy('name', 'ASC');
        })->all();

        foreach ($categories as $key => $value) {
            $temp[$value->id] = ucfirst($value->name);
        }

        return $temp;
    }

    /**
     * count of blogs by category
     * @param type $id
     * @return type
     */

    public function countBlogsCategory($id)
    {

        return $this->blog->countBlogsCategory($id);
    }

    /**
     * get categories for public side
     * @param type|string $view
     * @return type
     */
    public function getCategories($view = 'public.blog.category')
    {

        $blogs = $this->category->scopeQuery(function ($query) {
            return $query->whereStatus('Show')->orderBy('id', 'DESC');
        })->all();

        return view('blog::' . $view, compact('blogs'))->render();
    }

}
