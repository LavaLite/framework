<?php

namespace Litepie\Contact\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class ContactListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Contact\Models\Contact $contact)
    {
        return [
            'id'                => $contact->getRouteKey(),
            'name'              => $contact->name,
            'phone'             => $contact->phone,
            'mobile'            => $contact->mobile,
            'email'             => $contact->email,
            'default'           => $contact->default,
            'website'           => $contact->website,
            'details'           => $contact->details,
            'address_line1'     => $contact->address_line1,
            'address_line2'     => $contact->address_line2,
            'street'            => $contact->street,
            'city'              => $contact->city,
            'country'           => $contact->country,
            'pin_code'          => $contact->pin_code,
            'lat'               => $contact->lat,
            'lng'               => $contact->lng,
            'status'            => $contact->status,
            'status'            => trans('app.'.$contact->status),
            'created_at'        => format_date($contact->created_at),
            'updated_at'        => format_date($contact->updated_at),
        ];
    }
}