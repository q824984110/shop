<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Order;
use DB;
use Hash;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $rs = Order::orderBy('id','asc')
            ->where(function($query) use($request){
             
            })
            ->paginate($request->input('num', 10));


        $data = DB::table('order')     
                    ->join('user_info', function($join)
                    {
                        $join->on('order.id', '=', 'user_info.uid');
                    })->select()
                        ->orderBy('order.id', 'desc')
                        ->get();
                return view('admin/order/index',[
                 'title'=>'查看订单列表',
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
        return view('admin/order/create',[
            'title'=>'后台的订单添加页面'
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
       	$number = mt_rand(1,100000).time();

        $rs['number'] = Hash::make($number);
       
        $data = DB::table('order')->insert($rs);

        if($data){

            return redirect('admin/order');

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
        $rs = Order::find($id);
        return view('admin/order/edit',[
            'title'=>'修改订单信息',
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
        $data = Order::where('id',$id)->update($rs);

        if($data){

            return redirect('/admin/order')->with('success','修改成功');
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
       
        $id = $request->id;

        $um = Order::find($id);

        $um->delete();

        $res = $um->um()->delete();

        $data = Order::destroy($id);

        
        if($data){

            return redirect('/admin/order')->with('success','删除成功');

        } else {

            return back()->with('error','删除失败');

        }
    }
}
