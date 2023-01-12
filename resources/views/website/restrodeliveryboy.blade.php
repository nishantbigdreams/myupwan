@extends('layouts.website_master')
@section('body_content')

<div class="global-wrapper clearfix" id="global-wrapper">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="page-header">
                    <h1 class="page-title">Resturant Delivery Boy Information</h1>
                </header>
                <div class="box-lg">
                    <div class="row" data-gutter="60">
                       <!--- <div class="col-md-6">
                            <h3 class="widget-title">Sign in</h3>
                            <form>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="text" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check" type="checkbox" />Remember me</label>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Sign in" />
                                </form>
                                <br /><a href="#">Forgot Your Password?</a>
                            </div> --->
                            <div class="col-md-10">
                                <h3 class="widget-title">Resturant Delivery Boy Details</h3>
                                <form>
                                    <div class="form-group">
                                        <label class="h3">Delivery Boy Name</label>
                                        <input class="form-control" type="text" name="deliveryboyname" placeholder="  Enter Your name  " />
                                    </div>



                                     <div class="form-group">
                                        <label>Delivery Boy Mobile No.</label>
                                        <input class="form-control" type="number" name="deliveryboynumber" placeholder=" Enter Your Mobile no.  " />
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" type="E-mail" name="email" placeholder="  Your@.com  " />
                                    </div>

                                     <div class="form-group">
                                        <label>Vehicle No.</label>
                                        <input class="form-control" type="number" name="vehicleno" placeholder=" Enter Your Vehicle No.  "  />
                                    </div>

                                         <div class="form-group">
                                     <label style="text-align: left;font-size:14px;">Vehicle Types</label>
                                        <select class="form-control" name="vehicletype">
                                            <option>Two Wheeler</option>
                                            <option>Three Wheeler </option>
                                            <option>Four Wheeler</option>
                                        </select> 
                                    </div>
                                    <!---<div class="custom-file form-group">
                                       <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload Registration Certificate Photo Choose file</label>
                                    </div>-->

                                   <label class="control-label">Select File / Photo </label>
                                            <input id="input-b5" name="selectfile" type="file" multiple>
                                            <script>
                                            $(document).ready(function() {
                                                $("#input-b5").fileinput({showCaption: false, dropZoneEnabled: false});
                                            });
                                            </script>

                                            <br/>

                                    <div class="form-group">

                                    <label>Region (Area)</label>
                                        <select class="form-control">
                                            <option>Thane</option>
                                            <option>Mulund</option>
                                            <option>Mumbai</option>
                                        </select> 
                                    </div>


                                    <div class="form-group">

                                    <label>Upload Your Documents</label>
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
