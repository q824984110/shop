@extends('common/admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>

<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

@section('title',$title)

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>

        @if (count($errors) > 0)
		    <div class="mws-form-message error">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif


        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/goods" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">
                            分类列表
                        </label>
                        <div class="mws-form-item">
                            <select class="small" name='tid'>
                                <option value='0'>
                                    请选择
                                </option>
                                @foreach($rs as $k => $v)
                                <option value='{{$v->tid}}'>
                                    {{$v->tname}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">商品名</label>
        				<div class="mws-form-item">
        					<input type="text" name='gname' class="small">
        				</div>
        			</div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">尺寸</label>
                        <div class="mws-form-item">
                            <input type="text" name='size' class="small">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">价格</label>
                        <div class="mws-form-item">
                            <input type="text" name='price' class="small">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">库存</label>
                        <div class="mws-form-item">
                            <input type="text" name='num' class="small">
                        </div>
                    </div>

        			<div class="mws-form-row">
                        <label class="mws-form-label">商品详情</label>
                        <div class="mws-form-item">
                            <script id="editor" name='content' type="text/plain" style="width:700px;height:380px;"></script>
                        </div>
                    </div>

        			<div class="mws-form-row">
                    	<label class="mws-form-label">商品图片</label>
                    	<div class="mws-form-item">
                        	<input type="file" multiple name='gimg[]' style="position: absolute; top: 0px;  right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
        			
        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='status' value='1' checked> 上架</label></li>
        						<li><label><input type="radio" name='status' value='0'> 下架</label></li>
        					</ul>
        				</div>
        			</div>
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
        			<input type="submit" value="添加" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>
@stop

@section('js')

<script>
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    //让错误的信息3秒钟之后消失
    /*setInterval(function(){


    },3000)*/
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    setTimeout(function(){
        // $('.mws-form-message').slideUp(2000);
        $('.mws-form-message').fadeOut(2000);

    },3000);

    // delay(3000).

    
</script>

@stop