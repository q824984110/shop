@extends('common.admin')

@section('title','添加广告')


@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>添加广告链接</span>
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
        	<form class="mws-form" action="/admin/guanggao" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">订单名称</label>
        				<div class="mws-form-item">
        					<input type="text" name='gname' class="small">
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
	setInterval(function(){
		$('.mws-form-message').fadeOut(2000);
	},3000)
	

</script>
@stop

