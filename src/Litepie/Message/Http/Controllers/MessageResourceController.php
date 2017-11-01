<?php

namespace Litepie\Message\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
use Litepie\Message\Http\Requests\MessageRequest;
use Litepie\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Message\Models\Message;

/**
 * Admin web controller class.
 */
class MessageResourceController extends BaseController
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
        parent::__construct();
        $this->repository = $message;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class);
    }

    /**
     * Display a list of message.
     *
     * @return Response
     */
    public function index(MessageRequest $request)
    {

        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data      = $this->repository
                ->setPresenter(\Litepie\Message\Repositories\Presenter\MessageListPresenter::class)
                ->getDataTable($pageLimit);
            return $this->response
                ->data($data)
                ->output();
        }

        $messages = $this->repository->paginate();

        return $this->response->title(trans('message::message.names'))
            ->view('message::message.index', true)
            ->data(compact('messages'))
            ->output();

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

        if ($message->exists) {
            $view = 'message::message.show';
        } else {
            $view = 'message::message.new';
        }

        return $this->response->title(trans('app.view') . ' ' . trans('message::message.name'))
            ->data(compact('message'))
            ->view($view, true)
            ->output();
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
        return $this->response
            ->title(trans('app.new') . ' ' . trans('message::message.name'))
            ->view('message::message.compose', true)
            ->data(compact('message'))
            ->output();
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
            $status  = $request->get('status');
            $sent    = $request->all();
            $inbox   = $request->all();
            $draft   = $request->all();

            if (empty($mail_to)) {
                return response()->json([
                    'message'  => trans('messages.success.updated', ['Module' => trans('message::message.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/message/message/0'),
                ], 201);
            }

            foreach ($mail_to as $user_id) {

                if ($status == 'Draft') {
                    //draft
                    $draft['user_id']   = user_id('admin.web');
                    $draft['user_type'] = user_type('admin.web');
                    $draft['to']        = $user_id;
                    $draft['status']    = "Draft";
                    $message1           = $this->repository->create($draft);
                } else {
                    //sent
                    $sent['user_id']   = user_id('admin.web');
                    $sent['user_type'] = user_type('admin.web');
                    $sent['to']        = $user_id;
                    $message           = $this->repository->create($sent);

                    //inbox
                    $inbox['user_id']   = user_id('admin.web');
                    $inbox['user_type'] = user_type('admin.web');
                    $inbox['to']        = $user_id;
                    $inbox['status']    = "Inbox";
                    $message1           = $this->repository->create($inbox);
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
                'sent_count'  => $sent_count,
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
        return response()->view('message::message.edit', compact('message'));
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
                'code'        => 204,
                'redirect'    => trans_url('/admin/message/message/' . $message->getRouteKey()),
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
                $t   = $this->repository->deleteMultiple($ids);
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

    public function list(MessageRequest $request)
    {
        $messages['data'] = $this->repository
            ->pushCriteria(\Litepie\Message\Repositories\Criteria\MessageResourceCriteria::class)
            ->mailList();
        $messages['caption'] = $request->folder;
        return $this->response->title(trans('app.new') . ' ' . trans('message::message.name')) 
            ->view('message::message.show', true) 
            ->data(compact('messages'))
            ->output();
    }

    public function outbox(MessageRequest $request)
    {

        $messages['data'] = $this->repository
            ->pushCriteria(\Litepie\Message\Repositories\Criteria\MessageOutboxCriteria::class)
            ->mailList();

        return view('message::message.show', compact('messages'));
    }

    public function updateStatus(MessageRequest $request, Message $message, $status)
    {
        try {
            $Ids                  = $request->get('data');
            $attributes['status'] = $status;
            $array['important']   = 'Yes';

            if ($Ids != null) {

                foreach ($Ids as $key => $id) {

                    if ($status == 'Important') {
                        $this->repository->update($array, $id);
                    } else {

                        $this->repository->update($attributes, $id);
                    }

                }

            }

            $inbox_count      = $this->repository->msgCount('Inbox');
            $trash_count      = $this->repository->msgCount('Trash');
            $promotions_count = $this->repository->msgCount('Promotions');
            $important_count  = $this->repository->specialCount('important');
            $junk_count       = $this->repository->msgCount('Junk');
            $social_count     = $this->repository->msgCount('Social');
            $draft_count      = $this->repository->msgCount('Draft');
            $sent_count       = $this->repository->msgCount('Sent');
            $star_count       = $this->repository->specialCount('star');

            return response()->json([
                'inbox_count'      => $inbox_count,
                'trash_count'      => $trash_count,
                'promotions_count' => $promotions_count,
                'important_count'  => $important_count,
                'junk_count'       => $junk_count,
                'social_count'     => $social_count,
                'draft_count'      => $draft_count,
                'sent_count'       => $sent_count,
                'star_count'       => $star_count,
            ], 202);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    public function showMessage($status)
    {

        $messages['data']    = $this->repository->findByStatus($status);
        $messages['caption'] = $status;
        return view('message::message.show', compact('messages'));
    }

    public function getDetails($caption, $id)
    {
        $message            = $this->repository->getDetails($id);
        $message['caption'] = $caption;
        return view('message::message.details', compact('message'));
    }

    public function reply($id)
    {
        $message = $this->repository->getDetails($id);
        return view('message::message.reply', compact('message'));
    }

    public function forward($id)
    {
        $message = $this->repository->getDetails($id);

        return view('message::message.forward', compact('message'));
    }

    /*   public function compose()
    {
    return view('message::message.compose');
    }*/
    public function changeSubStatus(MessageRequest $request, Message $message)
    {
        try {
            $id                 = $request->get('id');
            $sub                = $request->get('star');
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
        return view('message::message.show', compact('messages'));
    }

    public function importantMessages()
    {
        $messages['data'] = $this->repository->scopeQuery(function ($query) {
            return $query->with('user')->whereImportant(1)->orderBy('id', 'DESC');
        })->paginate();
        $messages['caption'] = "Important";
        return view('message::message.show', compact('messages'));
    }

}
