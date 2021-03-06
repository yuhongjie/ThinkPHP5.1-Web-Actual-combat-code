<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use think\facade\Session;
use app\user\model\User;

class Auth extends Controller
{
	protected $middleware = [
		'Auth' => [
			'except' => [
				'create',
				'save'
			]
		],
	];

	/**
	 * 显示资源列表
	 *
	 * @return \think\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * 显示创建资源表单页.
	 *
	 * @return \think\Response
	 */
	public function create()
	{
		return $this->fetch();
	}

	/**
	 * 保存新建的资源
	 *
	 * @param  \think\Request $request
	 * @return \think\Response
	 */
	public function save(Request $request)
	{
		$requestData = $request->post();
		$result = $this->validate($requestData, 'app\user\validate\Auth');
		if (true !== $result) {
			return redirect('user/auth/create')->with('validate', $result);
		} else {
			$user = User::create($requestData);
			Session::set('user', $user);
			return redirect('user/auth/read')->params(['id' => $user->id]);
		}
	}

	/**
	 * 显示指定的资源
	 *
	 * @param  int $id
	 * @return \think\Response
	 */
	public function read($id)
	{
		$user = User::find($id);
		$this->assign([
			'user' => $user,
		]);
		return $this->fetch();
	}

	/**
	 * 显示编辑资源表单页.
	 *
	 * @param  int $id
	 * @return \think\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * 保存更新的资源
	 *
	 * @param  \think\Request $request
	 * @param  int $id
	 * @return \think\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * 删除指定资源
	 *
	 * @param  int $id
	 * @return \think\Response
	 */
	public function delete($id)
	{
		//
	}
}
