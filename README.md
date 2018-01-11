# ThailandJS for Laravel Framework
จากตัวที่กรอกที่อยู่ที่ดีที่สุดในไทยถูกปรับให้ใช้งานกับ Laravel ได้ง่ายขึ้น

[![Latest Stable Version](https://poser.pugx.org/baraear/laravel-thailand-js/v/stable)](https://packagist.org/packages/baraear/laravel-thailand-js)
[![Latest Unstable Version](https://poser.pugx.org/baraear/laravel-thailand-js/v/unstable)](https://packagist.org/packages/baraear/laravel-thailand-js)
[![License](https://poser.pugx.org/baraear/laravel-thailand-js/license)](https://packagist.org/packages/baraear/laravel-thailand-js)
[![Total Downloads](https://poser.pugx.org/baraear/laravel-thailand-js/downloads)](https://packagist.org/packages/baraear/laravel-thailand-js)
[![StyleCI](https://styleci.io/repos/116953641/shield?style=flat&branch=master)](https://styleci.io/repos/116953641)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/baraear/laravel-thailand-js.svg?branch=master)](https://scrutinizer-ci.com/g/baraear/laravel-thailand-js/?branch=master)

### การติดตั้ง
1. คุณสามารถติดตั้งแพคเกจนี้ได้ผ่านทาง Composer
```sh
composer require baraear/laravel-thailand-js
```
2. เมื่อติดตั้งเสร็จแล้วให้ทำการเพิ่ม Service Provider ของแพคเกจที่ไฟล์ `config/app.php`
```php
/*
 * Package Service Providers...
 */
Baraear\ThailandJS\ThailandJSServiceProvider::class,
```
3. ทำการเพิ่ม Facade ของแพคเกจที่ไฟล์ `config/app.php`
```php
/*
 * Package Service Providers...
 */
'aliases' => [
    'ThailandJS' => Baraear\ThailandJS\ThailandJSFacade::class,
]
```
4. ปรับปรุงไฟล์ `autoload.php`
```sh
composer dump-autoload
```
### การตั้งค่า
1. สร้างไฟล์สำหรับการตั้งค่าของแพคเกจ
```sh
php artisan vendor:publish --provider="Baraear\ThailandJS\ThailandJSServiceProvider" --tag="config"
```
2. ตรวจสอบการตั้งค่าที่ไฟล์ `config/thailandjs.php`
```php
<?php

return [
    /*
     * หากคุณใช้ laravel-mix ในการ compile asset files.
     */
    'use-mix' => false,

    'path' => [
        /*
         * ระบุ path ของไฟล์ .js ในกรณีที่คุณไม่ได้ใช้ laravel-mix
         */
        'js' => '/js/laravel-thailand-js',

        /*
         * ระบุ path ของไฟล์ .css ในกรณีที่คุณไม่ได้ใช้ laravel-mix
         */
        'css' => '/css/laravel-thailand-js',
    ],
];

```
### การใช้งาน
##### 1. กรณีที่ไม่ได้ใช้งาน `laravel-mix`
1. คัดลอกไฟล์ resoruces ที่จำเป็นสำหรับใช้งาน
```sh
php artisan vendor:publish --provider="Baraear\ThailandJS\ThailandJSServiceProvider" --tag="resources"
```
2. การประกาศใช้งานไฟล์ javascript และ stylesheet ในไฟล์ `.blade.php`
```php
// สำหรับประกาศใช้งาน stylesheet ทั้งหมดที่จำเป็นจะต้องใช้งาน
{!! ThailandJS::styles(); !!}

// สำหรับประกาศใช้งาน javascript ทั้งหมดที่จำเป็นจะต้องใช้งาน
{!! ThailandJS::scripts(); !!}
```
> หากมีการเปิดใช้งาน `use-mix` ฟังก์ชั่นดังกล่าวจะไม่ส่งผลใดๆ
3. การประกาศใช้งานฟังก์ชั่นของ `jquery.Thailand.js`
```php
/**
 * Render ThailandJS JavaScript function.
 *
 * @param array|string $attributes
 * @param string $onLoad
 * @param bool $log
 */
{!! ThailandJS::render(['district' => '#demo1 [name="district"]', 'amphoe' => '#demo1 [name="amphoe"]', 'province' => '#demo1 [name="province"]', 'zipcode' => '#demo1 [name="zipcode"]', ], '#loader, .demo', false); !!}

/**
 * Render ThailandJS JavaScript search function.
 *
 * @param string $searchable
 * @param string $prepend
 * @param string $onLoad
 * @param bool $log
 */
{!! ThailandJS::search('#demo2 [name="search"]', '#demo2-output', '#loader, .demo', false); !!}
```
> หากไม่ได้กำหนดพารามิเตอร์แพคเกจจะทำการกำหนดให้ตามแบบตัวอย่างของ `jquery.Thailand.js`

###### ตัวอย่างไฟล์ `index.html` ของ `jquery.Thailand.js` เมื่อถูกปรับใช้กับ Laravel Framework โหมดกรอกข้อมูล
```html
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>jquery.Thailand.js</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    {!! ThailandJS::styles(); !!}

</head>
<body>

    <div class="uk-container uk-padding">

        <h1>Auto Complete ที่อยู่ อย่างที่มันควรเป็น</h1>

        <div id="loader">
            <div uk-spinner></div> รอสักครู่ กำลังโหลดฐานข้อมูล...
        </div>

        <form id="demo1" class="demo" style="display:none;" autocomplete="off" uk-grid >

            <div class="uk-width-1-2@m">
                <label class="h2">ตำบล / แขวง</label>
                <input name="district" class="uk-input uk-width-1-1" type="text">
            </div>

            <div class="uk-width-1-2@m">
                <label class="h2">อำเภอ / เขต</label>
                <input name="amphoe" class="uk-input uk-width-1-1" type="text">
            </div>

            <div class="uk-width-1-2@m">
                <label class="h2">จังหวัด</label>
                <input name="province" class="uk-input uk-width-1-1" type="text">
            </div>

            <div class="uk-width-1-2@m">
                <label class="h2">รหัสไปรษณีย์</label>
                <input name="zipcode" class="uk-input uk-width-1-1" type="text">
            </div>

        </form>
        
    </div>
    
    {!! ThailandJS::scripts(); !!}
    {!! ThailandJS::render(['district' => '#demo1 [name="district"]', 'amphoe' => '#demo1 [name="amphoe"]', 'province' => '#demo1 [name="province"]', 'zipcode' => '#demo1 [name="zipcode"]', ], '#loader, .demo', false); !!}
    
</body>
</html>
```
###### ตัวอย่างไฟล์ `index.html` ของ `jquery.Thailand.js` เมื่อถูกปรับใช้กับ Laravel Framework โหมดค้นหา
```html
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>jquery.Thailand.js</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    {!! ThailandJS::styles(); !!}

</head>
<body>

    <div class="uk-container uk-padding">

        <h1>Auto Complete ที่อยู่ อย่างที่มันควรเป็น</h1>

        <div id="loader">
            <div uk-spinner></div> รอสักครู่ กำลังโหลดฐานข้อมูล...
        </div>
        
        <form id="demo2" class="demo" style="display:none;" autocomplete="off">
            <label class="h2">ค้นหาที่อยู่ของคุณ</label>
            <small>ลองกรอกอย่างใดอย่างหนึ่ง ตำบล, อำเภอ, จังหวัด หรือ รหัสไปรษณีย์</small>
            <input name="search" class="uk-input uk-width-1-1" type="text">

            <div id="demo2-output" class="uk-margin"></div>
        </form>
        
    </div>
    
    {!! ThailandJS::scripts(); !!}
    {!! ThailandJS::search('#demo2 [name="search"]', '#demo2-output', '#loader, .demo', false); !!}
    
</body>
</html>
```
##### 2. กรณีที่ไม่ได้ใช้งาน `laravel-mix`
> กำลังอยู่ในระหว่างการพัฒนา...
### การเปลี่ยนแปลง
คุณสามารถตรวจสอบการเปลี่ยนแปลงของแต่ละเวอร์ชั่นได้ที่ [CHANGELOG.md](https://github.com/baraear/laravel-thailand-js/blob/master/CHANGELOG.md).
### การพัฒนา
คุณสามารถตรวจสอบคุณสมบัติใหม่ที่กำลังจะถูกเพิ่มเข้ามาในเวอร์ชั่นถัดไปได้ที่ [TODO.md](https://github.com/baraear/laravel-thailand-js/blob/master/TODO.md).
### การอนุญาต
แพคเกจ `laravel-thailand-js` เป็นซอฟต์แวร์โอเพนซอร์สภายใต้การอนุญาต [MIT license](https://github.com/baraear/laravel-thailand-js/blob/master/LICENSE).