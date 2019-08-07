@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendors/nestable/nestable.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('vendors/nestable/jquery.nestable.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#nestable').nestable({
                maxDepth : 2,
                callback: function (details,e) {
                    id = e.data('id');
                    parent_id = e.parent().parent().data('id');
                    var sort = new Array();
                    e.parent().children().each(function (index, elem) {
                        sort[index] = $(elem).data('id');
                    });

                    if (sort.length === 0) {
                        var rootSorting = new Array();
                        $("#nestable > ol > li").each(function (index, elem) {
                            rootSorting[index] = $(elem).data('id');
                        });
                    }
                    $.post('{{route("admin.menu-builder.reordering")}}',
                        { id, parent_id, sort, rootSorting },
                        function (data) {
                            $('.toast').toast('show');
                        })
                        .done(function () {
                            $("#success-indicator").fadeIn(100).delay(1000).fadeOut();
                        })
                        .fail(function () {
                        })
                        .always(function () {
                        });
                }
            });
            $(document).on('click','.createMenuItem',function () {
                $('#menuModal .modal-title').html('Add Menu Item');
                $('#menuModal form')[0].reset();
                $('#menuModal #inpMethod').val('POST');
                $('#menuModal').modal('show');
            });
            $(document).on('click','.editMenuItem',function () {
                currData = $(this).closest('.dd-item').data();
                url = "{{ route("admin.menu-builder.index") }}"+"/"+currData.id;

                $('#menuModal .modal-title').html('Edit Menu Item');
                $('#menuModal').find('form').attr('action',url);
                $('#menuModal #inpMethod').val('PATCH');
                $('#menuModal #inpText').val(currData.text);
                $('#menuModal #inptIcon').val(currData.icon);
                $('#menuModal #inpRoute').val(currData.route);

                $('#menuModal').modal('show');
            });
            $(document).on('click','.delete_toggle',function (e) {
                e.preventDefault();
                id = $(this).closest('.dd-item').data('id');
                url = '{{ route('admin.menu-builder.index') }}';
                url = url+"/"+id;

                $('#deleteModal').find('form').attr('action',url);
                $('#inpDelete').attr('value', id);
                $('#deleteModal').modal('toggle');
            });
        });
    </script>
@endsection

@section('content')

    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['url'=>route('admin.menu-builder.index'),'text' =>'Menu List'],
        ['text' =>'Edit Menu '.$mMasterMenu->name],
        ]])
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">Menu Builder</h4>
                        <a href="#menuModal" class="btn btn-primary btn-sm  d-inline-block float-right" data-toggle="modal"><span
                                    class="mdi mdi-plus .d-block d-sm-none"></span>
                            <span class="d-none d-sm-block createMenuItem">Add Menu Item</span> </a>
                        
                        <a href="" class="btn btn-success btn-sm d-inline-block float-right mr-2">
                            <span class="mdi mdi-refresh "></span> </a>
                        
                        <div class="dd" id="nestable">
                            {!! $menu !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create New Item Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form class="modal-content border-0 form-horizontal" role="form" action="{{route('admin.menu-builder.store')}}" method="POST">
                <div class="modal-header text-white">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close text-white" style="opacity:0.9;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="mdi mdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="master_menu_id" value="{{$mMasterMenu->id}}">
                    <input id="inpMethod" type="hidden" name="_method" value="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-12 control-label">Text</label>
                        <input id="inpText" type="text" name="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="label" class="col-12 control-label">Icon |
                            <a href="https://materialdesignicons.com/cdn/2.0.46/" target="_blank"><i class="mdi mdi-material-ui"></i> Material Design</a>
                            <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank"><i class="fa fa-flag"></i> Font Awesome</a>
                        </label>
                        <input id="inptIcon" type="text" name="icon" class="form-control" placeholder="e.g : mdi mdi-pencil or fa fa-pencil">
                    </div>
                    <div class="form-group">
                        <label for="inpRoute" class="col-12 control-label">Route name</label>
                        <select id="inpRoute" name="route" class="form-control selectpicker dropup " data-live-search="true" title="Subbranch..." data-container="body">
                            <option value=""></option>
                            <?php foreach (\Route::getRoutes() as $route) {
                                if(strpos($route->getName(),'admin') !== false &&
                                in_array('GET',$route->methods) &&
                                strpos($route->uri(),'{') === false ){ ?>
                                    <option value="{{ $route->getName() }}" data-tokens="ketchup mustard"> {{$route->getName()}} </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete item Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content border-0 form-horizontal" action="{{route("admin.menu-builder.destroy",['id'=>0])}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="hidden" name="delete_id" id="inpDelete" value=""/>

                <div class="modal-header text-white">
                    <h5 class="modal-title">Delete Menu Item</h5>
                    <button type="button" class="close text-white" style="opacity:0.9;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="mdi mdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this menu item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" value="Delete Item"/>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

