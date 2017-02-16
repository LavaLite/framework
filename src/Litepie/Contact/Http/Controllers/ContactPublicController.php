<?php

namespace Litepie\Contact\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request as Request;
use Mail;
use Session;
class ContactPublicController extends BaseController
{
    // use ContactWorkflow;

    /**
     * Constructor.
     *
     * @param type \Litepie\Contact\Interfaces\ContactRepositoryInterface $contact
     *
     * @return type
     */
    public function __construct(ContactRepositoryInterface $contact)
    {
        $this->repository = $contact;
        parent::__construct();
    }

    /**
     * Show contact's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $this->theme->asset()->container('footer')->add('gmap','https://maps.googleapis.com/maps/api/js?key=AIzaSyCHM_z0TION52zp4ufPuVfedSAcjGOyW9M');
        
         $this->theme->asset()->container('footer')->usepath()->add('gmap3','packages/gmap3/js/gmap3.min.js');
        $contact = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->first();

        return $this->theme->of('contact::public.contact.index', compact('contact'))->render();
    }

    /**
     * Show contact.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $contact = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('contact::public.contact.show', compact('contact'))->render();
    }
     /**
     * Send mail
     *
     * @param string $slug
     *
     * @return response
     */
    public function sendMail(Request $request)
    {
        $data = $request->all();

        Mail::send('contact::public.emails.message', $data, function ($message) use($data){
            $message->from($data['email'], $data['name']);

            $message->to(config('litepie.contact.to'));
        });

        Session::flash('success', 'Success! Your message has been send successfully.');

        return redirect(trans_url('/contacts'));
    }
     /**
     * Send mail
     *
     * @param string $slug
     *
     * @return response
     */
    public function requestInfo(Request $request)
    {
        $data = $request->all();     
        Mail::send('contact::public.emails.message', $data, function ($message) use($data){
            $message->from($data['email'], $data['name']);

            $message->to($data['to']);
        });

        Session::flash('success', 'Success! Your Request has been send successfully.');

        return redirect()->back();
    }

}
