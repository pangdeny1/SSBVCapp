@extends("layouts.master")

@section("content")
    <div class="wrapper">
        <div class="page">
            <div class="sidebar-backdrop"></div>
            <!-- .page-cover -->
            @include("farmers._page_cover")

            <!-- .page-navs -->
            @include("farmers._page_nav")

            <div class="page-inner">
                <!-- .page-title-bar -->
                <header class="page-title-bar">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a href="{{ route("farmers.show", $farmer) }}">
                                    <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>
                                    {{ $farmer->full_name  }}
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="page-title mr-sm-auto"> Batches
                        <small class="badge">{{ $farmer->batches->count() }} Totals</small>
                    </h1>
                </header>

                <!-- .page-section -->
                <div class="page-section">
                    <!-- .masonry-layout -->
                    <div class="masonry-layout" style="position: relative; height: 800px;">
                        @foreach($farmer->batches as $batch)
                        <div class="masonry-item col-lg-6">
                            <section class="card card-fluid">
                                <div class="card-body">
                                    <div class="media align-items-center mb-3">
                                        <a href="#" class="user-avatar user-avatar-lg mr-3">
                                            <img src="{{ Avatar::create($batch->number)->toBase64() }}" />
                                        </a>
                                        <div class="media-body">
                                            <h3 class="card-title">
                                                <a href="#">{{ $batch->number }}</a>
                                            </h3>
                                            <h6 class="card-subtitle text-muted"> Batch </h6>
                                        </div>
                                        <a href="#"
                                           class="btn btn-reset text-muted"
                                           data-toggle="tooltip"
                                           title=""
                                           data-original-title="Chat with teams">
                                            <i class="oi oi-chat"></i>
                                        </a>
                                    </div>

                                    <p>{{ $batch->description }}</p>


                                    <!-- team details -->
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                    <i class="far fa-calendar-check"></i>
                                                </span> Valid From
                                            </td>
                                            <td>{{ $batch->valid_from->toFormattedDateString() }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                <i class="far fa-calendar-times"></i>
                                            </span> Valid Till
                                            </td>
                                            <td>{{ $batch->valid_till->toFormattedDateString() }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                    <i class="fas fa-users"></i>
                                                </span> Maximum number of farmers
                                            </td>
                                            <td>{{ $batch->max_count }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                    <i class="fas fa-users"></i>
                                                </span> Existing farmers
                                            </td>
                                            <td>{{ $batch->farmers->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                    <span class="fa fa-flag text-muted"></span>
                                                </span> Status
                                            </td>
                                            <td>{{ $batch->status }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection