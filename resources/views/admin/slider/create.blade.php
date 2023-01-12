@extends('layouts.master')

@section('page-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="active">
                        <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                            Add Slider
                        </a>
                    </li>
                    {{-- <li class="">
                    <a href="#allCategories" data-toggle="tab" aria-expanded="false">
                    Add Categories
                </a>
            </li> --}}
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="addCategories">
                        <form action="{{url('admin/slider')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control input-sm" name="image"
                                                   placeholder="image" id="image" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sort Heading Text</label>
                                            <input type="text" class="form-control input-sm" placeholder="Enter Heading"
                                                   required="" name="text_1" value="{{old('text_1')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Large Heading Text</label>
                                            <input type="text" class="form-control input-sm" placeholder="Enter Heading"
                                                   required="" name="text_2" value="{{old('text_2')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Priority</label>
                                            <input type="number" class="form-control input-sm"
                                                   placeholder="Enter Priority" required="" name="priority"
                                                   value="{{old('priority')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-custom">
                                            <input type="checkbox" name="status" id="status" value="1" checked>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-block">
                                    <i class="fa fa-check"></i> SAVE LISTING
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

