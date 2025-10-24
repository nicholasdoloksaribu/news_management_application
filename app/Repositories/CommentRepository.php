<?php 
namespace App\Repositories;
use App\Models\Comment;

class CommentRepository {

    protected $commentRepository;

    public function create(array $data){
        return Comment::create($data);
    }

    public function update($id, $data){
        $comment = Comment::findorFail($id);
        $comment->update($data);
        return $comment;
    }

    public function show($id){
        return Comment::findorFail($id);
    }

    public function delete($id){
        $comment = Comment::findOrFail($id);
        $comment->isDeleted = true;
        $comment->save();
        return $comment;
    }
}

?>