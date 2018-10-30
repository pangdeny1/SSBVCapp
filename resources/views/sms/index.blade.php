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
                            <li class="breadcrumb-item">
                                <a href="#">
                                    Settings
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Imports
                            </li>
                        </ol>
                    </nav>
                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-title mr-sm-auto mb-0">
                            Imports
                        </h1>
                        <div class="btn-toolbar">
                            <a href="{{ route("users.export") }}" class="btn btn-light">
                                <i class="far fa-file-excel"></i>
                                <span class="ml-1">Export as excel</span>
                            </a>
                            @can("create", \App\Importsm::class)
                            <a href="{{ route("users.create") }}" class="btn btn-primary">
                                <span class="fas fa-plus mr-1"></span>
                                New Sms
                            </a>
                            @endcan
                        </div>
                    </div>
                </header>

                <div class="page-section">
                    <section class="card shadow-1 border-0 card-fluid">
                        <header class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query("status") ? "" : "active" }}" 
                                        href="{{ route("users.index") }}"
                                    >
                                        All
                                    </a>
                                </li>
                            </ul>
                        </header>

                        <div class="card-body">

                            <div class="text-muted"> Showing {{ $imports->firstItem() }} to {{ $imports->lastItem() }} of {{ $imports->total() }} entries </div>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th nowrap>Send To</th>
                                            <th nowrap>Text</th>
                                            <th nowrap>Sender</th>
                                            <th nowrap>Batch</th>
                                            <th nowrap></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($imports as $import)
                                        <tr>
                                            <td class="align-middle" nowrap>
                                                <a href="">
                                                    {{ $import->send_to}}
                                                </a>
                                            </td>
                                            <td class="align-middle" nowrap>{{ $import->text }}</td>
                                            <td class="align-middle" nowrap>{{ $import->sender }}</td>
                                            <td class="align-middle text-capitalize" nowrap>
                                             {{ $import->batch_id }}   
                                            </td>
                                            
                                            <td class="align-middle text-right" nowrap>
                                                @can("edit", \App\Importsm::class)
                                                <a href="{{ route("users.edit", $import) }}" class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                    <span class="sr-only">Edit</span>
                                                </a>
                                                @endcan

                                                @can("delete", \App\Importsm::class)
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-secondary"
                                                   onclick="event.preventDefault(); document.getElementById('deletion-form-{{$import->id}}').submit();"
                                                >
                                                    <i class="far fa-trash-alt"></i>
                                                    <span class="sr-only">Remove</span>
                                                    <form id="deletion-form-{{$import->id}}"
                                                          action="{{ route('users.destroy', $import) }}"
                                                          method="POST"
                                                          class="d-none"
                                                    >
                                                        @csrf
                                                        @method("delete")
                                                    </form>
                                                </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- .pagination -->
                            {{ $imports->links() }}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection