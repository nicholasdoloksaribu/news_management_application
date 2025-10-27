<?php 
  namespace App\Repositories;
  use App\Models\Article;

  class ArticleRepository {
    

    public function find($id){
      return Article::findOrFail($id);
    }
    public function create(array $data){
       return Article::create($data);
    }
    
    public function update($id, $data){
      $article = Article::findOrFail($id);
      $article->update($data);
      return $article;
    }

    public function delete($id){
      $article = Article::findOrFail($id);
      $article->isDeleted = true;
      $article->save();
      return $article;
    }

    
  }

 ?>