@extends('user.layouts.master')

@section('title')
    || User Dashboard
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('user.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3 class="mb-3">User Dashboard</h3>
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">

                                <div class="col-xl-4 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="javascript:;">
                                        <i class="fas fa-user-shield"></i>
                                        <p>My Total Post</p>
                                        <h5 class="text-light">{{ $mytotalpost }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="javascript:;">
                                        <i class="fas fa-user-shield"></i>
                                        <p>My Total Public Post</p>
                                        <h5 class="text-light">{{ $mytotalpublicpost }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="javascript:;">
                                        <i class="fas fa-star"></i>
                                        <p>My Total Private Post</p>
                                        <h5 class="text-light">{{ $mytotalprivatepost }}</h5>
                                    </a>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
