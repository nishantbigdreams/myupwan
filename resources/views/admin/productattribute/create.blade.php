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
                        <form action="{{url('admin/productattibute')}}" method="post"
                              enctype="multipart/form-data">
                            <div class="row">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">Product</label>

                                            <select class="form-control input-sm" name="p_id" id="template" required>
                                                <option disabled>Select Product</option>
                                                @foreach ($products as $key => $product)

                                                    <option value="{{$product->id}}" data-sku="{{$product->name}}"
                                                            data-fields='{{$product->data}}'>
                                                        {{$product->name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Master Attribute</label>

                                            <select class="form-control input-sm" name="patt_id" id="template" required>
                                                <option disabled>Select Product Attribute</option>
                                                @foreach ($attributemasters as $key => $attributemaster)
                                                    <option value="{{$attributemaster->id}}"
                                                            data-fields='{{$attributemaster->id}}'>
                                                        {{$attributemaster->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="control-label">Text</label>
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Enter Attribute Text" required="" name="text"
                                                       value="{{old('text')}}">
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

