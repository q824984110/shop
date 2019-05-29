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
            <span><i class="icon-calculate"></i>导航栏修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/nav/{{$rs->id}}" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                	<div class="mws-form-row">
                    	<label class="mws-form-label">名称</label>
                    	<div class="mws-form-item">
                        	<input type="text" name="field" class=" large" value="{{$rs->field}}">
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                    	<label class="mws-form-label">状态</label>
                    	<div class="mws-form-item">
                        	<select name="status">
                                <option value="0" @if($rs->status==0)checked @endif>隐藏</option>
                                <option value="1" @if($rs->status==1)checked @endif>显示</option>   
                            </select>
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


