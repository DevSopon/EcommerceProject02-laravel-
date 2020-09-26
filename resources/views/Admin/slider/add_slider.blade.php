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
                <a href="#">Add Slider </a>
            </li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
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
                    <form class="form-horizontal" action="{{url('/save-slider')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="fileInput">Slider Image</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" name="slider_image" id="fileInput" type="file" required="">
                                </div>
                            </div>
                            <div class="control-group hidden-phone">
                                <label class="control-label" for="checkbox">Publication Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="publication_status" value="0" required="">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add Slider</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid sortable">
        </div>

         @endsection
