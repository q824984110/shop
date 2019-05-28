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
            <span><i class="icon-calculate"></i> 用户修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/userinfo/{{$rs->uid}}" method="post" enctype="multipart/form-data">                      
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">用户名</label>
                        <div class="mws-form-item">
                            <input type="text" name="username" class=" large" value="{{$rs->username}}" disabled>
                            <input type="hidden" name="username" class=" large" value="{{$rs->username}}">
                        </div>
                    </div>
                      <div class="mws-form-row">
                        <label class="mws-form-label">手机号</label>
                        <div class="mws-form-item">
                            <input type="text" name="phone" class=" large" value="{{$rs1->phone}}" >
                        </div>
                    </div>
                     <div class="mws-form-row">
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                           <select name="status">
                                <option value="0" @if($rs->status==0)checked @endif>未激活</option>
                                <option value="1" @if($rs->status==1)checked @endif>普通用户</option>
                                <option value="2" @if($rs->status==2)checked @endif>VIP用户</option>
                           </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">性别</label>
                        <div class="mws-form-item">
                            <input type="radio" name="sex" class=" large" value="0" @if($rs->sex==1)checked @endif>女
                            <input type="radio" name="sex" class=" large" value="1" @if($rs->sex==1)checked @endif>男
                            <input type="radio" name="sex" class=" large" value="0" @if($rs->sex==1)checked @endif>保密
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">真实姓名</label>
                        <div class="mws-form-item">
                            <input type="text" name="name" class=" large" value="{{$rs->name}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">QQ</label>
                        <div class="mws-form-item">
                            <input type="text" name="qq" class=" large" value="{{$rs->qq}}">
                        </div>
                    </div>
                      
                     <div class="mws-form-row">
                        <label class="mws-form-label">地址</label>
                        <div class="mws-form-item">
                            <input type="text" name="address" class=" large" value="{{$rs->address}}">
                        </div>
                    </div>  
                     <div class="mws-form-row">
                        <label class="mws-form-label">积分</label>
                        <div class="mws-form-item">
                            <input type="text" name="score" class=" large" value="{{$rs->score}}">
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