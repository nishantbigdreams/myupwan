@extends('layouts.master')

@section('page-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="active">
                        <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                            Update Master Product Attribute
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
                        <form action="{{route('slider.update', $slider[0]->id)}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{$slider[0]->image}}">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control input-sm" name="image"
                                                   placeholder="image" id="image">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Uploded</label>

                                            <div>
                                                <img src="{{url('public/sliderimg/'.$slider[0]->image)}}" width="200"
                                                     height="90">
                                            </div>
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
                                                   required="" name="text_1" value="{{$slider[0]->text_1}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Large Heading Text</label>
                                            <input type="text" class="form-control input-sm" placeholder="Enter Heading"
                                                   required="" name="text_2" value="{{$slider[0]->text_2}}">
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
                                                   value="{{$slider[0]->priority}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-custom">

                                            <input type="checkbox" name="status" id="status"
                                                   value="{{$slider[0]->status}}" {{$slider[0]->status == 1 ? 'checked' : ''}}>

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

