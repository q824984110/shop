@extends('common.admin')

@section('title','修改订单')


@section('content')
<div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>修改订单</span>
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
            <form class="mws-form" action="/admin/order/{{$rs->id}}" method='post' enctype='multipart/form-data'>
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">产品</label>
                        <div class="mws-form-item">
                            <input type="text" name='goodsname' class="small" value="{{$rs->goodsname}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">单价</label>
                        <div class="mws-form-item">
                            <input type="text" name='price' class="small" value="{{$rs->price}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">数量</label>
                        <div class="mws-form-item">
                            <input type="text" name='nums' class="small" value="{{$rs->nums}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">订购人</label>
                        <div class="mws-form-item">
                            <input type="text" name='name' class="small" value="{{$rs->name}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">手机</label>
                        <div class="mws-form-item">
                            <input type="text" name='phone' class="small" value="{{$rs->phone}}">
                        </div>
                    </div> 
                    <div class="mws-form-row">
                        <label class="mws-form-label">发货状态</label>
                        <div class="mws-form-item">
                            <select name="zt1">
                                <option value="0" @if($rs->zt1==0)checked @endif>未处理</option>
                                <option value="1" @if($rs->zt1==1)checked @endif>待发货</option>
                                <option value="2" @if($rs->zt1==2)checked @endif>已发货</option>
                                <option value="3" @if($rs->zt1==3)checked @endif>已签收</option>
                                <option value="4" @if($rs->zt1==4)checked @endif>已退回</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="addtime" value="{{$rs->addtime}}">
                     <div class="mws-form-row">
                        <label class="mws-form-label">付款状态</label>
                        <div class="mws-form-item">
                            <select name="zt2">
                                <option value="0" @if($rs->zt2==0)checked @endif>未付款</option>
                                <option value="1" @if($rs->zt2==1)checked @endif>已付款</option>
                               
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <input type="submit" value="修改" class="btn btn-primary">
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

