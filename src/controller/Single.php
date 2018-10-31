<?php

namespace techadmin\controller;

use techadmin\model\Category;
use techadmin\model\Single as SingleModel;
use techadmin\service\upload\contract\Factory as Uploader;
use techadmin\support\controller\AbstractController;
use think\Request;

class Single extends AbstractController
{
    protected $single;

    public function __construct(SingleModel $single)
    {
        parent::__construct();
        $this->single = $single;
    }

    public function index(Request $request, Category $category)
    {
        $data = $request->only(['category_id' => [], 'keywords' => '']);

        $articles = $this->single
            ->where('type', 1)
            ->when($data['keywords'], function ($query) use ($data) {
                $query->whereLike('title', '%'.$data['keywords'].'%');
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

        return $this->fetch('single/index', [
            'articles' => $articles,
            'parents' => $parents,
        ]);
    }

    public function edit(Request $request, Category $category)
    {
        $article = $this->single->find($request->get('id', 0));
        $parents = $category->flatTree();

        return $this->fetch('single/edit', [
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

            $hasBinding = $this->single->where('category_id', $data['category_id'])->when($data['id'], function ($query) use ($data) {
                $query->where('id', '<>', $data['id']);
            })->count();

            if ($hasBinding) {
                throw new \Exception('该栏目已经绑定其他单页');
            }

            $this->single->isUpdate($request->get('id') > 0)->save($data);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->redirect('techadmin.single');
    }

    public function delete(Request $request)
    {
        try {
            $this->single->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
