<?php

namespace Litepie\Message\Http\Controllers;

use App\Http\Controllers\PublicWebController as PublicController;
use Litepie\Message\Interfaces\MessageRepositoryInterface;

class MessageController extends PublicController
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
        $messages = $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
        })->paginate();

        return $this->theme->of('message::public.message.index', compact('messages'))->render();
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
        $message = $this->repository->scopeQuery(function ($query) use ($slug) {
            return $query->orderBy('id', 'DESC')
                ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('message::public.message.show', compact('message'))->render();
    }
}
