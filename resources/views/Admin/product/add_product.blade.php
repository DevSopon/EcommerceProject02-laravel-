@extends ('dashboard_layout')
@section ('admin_content')
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li>
                <i class="icon-edit"></i>
            </li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
                </div>
                <p class=" alert-success">
                <?php
                $message=Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
                </p>
                <div class="box-content">
                    <form class="form-horizontal" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="text">Product Name</label>
                                <div class="controls">
                                    <input type="text" class="input-lg" name="product_name" required="">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError">Product Category</label>
                                <div class="controls">
                                    <select id="selectError" data-rel="chosen" name="category_id">
                                        <option>Select One</option>
                                        <?php
                                        $all_published_category=DB::table('category_tbls')
                                            ->where('publication_status', 1)
                                            ->get();
                                        Foreach($all_published_category as $v_category) {?>
                                        <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
                                            <?php }   ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError3" >Product brand</label>
                                <div class="controls">
                                    <select id="selectError3" data-rel="chosen" name="manufacture_id">
                                        <option>Select One</option>
                                        <?php
                                        $all_published_brand=DB::table('manufacture_tbls')
                                            ->where('publication_status', 1)
                                            ->get();
                                        Foreach($all_published_brand as $v_brand)
                                        {?>
                                        <option value="{{$v_brand->manufacture_id}}"> {{$v_brand->manufacture_name}}</option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group hidden-phone">
                                <label class="control-label" for="textarea">Product Short Description</label>
                                <div class="controls">
                                    <textarea class="cleditor" name="product_short_description" required="" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="fileInput">Product Price</label>
                                <div class="controls">
                                    <input class="input-xlarge" name="product_price" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="fileInput">Product Image</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" name="product_image" id="fileInput" type="file">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="fileInput">Product Size</label>
                                <div class="controls">
                                    <input class="input-xlarge" name="product_size" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="fileInput">Product Color</label>
                                <div class="controls">
                                    <input class="input-xlarge" name="product_color" >
                                </div>
                            </div>

                            <div class="control-group hidden-phone">
                                <label class="control-label" for="checkbox">Publication Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="publication_status" value="0">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                                <a href="{{url('/all-product')}}" class="btn btn-info"> Back</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid sortable">
        </div>

@endsection
