<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Nav;
use Hash;
use App\Http\Requests\FormRequest;
use DB;
class NavController extends Controller
{
    public function index(Request $request)
    {
        $rs = Nav::orderBy('id','asc')
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


            
        return view('admin/nav/index',[
         'title'=>'查看导航列表',
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
         return view('admin/nav/create',[
            'title'=>'后台的导航添加页面'
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



       
         $data = DB::table('nav')->insert($rs);

        if($data){

            return redirect('/admin/nav');

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
        $rs = Nav::find($id);
        return view('admin/nav/edit',[
            'title'=>'修改导航信息',
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

       
        
        //修改数据
        $data = Nav::where('id',$id)->update($rs);

        if($data){

            return redirect('/nav/admins')->with('success','修改成功');
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
        $data = Nav::destroy($id);

        if($data){

            return redirect('/nav/admins')->with('success','删除成功');

        } else {

            return back()->with('error','删除失败');

        }
    
    }
}
