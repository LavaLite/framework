<?php

namespace Litepie\Message\Http\Controllers\Api;

use App\Http\Controllers\PublicApiController as PublicController;
use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Message\Repositories\Presenter\MessageItemTransformer;

/**
 * Pubic API controller class.
 */
class MessagePublicController extends PublicController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Message\Interfaces\MessageRepositoryInterface $message
     *
     * @return type
     */
    public function __construct(MessageRepositoryInterface $message)
    {
        $this->repository = $message;
        parent::__construct();
    }

    /**
     * Show message's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $messages = $this->repository
            ->setPresenter('\\Litepie\\Message\\Repositories\\Presenter\\MessageListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $messages['code'] = 2000;
        return response()->json($messages)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show message.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $message = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($message)) {
            $message         = $this->itemPresenter($module, new MessageItemTransformer);
            $message['code'] = 2001;
            return response()->json($message)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
