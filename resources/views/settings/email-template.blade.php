@extends('cmxperts::settings.index')

@section('settings.layout')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('cmxperts.settings.email-template-update') }}">
                     @csrf
                     <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.email_sms_template_settings') }}</legend>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="comment">{{__('settings.notifications_templates')}}</label>
                                     <textarea class="ckeditor" name="notify_templates">{{ setting('notify_templates') }}</textarea>
                                 </div>
                                 <div class="form-group">
                                     <label for="comment">{{__('settings.invite_templates')}}</label>
                                     <textarea class="ckeditor" name="invite_templates">{{setting('invite_templates')}}</textarea>
                                 </div>
                             </div>
                         </div>
                    </fieldset>
                     <div class="row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span>{{ __('settings.update_email_sms_template_settings') }}</span>
                            </button>
                        </div>
                     </div>
                 </form>
            </div>
        </div>
    </div>
@endsection
