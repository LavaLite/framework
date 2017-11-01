<?php

namespace Litepie\Message;

use User;
use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Message\Repositories\Criteria\MessageResourceCriteria;

class Message
{
    /**
     * $message object.
     */
    protected $message;

    /**
     * Constructor.
     */
    public function __construct(MessageRepositoryInterface $message)
    {
        $this->repository = $message;
    }

    /**
     * Returns count of message.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count($folder, $label = null, $read = 1)
    {
        return $this->repository
            ->pushCriteria(new MessageResourceCriteria($folder, $label, $read))
            ->mailCount();
    }

    /**
     * Returns count of message with given label.
     *
     * @param array $filter
     *
     * @return int
     */
    public function list($folder, $label = null, $read = 1)
    {
        return $this->repository
            ->pushCriteria(new MessageResourceCriteria($folder, $label, $read))
            ->mailList();
    }

    /**
     * Display message of the user.
     *
     * @return void
     *
     * @author
     **/
    public function gadget($view)
    {
        return view('message::' . $view);
    }

    public function messages()
    {
        return $this->repository->messages();
    }

    public function unreadCount()
    {
        return $this->repository->unreadCount();
    }

    public function unreaded()
    {
        return $this->repository->unreaded();
    }

}
