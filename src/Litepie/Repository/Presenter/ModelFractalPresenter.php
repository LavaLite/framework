<?php

namespace Litepie\Repository\Presenter;

use Exception;
use Prettus\Repository\Transformer\ModelTransformer;

/**
 * Class ModelFractalPresenter.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class ModelFractalPresenter extends FractalPresenter
{
    /**
     * Transformer.
     *
     * @throws Exception
     *
     * @return ModelTransformer
     */
    public function getTransformer()
    {
        if (!class_exists('League\Fractal\Manager')) {
            throw new Exception("Package required. Please install: 'composer require league/fractal' (0.12.*)");
        }

        return new ModelTransformer();
    }
}
