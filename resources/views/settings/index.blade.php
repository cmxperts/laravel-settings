@extends('layout.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/bootstrap-select/bootstrap-select.min.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/forms/switch-theme.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    {!! Html::style('plugins/summernote/summernote-bs4.css') !!}
    {!! Html::style('assets/css/forms/form-widgets.css') !!}
@endpush

@section('content')
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <div class="navbar-nav flex-column">
                <h2>{{__('settings.settings')}}</h2>
            </div>
            <ul class="navbar-nav d-flex align-center ml-auto right-side-filter flex-column">
                <li>
                    <i class="las la-angle-double-right"></i>
                    <span id="currentDate"></span>
                </li>
            </ul>
        </header>
    </div>

    <div class="content px-3">
        <div class="row layout-top-spacing data-table-container">
            <div class="col-md-3">
                <div class="bg-light card">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('cmxperts.settings.index') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix'))) ? 'active' : '' }} ">{{ __('settings.site_settings') }}</a>
                        <a href="{{ route('cmxperts.settings.sms') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix').'/sms')) ? 'active' : '' }}">{{ __('settings.sms_settings') }}</a>
                        <a href="{{ route('cmxperts.settings.email') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix').'/email')) ? 'active' : '' }}">{{ __('settings.email_settings') }}</a>
                        <a href="{{ route('cmxperts.settings.notification') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix').'/notification')) ? 'active' : '' }}">{{ __('settings.notification_settings') }}</a>
                        <a href="{{ route('cmxperts.settings.email-template') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix').'/emailtemplate')) ? 'active' : '' }}">{{ __('settings.email_sms_template_settings') }}</a>
                        <a href="{{ route('cmxperts.settings.homepage') }}"
                           class="list-group-item list-group-item-action {{ (request()->is(config('cmx_settings.route_prefix').'/homepage')) ? 'active' : '' }}">{{ __('settings.frontend_settings') }}</a>
                    </div>
                </div>
            </div>

            @yield('settings.layout')
        </div>
    </div>

@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('assets/js/forms/forms-validation.js') !!}
    {!! Html::script('plugins/bootstrap-select/bootstrap-select.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
    {!! Html::script('plugins/summernote/summernote-bs4.js') !!}
@endpush
