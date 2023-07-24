@extends('cmxperts::settings.index')

@section('settings.layout')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('cmxperts.settings.site-update') }}"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="setting-fieldset">
                    <legend class="setting-legend">{{ __('settings.general_settings') }}</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="site_name">{{ __('settings.site_name') }}</label>
                                <span class="text-danger">*</span>
                                <input name="site_name" id="site_name" type="text"
                                    class="form-control @error('site_name') is-invalid @enderror"
                                    value="{{ old('site_name', setting('site_name')) }}">
                                @error('site_name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label
                                    for="site_phone_number">{{ __('settings.site_phone_number') }}</label>
                                <span class="text-danger">*</span>
                                <input name="site_phone_number" id="site_phone_number" type="text"

                                    class="form-control @error('site_phone_number') is-invalid @enderror"
                                    value="{{ old('site_phone_number', setting('site_phone_number')) }}">
                                @error('site_phone_number')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="site_footer">{{ __('settings.site_footer') }}</label> <span
                                    class="text-danger">*</span>
                                <input name="site_footer" id="site_footer"
                                    class="form-control @error('site_footer') is-invalid @enderror"
                                    value="{{ old('site_footer', setting('site_footer')) }}">
                                @error('site_footer')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="site_address">{{ __('settings.site_address') }}</label> <span
                                    class="text-danger">*</span>
                                <textarea name="site_address" id="site_address" cols="30" rows="3"
                                          class="form-control small-textarea-height @error('site_address') is-invalid @enderror">{{ old('site_address', setting('site_address')) }}</textarea>
                                @error('site_address')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <!-- Files Field -->
                            <div class="form-group">
                                {!! Form::label('logo', __('settings.site_logo').':') !!}
                                <div class="input-group" data-toggle="cmxuploader" data-type="all"  data-multiple="true" >
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('global.browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('global.choose_file') }}</div>
                                    <input type="hidden" name="site_logo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="site_email">{{ __('settings.site_email') }}</label> <span
                                    class="text-danger">*</span>
                                <input name="site_email" id="site_email"
                                    class="form-control @error('site_email') is-invalid @enderror"
                                    value="{{ old('site_email', setting('site_email')) }}">
                                @error('site_email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="timezone">{{ __('settings.timezone') }}</label> <span
                                    class="text-danger">*</span>
                                <?php
                                        $className = 'form-control';
                                        if($errors->first('timezone')) {
                                            $className = 'form-control is-invalid';
                                        }
                                        echo Timezonelist::create('timezone', setting('timezone') , ['class'=> $className]); ?>
                                @error('timezone')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="site_description">{{ __('settings.description') }}</label> <span
                                    class="text-danger">*</span>
                                <textarea name="site_description" id="site_description" cols="30" rows="3"
                                    class="form-control small-textarea-height @error('site_description') is-invalid @enderror">{{ old('site_description', setting('site_description')) }}</textarea>
                                @error('site_description')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-primary">
                            <span>{{ __('settings.update_site_settings') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
