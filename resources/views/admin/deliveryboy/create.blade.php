	@extends('layouts.master')
	@section('styles')

	@endsection
	@section('page-content')
	<br>
	<br>
	<div class="global-wrapper clearfix" id="global-wrapper">

	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <header class="page-header">
	                     <h1 style="font-size: 28px !important;
	    color: #e95a0c !important;
	    text-transform: uppercase !important;
	    letter-spacing: 0.2px !important;">Delivery Boy <span style="font-size: 28px !important;
	    color: #79776e !important;
	    text-transform: uppercase !important;
	    letter-spacing: 0.2px !important;">Details</span> </h1>
	                </header>
	                <div class="box-lg">
	                    <div class="row" data-gutter="60">
	                      
	                            <div class="col-md-10">
	                               
	                                <form class="" action="{{route('admin.save_delivery_boy_details')}}" method="post" enctype="multipart/form-data">
	                                	{{ csrf_field() }}
	                                    <div class="form-group">
	                                        <label  style="font-size:16px;text-align:left;">Delivery Boy Name</label>
	                                        <input class="form-control" type="text" name="name" placeholder="  Enter Your name  " />
	                                    </div>



	                                     <div class="form-group">
	                                        <label style="font-size:16px;text-align:left;">Delivery Boy Mobile No.</label>
	                                        <input class="form-control" type="number" name="mobile_no" placeholder=" Enter Your Mobile no.  " />
	                                    </div>

	                                    
	                                    <div class="form-group">
	                                        <label style="font-size:16px;text-align:left;">E-mail</label>
	                                        <input class="form-control" type="E-mail" name="email" placeholder="email "  required="" />
	                                    </div>

	                                     <div class="form-group">
	                                        <label style="font-size:16px;text-align:left;">Vehicle No.</label>
	                                        <input class="form-control" type="text" name="vehicle_no" placeholder=" Enter Your Vehicle No.  "   required="" />
	                                    </div>

	                                         <div class="form-group">
	                                     <label style="font-size:16px;text-align:left;">Vehicle Types</label>
	                                        <select class="form-control" name="vehicle_type"  required="" >
	                                            <option>Two Wheeler</option>
	                                            <option>Three Wheeler </option>
	                                            <option>Four Wheeler</option>
	                                        </select> 
	                                    </div>
	                                    <!---<div class="custom-file form-group">
	                                       <input type="file" class="custom-file-input" id="customFile">
	                                    <label class="custom-file-label" for="customFile">Upload Registration Certificate Photo Choose file</label>
	                                    </div>-->

	                                   <label class="control-label" style="font-size:16px;text-align:left;">Select File / Photo </label>
	                                            <input id="profile" name="profile" type="file" required="" >
	                                            <!-- <script>
	                                            $(document).ready(function() {
	                                                $("#input-b5").fileinput({showCaption: false, dropZoneEnabled: false});
	                                            });
	                                            </script> -->

	                                            <br/>

	                                    <div class="form-group">

	                                    <label style="font-size:16px;text-align:left;">Region (Area)</label>
	                                        <select class="form-control">
	                                            <option>Thane</option>
	                                            <option>Mulund</option>
	                                            <option>Mumbai</option>
	                                        </select> 
	                                    </div>


	                                    <div class="form-group">

	                                    <label style="font-size:16px;text-align:left;">Upload Your Documents</label>
	                                        <select class="form-control">
	                                            <option>UID</option>
	                                            <option>PAN CARD</option>
	                                            <option>VOTER ID</option>
	                                        </select> 
	                                    </div>
	                                        <br/>

	                                    <input class="btn btn-primary" type="submit" value="Submit" />
	                                    
	                                    </form>
	                                </div>

	                            
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="gap gap-small"></div>
	@endsection
	@section('page-scripts')