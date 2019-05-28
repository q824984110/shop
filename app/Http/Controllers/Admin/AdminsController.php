<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admins;
use App\Model\Admin\Role;
use Hash;
use App\Http\Requests\FormRequest;
use DB;
class AdminsController extends Controller
{
    /**
     * 给用户添加角色的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function user_role(Request $request)
    {
        //把用户的信息显示出来
        $uid = $request->id;

        $us = Admins::find($uid); 

        //获取所有的角色
        $roles = Role::all();

        //查找当前登录的管理员 具有哪些角色
        //多对多
        $ur = $us->user_role()->get();

        $urr = [];
        foreach($ur as $k => $v){

            $urr[] = $v->id;
        }

        return view('admin.admins.userrole',[
            'title'=>'用户角色添加页面',
            'us'=>$us,
            'roles'=>$roles,
            'urr'=>$urr

        ]);
    }

    /**
     * 处理用户和角色方法
     *
     * @return \Illuminate\Http\Response
     */
    public function do_user_role(Request $request)
    {
        //获取用户的id
        $uid = $request->id;


        //根据用户的id把user_role里面的相关信息 进行删除
        //就是删除之前的角色
        DB::table('user_role')->where('userid',$uid)->delete();

        //获取角色的id
        $rid = $request->roleid;

        //遍历角色
        $ur = [];
        foreach($rid as $k => $v){
            $arr = [];
            $arr['userid'] =  $uid;
            $arr['roleid'] = $v;

            $ur[] = $arr;

            // array_push()
        }

        //往数据表user_role里面添加数据
        $data = DB::table('user_role')->insert($ur);

        if($data){

            return redirect('/admin/admins')->with('success','添加角色成功');
        } else {

            return back();
        }


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rs = Admins::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('username');
                $email = $request->input('email');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 10));


            
        return view('admin/admins/index',[
         'title'=>'查看管理员列表',
         'rs'=>$rs,
         'request'=>$request

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin/admins/create',[
            'title'=>'后台的管理员添加页面'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $rs = $request->except('_token','repassword','profile');

        $this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',
            'name' => 'required|regex:/^[\x80-\xff_A-Za-z0-9]',
            'password' => 'required|regex:/^\S{8,16}$/',
            'profile' => 'required',
            'repassword'=>'same:password',
            'email'=> 'email',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        ],[
            'username.required' => '账号不能为空',
            'username.regex' => '账号格式不正确',
            'name.required' => '姓名不能为空',
            'name.regex' => '姓名格式不正确',
            'profile.required' => '必须选择一张图片当做头像',
            'username.unique' => '账号已经存在',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'repassword.same'=>'两次密码不一致',
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ]);

        if($request->hasFile('profile')){

            $file = $request->file('profile');

            $name = 'img_'.rand(1111,9999).time();

            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

        }

        unset($rs['repassword']);

         $rs['password'] = Hash::make($request->password);

         $data = DB::table('admin')->insert($rs);

        if($data){

            return redirect('/admin/admins');

        } else {

            return back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = Admins::find($id);
        return view('admin/admins/edit',[
            'title'=>'修改管理员信息',
            'rs'=>$rs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rs = $request->except('_token','_method');

        $this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',
            'name' => 'required|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'profile' => 'required',      
            'email'=> 'email',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        ],[
            'username.required' => '账号不能为空',
            'username.regex' => '账号格式不正确',
            'name.required' => '姓名不能为空',
            'name.regex' => '姓名格式不正确',
            'profile.required' => '必须选择一张图片当做头像',
            'username.unique' => '账号已经存在',  
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ]);
        //处理头像
        if($request->hasFile('profile')){

            //获取图片上传的信息
            $file = $request->file('profile');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

        }

        //修改数据
        $data = Admins::where('id',$id)->update($rs);

        if($data){

            return redirect('/admin/admins')->with('success','修改成功');
        } else {

            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Admins::destroy($id);

        if($data){

            return redirect('/admin/admins')->with('success','删除成功');

        } else {

            return back()->with('error','删除失败');

        }
    
    }
}
