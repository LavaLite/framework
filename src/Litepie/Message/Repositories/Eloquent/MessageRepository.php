<?php

namespace Litepie\Message\Repositories\Eloquent;

use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;
use User;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->fieldSearchable = config('litepie.message.message.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.message.message.model');
    }

    public function unreaded($count = 10, $folder = 'Inbox')
    {
        return $this->model
            ->with('user')
            ->whereFolder($folder)
            ->whereReaded('No')
            ->orderBy('id', 'DESC')
            ->take($count);
    }

    public function countUnreaded($folder = 'Inbox')
    {
        return $this->model
            ->whereFolder($folder)
            ->whereReaded('No')
            ->count();
    }

    public function mailList()
    {
        return $this ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function mailCount()
    {
        return $this->count();
    }

    public function withLabel($label)
    {
        return $this->model
            ->with('user')
            ->where('labels', 'LIKE', "%$label%")
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function countWithLabel($label)
    {
        return $this->model
            ->where('labels', 'LIKE', "%$label%")
            ->count();
    }

    public function starred()
    {
        return $this->model
            ->with('user')
            ->whereStarred("Yes")
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function countStarred()
    {
        return $this->model
            ->whereStarred("Yes")
            ->count();
    }

    public function message($id)
    {
        return $this->model
            ->with('user')
            ->whereId($id)
            ->first();
    }

}
