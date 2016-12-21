<?php

namespace Litepie\Contact;

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
}
