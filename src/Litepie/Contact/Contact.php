<?php

namespace Litepie\Contact;

use User;

class Contact
{
    /**
     * $contact object.
     */
    protected $contact;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Contact\Interfaces\ContactRepositoryInterface $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Returns count of contact.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  $this->contact->count();
    }

    /**
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.contact.gadget', $count = 10)
    {

        if (User::hasRole('user')) {
            $this->contact->pushCriteria(new \Litepie\Litepie\Repositories\Criteria\ContactUserCriteria());
        }

        $contact = $this->contact->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('id', 'DESC')->take($count);
        })->all();

        return view('contact::' . $view, compact('contact'))->render();
    }
    /**
     * Returns field of contact.
     *
     * @param array $filter
     *
     * @return int
     */
    public function get($field)
    {
        $data=  $this->contact->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->first([$field]);
        return $data[$field];
    }
}
