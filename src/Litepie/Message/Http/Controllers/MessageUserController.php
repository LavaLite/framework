<?php

namespace Litepie\Message\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Message\Http\Requests\MessageRequest;
use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Message\Models\Message;
use User;

class MessageUserController extends BaseController
{
    /**
     * Initialize message controller.
     *
     * @param type MessageRepositoryInterface $message
     *
     * @return type
     */
    public function __construct(MessageRepositoryInterface $message)
    {
        $this->repository = $message;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MessageRequest $request)
    {
        $guard = $this->getGuardRoute();
        $this->theme->asset()->usepath()->add('select2-css', 'packages/select2/css/select2.min.css');
        $this->theme->asset()->container('footer')->usepath()->add('select2-js', 'packages/select2/js/select2.min.js');

        $this->repository->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageUserCriteria());
        $messages = $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
        })->paginate(2);

        $this->theme->prependTitle(trans('message::message.names'));

        return $this->theme->of('message::user.message.index', compact('messages','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Message $message
     *
     * @return Response
     */
    public function show(MessageRequest $request, Message $message)
    {
        Form::populate($message);
        $guard = $this->getGuardRoute();
        return $this->theme->of('message::user.message.show', compact('message','guard'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MessageRequest $request)
    {
        $guard = $this->getGuardRoute();
        $message = $this->repository->newInstance([]);
        Form::populate($message);
        return $this->theme->of('message::user.message.create', compact('message','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MessageRequest $request)
    {   
        try {
            $guard = $this->getGuardRoute();
            $mail_to = $request->get('mails');
            $status = $request->get('status');
            $sent = $request->all();
            $inbox = $request->all();
            $draft = $request->all();
            if(empty($mail_to)){
                return response()->json([
                    'message'     => trans('messages.success.updated', ['Module' => trans('message::message.name')]),
                    'code'        => 204,
                    'redirect'    => trans_url($guard.'/message/message/'),
                ], 201);
            }
            foreach ($mail_to as $user_id) {
                if($status == 'Draft')
                {
                    //draft
                    $draft['user_id'] = user_id('web');
                    $draft['user_type'] = user_type('web');
                    $draft['to'] = $user_id;
                    $draft['status'] = "Draft";
                    $message1 = $this->repository->create($draft);
                }
                else{
                     //sent
                    $sent['user_id'] = user_id('web');
                    $sent['user_type'] = user_type('web');
                    $sent['to'] = $user_id; 
                    $message = $this->repository->create($sent);

                    //inbox
                    $inbox['user_id'] =user_id('web');
                    $inbox['user_type'] = user_type('web');
                    $inbox['to'] = $user_id;
                    $inbox['status'] = "Inbox";
                    $message1 = $this->repository->create($inbox);
                }               
            }

            $sent_count = $this->repository->userUnreadCount('Sent', $guard);
            $inbox_count = $this->repository->userMsgCount('Inbox', $guard);
            $draft_count = $this->repository->userUnreadCount('Draft', $guard);

           return response()->json([
                'message'     => 'Your message has been sent',
                'code'        => 204,
                'redirect'    => trans_url('user/message/message'),
                'sent_count'  => $sent_count,
                'inbox_count' => $inbox_count,
                'draft_count' => $draft_count,
            ], 202);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Message $message
     *
     * @return Response
     */
    public function edit(MessageRequest $request, Message $message)
    {
        $guard = $this->getGuardRoute();
        Form::populate($message);
        return $this->theme->of('message::user.message.edit', compact('message','guard'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Message $message
     *
     * @return Response
     */
    public function update(MessageRequest $request, Message $message)
    { 
        try {
            $guard = $this->getGuardRoute();
            $this->repository->update($request->all(), $message->getRouteKey());
            $inbox_count = $this->repository->userMsgCount('Inbox',$guard);
            $sent_count = $this->repository->userUnreadCount('Sent',$guard);
            $draft_count = $this->repository->userUnreadCount('Draft',$guard);

            return response()->json([              
                'inbox_count' => $inbox_count,
                'sent_count' => $sent_count,
                'draft_count' => $draft_count,                
                'redirect' => trans_url('user/message/message'),
            ], 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }

    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MessageRequest $request, Message $message)
    {
        try {
            $guard = $this->getGuardRoute();
            if (!empty($request->get('arrayIds'))) {
                $ids = $request->get('arrayIds');
                $t = $this->repository->deleteMultiple($ids);
                return $t;
            } else {
                $t = $message->delete();
            }
            $trash_count = $this->repository->userUnreadCount('Trash',$guard);
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('message::message.name')]),
                'code'     => 202,
                'redirect' => trans_url('user/message/message/0'),
                'trash_count' => $trash_count, 
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('user/message/message/' . $message->getRouteKey()),
            ], 400);
        }
    }

    public function compose(MessageRequest $request)
    {
        $guard = $this->getGuardRoute();
        return view('message::user.message.compose',compact('guard'));
    }

    public function inbox(MessageRequest $request)
    {
        $messages['data'] = $this->repository->inbox();
        $guard = $this->getGuardRoute();
        return view('message::user.message.show', compact('messages','guard'));
    }

    public function search(MessageRequest $request, $slug = 'none', $status = 'Inbox')
    {
        $messages['data'] = $this->repository->search($status, $slug);        
        $guard = $this->getGuardRoute();
        $messages['caption'] = $status;
        return view('message::user.message.show', compact('messages','guard'));
    }

    public function updateStatus(MessageRequest $request, Message $message, $status)
    {     
        try {
            $guard = $this->getGuardRoute();
            $Ids = $request->get('data');
            $attributes['status'] = $status;
            $array['important'] = 'Yes';
            if ($Ids != null){
                foreach ($Ids as $key => $id){   
                    if($status  == 'Important'){  
                        $this->repository->update($array, $id);
                    }
                    else{
                        $this->repository->update($attributes, $id);
                    }
                }
            }            
            $inbox_count = $this->repository->userMsgCount('Inbox',$guard);
            $trash_count = $this->repository->userMsgCount('Trash',$guard);            
            $draft_count = $this->repository->userUnreadCount('Draft',$guard);
            $sent_count = $this->repository->userUnreadCount('Sent',$guard);

            return response()->json([ 
                'inbox_count' => $inbox_count,
                'trash_count' => $trash_count,
                'draft_count' =>     $draft_count,
                'sent_count' =>       $sent_count,
            ], 202);
        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    public function showMessage($status)
    {
        $guard = $this->getGuardRoute();
        $email = user('web')->email;
        $messages['data'] =  $this->repository->scopeQuery(function ($query) use ($status,$guard,$email) {
                return $query->with('user')
                ->where(function($query) use($status,$email){
                    if ($status == 'Inbox') {
                        $query->whereTo($email);
                    }else{
                        $query->whereUserId(user_id('web'))
                            ->whereUserType(user_type('web'));
                    }
                })
                ->whereStatus($status)
                ->orderBy('id', 'DESC');
            })->paginate(10);
        $messages['caption'] = $status;
        return view('message::user.message.show', compact('messages','guard'));
    }

    public function getDetails($caption, $id)
    {
        $guard = $this->getGuardRoute();
        $message = $this->repository->getDetails($id);
        $message['caption'] = $caption;
        return view('message::user.message.details', compact('message','guard'));
    }

    public function reply($id)
    {
        $guard = $this->getGuardRoute();
        $message = $this->repository->getDetails($id);
        return view('message::user.message.reply', compact('message','guard'));
    }

    public function forward($id)
    {
        $guard = $this->getGuardRoute();
        $message = $this->repository->getDetails($id);

        return view('message::user.message.forward', compact('message','guard'));
    }



    public function importantSubStatus(MessageRequest $request, Message $message)
    {  
        try {
            $id = $request->get('id');
            $sub = $request->get('important');
            $attributes['important'] = $sub;
            $this->repository->update($attributes, $id);
            return;
        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }


    public function starredSubStatus(MessageRequest $request, Message $message)
    {
        try {
            $id = $request->get('id');
            $sub = $request->get('star');
            $attributes['star'] = $sub;
            $this->repository->update($attributes, $id);
            return;
        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    public function starredMessages()
    {
        $guard = $this->getGuardRoute();
        $this->repository->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageUserCriteria());
        $messages['data'] = $this->repository->scopeQuery(function ($query) {
            return $query->with('user')->whereStar(1)->where('status','<>','Trash')->orderBy('id', 'DESC');
        })->paginate();
        $messages['caption'] = "Starred";
        return view('message::user.message.show', compact('messages','guard'));
    }

    /**
     *getting  Important message
     *@return
     */
    public function importantMessages()
    {
        $guard = $this->getGuardRoute();
        $this->repository->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageUserCriteria());
        $messages['data'] = $this->repository->scopeQuery(function ($query) {
            return $query->with('user')->whereImportant(1)->where('status','<>','Trash')->orderBy('id', 'DESC');
        })->paginate();
        $messages['caption'] = "Important";
        return view('message::user.message.show', compact('messages','guard'));
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteMultiple(MessageRequest $request, Message $message)
    {
        try {

            if (!empty($request->get('arrayIds'))) {
                $ids = $request->get('arrayIds');

                if (is_array($ids)) {
                    $t = $this->repository->deleteMultiple($ids);
                } else {
                    $t = $message->delete($ids);
                }

                return $t;
            }
            $trash_count = $this->repository->userUnreadCount('Trash',$guard);
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('message::message.name')]),
                'code'     => 202,
                'redirect' => trans_url('user/message/message/0'),
                'trash_count' => $trash_count, 
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('user/message/message/' . $message->getRouteKey()),
            ], 400);
        }

    }



}
