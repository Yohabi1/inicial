@extends('admin.layouts.master')
@section('title',__('Settings'))
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>@lang('Language Manager') <a href="#addModal" data-toggle="modal" class="btn btn-dark btn-sm float-right"><i class="fa fa-plus"></i> @lang('Add New')</a> </h2>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Code')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lang_list as $data)
                        <tr id="row1">
                            <td>{{$data->name}}</td>
                            <td>{{$data->code}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('language-key', $data->id)}}"><i class="fa fa-code"></i>@lang('Keyword Edit')</a>
                                <a class="btn btn-primary" href="#editModal1{{$data->id}}" data-toggle="modal">@lang('Edit')</a>
                                <button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#delModal{{$data->id}}">@lang('Delete')</button>
                            </td>
                        </tr>

                    {{-- Edit Modal --}}
                    <div id="editModal1{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('Edit') {{$data->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" method="post" action="{{route('language-manage-update', $data->id)}}">
                                    <div class="modal-body">
                                        {{csrf_field()}}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <label class="control-label">@lang('Language Name')</label>
                                                    <input class="form-control text-capitalize" value="{{$data->name}}" id="code" type="text" required name="name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" id="btn-save" data-dismiss="modal" class="btn btn-sm btn-danger">@lang('Cancel')</button>
                                            <button type="submit" class="btn btn-sm btn-success"> @lang('Update')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Delete Modal --}}
                    <div id="delModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('Confirm Delete') {{$data->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="text-danger">@lang('Are you sure?')</h2>
                                </div>
                                <form id="confirmDel" role="form" action="{{route('language-manage-del', $data->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-footer">
                                        <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                                        <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    {{-- Add Modal --}}
    <div id="addModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New Language')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('language-manage-store')}}">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Language Name')</label>
                                    <input class="form-control text-capitalize" id="code" type="text" required name="name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Language Code')</label>
                                    <input class="form-control text-capitalize" id="link" type="text" required name="code">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">@lang('Cancel')</button>
                            <button type="submit" id="btn-save" class="btn btn-sm btn-success"> @lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop