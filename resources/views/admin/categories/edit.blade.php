@extends('layouts.master')
@section('page-style')

@endsection
@section('page-content')


<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <ul class="nav nav-tabs tabs-bordered">
                <li class="active">
                    <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                        Add Categories
                    </a>
                </li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="addCategories">
                    <form action="{{route('admin.category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control input-sm" placeholder="Enter Category Name" required="" name="name" value="{{$category->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Initail for SKU</label>
                                        <input type="text" class="form-control input-sm" placeholder="SKU Initail" required="" name="sku_initial" value="{{$category->sku_initial}}">
                                        <span class="help-block"><small>Set SKU initial. e.g PRN for Printer</small></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Select Parent Category</label>
                                        <select class="form-control input-sm" name="parent_category" required="">
                                            <option disabled="" value="" selected="">SELECT PARENT CATEGORY</option>
                                            @foreach($parentCategories as $parent_category)
                                            <option value="{{$parent_category->id}}"
                                                 {{$category->parent_category_id == $parent_category->id ? 'selected':''}}>
                                                {{$parent_category->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" id="addType" class="btn btn-sm btn-custom m-t-20">
                                            <i class="fa fa-plus-circle"></i> Add New Type
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-warning m-t-20" data-toggle="modal" data-target="#cat_seo">
                                            <i class="mdi mdi-check-all"></i> Cat SEO
                                        </button>
                                    </div>
                                </div>
                                   <div class="col-md-3">
                                <div id="img-preview"></div>
                                <input type="file" id="choose-file" name="category_image"  />
                                <label for="choose-file">Choose File</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-success m-t-20">
                                            <i class="mdi mdi-check-all"></i> SAVE CATEGORY
                                        </button>
                                    </div>
                                </div>
                             
                                </div>


                            </div>
                        </div>
                        <div id="addTypeDiv">
                            @foreach (json_decode($category->data) as $cat_key => $category)
                            <div class="row p-t-10" style="background:#e8eaf1">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Type</label>
                                        <input type="text" class="form-control input-sm" placeholder="Enter Type Name" required="" name="data[{{$cat_key}}][]" value="{{$category[0]->name}}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" id="addType" class="btn btn-sm btn-custom m-t-20 addAttibute" data-count={{$cat_key}}>
                                        <i class="fa fa-plus-circle"></i> Add Attibute
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-danger m-t-20 ">
                                        <i class="fa fa-times-circle"></i> Remove Attibute
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                @foreach ($category[1] as $key => $object)
                                <div class="row bg-gray p-t-10 m-0">
                                    <div class="col-md-4 col-md-offset-2">
                                        <div class="form-group">
                                            <label class="control-label">Attribute</label>
                                            <input type="text" class="form-control input-sm" placeholder="Enter Attribute Name" required="" name="attribute[{{$cat_key}}][]" value="{{$object->attribute}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Attribute Type</label>
                                        <select name="attribute_type[{{$cat_key}}][]" class="form-control input-sm" required>
                                            <option value="checkbox" {{$object->type == 'checkbox' ? 'selected':''}}>
                                                &#x2611; <i class="fa fa-home"></i> Checkbox
                                            </option>
                                            <option value="text" {{$object->type == 'text' ? 'selected':''}}>
                                                &#x2631; Text
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="input-sm btn btn-danger m-t-20 ">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        <div id="seo_values">
                          <input type="hidden" name="categories_seo_id" value="{{$categories_seo[0]->id??''}}">
                          <input type="hidden" name="categories_id" value="{{$categories_seo[0]->category_id??''}}">
                          <input type="hidden" name="focus_keywords" value="{{$categories_seo[0]->focus_keyword??''}}">
                          <input type="hidden" name="lsi_keywords" value="{{$categories_seo[0]->lsi_keyword??''}}">
                          <input type="hidden" name="title_tag" value="{{$categories_seo[0]->title_tag??''}}">
                          <input type="hidden" name="h1_tag" value="{{$categories_seo[0]->heading_tag??''}}">
                          <input type="hidden" name="content_sections" value="{{$categories_seo[0]->content_section??''}}">
                          <input type="hidden" name="meta_description_tag" value="{{$categories_seo[0]->meta_description_tag??''}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script type="text/javascript">

    let count = "<?php echo $cat_key; ?>";
    $('#addType').click(function(){
        $('#addTypeDiv').append(`
            <div class="row p-t-10" style="background:#e8eaf1">
            <div class="col-md-5 col-md-offset-1">
            <div class="form-group">
            <label class="control-label">Type</label>
            <input type="text" class="form-control input-sm" placeholder="Enter Type Name" required="" name="data[`+(++count)+`][]">
            <span class="help-block"><small>Set new type for your products.(e.g Color)</small></span>
            </div>
            </div>
            <div class="col-md-2">
            <button type="button" id="addType" class="btn btn-sm btn-custom m-t-20 addAttibute" data-count='`+(count)+`'>
            <i class="fa fa-plus-circle"></i> Add Attibute
            </button>
            </div>
            <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-danger m-t-20 ">
            <i class="fa fa-times-circle"></i> Remove Attibute
            </button>
            </div>
            <div class="clearfix"></div>
            </div>
            `);
    })

    $(document).on('click','.btn-danger',function(){
        $(this).closest('.row').remove();
    });

    $(document).on('click','.addAttibute',function(){
        $attributeDiv = $(this).parent().parent();
        let data_count = $(this).data('count');
        $attributeDiv.append(`
            <div class="row bg-gray p-t-10 m-0">
            <div class="col-md-4 col-md-offset-2">
            <div class="form-group">
            <label class="control-label">Attribute</label>
            <input type="text" class="form-control input-sm" placeholder="Enter Attribute Name" required="" name="attribute[`+data_count+`][]">
            <span class="help-block"><small>Set new Attribute for your products (e.g Color Black)</small></span>
            </div>
            </div>
            <div class="col-md-2">
            <label class="control-label">Attribute Type</label>
            <select name="attribute_type[`+data_count+`][]" class="form-control input-sm" required>
            <option value="checkbox"> &#x2611; <i class="fa fa-home"></i> Checkbox</option>
            <option value="text"> &#x2631; Text</option>
            </select>
            <span class="help-block"><small> Checkbox Will be used for filter</small></span>
            </div>
            <div class="col-md-2">
            <button type="button" class="input-sm btn btn-danger m-t-20 ">
            <i class="fa fa-times-circle"></i>
            </button>
            </div>
            </div>
            `);

    });

    $(document).on('click','.save_modal',function(){
        var focus_keywords       = $("input[name=modal_focus_keywords]").val();
        var lsi_keywords         = $("input[name=modal_lsi_keywords]").val();
        var title_tag            = $("input[name=modal_title_tag]").val();
        var h1_tag               = $("input[name=modal_h1_tag]").val();
        var content_sections     = $("textarea[name=modal_content_sections]").val();
        var meta_description_tag = $("textarea[name=modal_meta_description_tag]").val();
        
        $('input[name="focus_keywords"]').val(focus_keywords);
        $('input[name="lsi_keywords"]').val(lsi_keywords);
        $('input[name="title_tag"]').val(title_tag);
        $('input[name="h1_tag"]').val(h1_tag);
        $('input[name="content_sections"]').val(content_sections);
        $('input[name="meta_description_tag"]').val(meta_description_tag);
    });

</script>
@endsection
<div id="cat_seo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div class="col-sm-6" hidden>
              <div class="form-group">
                  <label>Focus Keywords</label>
                  <input type="text" class="form-control" name="categories_seo_id" value="{{$categories_seo[0]->id??''}}">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Focus Keywords</label>
                  <input type="text" class="form-control" name="modal_focus_keywords" value="{{$categories_seo[0]->focus_keyword??''}}">
              </div>
          </div>
          <div class="col-sm-6">
               <div class="form-group">
                  <label>LSI Keywords</label>
                  <input type="text" class="form-control" name="modal_lsi_keywords" value="{{$categories_seo[0]->lsi_keyword??''}}">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Title Tag</label>
                  <input type="text" class="form-control"  name="modal_title_tag" value="{{$categories_seo[0]->title_tag??''}}">
              </div>
          </div>
          <div class="col-sm-6">
               <div class="form-group">
                  <label>H1 Tag</label>
                  <input type="text" class="form-control"  name="modal_h1_tag" value="{{$categories_seo[0]->heading_tag??''}}">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Content Sections</label>
                  <textarea rows="3" class="form-control" name="modal_content_sections" id="modal_content_sections">{{$categories_seo[0]->content_section??''}}</textarea>
              </div>
          </div>
          <div class="col-sm-6">
               <div class="form-group">
                  <label>Meta Description Tag</label>
                  <textarea rows="3" class="form-control" name="modal_meta_description_tag" id="modal_meta_description_tag">{{$categories_seo[0]->meta_description_tag??''}}</textarea>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="save_modal" class="btn btn-default save_modal" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>