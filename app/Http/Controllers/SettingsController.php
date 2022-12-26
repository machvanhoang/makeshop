<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Constant\Constant;
use App\Models\Settings;
use Validator;

class SettingsController extends Controller
{
    public const SETTING_ID = 1;
    public function index(Request $request)
    {
        $setting = Settings::find(Constant::SETTING_ID);
        return view('setting', compact('setting'));
    }
    private function rule()
    {
        return [
            'shop_id' => 'required',
            'auth_code' => 'required',
            'process' => 'required',
            'response_format' => 'required',
        ];
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $role = $this->rule();
        $validator = Validator::make($data, $role);
        if ($validator->fails()) {
            return redirect()->back()->withInput();
        }
        $setting = Settings::find(Constant::SETTING_ID);
        if (empty($setting))
            return redirect()->route('home');
        $setting->shop_id = $data['shop_id'];
        $setting->auth_code = $data['auth_code'];
        $setting->process = $data['process'];
        $setting->access_token = $data['access_token'];
        $setting->response_format = $data['response_format'];
        if ($setting->save()) {
            return redirect()->route('settings.index')->with('_alert_data', 'Update Data successfully!!!');
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function parse_access_token(Request $request)
    {
        $data = $request->all();
        $validator =  Validator::make($data, [
            'url_parse' => 'required'
        ]);
        if ($validator->fails()) {
            dd('failse');
            return redirect()->back()->withInput();
        }
        $setting = Settings::find(Constant::SETTING_ID);
        if (empty($setting))
            return redirect()->route('home');
        $url_parse = $data['url_parse'];
        $string_decode = urldecode($url_parse);
        $access_token = str_replace("https://www.makeshop.jp/api/product/" . $setting->process . "/?shop_id=" . $setting->shop_id . "&access_token=", "", $string_decode);
        $setting->access_token = $access_token;
        if ($setting->save()) {
            return redirect()->route('settings.index')->with('_alert_token', 'Update Access TOKEN successfully!!!');
        } else {
            return redirect()->back()->withInput();
        }
    }
    
}
