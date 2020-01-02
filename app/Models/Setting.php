<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/12/27
 * Time: 16:17
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function add(array $data)
    {
        $setting = new Setting();

        $setting->name = $data['name'] ?? '';
        $setting->logo = $data['logo'] ?? '';
        $setting->url = $data['url'] ?? '';
        $setting->copyright = $data['copyright'] ?? '';
        $setting->hotline = $data['hotline'] ?? '';
        $setting->contact = $data['contact'] ?? '';
        $setting->mobile = $data['mobile'] ?? '';
        $setting->email = $data['email'] ?? '';
        $setting->record_sn = $data['record_sn'] ?? '';
        $setting->address = $data['address'] ?? '';
        $setting->statistics = $data['statistics'] ?? '';

        return $setting->save();

    }

    public static function edit(Setting $setting, array $data)
    {

        $setting->name = $data['name'] ?? '';
        $setting->logo = $data['logo'] ?? '';
        $setting->url = $data['url'] ?? '';
        $setting->copyright = $data['copyright'] ?? '';
        $setting->hotline = $data['hotline'] ?? '';
        $setting->contact = $data['contact'] ?? '';
        $setting->mobile = $data['mobile'] ?? '';
        $setting->email = $data['email'] ?? '';
        $setting->record_sn = $data['record_sn'] ?? '';
        $setting->address = $data['address'] ?? '';
        $setting->statistics = $data['statistics'] ?? '';

        return $setting->update();

    }
}