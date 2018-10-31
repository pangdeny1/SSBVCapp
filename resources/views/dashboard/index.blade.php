@extends('layouts.master')

@section('content')
    <div class="wrapper">
        <!-- .page -->
        <div class="page"><div class="sidebar-backdrop"></div>
            <!-- .page-inner -->
            <div class="page-inner">
                <!-- .page-title-bar -->
                <header class="page-title-bar">
                    <p class="lead">
                        <span class="font-weight-bold">Hello, {{ auth()->user()->full_name }}</span>
                        <span class="d-block text-muted"></span>
                    </p>
                </header>

                <div class="page-section">
                    <div class="section-block">
                        <div class="metric-row">
                            <div class="col-lg-9">
                                <div class="metric-row metric-flush">
                                    <!-- metric column -->
                                    <div class="col">
                                        <!-- .metric -->
                                        <a href="" class="metric metric-bordered align-items-center">
                                            <h2 class="metric-label"> Registered Users </h2>
                                            <p class="metric-value h3">
                                                <sub>
                                                    <i class="oi oi-people"></i>
                                                </sub>
                                                <span class="value">
                                                   
                                                </span>
                                            </p>
                                        </a>
                                        <!-- /.metric -->
                                    </div>
                                    <!-- /metric column -->

                                    <div class="col">
                                        <!-- .metric -->
                                        <a href="" class="metric metric-bordered align-items-center">
                                            <h2 class="metric-label"> Menu  1 </h2>
                                            <p class="metric-value h3">
                                                <sub>
                                                    <i class="oi oi-fork"></i>
                                                </sub>
                                                <span class="value">
                                                    
                                                </span>
                                            </p>
                                        </a>
                                    </div>

                                    <!-- metric column -->
                                    <div class="col">
                                        <!-- .metric -->
                                        <a href="" class="metric metric-bordered align-items-center">
                                            <h2 class="metric-label"> Menu 2</h2>
                                            <p class="metric-value h3">
                                                <sub>
                                                    <i class="fa fa-tasks"></i>
                                                </sub>
                                                <span class="value">
                                                    
                                                </span>
                                            </p>
                                        </a>
                                        <!-- /.metric -->
                                    </div>
                                    <!-- /metric column -->
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="card-metric">
                                    <a class="metric">
                                        <div class="metric-badge">
                                        <span class="badge badge-lg badge-success">
                                            <span class="oi oi-media-record pulse mr-1"></span> COMPLETED 
                                        </span>
                                        </div>
                                        <p class="metric-value h3">
                                            <sub>
                                                <i class="oi oi-timer"></i>
                                            </sub>
                                            <span class="value">
                                               
                                            </span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="section-deck">
                        <div class="card card-fluid">
                            <header class="card-header"> Today's Imports </header>
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-left"  nowrap>#</th>
                                                <th class="text-right"  nowrap>Sender</th>
                                                <th class="text-right" nowrap>Text</th>
                                                <th class="text-right" nowrap>Send toTo</th>
                                                <th class="text-right"  nowrap>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     @foreach(\App\Importsm::latest()->take(5)->get() as $sms)
                                            <tr>
                                                
                                                <td>{{$sms->id}}</td>
                                                <td class="text-right">
                                                    {{$sms->sender}}
                                                </td>
                                                <td class="text-right">
                                                   {{$sms->text}}
                                                </td>
                                                <td class="text-right">
                                                   {{$sms->send_to}}
                                                </td>
                                                <td class="text-capitalize">
                                                   
                                                </td>
                                            </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                                                                     

                            <footer class="card-footer">
                                <a href="" class="card-footer-item">
                                    View all
                                    <i class="fa fa-fw fa-angle-right"></i>
                                </a>
                            </footer>
                        </div>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
