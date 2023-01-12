<div id="addBrand" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Brand</h4>
    <div class="custom-modal-text">
        <div class="row">
            <form class="" action="{{route('admin.brand.store')}}" method="post">
            {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Brand Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" required="">
                        <span class="help-block"><small>Set new brand</small></span>
                    </div>
                </div>
                <button name="button" class="btn btn-custom" id="addBrandBtn">
                    <i class="mdi mdi-check-all"></i> Submit
                </button>
            </form>
        </div>
    </div>
</div>

@push('page-script')
<script type="text/javascript">
    $('#addBrandBtn').click(function(e){
        e.preventDefault();

        $form = $(this).closest('form');
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
        }).done(function(data, textStatus, jqXHR) {
            // console.log(data);
            $('#brand_div').load(location.href + ' #brand_div', function(){
                Custombox.close();
                $form.trigger('reset');
            });
                
        });
});
</script>
@endpush