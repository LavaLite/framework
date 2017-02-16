<?php

namespace Litepie\Blog\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class BlogListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogListTransformer();
    }
}