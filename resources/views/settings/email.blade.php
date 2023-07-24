@extends('cmxperts::settings.index')

@section('settings.layout')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" id="email-setting-form" role="form" method="POST" action="{{ route('cmxperts.settings.email-update') }}">
                    @csrf
                    <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.email_settings') }}</legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mail_host">{{ __('settings.mail_host') }}</label> <span class="text-danger">*</span>
                                    <input name="mail_host" id="mail_host" type="text"
                                        class="form-control @error('mail_host') is-invalid @enderror"
                                        value="{{ old('mail_host', setting('mail_host')) }}">
                                    @error('mail_host')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mail_username">{{ __('settings.mail_username') }}</label> <span
                                        class="text-danger">*</span>
                                    <input name="mail_username" id="mail_username" type="text"
                                        class="form-control @error('mail_username') is-invalid @enderror"
                                        value="{{ old('mail_username', setting('mail_username')) }}">
                                    @error('mail_username')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mail_from_name">{{ __('settings.mail_from_name') }}</label> <span
                                        class="text-danger">*</span>
                                    <input name="mail_from_name" id="mail_from_name" type="text"
                                        class="form-control @error('mail_from_name') is-invalid @enderror"
                                        value="{{ old('mail_from_name', setting('mail_from_name')) }}">
                                    @error('mail_from_name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{ __('settings.status') }}</label> <span class="text-danger">*</span>
                                    <select name="mail_disabled" id="mail_disabled"
                                        class="form-control @error('mail_disabled') is-invalid @enderror">
                                        <option value="1" {{ (old('mail_disabled', setting('mail_disabled')) == 1) ? 'selected' : '' }}> {{ __('settings.enable') }}</option>
                                        <option value="0" {{ (old('mail_disabled', setting('mail_disabled')) == 0) ? 'selected' : '' }}> {{ __('settings.disable') }}</option>
                                    </select>
                                    @error('mail_disabled')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mail_port">{{ __('settings.mail_port') }}</label> <span class="text-danger">*</span>
                                    <input name="mail_port" id="mail_port" class="form-control @error('mail_port') is-invalid @enderror"
                                        value="{{ old('mail_port', setting('mail_port')) }}">
                                    @error('mail_port')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mail_password">{{ __('settings.mail_password') }}</label> <span
                                        class="text-danger">*</span>
                                    <input name="mail_password" id="mail_password" type="text"
                                        class="form-control @error('mail_password') is-invalid @enderror"
                                        value="{{ old('mail_password', setting('mail_password')) }}">
                                    @error('mail_password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mail_from_address">{{ __('settings.mail_from_address') }}</label>
                                    <span class="text-danger">*</span>
                                    <input name="mail_from_address" id="mail_from_address" cols="30" rows="2"
                                        class="form-control @error('mail_from_address') is-invalid @enderror" value="{{ old('mail_from_address', setting('mail_from_address')) }}">
                                    @error('mail_from_address')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mail_encryption">{{ __('settings.mail_encryption') }}</label>
                                    <span class="text-danger">*</span>
                                    <select id="mail_encryption" name="mail_encryption" class="form-control @error('mail_encryption') is-invalid @enderror">
                                        <option value="" {{ (setting('mail_encryption') == '') ? 'selected' : '' }}>None</option>
                                        <option value="tls" {{ (setting('mail_encryption') == 'tls') ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ (setting('mail_encryption') == 'ssl') ? 'selected' : '' }}>SSL</option>
                                    </select>
                                    @error('mail_encryption')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" onclick="sendTestMail()">
                                        <span>{{ __('settings.send_test_email') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <span>{{ __('settings.update_email_settings') }}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script type="text/javascript">
        function sendTestMail(){
            var testData = new FormData($('#email-settings-form')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('cmxperts.settings.email-test') }}',
                data: testData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    if (result.success == true) {
                        CMX.plugin.notify('success','Mail Successfully Sent!');
                    } else {
                        CMX.plugin.notify('error','Error Sending Mail!');
                    }
                },
                error: function (err) {
                    CMX.plugin.notify('error',err);
                }
            });

        }
    </script>
@endpush
