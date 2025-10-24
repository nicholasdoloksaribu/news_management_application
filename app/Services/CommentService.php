<?php 
namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $data){
        return $this->commentRepository->create($data);
    }

    public function updateComment($id, $data){
        return $this->commentRepository->update($id,$data);
    }

    public function showCommentById($id){
        return $this->commentRepository->show($id);
    }

    public function deleteComment($id){
        return $this->commentRepository->delete($id);
    }

}
?>