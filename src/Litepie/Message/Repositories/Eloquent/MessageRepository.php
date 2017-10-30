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

    public function deleteMultiple($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function unread()
    {

        return $this->model->with('user')->whereStatus("Inbox")->where("read", "=", 0)->orderBy('id', 'DESC')->get();
    }

    public function messages()
    {
        $email = user(getenv('guard'))->email;

        return $this->model->with('user')->whereTo($email)->whereStatus('Sent')->orderBy('id', 'DESC')->take(10)->get();
    }

    public function msgCount($slug)
    {
        $email = user(getenv('guard'))->email;
        return $this->model->with('user')
            ->where(function($query) use($slug,$email){
                if ($slug == 'Inbox') {
                $query->whereTo($email);
                }
            })
            ->whereStatus($slug)
            ->whereUserId(user_id())
            ->whereUserType(user_type())
            ->where("read", "=", 0)
            ->orderBy('id', 'DESC')
            ->count();
    }

    public function specialCount($slug)
    {
        return $this->model->with('user')           
            ->where($slug ,'=' ,'Yes')
            ->whereUserId(user_id())
            ->whereUserType(user_type())
            ->where("read", "=", 0)
            ->orderBy('id', 'DESC')
            ->count();
    }

    public function userMsgCount($slug,$guard)
    {
        $email = user(getenv('guard'))->email;
        return  $this->model->with('user')
            ->where(function($query) use($slug,$email){
                if ($slug == 'Inbox') {
                return $query->whereTo($email);
                }
            })
            ->whereStatus($slug)
            ->whereUserId(user_id(getenv('guard')))
            ->whereUserType(user_type(getenv('guard')))
            ->where("read", "=", 0)
            ->orderBy('id', 'DESC')
            ->count();
    }

    public function userUnreadCount($slug,$guard)
    {
        $email = user(getenv('guard'))->email;
        return  $this->model->with('user')            
            ->whereStatus($slug)
            ->whereUserId(user_id(getenv('guard')))
            ->whereUserType(user_type(getenv('guard')))
            ->orderBy('id', 'DESC')
            ->count();
    }


    public function userSpecialCount($slug,$guard)
    {
        return $this->model->with('user')           
            ->where($slug ,'=' ,'Yes')
            ->whereUserId(user_id(getenv('guard')))
            ->whereUserType(user_type(getenv('guard')))
            ->orderBy('id', 'DESC')
            ->count();
    }

    public function search($status, $slug)
    {

        return $this->model->with('user')->where(function ($query) use ($slug) {
            if ($slug != 'none') {
                $query->orWhere('subject', 'LIKE', '%' . $slug . '%');
                $query->orWhere('message', 'LIKE', '%' . $slug . '%');
                $query->orWhere('created_at', 'LIKE', '%' . $slug . '%');
            }
        })
        ->whereStatus($status)
        ->orderBy('id', 'DESC')
        ->paginate(10);

    }

    public function findByStatus($status)
    {
        $email = user()->email;
        return $this->model
            ->with('user')
             ->where(function($query) use($status,$email){
                if ($status == 'Inbox') {
                $query->whereTo($email);
                }
            })
            ->whereStatus($status)
            ->whereUserId(user_id())
            ->whereUserType(user_type())
            ->orderBy('id', 'DESC')->paginate(10);
    }

    public function getStarredMessages()
    {
        return $this->model
            ->with('user')
            ->whereStar("Yes")
            ->where('status','<>',"Trash")
            ->whereUserId(user_id())
            ->orderBy('id', 'DESC')->paginate(10);
    }

    public function inbox()
    {
        $email = users()->email;

        return $this->model->with('user')->whereTo($email)->whereStatus('Sent')->orderBy('id', 'DESC')->paginate(10);
    }

    public function getDetails($id)
    {
        return $this->model->with('user')->whereId($id)->first();
    }

}
