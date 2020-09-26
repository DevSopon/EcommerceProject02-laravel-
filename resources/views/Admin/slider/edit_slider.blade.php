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
            <a href="#">Add Product </a>
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
                <form class="form-horizontal" action="{{url('/update-product', $all_product_info->product_id)}}" method="post" >
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="text">Product Name</label>
                            <div class="controls">
                                <input type="text" class="input-lg " value="{{$all_product_info->product_name}}" name="product_name" required="">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Product Price</label>
                            <div class="controls">
                                <input class="input-xlarge" value="{{$all_product_info->product_price}}" name="product_price" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Product Image</label>
                            <div class="controls">
                                <input class="input-file uniform_on" value="{{$all_product_info->product_image}}" name="product_image" id="fileInput" type="file">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Product Size</label>
                            <div class="controls">
                                <input class="input-xlarge" value="{{$all_product_info->product_size}}" name="product_size" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Product Color</label>
                            <div class="controls">
                                <input class="input-xlarge" value="{{$all_product_info->product_color}}" name="product_color" >
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="row-fluid sortable">
    </div>

@endsection
