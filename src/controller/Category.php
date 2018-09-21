<?php
namespace techadmin\controller;

use techadmin\model\Category as CategoryModel;
use techadmin\support\controller\AbstractController;
use think\Controller;
use think\Request;

class Category extends AbstractController
{

    protected $category;

    public function __construct(CategoryModel $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function index()
    {
        $categorys = $this->category->flatTree();
        return $this->fetch('category/index', [
            'categorys' => $categorys,
        ]);
    }

    public function edit(Request $request)
    {
        $category = $this->category->find($request->get('id', 0));

        $parents = $this->category->flatTree();

        return $this->fetch('category/edit', [
            'category' => $category,
            'parents'  => $parents,
        ]);
    }

    public function save(Request $request)
    {
        try {

            $data = $request->post();

            $res = $this->category->isUpdate($request->get('id') > 0)->save($data);

        } catch (\Exception $e) {
            $this->error('保存失败');
        }
        $this->redirect('techadmin.category');
    }

    public function delete(Request $request)
    {
        try {
            $this->category->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }
}
