@extends('admin.layouts.master')

@section('title')
    || Create Documents
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('admin.layouts.sidebar')


            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create Documents</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('admin.documents.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    
                                    @csrf
                                    
                                    <div class="form-group wsus_input">
                                        <label>Topic</label>
                                        <input type="text" class="form-control"name="topic" value="{{ old('topic') }}"
                                            placeholder="Research Topic">
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="category"
                                            value="{{ old('category') }}" placeholder="Category">
                                    </div>

                                    <div class="form-group wsus_input">
                                        <label>Source</label>
                                        <input type="text" class="form-control" name="source"
                                            value="{{ old('source') }}" placeholder="Source">
                                    </div>



                                    <div class="form-group wsus_input">
                                        <label>Description</label>
                                        <textarea class="ckeditor" name="description" id="" cols="30" rows="5">
                                            
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
                                            <option value="private">Private</option>
                                            <option value="public">Public</option>
                                        </select>
                                    </div>


                                    <button class="btn btn-primary mt-3">Create Documents</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
