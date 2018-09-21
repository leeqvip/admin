<?php
namespace techadmin\controller\auth;

use techadmin\service\auth\contract\Auth;
use techadmin\support\controller\AbstractController;
use think\Controller;
use think\Request;

class Passport extends AbstractController
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        parent::__construct();
        $this->auth = $auth;
    }

    public function user()
    {
        try {
            $user = $this->auth->user();
            return json(
                [
                    'admin_account' => $user->admin_account,
                    'login_at'      => $user->login_at,
                ]
            );
        } catch (\Exception $e) {
            return json([]);
        }
    }

    public function login()
    {
        return $this->fetch('auth/passport/login');
    }

    public function loginAuth(Request $request)
    {
        try {
            $this->auth->login($request);

            return redirect('techadmin.index');

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('techadmin.auth.passport.login');
    }
}
