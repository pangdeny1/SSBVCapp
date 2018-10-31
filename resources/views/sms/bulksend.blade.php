@extends("layouts.master")

@section("content")
  <div class="wrapper">
        <div class="page">
            <div class="page-inner">
                <header class="page-title-bar">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route("home") }}">
                                    <i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Dashboard
                                </a>
                            </li>
                           
                            <li class="breadcrumb-item active">
                               Bulk Send
                            </li>
                        </ol>
                    </nav>
                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-title mr-sm-auto mb-0">
                          Bulk Send : {{$batch->Batchdesc}}
                        </h1>
                        <div class="btn-toolbar">
                            <a href="{{ route("users.export") }}" class="btn btn-light">
                                <i class="far fa-file-excel"></i>
                                <span class="ml-1">Export as excel</span>
                            </a>
                            @can("create", \App\User::class)
                            <a href="{{url('createBatchperiod')}}" class="btn btn-primary">
                                <span class="fas fa-plus mr-1"></span>
                                New Batch
                            </a>
                            @endcan
                        </div>
                    </div>
                </header>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
 
    <td height="180" valign="top"> 
    
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bordercolordark="#CCCCCC" bordercolorlight="#CCCCCC" bgcolor="#F2F2F2">
        

        <tr bgcolor="#F4F4F4"> 
          <td height="30" > 
            <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b> Batch : {{$batch->number}}</b>
              :</font></div>
          </td>
          </tr>
       
         <tr bgcolor="#F4F4F4"> 
          <td height="300" colspan="6" valign=top> 
           <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                      @include('includes.flash')
                      

                          <table>
                                 <tr>
                                  <td>
                         <form class="form-horizontal" role="form" method="POST" action="{{ url('/generate/'.$batch->number) }}">
                        {!! csrf_field() !!}

                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              @if($batch->status=='open')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Send Batch Data
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                          </td>
                     <td>  
                      <form class="form-horizontal" role="form" method="POST" action="{{ url('/void/'.$batch->id) }}">
                        {!! csrf_field() !!}

                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                               @if($batch->status=='open')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Void Batch
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                   </td>
                    <td> <form class="form-horizontal" role="form" method="POST" action="{{ url('/close/'.$batch->id) }}">
                        {!! csrf_field() !!}

                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                               @if($batch->status=='open')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Close Batch 
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                     </td>
                       <td>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/open/'.$batch->id) }}">
                        {!! csrf_field() !!}

                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Open Batch 
                                </button>
                            </div>
                        </div>
                    </form>
                            </td>
                                 </tr>
                                 </table>       
                       
                                  
                                <div class="panel-body panel-body-table">
                                    
                                    <div class="table-responsive">
                                        <table id="customers2" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Sender ({{$batch->count()}})</th>
                                                    <th width="20%">text</th>
                                                    <th width="20%">send To</th>
                                                    <th width="20%">Status</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                       @foreach(\App\Importsm::where('batch_id',$batch->number)->get() as $sms)
                                                <tr>
                                                    <td><strong>{{$sms->sender}}</strong></td>
                                                    <td><strong>{{$sms->text}}</strong></td>
                                                    <td><strong>{{$sms->send_to}}</strong></td>
                                                    <td><span class="label label-danger">Eligible</span></td>
                                                    
                                                </tr>
                                           @endforeach
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->   
          </td>
          
        </tr>
      </table>
      
    </td>
  </tr>

</table>

@endsection