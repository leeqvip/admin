<?php
namespace techadmin\controller;

use techadmin\model\LinkBlock as LinkBlockModel;
use techadmin\support\AbstractController;
use think\Controller;
use think\Request;

class LinkBlock extends AbstractController
{

    protected $model;

    public function __construct(LinkBlockModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $blocks = $this->model->paginate();
        return $this->fetch('link/block/index', [
            'blocks' => $blocks,
        ]);
    }

    public function edit(Request $request)
    {
        $block = $this->model->find($request->get('id', 0));

        return $this->fetch('link/block/edit', [
            'block' => $block,
        ]);
    }

    public function save(Request $request)
    {
        try {
            $data = $request->post();

            $this->model->isUpdate($request->get('id') > 0)->save($data);

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->redirect('techadmin.link.block');
    }

    public function delete(Request $request)
    {
        try {
            $this->model->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }
}
