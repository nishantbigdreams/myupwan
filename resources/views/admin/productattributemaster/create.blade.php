@extends('layouts.master')

@section('page-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="active">
                        <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                            Add Master Product Attribute
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
                        <form action="{{url('admin/productattributemaster')}}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control input-sm" placeholder="Enter Attribute Name" required="" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control input-sm" name="image" placeholder="image" id="image" required="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                           {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-custom">
                                        <input type="checkbox" name="status" id="status" value="1" checked>
                                        <label for="status">Status</label>
                                    </div>
                                </div>
                            </div>--}}
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

