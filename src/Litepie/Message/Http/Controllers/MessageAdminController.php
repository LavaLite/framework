<?php

namespace Litepie\Message\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Message\Http\Requests\MessageRequest;
use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Message\Models\Message;
use User;

/**
 * Admin web controller class.
 */
class MessageAdminController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public $guard = 'admin.web';

    /**
     * The home page route of admin.
     *
     * @var string
     */
    public $home = 'admin';

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
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        parent::__construct();
    }

    /**
     * Display a list of message.
     *
     * @return Response
     */
    public function index(MessageRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $this->theme->asset()->add('select2-css', 'packages/select2/css/select2.min.css');
        $this->theme->asset()->container('extra')->add('select2-js', 'packages/select2/js/select2.full.js');

        if ($request->wantsJson()) { 
            $messages = $this->repository
                ->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageAdminCriteria())
                ->setPresenter('\\Litepie\\Message\\Repositories\\Presenter\\MessageListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $messages['recordsTotal'] = $messages['meta']['pagination']['total'];
            $messages['recordsFiltered'] = $messages['meta']['pagination']['total'];
            $messages['request'] = $request->all();
            return response()->json($messages, 200);

        }

        $this->theme->prependTitle(trans('message::message.names') . ' :: ');
        return $this->theme->of('message::admin.message.index')->render();

    }

    /**
     * Display message.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return Response
     */
    public function show(MessageRequest $request, Message $message)
    {

        if (!$message->exists) {
            return response()->view('message::admin.message.new', compact('message'));
        }

        Form::populate($message);
        return response()->view('message::admin.message.show', compact('message', 'messages'));
    }

    /**
     * Show the form for creating a new message.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MessageRequest $request)
    {

        $message = $this->repository->newInstance([]);

        Form::populate($message);

        return response()->view('message::admin.message.create', compact('message'));

    }

    /**
     * Create new message.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MessageRequest $request)
    {
        try {

            $mail_to = $request->get('mails');
            $status = $request->get('status');
            $sent = $request->all();
            $inbox = $request->all();
            $draft = $request->all();
            if(empty($mail_to)){
                return response()->json([
                    'message'     => trans('messages.success.updated', ['Module' => trans('message::message.name')]),
                    'code'        => 204,
                    'redirect'    => trans_url('/admin/message/message/0'),
                ], 201);
            }

            foreach ($mail_to as $user_id) {
                if($status == 'Draft')
                {
                    //draft
                    $draft['user_id'] = user_id('admin.web');
                    $draft['user_type'] = user_type('admin.web');
                    $draft['to'] = $user_id;
                    $draft['status'] = "Draft";
                    $message1 = $this->repository->create($draft);
                }
                else{
                     //sent
                    $sent['user_id'] = user_id('admin.web');
                    $sent['user_type'] = user_type('admin.web');
                    $sent['to'] = $user_id; 
                    $message = $this->repository->create($sent);

                    //inbox
                    $inbox['user_id'] =user_id('admin.web');
                    $inbox['user_type'] = user_type('admin.web');
                    $inbox['to'] = $user_id;
                    $inbox['status'] = "Inbox";
                    $message1 = $this->repository->create($inbox);
                }
            }

            $inbox_count = $this->repository->msgCount('Inbox');
            $draft_count = $this->repository->msgCount('Draft');
            $sent_count  = $this->repository->msgCount('Sent');

            return response()->json([
                'message'     => trans('messages.success.updated', ['Module' => trans('message::message.name')]),
                'code'        => 204,
                'redirect'    => trans_url('/admin/message/message/status/Inbox'),
                'inbox_count' => $inbox_count,
                'draft_count' => $draft_count,
                'sent_count' => $sent_count,
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show message for editing.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return Response
     */
    public function edit(MessageRequest $request, Message $message)
    {
        Form::populate($message);
        return response()->view('message::admin.message.edit', compact('message'));
    }

    /**
     * Update the message.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return Response
     */
    public function update(MessageRequest $request, Message $message)
    {
        try {

            $attributes = $request->all();

            $message->update($attributes);
            $inbox_count = $this->repository->msgCount('Inbox');
            return response()->json([/*
                'message'  => trans('messages.success.updated', ['Module' => trans('message::message.name')]),*/
                'code'     => 204,
                'redirect' => trans_url('/admin/message/message/' . $message->getRouteKey()),
                'inbox_count' => $inbox_count,
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/message/message/' . $message->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the message.
     *
     * @param Model   $message
     *
     * @return Response
     */
    public function destroy(MessageRequest $request, Message $message)
    {
        try {

            if (!empty($request->get('arrayIds'))) {
                $ids = $request->get('arrayIds');
                $t = $this->repository->deleteMultiple($ids);
                return $t;
            } else {
                $t = $message->delete();
            }

            $this->repository->pushCriteria(new \Litepie\Message\Repositories\Criteria\MessageAdminCriteria());
            $inbox_count = $this->repository->msgCount('Inbox');
            $trash_count = $this->repository->msgCount('Trash');

            return response()->json([
                'message'     => trans('messages.success.deleted', ['Module' => trans('message::message.name')]),
                'code'        => 202,
                'redirect'    => trans_url('/admin/message/message/0'),
                'inbox_count' => $inbox_count,
                'trash_count' => $trash_count,
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/message/message/' . $message->getRouteKey()),
            ], 400);
        }

    }

    public function compose(MessageRequest $request)
    {
        return view('message::admin.message.compose');
    }

    public function inbox(MessageRequest $request)
    {
        $messages['data'] = $this->repository->inbox();

        return view('message::admin.message.show', compact('messages'));
    }

    public function search(MessageRequest $request, $slug = 'none', $status = 'Inbox')
    {

        $messages['data'] = $this->repository->search($status, $slug);

        return view('message::admin.message.search', compact('messages'));
    }

    public function updateStatus(MessageRequest $request, Message $message, $status)
    {
        try {
            $Ids = $request->get('data');
            $attributes['status'] = $status;
            $array['important'] = 'Yes';
            if ($Ids != null) {
                foreach ($Ids as $key => $id)
                {   
                    if($status  == 'Important')
                    {
                        $this->repository->update($array, $id);
                    }
                    else{

                        $this->repository->update($attributes, $id);
                    }
                }
            } 
            $inbox_count = $this->repository->msgCount('Inbox');
            $trash_count = $this->repository->msgCount('Trash');
            $promotions_count = $this->repository->msgCount('Promotions');
            $important_count = $this->repository->specialCount('important');
            $junk_count = $this->repository->msgCount('Junk');
            $social_count = $this->repository->msgCount('Social');
            $draft_count = $this->repository->msgCount('Draft');
            $sent_count = $this->repository->msgCount('Sent');
            $star_count = $this->repository->specialCount('star');

            return response()->json([ 
                'inbox_count' => $inbox_count,
                'trash_count' => $trash_count,
                'promotions_count' => $promotions_count,
                'important_count' =>  $important_count,
                'junk_count' =>       $junk_count,
                'social_count' =>     $social_count,
                'draft_count' =>     $draft_count,
                'sent_count' =>       $sent_count,
                'star_count' =>       $star_count,
            ], 202);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    public function showMessage($status)
    {

        $messages['data'] = $this->repository->findByStatus($status);
        $messages['caption'] = $status;
        return view('message::admin.message.show', compact('messages'));
    }

    public function getDetails($caption, $id)
    {
        $message = $this->repository->getDetails($id);
        $message['caption'] = $caption;
        return view('message::admin.message.details', compact('message'));
    }

    public function reply($id)
    {
        $message = $this->repository->getDetails($id);
        return view('message::admin.message.reply', compact('message'));
    }

    public function forward($id)
    {
        $message = $this->repository->getDetails($id);

        return view('message::admin.message.forward', compact('message'));
    }

    /*   public function compose()
    {
    return view('message::admin.message.compose');
    }*/
    public function changeSubStatus(MessageRequest $request, Message $message)
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
        $messages['data'] = $this->repository->scopeQuery(function ($query) {
            return $query->with('user')->whereStar(1)->orderBy('id', 'DESC');
        })->paginate();
        $messages['caption'] = "Starred";
        return view('message::admin.message.show', compact('messages'));
    }

    public function importantMessages()
    {
        $messages['data'] = $this->repository->scopeQuery(function ($query) {
            return $query->with('user')->whereImportant(1)->orderBy('id', 'DESC');
        })->paginate();
        $messages['caption'] = "Important";
        return view('message::admin.message.show', compact('messages'));
    }

}
