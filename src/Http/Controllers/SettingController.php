<?php

namespace CmXperts\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use CmXperts\Settings\Notifications\SendTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Akaunting\Setting\Facade AS Setting;

class SettingController extends Controller
{

    public $data = [];

    public function __construct()
    {
        $this->data['sitetitle'] = 'Settings';
        $this->middleware(['permission:settings']);
    }

    // Site Setting
    public function index()
    {
        return view('cmxperts::settings.site');
    }

    public function siteSettingUpdate(Request $request)
    {

        $niceNames = [];
        $settingArray = $this->validate($request, $this->siteValidateArray(), [], $niceNames);

        if ($request->hasFile('site_logo')) {
            $site_logo = request('site_logo');
            $settingArray['site_logo'] = $site_logo->getClientOriginalName();
            $request->site_logo->move(public_path('images'), $settingArray['site_logo']);
        } else {
            unset($settingArray['site_logo']);
        }

        if (isset($settingArray['timezone'])) {
            $this->setEnv('APP_TIMEZONE', $settingArray['timezone']);
            Artisan::call('optimize:clear');
        }

        Setting::set($settingArray);
        Setting::save();

        return redirect(route('cmxperts.settings.index'))->withSuccess('The Site settings updated successfully');
    }

    // SMS Setting
    public function smsSetting()
    {
        return view('cmxperts::settings.sms');
    }

    public function smsSettingUpdate(Request $request)
    {
        $niceNames = [];
        $settingArray = $this->validate($request, $this->smsValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();
        return redirect(route('cmxperts.settings.sms'))->withSuccess('The SMS settings updated successfully.');
    }

    // email template Setting
    public function emailTemplateSetting()
    {
        return view('cmxperts::settings.email-template');
    }

    public function mailTemplateSettingUpdate(Request $request)
    {
        $niceNames = [];
        $settingArray = $this->validate($request, $this->emailTemplateValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();
        return redirect(route('cmxperts.settings.email-template'))->withSuccess('The Email & Sms template settings updated successfully.');
    }

    // EMail Setting
    public function emailSetting()
    {
        return view('cmxperts::settings.email');
    }

    public function emailSettingUpdate(Request $request)
    {
        $niceNames = [];
        $emailSettingArray = $this->validate($request, $this->emailValidateArray(), [], $niceNames);

        Setting::set($emailSettingArray);
        Setting::save();
        //$x = array();
        foreach($emailSettingArray AS $type => $val){
            if($type == 'mail_disabled')
                continue;
            //$x[strtoupper($type)] = $val;
            $this->overWriteEnvFile(strtoupper($type), $val);
        }
        return redirect(route('cmxperts.settings.email'))->withSuccess('The Email settings updated successfully');
    }

    public function emailSettingTest(Request $request)
    {
        $user = User::find(39);
        try {
            $user->notify(new SendTest());
        } catch (\Exception $e) {
            // Using a generic exception
            return $e;
        }
        return ['success' => true];
//        try {
//            Mail::to($request->mail_to_address)->send(new SendMail("Test Email", "Test Email"));
//        } catch (\Throwable $th) {
//            //throw $th;
//        }

    }

    // Notification Setting
    public function notificationSetting()
    {
        return view('cmxperts::settings.notification');
    }

    public function notificationSettingUpdate(Request $request)
    {

        $niceNames = [];
        $notificationSettingArray = $this->validate($request, $this->notificationValidateArray(), [], $niceNames);

        Setting::set($notificationSettingArray);
        Setting::save();

        return redirect(route('cmxperts.settings.notification'))->withSuccess('The Notification settings updated successfully.');
    }

    // Homepage Setting
    public function homepageSetting()
    {
        return view('cmxperts::settings.homepage');
    }

    public function homepageSettingUpdate(Request $request)
    {
        $niceNames = [];
        $settingArray = $this->validate($request, $this->frontendValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();

        return redirect(route('cmxperts.settings.homepage'))->withSuccess('The Home page settings updated successfully');
    }

    // Site Setting validation
    private function siteValidateArray()
    {
        return [
            'site_name' => 'required|string|max:100',
            'site_email' => 'required|string|max:100',
            'notify_email' => 'required|string|max:2000',
            'site_phone_number' => 'required', 'max:60',
            'site_footer' => 'required|string|max:200',
            'timezone' => 'required|string',
            'site_logo' => 'nullable|mimes:jpeg,jpg,png,gif|max:3096',
            'site_description' => 'required|string|max:500',
            'site_address' => 'required|string|max:500',
        ];
    }

    // SMS Setting validation
    private function smsValidateArray()
    {
        return [
            'twilio_auth_token' => 'required|string|max:200',
            'twilio_account_sid' => 'required|string|max:200',
            'twilio_from' => 'required|string|max:20',
            'twilio_disabled' => 'numeric',
        ];
    }


    // EMAIL Setting validation
    private function emailValidateArray()
    {
        return [
            'mail_host' => 'required|string|max:100',
            'mail_port' => 'required|string|max:100',
            'mail_username' => 'required|string|max:100',
            'mail_password' => 'required|string|max:100',
            'mail_encryption' => 'required|string|max:100',
            'mail_from_name' => 'required|string|max:100',
            'mail_from_address' => 'required|string|max:200',
            'mail_disabled' => 'numeric',
        ];
    }

    // `Notif`ication Setting validation
    private function notificationValidateArray()
    {
        return [
            'notifications_email' => 'nullable|string|max:100',
            'notifications_sms' => 'nullable|string|max:100',
        ];
    }

    // Notification Setting validation
    private function emailTemplateValidateArray()
    {
        return [
            'notify_templates' => 'nullable|string|max:150',
            'invite_templates' => 'nullable|string|max:150',
        ];
    }

    // Homepage Setting validation
    private function frontendValidateArray()
    {
        return [
            'front_end_enable_disable' => 'required|string|max:100',
            'visitor_agreement' => 'required|string|max:100',
            'welcome_screen' => 'nullable|string|max:255',
            'terms_condition' => 'nullable|string|max:255',
        ];
    }

    public function overWriteEnvFile($type, $val)
    {
        $error = "";
        $path = base_path('.env');
        if (file_exists($path)) {
            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                if ($type == 'APP_DEBUG') {
                    if (env($type) == true) {
                        file_put_contents($path, str_replace(
                            $type . '=true', $type . '=false', file_get_contents($path)
                        ));
                    } else {
                        file_put_contents($path, str_replace(
                            $type . '=false', $type . '=true', file_get_contents($path)
                        ));
                    }
                } else {
                    $val = '"' . trim($val) . '"';
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)
                    ));
                }
            } else {
                $val = '"' . trim($val) . '"';
                file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
            }
        } else {
            return "0";
        }
        if ($error)
            return "0";
        return "1";
    }

    public static function setEnv($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
            ));
        }
    }

}
