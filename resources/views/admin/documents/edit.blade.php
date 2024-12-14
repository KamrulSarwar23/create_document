@extends('admin.layouts.master')

@section('title')
    || Edit Documents
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('admin.layouts.sidebar')


            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Edit Document</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @foreach ($document->files as $file)

                                        <img class="my-5" width="200" height="150"
                                            src="{{ asset($file->files) }}" alt="">

                                @endforeach

                                    <div class="form-group wsus_input">
                                        <label>Topic</label>
                                        <input type="text" class="form-control"name="topic" value="{{ $document->topic }}"
                                            placeholder="Research Topic">
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="category"
                                            value="{{ $document->category }}" placeholder="Category">
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label>Source</label>
                                        <input type="text" class="form-control" name="source"
                                            value="{{ $document->source }}" placeholder="Source">
                                    </div>



                                    <div class="form-group wsus_input">
                                        <label>Description</label>
                                        <textarea class="ckeditor" name="description" id="" cols="50" rows="10">
                                            {{ $document->description }}
                                        </textarea>
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label>Upload Multiple Files</label>
                                        <input type="file" class="form-control" name="files[]" value=""
                                            placeholder="Research Topic" multiple>
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label for="inputState">Private/Public</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option {{ $document->status == 'private' ? 'selected' : '' }} value="private">Private</option>
                                            <option {{ $document->status == 'public' ? 'selected' : '' }} value="public">Public</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label for="inputState">Approved/Pending</label>
                                        <select id="inputState" class="form-control" name="is_approved">
                                            <option {{ $document->is_approved == 'approved' ? 'selected' : '' }} value="approved">Approved</option>
                                            <option {{ $document->is_approved == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-primary mt-3">Update Documents</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
