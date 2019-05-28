<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;

use App\Http\Requests\FormRequest;

use App\Model\Admin\User;
use App\Model\Admin\Role;

use DB;

class UserController extends Controller
{
    public function user_role(Request $request)
    {
        //把用户的信息显示出来
        $uid = $request->id;

        $us = User::find($uid); 

        //获取所有的角色
        $roles = Role::all();

        //查找当前登录的管理员 具有哪些角色
        //多对多
        $ur = $us->user_role()->get();

        $urr = [];
        foreach($ur as $k => $v){

            $urr[] = $v->id;
        }

        return view('admin.user.userrole',[
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

            return redirect('/admin/user')->with('success','添加角色成功');
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
       $rs = User::orderBy('id','asc')
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


        $data = DB::table('user')     
                    ->join('user_info', function($join)
                    {
                        $join->on('user.id', '=', 'user_info.uid');
                    })->select()
                        ->orderBy('user.id', 'desc')
                        ->get();
                return view('admin/user/index',[
                 'title'=>'查看用户列表',
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
        return view('admin/user/create',[
            'title'=>'后台的用户添加页面'
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
      
        $rs = $request->except('_token','repass','profile');

        $this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',
           
            'password' => 'required|regex:/^\S{8,16}$/',
            'profile' => 'required',
            'repassword'=>'same:password',
            'email'=> 'email',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        ],[
            'username.required' => '账号不能为空',
            'username.regex' => '账号格式不正确',
           
           
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

         $data = DB::table('user')->insert($rs);

        if($data){

            return redirect('admin/user');

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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = User::find($id);
        return view('admin/user/edit',[
            'title'=>'修改用户信息',
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
        $data = User::where('id',$id)->update($rs);

        if($data){

            return redirect('/admin/user')->with('success','修改成功');
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
   
     public function delete(Request $request)
    {
        // $rs = Goodsimg::where('gid',$id)->get();

        // foreach($rs as $k => $v){

        //     @unlink('./'.$v->gimg);
        // }
        $id = $request->id;

        $um = User::find($id);

        $um->delete();

        $res = $um->um()->delete();

        $data = User::destroy($id);

        
        if($data){

            return redirect('/admin/user')->with('success','删除成功');

        } else {

            return back()->with('error','删除失败');

        }
    }

  
}
