<?php

namespace Litepie\Message;
use User;

class Message
{
    /**
     * $message object.
     */
    protected $message;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Message\Interfaces\MessageRepositoryInterface $message)
    {
        $this->message = $message;
    }

    /**
     * Returns count of message.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count($slug)
    {

        $email = user(getenv('guard'))->email;
        $this->message->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageUserCriteria());
        if($slug == 'Inbox'){
            return $this->message->scopeQuery(function ($query) use ($slug,$email) {
                return $query->with('user')->whereStatus($slug)->whereTo($email)->where("read", "=", 0)->orderBy('id', 'DESC');
            })->count();
        }

        return $this->message->scopeQuery(function ($query) use ($slug) {
                return $query->with('user')->whereStatus($slug)->where("read", "=", 0)->orderBy('id', 'DESC');
            })->count();
       
    }

    public function specialCount($slug)
    {

        $email = user(getenv('guard'))->email;
        $this->message->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageUserCriteria());
        return $this->message->scopeQuery(function ($query) use ($slug) {
                return $query->with('user')->where($slug,'=','Yes')->where("read", "=", 0)->orderBy('id', 'DESC');
            })->count();
       
    }

    public function adminMsgcount($slug)
    {
        return $this->message->msgCount($slug);
    }

    public function adminSpecialcount($slug)
    {
        return $this->message->specialCount($slug);
    }

    public function userMsgcount($slug, $guard)
    {
        return $this->message->userMsgCount($slug , $guard);
    }

    public function userUnreadCount($slug, $guard)
    {
        return $this->message->userUnreadCount($slug , $guard);
    }


    public function userSpecialcount($slug, $guard)
    {
        return $this->message->userSpecialCount($slug , $guard);
    }


    /**
     * Display message of the user.
     *
     * @return void
     *
     * @author
     **/
    public function display($view)
    {
        return view('message::admin.message.' . $view);
    }

    public function messages()
    {
        return $this->message->messages();
    }

    public function unreadCount()
    {
        return $this->message->unreadCount();
    }

    public function unread()
    {
        return $this->message->unread();
    }

    /**
     *Taking all Users mail id
     *@return array
     */
    public function getUsers()
    {
        $array = [];
        $model = getenv('auth.model');
        $users = $model::all();
        foreach ($users as $key => $user) {
            $array[$user->email] = $user->email;
        }
        
        return $array;
    }

}
