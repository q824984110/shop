@extends('common/admin')


@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    
    @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif
    

    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            
           



            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                       
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 90px;">
                            用户名
                        </th>
                            
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                            手机号
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 90px;">
                           姓名
                        </th>
                      
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                           性别
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                           QQ
                        </th>
                   
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                           默认地址
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                           积分
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 100px;">
                           操作
                        </th>
         
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($data as $k => $v)
                    @if($k % 2 == 0)
                        <tr class="odd">
                    @else
                        <tr class="even">
                    @endif
                       
                        <td class=" ">
                            {{$v->username}}
                        </td>
                        
                        <td class=" ">
                            {{$v->phone}}
                        </td>

                       
                        <td class=" ">
                              {{$v->name}}
                        </td>
                         @php
                            switch($v->sex){
                                case 0:
                                    echo '<td class=" ">女</td>';   
                                break;
                                case 1:
                                    echo '<td class=" ">男</td>';   
                                break;
                                case 2:
                                    echo '<td class=" ">保密</td>';   
                                break;
                            }
                        @endphp
                        <td class=" ">
                            {{$v->qq}}
                        </td>
                  
                        <td class=" ">
                            {{$v->address}}
                        </td>
                        <td class=" ">
                            {{$v->score}}
                        </td>
                        
                    
                        <td class=" ">
     
                               <a href="/admin/userinfo/delete?uid={{$v->uid}}"class="icol-bin-closed" title="删除用户详细信息"></a>&nbsp;&nbsp;

                         
                               <a href="/admin/userinfo/{{$v->id}}/edit" class="icol-pencil" title="编辑用户详细信息" style=""></a>

                               
                        </td>
                      
                    </tr>
                    @endforeach

                </tbody>
            </table>
         

           
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    setTimeout(function(){
        $('.mws-form-message').hide(1200)
    },2000)
</script>
@stop