<?php
namespace Litepie\Database\Presenter;

use Exception;
use Litepie\Database\Transformer\ModelTransformer;

/**
 * Class ModelFractalPresenter
 * @package Litepie\Database\Presenter
 */
class ModelFractalPresenter extends FractalPresenter {

    /**
     * Transformer
     *
     * @return ModelTransformer
     * @throws Exception
     */
    public function getTransformer()
    {
        if ( !class_exists('League\Fractal\Manager') ){
            throw new Exception("Package required. Please install: 'composer require league/fractal' (0.12.*)");
        }

        return new ModelTransformer();
    }
}