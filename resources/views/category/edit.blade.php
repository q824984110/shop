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
            <span><i class="icon-calculate"></i>分类信息修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/category/{{$rs->tid}}" method="post">
                <div class="mws-form-inline">
                	<div class="mws-form-row">
                    	<label class="mws-form-label">分类名</label>
                    	<div class="mws-form-item">
                        	<input type="text" name="tname" class=" large" value="{{$rs->tname}}">
                        </div>
                    </div>
                    
                    
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                           <label>开启<input type="radio" name="status" class=" large" value="1" checked></label>
                           <label> 禁用<input type="radio" name="status" class=" large" value="0"></label>
                        </div>
                    </div>
                	
                        
                   
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


