<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods_img;
use App\Model\Admin\Goods;
use DB;
use App\Model\Admin\Category;


class GoodsController extends Controller
{
    /**
     * 商品列表页
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	
        

    	$rs = Goods::orderBy('gid','asc')
            ->where(function($query) use($request){
                // 检测关键字
                $gname = $request->input('gname');
                $price = $request->input('price');
                // 如果商品名不为空
                if (!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }

                // 如果价格不为空
                if(!empty($price)) {
                    $query->where('price','like','%'.price.'%');
                }

            })->paginate($request->input('num', 10));
           
    	return view('admin.goods.list',[

    		'title'=>'商品的列表页面',
    		'rs' => $rs,
    		'request'=>$request
            

    	]);

    }



    /**
     * 商品添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
    	$rs = DB::select('select *,concat(path,tid) as paths from goods_type ORDER BY paths asc');
        foreach($rs as $k => $v)
       {
       	//通过path路径的逗号
       	$info = count(explode(',',$v->path))-2;
       	$v->tname = str_repeat('\__', $info).$v->tname;
       }
        return view('admin.goods.create',[
        	'title' => '商品添加页面',
        	'rs' => $rs
    	]);
    }



    /**
     * 处理商品添加的方法.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
    	//表单验证
        $rs = $request->except('_token','gimg');
        //dd($rs);
        //$data = DB::table('goods')->insert($rs);
        $data = Goods::create($rs);

        //商品的图片处理
        if ($request->hasFile('gimg')) {

            $files = $request->file('gimg');

            $gs = [];
            //遍历
            foreach($files as $k => $v){
                $garr = [];
                // $garr['gid'] = $gid;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $v->getClientOriginalExtension();
                //移动
                $v->move('./uploads/gimgs',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $garr['gimg'] = "/uploads/gimgs/".$names.'.'.$suffix;
                array_push($gs,$garr);
            }
   	 }

	      try{ 
	            //存储商品的图片    
	            $res = $data->gm()->createMany($gs);
	            if ($res) {
	              return redirect('/admin/goods')->with('success','添加成功');
	            }
	        }catch(\Exception $e){   
	            return back()->with('error','添加失败');
	        }
	}

    /**
     * 商品详情页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //根据id 删除图片
        $res = Goods_img::find($id);
        
        $data = @unlink('.'.$res->gimg);
        if(!$data){
            echo '删除失败';
        }
        $rs = Goods_img::where('info_id',$id)->delete();
        
        if($rs){
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * 商品信息修改页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id获取数据
        $rs = Goods::find($id);

        $gs = $rs->gm()->get();

        //dump($gs);
        //dump($id);
        //dump($rs);die;
 
        return view('admin.goods.edit',[
            'title' => '商品修改页面', 
            'rs' => $rs, 
            'gs' => $gs
           
        
        ]);
    }

    /**
     * 处理商品修改的方法
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rs = $request->except('_token','_method','gimg');
        $data = Goods::where('gid',$id)->update($rs);

         //商品的图片处理
        if ($request->hasFile('gimg')) {

            $files = $request->file('gimg');

            $gs = [];
            //遍历
            foreach($files as $k => $v){
                $garr = [];
                $garr['gid'] = $id;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $v->getClientOriginalExtension();
                //移动
                $v->move('./uploads/gimgs',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $garr['gimg'] = "/uploads/gimgs/".$names.'.'.$suffix;
                array_push($gs,$garr);
            }
      }
      // 添加商品的的关联图片
      $res = DB::table('goods_img')->insert($gs);
      try{
         if ($res) {
                  return redirect('/admin/goods')->with('success','修改成功');
                }
            }catch(\Exception $e){   
                return back()->with('error','修改失败');
            }
}

    /**
     * 删除商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response   
     */
    public function destroy($id)
    {

        
        //删除图片的路径信息
        $rs = Goods_img::where('gid',$id)->get();
        foreach ($rs as $k=>$v){
            @unlink('./'.$v->gimg);
        }
        $gm = Goods::find($id);

        $gm->delete();

        $res = $gm->gm()->delete();
         try{
                 if ($res) {
                          return redirect('/admin/goods')->with('success','删除成功');
                        }
                    }catch(\Exception $e){   
                        return back()->with('error','删除失败');
                    }
        
        
    }
}
