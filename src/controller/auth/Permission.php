<?php
namespace techadmin\controller\auth;

use techadmin\model\Permission as PermissionModel;
use techadmin\support\controller\AbstractController;
use think\Controller;
use think\Request;

class Permission extends AbstractController
{

    protected $permission;

    public function __construct(PermissionModel $permission)
    {
        parent::__construct();
        $this->permission = $permission;
    }

    public function index()
    {
        $permissions = $this->permission->paginate();
        return $this->fetch('auth/permission/index', [
            'permissions' => $permissions,
        ]);
    }

    public function edit(Request $request)
    {
        $permission = $this->permission->find($request->get('id', 0));
        return $this->fetch('auth/permission/edit', [
            'permission' => $permission,
        ]);
    }

    public function save(Request $request)
    {
        try {
            $data = $request->post();

            $res = $this->permission->isUpdate($request->get('id') > 0)->save($data);

        } catch (\Exception $e) {
            $this->error('保存失败');
        }
        $this->redirect('techadmin.auth.permission');
    }

    public function delete(Request $request)
    {
        try {
            $this->permission->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }
}
