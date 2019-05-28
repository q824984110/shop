<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;

use DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
    	$rs = Category::select(DB::raw('*,concat(path,tid) as paths'))->where('tname','like','%'.$request->tname.'%')->orderBy('paths','asc')->paginate($request->input('num',10));

    	//分类项添加标识
       foreach($rs as $k => $v)
       {
       	//拼接层级分类的标识
       	$info = count(explode(',',$v->path))-2;
       	$v->tname = str_repeat('\__', $info).$v->tname;
       }

        //分类列表页
        return view('category.list',[
        	'title'=>'分类的列表页面',
        	'request' => $request,
        	'rs' => $rs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //查询出父级分类
       //$rs = Category::all();
       // dump($rs);
       
       //查询出来的分类项进行排序
       $rs = DB::select('select *,concat(path,tid) as paths from goods_type ORDER BY paths asc');

       //分类项添加标识
       foreach($rs as $k => $v)
       {
       	//通过path路径的逗号
       	$info = count(explode(',',$v->path))-2;
       	$v->tname = str_repeat('\__', $info).$v->tname;

       	//dump($v->tname);
       }

       //添加分类页面
        return view('category.create',[
        	'title' => '分类的添加页面',
        	'rs' => $rs
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
        //
      //dump( $request->all()) ;die;
      $rs = $request->except('_token');
      if($request->pid == '0'){
      	$rs['path'] = '0,';
      } else {
      	$res = Category::where('tid',$request->pid)->first();
      	//dump($res);die;
      	//拼接path路径
      	$rs['path'] = $res->path.$res->tid.',';
      	//dump($rs);die;
      }
      
      //添加数据
      //$data = Category::create($rs);
      
      //dump($data);die;
      $data = Goods::create($rs);
      //dump($data);die;

      if($data){
      	
      		return redirect('/admin/category')->with('success','添加成功');
      	} else {
      		return back()->with('error','添加失败');
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
        //根据tid 获取数据
        $rs = Category::find($id);

        //显示页面
       
        return view('category.edit',[
        	'title'=>'分类的修改页面',
        	'rs' => $rs

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

    	$data = Category::where('tid',$id)->update($rs);

    	if($data){
    		return redirect('/admin/category')->with('success','修改成功');
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
        //根据id 查询名下是否有子分类
        $res = Category::where('tid',$id)->first();
        //如果有的话就删除
        $rs = Category::where('path','like','%'.$res->pathe.$res->tid.',%')->delete();
        //执行删除
        if(!$rs){
        	echo '删除子类失败';
        }
        $data = Category::destroy($id);

       if($data){
    		return redirect('/admin/category')->with('success','删除成功');
    	} else {
    		return back()->with('error','删除失败');
    	}
    }
}
