@extends('layouts.master')
@section('styles')
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endsection
@section('page-content')
<div class="container-fluid">
    <div class="col-md-12 m-t-30">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Home Page Settings</h4>
            <ul class="nav nav-tabs tabs-bordered nav-justified">
                <li class="active">
                    <a href="#section" data-toggle="tab" aria-expanded="false">
                        Section Settings
                    </a>
                </li>
                <li class="">
                        {{-- <a href="#slider-setting" data-toggle="tab" aria-expanded="true">
                            Slider Settings
                        </a> --}}
                    </li>
                    <li class="">
                        {{-- <a href="#banner" data-toggle="tab" aria-expanded="false">
                            Banner Settings
                        </a> --}}
                    </li>
                    <li class="">
                        {{-- <a href="#portlet" data-toggle="tab" aria-expanded="false">
                            Portlet Settings
                        </a> --}}
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="slider-setting">
                        <div class="dropzone" id="myId">

                        </div>
                    </div>
                    <div class="tab-pane active" id="section">
                        <form method="post" action="{{route('admin.homepage.post')}}">
                            {{csrf_field()}}
                            <div class="container">
                                <div class="col-md-2 col-offset-md-10">
                                    <button type="button" name="button" class="btn btn-custom addSection">
                                        <i class="fa fa-plus"></i> Add new Section
                                    </button>
                                </div>
                            </div>
                            @php
                            $sections = [];
                            if ($setting && $setting->section) {
                                $sections = (array) json_decode($setting->section);
                            }
                            @endphp
                            @foreach($sections as $key => $data)
                            <div class="container">
                                <hr/>
                                <div class="col-md-2">
                                    <label for="section_title" class="control-label">Set Section Title </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="title[]" placeholder="Section Name E.g Best Printers" class="form-control input-sm" value="{{$data->section}}" />
                                </div>
                                <div class="col-md-2">
                                    <button type="button" name="button" class="btn btn-danger removeSection">
                                        <i class="fa fa-minus"></i> Remove Section
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <label for="sku" class="control-label"> Select Product SKU </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="tags-default">
                                        <input type="text" name="section_products[]" class="form-control tags" placeholder="Product SKU Code" value="{{implode(',', (array) json_decode($data->sku))}}"/>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="sectionDiv">

                            </div>
                            <div class="col-md-2 col-md-offset-10">
                                <button class="btn btn-sm btn-success btn-block" >
                                    <i class="fa fa-paper-plane"></i> SAVE
                                </button>
                            </div>
                            <br>
                        </form>
                    </div>

                        {{-- <div class="tab-pane" id="banner">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                        <div class="tab-pane" id="portlet">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('page-scripts')
        <script src="{{ asset('js/dropzone.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
        <script type="text/javascript">
            $(".tags").tagsinput('items');

            Dropzone.options.myId = {
                url:'/',
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }
            else { done(); }
        }
    };


    $(document).on('click', '.addSection', function() {
        $('.sectionDiv').append(`
            <div class="container">
            <hr/>
            <div class="col-md-2">
            <label for="section_title" class="control-label">Set Section Title </label>
            </div>
            <div class="col-md-8">
            <input type="text" name="title[]" placeholder="Section Name E.g Best Printers" class="form-control input-sm"/>
            </div>
            <div class="col-md-2">
            <button type="button" name="button" class="btn btn-danger removeSection">
            <i class="fa fa-minus"></i> Remove Section
            </button>
            </div>
            <div class="col-md-2">
            <label for="sku" class="control-label"> Select Product SKU </label>
            </div>
            <div class="col-md-8">
            <div class="tags-default">
            <input type="text" name="section_products[]" class="form-control tags" placeholder="Product SKU Code"/>
            </div>
            </div>
            </div>
            `);
        $(".tags").last().tagsinput('items');
    });


    $(document).on('click', '.removeSection', function() {
        $(this).parent().parent().remove();
    });
</script>
@endsection
