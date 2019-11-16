<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>
        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation" style="padding:5px;">
                <?php 
                    $id = Auth::guard('admin')->user()->adminID;
                ?>
                    <a href="{{ url('admin/edit_view/'.$id) }}">
                        Edit personal information
                    </a>
                </li>
                <li role="presentation" style="padding:5px;">
                    <a href="{{ url('/edit_password') }}">
                         Change password
                    </a>
                </li>
                <li role="presentation" style="padding:5px;">
                    <a href="{{ url('/admin') }}">
                         Manage instructors
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
