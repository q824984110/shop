<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

use App\Http\Requests\FormRequest;

use App\Model\Admin\User;
use App\Model\Admin\UserInfo;

use DB;
class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $data = DB::table('user')     
                        ->join('user_info', function($join)
                        {
                            $join->on('user.id', '=', 'user_info.uid');
                        })->select()
                            ->get();
                      
                    return view('admin/userinfo/index',[
                     'title'=>'查看用户详细信息',
                        'data'=>$data
                    

                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
 
        return view('admin/userinfo/create',[
            'title'=>'用户详细信息添加页面'
            ,'id'=>$id
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
      
        $rs = $request->except('_token');

       

        $data = DB::table('user_info')->insert($rs);
        if($data){

            return redirect('admin/userinfo');

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
    public function edit($uid)
    {
        $rs = UserInfo::find($uid);
        $rs1 = User::find($uid);

        if(!$rs){
            return view('admin/userinfo/create',[
                'id'=>$uid
            ]);
        }else{
            return view('admin/userinfo/edit',[
            'title'=>'修改用户详细信息',
            'rs'=>$rs,
            'rs1'=>$rs1
        ]);
        }
        

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
        $rs = $request->except('_token','_method','phone','status');
        $rs1 = $request->except('_token','_method','uid','sex','name','qq','address','score');
         $this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',  
            
            'qq'=> 'required',
            'address'=> 'required',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        ],[
            'username.required' => '账号不能为空',
            'username.regex' => '账号格式不正确',
            'qq.required' => 'QQ不能为空',
            'qq.regex' => 'QQ格式不正确',
            'username.unique' => '账号已经存在',
            'qq.unique' => 'QQ已经被使用',
            'address.required' => '地址不能为空',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ]);

        $data1 = User::where('id',$id)->update($rs1);
        $data = UserInfo::where('uid',$id)->update($rs);

        if($data||$data1){
            return redirect('admin/user')->with('success','修改成功');
        } else {

            return back()->with('error','修改失败');
        }
    }

    public function delete()
    {
        $uid = $_GET['uid'];
        $data = UserInfo::destroy($uid);

        if($data){

            return redirect('/admin/userinfo')->with('success','删除成功');

        } else {

            return back()->with('error','删除失败');

        }
    }

}
