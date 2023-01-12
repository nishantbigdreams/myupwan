<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{$errors->has('ship_contact_person')? 'has-error':''}}">
                <label>Contact Person <small class="text-danger">Max (30) Chars</small></label>
                <input class="form-control req" type="text" name="ship_contact_person" value="{{old('ship_contact_person') ?? auth()->user()->shippingAddress->contact_person ?? auth()->user()->name ?? ""}}" placeholder="Jhon Doe" maxlength="30" />
                @if($errors->has('ship_contact_person'))
                    <span class="text-danger">{{$errors->first('ship_contact_person')}}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('ship_contact_number')? 'has-error':''}}">
                <label>Contact Number</label>
                <input class="form-control req" type="tel" name="ship_contact_number" value="{{old('ship_contact_number') ?? auth()->user()->shippingAddress->contact_number ?? auth()->user()->phone ?? ""}}" placeholder="98xxxxxxxx" />
                @if($errors->has('ship_contact_number'))
                    <span class="text-danger">{{$errors->first('ship_contact_number')}}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="cntr">
        <input class="hidden cbx1" id="company" type="checkbox" name="isCompany" value="Yes" />
        <label class="cbx" for="company"></label>
        <label class="lbl" for="company">
            Is Company ?
        </label>
    </div>

    <div class="row" style="display:none;" id="company_details">
        <div class="col-md-6">
            <div class="form-group">
                <label for="gst">GST No.</label>
                <input id="gst" class="form-control" type="text" name="gst" placeholder="GST No." value="" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="pan">PAN No.</label>
                <input id="pan" class="form-control" type="text" name="pan" placeholder="Pan No." value="" />
            </div>
        </div>
    </div>

    <div class="form-group {{$errors->has('ship_address_line_0')? 'has-error':''}}">
        <label>Flat no / Society <small class="text-danger">Max (30) Chars</small> </label>
        <input class="form-control req" type="text" name="ship_address_line_0" value="{{old('ship_address_line_0') ?? auth()->user()->shippingAddress->address_line_0 ?? ''}}" placeholder="Flat no/Society" maxlength="30">
        @if($errors->has('ship_address_line_0'))
            <span class="text-danger">{{$errors->first('ship_address_line_0')}}</span>
        @endif
    </div>
    <div class="form-group {{$errors->has('ship_address_line_1')? 'has-error':''}}">
        <label>Address Line 1 <small class="text-danger">Max (30) Chars</small></label>
        <input class="form-control req" type="text" name="ship_address_line_1" value="{{old('ship_address_line_1') ?? auth()->user()->shippingAddress->address_line_1 ?? ''}}" placeholder="Street/Locality" id="route" onFocus="geolocate()" maxlength="30" />
        @if($errors->has('ship_address_line_1'))
            <span class="text-danger">{{$errors->first('ship_address_line_1')}}</span>
        @endif
    </div>
    <div class="form-group {{$errors->has('ship_address_line_2')? 'has-error':''}}">
        <label>Address Line 2 <small class="text-danger">Max (30) Chars</small></label>
        <input class="form-control" type="text" name="ship_address_line_2" value="{{old('ship_address_line_2') ?? auth()->user()->shippingAddress->address_line_2 ?? ''}}" placeholder="Landmark" maxlength="30" />
        @if($errors->has('ship_address_line_2'))
            <span class="text-danger">{{$errors->first('ship_address_line_2')}}</span>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group {{$errors->has('ship_pincode') ?'has-error': isset($ship_pin_error) ? 'has-error':''}}">
                <label>Zip/Postal</label>
                <small class="text-primary pincode_loader"></small>
                <input class="form-control pincode req" type="text" name="ship_pincode" value="{{old('ship_pincode') ?? auth()->user()->shippingAddress->pincode ?? ''}}" placeholder="400011" maxlength="6" pattern="^[1-9][0-9]{5}$">
                @if($errors->has('ship_pincode'))
                    <span class="text-danger">{{$errors->first('ship_pincode')}}</span>
                @endif
                 @isset($ship_pin_error)
                    <span class="text-danger">{{$ship_pin_error}}</span>
                @endisset
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group {{$errors->has('ship_city')? 'has-error':''}}">
                <label>City</label>
                <input class="form-control req" type="text" name="ship_city" value="{{old('ship_city') ?? auth()->user()->shippingAddress->city ?? auth()->user()->city ?? ""}}" placeholder="E.g Mumbai" />
                @if($errors->has('ship_city'))
                    <span class="text-danger">{{$errors->first('ship_city')}}</span>
                @endif
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group {{$errors->has('ship_state')? 'has-error':''}}">
                <label>State</label>
                <input class="form-control req" type="text" name="ship_state" value="{{old('ship_state') ?? auth()->user()->shippingAddress->state ?? auth()->user()->state ?? ""}}" placeholder="E.g Maharashtra"/>
                @if($errors->has('ship_state'))
                    <span class="text-danger">{{$errors->first('ship_state')}}</span>
                @endif
            </div>
        </div>
    </div>
</div>
