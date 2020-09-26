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
                <a href="#">Add Brand</a>
            </li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Brand</h2>
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
                    <form class="form-horizontal" action="{{url('/save-brand')}}" method="post">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="text">Brand Name</label>
                                <div class="controls">
                                    <input type="text" class="input-lg " name="manufacture_name" required="">
                                </div>
                            </div>

                            <div class="control-group hidden-phone">
                                <label class="control-label" for="textarea">Brand Description</label>
                                <div class="controls">
                                    <textarea class="cleditor" name="manufacture_description" required="" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="control-group hidden-phone">
                                <label class="control-label" for="checkbox">Publication Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="publication_status" value="0">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid sortable">
        </div>
@endsection
