<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Profile\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Services\Profile\Comments\CommentsService;
use Auth;


/**
 * Class CommentsController
 * @package App\Http\Controllers\Admin
 */
class CommentsController extends Controller
{

    /**
     * @var CommentsService
     */
    private $commentsService;


    /**
     * CommentsController constructor.
     * @param CommentsService $commentsService
     */
    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }


    /**
     * Возвращает список комментариев в формате json с пагинацией
     *
     * @return string
     */
    public function index()
    {
        $userId = Auth::user()->id;
        return $this->commentsService->getCommentsList($userId)->toJson();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getComment(int $id)
    {
        return $this->commentsService->getCommentById($id)->toJson();
    }


    /**
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->getData();
        $result = $this->commentsService->updateCommentData($comment, $data);
        return $result ? response('Success', 200) : response('Unsuccess', 400);
    }
}
