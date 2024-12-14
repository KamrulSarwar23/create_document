<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.png" type="image/png">
    <title>All Public Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-text {
            max-height: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-body .badge {
            margin-right: 5px;
        }

        #category-select {
            max-height: 150px;
            overflow-y: auto;
        }

        a {
            color: black;
            text-decoration: none;
        }

        p{
            color: black;
            font-family: roboto;
        }
    </style>
</head>

<body>
    <div class="container my-4">

        <div class="col-md-12 text-center py-4 bg-info text-light">
            <h2>Stay Organized, Stay Productive</h2>
            <h4>Manage your data efficiently and achieve your goals effortlessly.</h4>
        </div>
        <!-- Search Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form class="row g-3 align-items-center" action="{{ route('public.document') }}" method="GET">

                            <!-- Search Input and Button -->
                            <div class="col-md-3 col-sm-6 d-flex align-items-center">
                                <input type="text" class="form-control me-2" placeholder="Search Here" name="search"
                                    value="{{ $search }}">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>

                            <!-- Category Dropdown and Button -->
                            <div class="col-md-3 col-sm-6 d-flex align-items-center">
                                <select name="category" id="category-select" class="form-control">
                                    <option disabled value="" {{ empty($categorysearch) ? 'selected' : '' }}>
                                        Select Category</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category == $categorysearch ? 'selected' : '' }}
                                            value="{{ $category }}">
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-info ms-2">Filter</button>
                            </div>

                            <div class="col-md-3 col-sm-6 d-flex align-items-center">
                                <select name="user" id="user-select" class="form-control">
                                    <option disabled value="" {{ empty($usersearch) ? 'selected' : '' }}>Select Author</option>
                                    @foreach ($SearchByuser as $user)
                                        <option {{$user->id == $usersearch ? 'selected' : ''}} value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-info ms-2">Filter</button>
                            </div>

                            <!-- Authentication Links -->
                            <div class="col-md-3 col-sm-12 text-end">
                                @auth
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="btn btn-success btn-login">Dashboard</a>
                                    @else
                                        <a href="{{ route('user.dashboard') }}"
                                            class="btn btn-success btn-login">Dashboard</a>
                                    @endif
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-success me-2">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-info">Register</a>
                                @endguest
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="col-md-2">
                    @if ($search || $categorysearch || $usersearch)
                        <a href="{{ route('public.document') }}" class="btn btn-danger mb-2">Reset Filter</a>
                    @endif



                </div>


                @if (count($alldocuments) > 0)



                    @foreach ($alldocuments as $item)
                        <a href="{{ route('public.document.detail', $item->id) }}" class="text-primary mt-3">
                            <div class="card mb-3 shadow-sm">

                                <div class="card-body">
                                    <!-- Header Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $item->user->name }}</h5>
                                        @if ($item->status === 'private')
                                            <span class="badge bg-success text-uppercase">{{ $item->status }}</span>
                                        @else
                                            <span class="badge bg-info text-uppercase">{{ $item->status }}</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $item->created_at->format('M d, Y h:i A') }}</small> -
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>

                                    <!-- Category and Source -->
                                    <div class="mt-2">
                                        <span class="badge bg-info text-uppercase">{{ $item->category }}</span>
                                        <br>
                                        <span class="badge bg-info text-uppercase">{{ $item->source }}</span>
                                    </div>

                                    <!-- Description -->
                                    <p class="card-text mt-3 description">
                                        {!! \Illuminate\Support\Str::limit($item->description, 1000) !!}
                                    </p>

                                    <a href="{{ route('public.document.detail', $item->id) }}"
                                        class="text-primary mt-3">See more...</a>


                                </div>


                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="col-md-12 text-center mt-5">
                        <h2>No Data Found</h2>
                    </div>
                @endif

                {{ $alldocuments->appends($_GET)->links() }}

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('category-select');
            if (selectElement.options.length > 5) {
                selectElement.style.maxHeight = '150px';
                selectElement.style.overflowY = 'auto';
            }
        });
    </script>
</body>

</html>
