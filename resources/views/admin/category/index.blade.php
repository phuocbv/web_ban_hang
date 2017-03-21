@extends('layouts.admin.app')

@section('title')
    @lang('admin.categories')
@endsection

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    @lang('admin.list', ['name' => 'Category'])
                </h3>
            </div>

            <div class="col-lg-12">
                @include('admin.shared.flash')
            </div>

            @if (count($categories))
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th class="colum" width="10%">@lang('admin.label.index')</th>
                            <th class="colum">@lang('admin.category', ['name' => 'Name'])</th>
                            <th class="colum">@lang('admin.sort')</th>
                            <th class="colum" width="10%">@lang('admin.label.edit')</th>
                            <th class="colum" width="10%">@lang('admin.label.action')</th>
                            <th class="colum">@lang('admin.parent_category')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $key + 1 !!}</td>
                                <td><a href="#">{!! $category->name !!}</a></td>
                                <td>{!! $category->sort !!}</td>
                                <td class="center" width="10%">
                                    <i class="fa fa-pencil fa-fw edit" data-id="{{ $category->id }}"></i>
                                </td>
                                <td class="center" width="10%">   
                                    <i class="fa fa-trash" data-id="{{ $category->id }}"></i>
                                </td>
                                @if ($category->parent)
                                <td width="10%">
                                    {{ $category->parent->name }}
                                </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 align="center">@lang('admin.message.empty_data', ['name' => 'Category'])</h4>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('admin.edit-category')</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category-name">@lang('admin.category-name')</label>
                        <input type="text" class="form-control" id="category-name" placeholder="@lang('admin.category-name')">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
    <script type="text/javascript" src="{{ asset('bower_components/blockUI/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script src="{{ asset('admin/js/category.js') }}"></script>
    <script>
        var dttable = new dttable();
        var category = new category();
        $(function() {
            dttable.init('#dataTables-example');
            category.init({
                imageAwait: '{{ asset('/images/await.gif') }}'
            });
        });
    </script>
@endsection
