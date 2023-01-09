@extends('layouts.website_master')
@section('body_content')

<div class="global-wrapper clearfix" id="global-wrapper">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="page-header">
                    <h1 class="page-title">Resturant Information</h1>
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
                                <h3 class="widget-title">Resturant Info</h3>
                                <form>
                                    <div class="form-group">
                                        <label>Resturant Name</label>
                                        <input class="form-control" type="text" placeholder="  Your Resturant name  " />
                                    </div>

                                     <div class="custom-file form-group">
                                    <input type="file" class="custom-file-input " id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload Resturant Logo Photo Choose file</label>
                                    </div>
                                    


                                     <div class="form-group">
                                        <label>Resturant licence No.</label>
                                        <input class="form-control" type="number" placeholder="  Your licence no.  " />
                                        </div>

                                     <div class="custom-file form-group">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload Resturant licence Photo Choose file</label>
                                    </div>
                                 

                                     <div class="form-group">
                                        <label>Resturant Certificate No.</label>
                                        <input class="form-control" type="number" placeholder="  Your Certificate No.  "  />
                                    </div>


                                    <div class="custom-file form-group">
                                       <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload Registration Certificate Photo Choose file</label>
                                    </div>

                                   <label class="control-label">Select File / Photo </label>
                                            <input id="input-b5" name="input-b5[]" type="file" multiple>
                                            <script>
                                            $(document).ready(function() {
                                                $("#input-b5").fileinput({showCaption: false, dropZoneEnabled: false});
                                            });
                                            </script>

                                            <br/>

                                     <div class="form-group">
                                        <label>Owner Name</label>
                                        <input class="form-control" type="text" placeholder="  Your Resturant name  " />
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input class="form-control" type="number" placeholder="  Your Mobile no. "  />
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" type="E-mail" />
                                    </div>
                                  

                                     <div class="form-group">
                                        <label>Purchase Manager Name</label>
                                        <input class="form-control" type="E-mail" placeholder="  Your Manager name  " />
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input class="form-control" type="number" placeholder="  Your Mobile no. "  />
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" />
                                    </div>
                                    

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
