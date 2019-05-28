<?php 
	
	function getCateName($pid)
	{
		if($pid == '0'){
			return '顶级分类';
		} else {
			//查询出父类的信息
			$rs = DB::table('goods_type')->where('tid',$pid)->first();
			//var_dump($rs);die;
			return $rs->tname;
		}
	}