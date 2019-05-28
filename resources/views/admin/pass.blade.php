@extends('common.admin')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>

        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/dopass" method='post' >
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">旧密码</label>
        				<div class="mws-form-item">
        					<input type="password" name='oldpass' class="small">
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">新密码</label>
        				<div class="mws-form-item">
        					<input type="password" name='password' class="small">
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">确认密码</label>
        				<div class="mws-form-item">
        					<input type="password" name='repass' class="small">
        				</div>
        			</div>
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
        			<input type="submit" value="修改" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>

@stop