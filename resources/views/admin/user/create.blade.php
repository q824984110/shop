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
            <span><i class="icon-calculate"></i>用户添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/user" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                	<div class="mws-form-row">
                    	<label class="mws-form-label">账号</label>
                    	<div class="mws-form-item">
                        	<input type="text" name="loginname" class=" large">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">用户名</label>
                        <div class="mws-form-item">
                            <input type="text" name="username" class=" large">
                        </div>
                    </div>
                    <input type="hidden" name="status" value="1">
                    <div class="mws-form-row">
                    	<label class="mws-form-label">密码</label>
                    	<div class="mws-form-item">
                        	<input type="password" name="password" class="large">
                        </div>
                    </div>
                    <div class="mws-form-row">
                    	<label class="mws-form-label">确认密码</label>
                    	<div class="mws-form-item">
                        	<input type="password" name="repassword" class=" large">
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">手机号</label>
                        <div class="mws-form-item">
                            <input type="text" name="phone" class=" large">
                        </div>
                    </div>
                    
                	<div class="mws-form-row">
                    	<label class="mws-form-label">头像</label>
                    	<div class="mws-form-item">
                        	<input type="file" name="profile" class=" large">
                        </div>
                    </div>
                    
                    <input type="hidden" name="addtime" value="<?=time();?>">
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



