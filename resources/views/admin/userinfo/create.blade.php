@extends('common/admin')
@section('content')
@if (count($errors) > 0)
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="grid_8">
    <div class="mws-panel">
        <div class="mws-panel-header">
            <span><i class="icon-calculate"></i> 用户详细信息添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/userinfo" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                	<div class="mws-form-row">
                    	<label class="mws-form-label">用户名</label>
                    	<div class="mws-form-item">
                            <input type="text" name="username" class=" large">
                        	
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">性别</label>
                        <div class="mws-form-item">
                            <input type="radio" name="sex" class=" large" value="0">女
                            <input type="radio" name="sex" class=" large" value="1">男
                            <input type="radio" name="sex" class=" large" value="0">保密
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">姓名</label>
                        <div class="mws-form-item">
                            <input type="text" name="name" class=" large">
                        </div>
                    </div>
                    <input type="hidden" name="uid" value="{{$id}}">
                    <div class="mws-form-row">
                        <label class="mws-form-label">QQ</label>
                        <div class="mws-form-item">
                            <input type="text" name="qq" class=" large">
                        </div>
                    </div>
                     <div class="mws-form-row">
                        <label class="mws-form-label">地址</label>
                        <div class="mws-form-item">
                            <input type="text" name="address" class=" large">
                        </div>
                    </div>  
                     <div class="mws-form-row">
                        <label class="mws-form-label">积分</label>
                        <div class="mws-form-item">
                            <input type="text" name="score" class=" large">
                        </div>
                    </div>    
                 	{{csrf_field()}}
            		<div class="mws-form-row">
                    	
                    	<div class="mws-form-item">
                        	<input type="submit" value="添加" class="btn">
	                        </div>
	                    </div>	
	                </div>
	            </form>
	        </div>
	    </div>  
	</div>

@stop