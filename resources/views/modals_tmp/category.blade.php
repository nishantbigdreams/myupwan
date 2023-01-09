<div id="addCategory" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Category</h4>
    <div class="custom-modal-text">
        <div class="row">
            <form class="" action="{{route('admin.category.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Parent Category</label>
                    <div class="col-sm-10" id="category_div_2">
                        <select class="form-control input-sm" name="parent_category">
                            <option selected disabled>Select Parent Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block"><small>Select Parent Category to create sub-category</small></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter New Category Name" required="" name="name">
                        <span class="help-block"><small>Set new category of for your products.</small></span>
                    </div>
                </div>
                <button name="button" class="btn btn-custom" id="addCategoryBtn">
                    <i class="mdi mdi-check-all"></i> Submit
                </button>
            </form>
        </div>
    </div>
</div>

@push('page-script')
{{-- @parent --}}
<script type="text/javascript">
    $('#addCategoryBtn').click(function(e){
        e.preventDefault();

        $form = $(this).closest('form');
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
        }).done(function(data, textStatus, jqXHR) {
            // console.log(data);
            $('#category_div').load(location.href + ' #category_div', function(){
                Custombox.close();
                $form.trigger('reset');
            });
            $('#category_div_2').load(location.href + ' #category_div_2');
                
        });
});
</script>
@endpush