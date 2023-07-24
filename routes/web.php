<?php

use CmXperts\Settings\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => '\CmXperts\Settings\Http\Controllers',
    'middleware' => config('cmx_settings.middleware'),
    'prefix' => config('cmx_settings.route_prefix'),
    'as' => 'cmxperts.settings.'
], function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/', [SettingController::class, 'siteSettingUpdate'])->name('site-update');
    Route::get('sms', [SettingController::class, 'smsSetting'])->name('sms');
    Route::post('sms', [SettingController::class, 'smsSettingUpdate'])->name('sms-update');
    Route::get('email', [SettingController::class, 'emailSetting'])->name('email');
    Route::post('email', [SettingController::class, 'emailSettingUpdate'])->name('email-update');
    Route::post('test-email', [SettingController::class, 'emailSettingTest'])->name('email-test');
    Route::get('notification', [SettingController::class, 'notificationSetting'])->name('notification');
    Route::post('notification', [SettingController::class, 'notificationSettingUpdate'])->name('notification-update');
    Route::get('emailtemplate', [SettingController::class, 'emailTemplateSetting'])->name('email-template');
    Route::post('emailtemplate', [SettingController::class, 'mailTemplateSettingUpdate'])->name('email-template-update');
    Route::get('homepage', [SettingController::class, 'homepageSetting'])->name('homepage');
    Route::post('homepage', [SettingController::class, 'homepageSettingUpdate'])->name('homepage-update');
});
