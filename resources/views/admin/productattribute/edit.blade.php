@extends('layouts.master')
@section('page-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="active">
                        <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                            Update Product Attribute
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="addCategories">
                        <form action="{{route('productattibute.update', $pro_att1[0]->id)}}" method="post">
                            <div class="row">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product</label>
                                            <select class="form-control input-sm" name="p_id" id="template" required>
                                                <option disabled>Select Product</option>

                                                @foreach ($products as $con)
                                                    @if ($con->id==$pro_att1[0]->p_id)
                                                        <option value="{{ $con->id}}" selected>
                                                            {{ $con->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $con->id}}">
                                                            {{ $con->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product</label>
                                            <select class="form-control input-sm" name="patt_id" id="template" required>
                                                <option disabled>Select Product Attribute</option>
                                                @foreach ($products_attribute as $con)
                                                    @if ($con->id==$pro_att1[0]->patt_id)
                                                        <option value="{{ $con->id}}" selected>
                                                            {{ $con->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $con->id}}">
                                                            {{ $con->name }}
                                                        </option>
                                                    @endif
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
                                                   value="{{$pro_att1[0]->text}}">
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

