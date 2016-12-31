@extends("layouts.admin.app")

@section("content")
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
                                    <i class="fa fa-pencil fa-fw"></i>
                                </td>
                                <td class="center" width="10%">
                                    <i class="fa fa-trash"></i>
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

<div class="modal fade bs-example-modal-sm"
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        </div>
    </div>
</div>
@stop

@section('script')
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script>
        var dttable = new dttable();
        dttable.init('#dataTables-example');
    </script>
@endsection
