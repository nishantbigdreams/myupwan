@extends('layouts.master')

@section('page-content')

    <br>
    <br>
    <div class="col-md-12">
        <form class="" action="{{route('admin.sms.send')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="body">Message Body</label>
                <textarea name="body" id="body" rows="5" class="form-control" placeholder="Start typing your message here" required></textarea>
            </div>
            <button class="btn btn-primary pull-right">
                <i class="fa fa-paper-plane"></i> SEND
            </button>
        </form>
    </div>

@endsection
