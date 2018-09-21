<?php
namespace techadmin\controller;

use techadmin\model\Article as ArticleModel;
use techadmin\model\Category;
use techadmin\service\upload\contract\Factory as Uploader;
use techadmin\support\controller\AbstractController;
use think\Controller;
use think\Request;

class Article extends AbstractController
{

    protected $article;

    public function __construct(ArticleModel $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    public function index(Request $request, Category $category)
    {
        $data = $request->only(['category_id' => [], 'keywords' => '']);

        $articles = $this->article
            ->where('type', 1)
            ->when($data['keywords'], function ($query) use ($data) {
                $query->whereLike('title', '%' . $data['keywords'] . '%');
            })
            ->when($data['category_id'], function ($query) use ($data) {
                $query->whereIn('category_id', $data['category_id']);
            })
            ->order('id', 'desc')
            ->with('category')
            ->paginate([
                'query' => $data,
            ]);
        $parents = $category->flatTree();
        return $this->fetch('article/index', [
            'articles' => $articles,
            'parents'  => $parents,
        ]);
    }

    public function edit(Request $request, Category $category)
    {
        $article = $this->article->find($request->get('id', 0));
        $parents = $category->flatTree();
        return $this->fetch('article/edit', [
            'article' => $article,
            'parents' => $parents,
        ]);
    }

    public function save(Request $request, Uploader $uploader)
    {
        try {
            $data = $request->post();
            if ($image = $uploader->image('image')) {
                $data['image'] = $image->getUrlPath();
            }

            $this->article->isUpdate($request->get('id') > 0)->save($data);

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->redirect('techadmin.article');
    }

    public function delete(Request $request)
    {
        try {
            $this->article->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }
}
