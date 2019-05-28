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
            <span><i class="icon-calculate"></i>管理员修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/admins/{{$rs->id}}" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                	<div class="mws-form-row">
                    	<label class="mws-form-label">管理员账号</label>
                    	<div class="mws-form-item">
                            <input type="text" name="username" class=" large" value="{{$rs->username}}" disabled>
                        	<input type="hidden" name="username" class=" large" value="{{$rs->username}}" >
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                    	<label class="mws-form-label">真实姓名</label>
                    	<div class="mws-form-item">
                        	<input type="text" name="name" class=" large" value="{{$rs->name}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">电话</label>
                        <div class="mws-form-item">
                            <input type="text" name="phone" class=" large" value="{{$rs->phone}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">邮箱</label>
                        <div class="mws-form-item">
                            <input type="text" name="email" class=" large" value="{{$rs->email}}">
                        </div>
                    </div>
                	<div class="mws-form-row">
                    	<label class="mws-form-label">头像</label>
                    	<div class="mws-form-item">
                        	 <img src="{{$rs->profile}}" alt="" style='width:120px'>
                        	<input type="file" name='profile' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
                        
                    <input type="hidden" name="addtime" value="<?=time();?>">
                 	{{csrf_field()}}

                 	{{method_field('PUT')}}
            		<div class="mws-form-row">
                    	
                    	<div class="mws-form-item">
                        	<input type="submit" value="修改" class="btn">
	                        </div>
	                    </div>	
	                </div>
	            </form>
	        </div>
	    </div>  
	</div>

@stop

@section('js')

<script>
    setTimeout(function(){

        $('.mws-form-message').fadeOut(2000);

    },3000)


    
</script>

@stop


