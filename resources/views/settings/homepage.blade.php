@extends('cmxperts::settings.index')

@section('settings.layout')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('cmxperts.settings.homepage-update') }}">
                     @csrf
                     <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.frontend_enable_disable') }}</legend>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group" id="">
                                     <label class="control-label" for="defaultUnchecked">{{__('settings.frontend_enable_disable')}}</label>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="front_end_enable_disable" {{ setting('front_end_enable_disable') == true ? "checked":"" }} value="1">{{__('settings.enable')}}
                                         </label>
                                     </div>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="front_end_enable_disable" {{ setting('front_end_enable_disable') == false ? "checked":"" }} value="0">{{__('settings.disable')}}
                                         </label>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group" id="">
                                     <label class="control-label" for="defaultUnchecked">{{ __('settings.visitor_agreement')}}</label>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="visitor_agreement" {{ setting('visitor_agreement') == true ? "checked":"" }} value="1">{{__('settings.enable')}}
                                         </label>
                                     </div>
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="visitor_agreement" {{ setting('visitor_agreement') == false ? "checked":"" }} value="0">{{__('settings.disable')}}
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </fieldset>

                    <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.welcome_screen_settings') }}</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="ckeditor" name="welcome_screen" id="comment">{{setting('welcome_screen')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('settings.terms_condition_settings') }}</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="ckeditor" name="terms_condition" id="terms_condition">{{setting('terms_condition')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                     <div class="row">
                         <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <span>{{ __('settings.update_frontend_settings') }}</span>
                            </button>
                         </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
@endsection
