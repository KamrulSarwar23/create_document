@extends('admin.layouts.master')

@section('title')
    || Documents Details
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('admin.layouts.sidebar')


            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Documents Details</h3>

                        <div class="wsus__dashboard_profile">


                            <div class="wsus__dash_pro_area mb-3">


                                <div class="container my-4">
                                    <!-- Example Card Start -->


                                    <div class="mb-4">
                                        <div class="card-body">
                                            <!-- Header Section -->
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title mb-0">{{ $item->user->name }}</h5>



                                                @if ($item->status === 'private')
                                                    <span class="badge bg-success text-uppercase">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge bg-info text-uppercase">{{ $item->status }}</span>
                                                @endif

                                            </div>

                                            <small
                                                class="text-muted">{{ $item->created_at->format('M d, Y h:i A') }}</small>
                                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>

                                            <div>
                                                <span class="badge bg-info text-uppercase mt-3">{{ $item->category }}</span>
                                                <div class="mb-3">
                                                    <span class="badge bg-info text-uppercase">{{ $item->source }}</span>
                                                </div>
                                            </div>

                                      

                                            <p class="card-text text-truncate" style="max-height: 80px; overflow: hidden;">
                                                {!! $item->description !!}
                                            </p>
                                            <div class="my-3">
                                                @foreach ($item->files as $file)
                                                    <div>
                                                        <a href="{{ asset($file->files) }}" target="_blank">
                                                            <img class="my-5" width="800px" height="400px" src="{{ asset($file->files) }}" alt="">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            

                                            <!-- Footer Section -->
                                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                                <div>

                                                </div>

                                                {{-- @if ($item->user_id === auth()->user()->id)
                                                    <div>
                                                        <a href="{{ route('admin.documents.edit', $item->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('admin.documents.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mt-2">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>

                                                        <a href="{{ route('admin.documents.destroy', $item->id) }}" class="delete-item btn btn-warning btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </a>

                                                    </div>
                                                @endif --}}

                                            </div>


                                        </div>
                                    </div>
                                    <!-- Example Card End -->

                                </div>



                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
