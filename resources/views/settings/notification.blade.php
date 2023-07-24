@extends('cmxperts::settings.index')

@section('settings.layout')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('cmxperts.settings.notification-update') }}">
                     @csrf
                     <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.notification_settings') }}</legend>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group" id="">
                                     <label class="control-label" for="defaultUnchecked">{{__('settings.email_notifications')}}</label>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="notifications_email" {{ setting('notifications_email') == true ? "checked":"" }} value="1">{{__('settings.enable')}}
                                         </label>
                                     </div>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="notifications_email" {{ setting('notifications_email') == false ? "checked":"" }} value="0">{{__('settings.disable')}}
                                         </label>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group" id="">
                                     <label class="" for="defaultUnchecked">{{__('settings.sms_notifications')}}</label>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="notifications_sms" {{ setting('notifications_sms') == true ? "checked":"" }} value="1">{{__('settings.enable')}}
                                         </label>
                                     </div>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="notifications_sms" {{ setting('notifications_sms') == false ? "checked":"" }} value="0">{{__('settings.disable')}}
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </fieldset>
                     <div class="row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span>{{ __('settings.update_notification_settings') }}</span>
                            </button>
                        </div>
                     </div>
                 </form>
            </div>
        </div>
    </div>
@endsection
