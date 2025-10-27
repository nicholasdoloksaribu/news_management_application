<?php 

namespace App\Services;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Str;

class ArticleService {
    protected $articleRepository;
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function createArticle(array $data, $image = null){
        if($image){
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('article', $filename, 'public');
            $data['image'] = $path;
        }
        return $this->articleRepository->create($data);
    }

    public function updateArticle($id, $data){

        $article = $this->articleRepository->find($id);

        if (isset($data['image'])) {
            # code...
            if($article->image && Storage::disk('public')->exists($article->image)){
                Storage::disk('public')->delete($article->image);
            }

            $imagePath = $data['image']->store('article', 'public');

            $data['image'] = $imagePath;
        }
        return $this->articleRepository->update($id,$data);
    }

    public function deleteArticle($id){
        return $this->articleRepository->delete($id);
    }
    
    
    
}

?>