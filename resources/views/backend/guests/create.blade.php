@extends('backend.theme.layout.app')

@section('styles')
    @include('backend.guests.incs._styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-blue">{{ $title }}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{route('guests.index')}}" data-toggle="tooltip" title="{{ trans('main.show-all') }}   {{ trans('main.guests') }}"> <i class="fa fa-list"></i> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{ route('guests.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                        @csrf
                        @include('backend.guests.incs._fields', [
                            'data' => collect(old()),
                            'action' => 'create'
                        ])
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn green">{{ trans('main.add') }} {{ trans('main.guest') }}</button>
                                    <a href="{{ route('guests.index') }}" class="btn default">{{ trans('main.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @include('backend.guests.incs._scripts', [
        'data' => collect(old())
    ])
@endsection
