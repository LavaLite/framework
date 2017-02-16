<?php

namespace Litepie\Blog\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class BlogCategoryListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogCategoryListTransformer();
    }
}