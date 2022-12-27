<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Constant\Constant;
use App\Models\Settings;
use App\Models\Products;
use App\Models\LogHistory;
use Carbon\Carbon;
use Validator;

class AsyncController extends Controller
{
    public function index(Request $request)
    {
        $setting = Settings::select('total_product')->find(Constant::SETTING_ID);
        $last_checking = LogHistory::where('type', Constant::CHECKING)->orderBy('id', 'desc')->first();
        $last_async = LogHistory::where('type', Constant::ASYNC)->orderBy('id', 'desc')->first();
        return view(
            'async',
            compact('setting', 'last_checking', 'last_async')
        );
    }
    public function total_product(Request $request)
    {
        $data = $request->all();
        $validator =  Validator::make($data, [
            'total_product' => 'required'
        ]);
        if ($validator->fails()) {
            dd('failse');
            return redirect()->back()->withInput();
        }
        $setting = Settings::find(Constant::SETTING_ID);
        if (empty($setting))
            return redirect()->route('home');
        $setting->total_product = $data['total_product'];
        if ($setting->save()) {
            return redirect()->route('async.index')->with('_alert_total', '総製品を正常に更新!!!');
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function checking(Request $request)
    {
        $setting = Settings::find(Constant::SETTING_ID);
        $total_product = $setting->total_product;
        $All_PAGE = (int)ceil($total_product / 50);
        $data_checking = [];
        $data_checking['time_start'] = Carbon::now();
        for ($page = 1; $page <= $All_PAGE; $page++) {
            $ch = curl_init('https://www.makeshop.jp/api/product/search/?shop_id=' . $setting->shop_id . '&access_token=' . $setting->access_token);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POSTFIELDS => array(
                    'display_page' => $page,
                    'response_format' => 'json'
                )
            ));
            $data = curl_exec($ch);
            curl_close($ch);
            Storage::disk('public')->put('Page_' . $page . '.json', $data);
        }
        $data_checking['time_end'] = Carbon::now();
        $data_checking['type']     = Constant::CHECKING;
        LogHistory::create($data_checking);
        return redirect()->route('async.index')->with('_alert_checking', 'データのチェックに成功しました!!!');
    }
    private function saveDataProduct($product_list)
    {
        foreach ($product_list as $key => $item) {
            $this->createProduct($item);
        }
    }
    public function async(Request $request)
    {
        $store_path = storage_path('app/public');
        $array_folder = scandir($store_path);
        unset($array_folder[0]);
        unset($array_folder[1]);
        unset($array_folder[2]);
        $data_async['time_start'] = Carbon::now();
        foreach ($array_folder as $key => $item) {
            $real_path = $store_path . "/" . $item;
            $json = file_get_contents($real_path);
            $data = json_decode($json);
            $result_data = $data->result_data;
            if (!empty($result_data->product_list)) {
                $this->saveDataProduct($result_data->product_list);
            }
        }
        $data_async['time_end'] = Carbon::now();
        $data_async['type']     = Constant::ASYNC;
        LogHistory::create($data_async);
        return redirect()->route('async.index')->with('_alert_async', 'データのチェックに成功しました!!!');
    }
    public function async_single(Request $request)
    {
        try {
            $setting = Settings::find(Constant::SETTING_ID);
            $brand_code = $request->get('brand_code');
            $ch = curl_init('https://www.makeshop.jp/api/product/search/?shop_id=' . $setting->shop_id . '&access_token=' . $setting->access_token);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POSTFIELDS => array(
                    'display_page' => 1,
                    'response_format' => 'json',
                    'brand_code'   => $brand_code
                )
            ));
            $data = curl_exec($ch);
            curl_close($ch);
            $obj_json = json_decode($data);
            $result_data = $obj_json->result_data;
            if ($result_data->status_code == 200) {
                if (!empty($result_data->product_list)) {
                    $item = $result_data->product_list[0];
                    $product = Products::where('product_id', $item->product_id)->first();
                    if (empty($product)) {
                        $this->createProduct($item);
                    } else {
                        $this->updateProduct($product, $item);
                    }
                    return redirect()->route('async.index')->with('_alert_async', '単一製品の同期に成功しました !!!');
                }
                return redirect()->route('async.index')->with('_alert_async', 'データの同期に成功しました!!!');
            } else {
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    private function createProduct($item)
    {
        $data = [];
        $data['product_id'] = $item->product_id;
        $data['brand_code'] = $item->brand_code;
        $data['ubrand_code'] = $item->ubrand_code;
        $data['is_display'] = $item->is_display;
        $data['is_member_only'] = $item->is_member_only;
        $data['product_name'] = $item->product_name;
        $data['product_page_url'] = $item->product_page_url;
        $data['weight'] = !empty($item->weight) ? $item->weight : 0;
        $data['price'] = !empty($item->price) ? $item->price : 0;
        $data['consumption_tax_rate'] = $item->consumption_tax_rate;
        $data['jancode'] = $item->jancode;
        $data['vendor'] = $item->vendor;
        $data['origin'] = $item->origin;
        $data['stock'] = !empty($item->stock) ? (int)$item->stock : 0;
        $data['is_diplay_stock'] = !empty($item->is_diplay_stock) ? $item->is_diplay_stock : 0;
        $data['zoom_image_url'] = $item->zoom_image_url;
        $data['price_tax'] = round($item->price * (1 + ((float)$item->consumption_tax_rate / 100)));
        $product = Products::create($data);
        if ($product->is_display == 'N') {
            $product->delete();
        }
    }
    private function updateProduct($product, $item)
    {
        $product->product_id = $item->product_id;
        $product->brand_code = $item->brand_code;
        $product->ubrand_code = $item->ubrand_code;
        $product->is_display = $item->is_display;
        $product->is_member_only = $item->is_member_only;
        $product->product_name = $item->product_name;
        $product->product_page_url = $item->product_page_url;
        $product->weight = !empty($item->weight) ? $item->weight : 0;
        $product->price = !empty($item->price) ? $item->price : 0;
        $product->consumption_tax_rate = $item->consumption_tax_rate;
        $product->jancode = $item->jancode;
        $product->vendor = $item->vendor;
        $product->origin = $item->origin;
        $product->stock = !empty($item->stock) ? (int)$item->stock : 0;
        $product->is_diplay_stock = !empty($item->is_diplay_stock) ? $item->is_diplay_stock : 0;
        $product->zoom_image_url = $item->zoom_image_url;
        $product->price_tax = round($product->price * (1 + ((float)$product->consumption_tax_rate / 100)));
        $product->save();
        if ($product->is_display == 'N') {
            $product->delete();
        }
    }
}
