@extends("layouts.master")

@section("content")
    <div class="wrapper">
        <div class="page has-sidebar">
            <div class="sidebar-backdrop"></div>
            <div class="page-inner">
                <header class="page-title-bar">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route("home") }}">
                                    <i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">
                                    Settings
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href=" }}">
                                    Send Send SM
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                New 
                            </li>
                        </ol>
                    </nav>
                    <h1 class="page-title"> New batch </h1>
                </header>

                <div class="page-section">
                    <div class="section-block">
                        <div class="d-xl-none">
                            <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar">
                                <i class="fa fa-th-list"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('storesingle')}}"
                                  method="post"
                                  class="card"
                            >
                                @csrf
                                <header class="card-header border-bottom-0">
                                    Create a new batch
                                </header>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="send_to">send_to</label>
                                            <input type="text"
                                                   name="send_to"
                                                   id="send_to"
                                                   class="form-control {{ $errors->has('send_to') ? 'is-invalid' : '' }}"
                                                   value="{{ old("send_to") }}"
                                                   placeholder="start with 255"
                                            >
                                            @if ($errors->has('send_to'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('send_to') }}</strong>
                                                </span>
                                            @endif
                                        </div>
</div>

                                         <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="text">text</label>
                                            <textarea 
                                                name="text"
                                                id="text"
                                                class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}"
                                                rows="6"
                                                placeholder="Type something..."
                                            >{{ old("text") }}</textarea>
                                            @if ($errors->has('text'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                       

                                    <button class="btn btn-block btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-sidebar border-left bg-white">
                <header class="sidebar-header d-sm-none">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a href="#" onclick="Looper.toggleSidebar()">
                                    <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back
                                </a>
                            </li>
                        </ol>
                    </nav>
                </header>
                <div class="sidebar-section">
                    {{--<h3 class="section-title"> I'm a sidebar </h3>--}}
                </div>
            </div>
        </div>
    </div>
@endsection