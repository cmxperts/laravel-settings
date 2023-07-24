@extends('cmxperts::settings.index')

@section('settings.layout')
     <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('cmxperts.settings.sms-update') }}">
                    @csrf
                    <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.sms_settings') }}</legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="twilio_auth_token">{{ __('settings.twilio_auth_token') }}</label> <span
                                        class="text-danger">*</span>
                                    <input name="twilio_auth_token" id="twilio_auth_token" type="text"
                                        class="form-control {{ $errors->has('twilio_auth_token') ? ' is-invalid ' : '' }}"
                                        value="{{ old('twilio_auth_token', setting('twilio_auth_token')) }}">
                                    @if ($errors->has('twilio_auth_token'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('twilio_auth_token') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="twilio_from">{{ __('settings.twilio_from') }}</label> <span
                                        class="text-danger">*</span>
                                    <input name="twilio_from" id="twilio_from" type="text"
                                        class="form-control {{ $errors->has('twilio_from') ? ' is-invalid ' : '' }}"
                                        value="{{ old('twilio_from', setting('twilio_from')) }}">
                                    @if ($errors->has('twilio_from'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('twilio_from') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="twilio_account_sid">{{ __('settings.twilio_account_sid') }}</label>
                                    <span class="text-danger">*</span>
                                    <input name="twilio_account_sid" id="twilio_account_sid" type="text"
                                        class="form-control {{ $errors->has('twilio_account_sid') ? ' is-invalid ' : '' }}"
                                        value="{{ old('twilio_account_sid', setting('twilio_account_sid')) }}">
                                    @if ($errors->has('twilio_account_sid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('twilio_account_sid') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('settings.status') }}</label> <span class="text-danger">*</span>
                                    <select name="twilio_disabled" id="twilio_disabled"
                                        class="form-control @error('twilio_disabled') is-invalid @enderror">
                                        <option value="1" {{ (old('twilio_disabled', setting('twilio_disabled')) == 1) ? 'selected' : '' }}> {{ __('settings.enable') }}</option>
                                        <option value="0" {{ (old('twilio_disabled', setting('twilio_disabled')) == 0) ? 'selected' : '' }}> {{ __('settings.disable') }}</option>
                                    </select>
                                    @error('twilio_disabled')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-primary">
                                <span>{{ __('settings.update_sms_settings') }}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
