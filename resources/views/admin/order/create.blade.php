@extends('common.admin')

@section('title','添加订单')


@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>添加订单</span>
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
        	<form class="mws-form" action="/admin/order" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">产品</label>
        				<div class="mws-form-item">
        					<input type="text" name='goodsname' class="small">
        				</div>
        			</div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">单价</label>
                        <div class="mws-form-item">
                            <input type="text" name='price' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">数量</label>
                        <div class="mws-form-item">
                            <input type="text" name='nums' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">订购人</label>
                        <div class="mws-form-item">
                            <input type="text" name='name' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">手机</label>
                        <div class="mws-form-item">
                            <input type="text" name='phone' class="small">
                        </div>
                    </div> 
                   
                    <input type="hidden" name="addtime" value="<?=time();?>">
                    <input type="hidden" name="zt1" value="0">
                    <input type="hidden" name="zt2" value="0">
                
        			
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

