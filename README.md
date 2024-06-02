<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 飲食店予約システム
![表面](https://github.com/yuriF5/advance/assets/152612024/c8a5ee9d-0132-4a73-8e9f-2d23fc6853e4)


管理者メニュー

<img src="https://github.com/yuriF5/advance/assets/152612024/a672fc63-4189-40fd-890c-cea3fdcc48cf" width="30%">

店舗代表者メニュー

<img src="https://github.com/yuriF5/advance/assets/152612024/c0717f45-34c5-4867-b6aa-2a3e4ab81e72" width="30%">




## 作成した目的
ある会社のとあるアプリ開発の勉学の為に作成しました。

## 当アプリケーションURLと関連URL
- https://github.com/yuriF5/Advance

  ※PC：Chrome/Firefox/Safari 最新バージョンを使用対象の為不足していると意図した画面が表示されない可能性があります。

- 開発環境：http://localhost/
- phpMyAdmin:http://localhost:8080/

git clone git@github.com:estra-inc/confirmation-test-contact-form.git
※ご使用のphp等のversionに適したversionに必ず修正してください。意図しない表示がされます。

## 機能一覧
ログイン機能、メール認証、お気に入り追加/削除、予約追加/変更/削除、検索、レビュー、リマインドメール送信、QRコードで予約認証、決済機能  
管理者権限で店舗代表者作成、ユーザー一覧閲覧、お知らせメール送信  
店舗代表者権限で店舗情報の作成/更新、予約確認/変更/削除  新規店舗追加ストレージで画像追加

## 仕様技術
docker、Laravel 8.x、PHP8.1.2 4、laravel-fortify、laravel-permission、Stripe、javascript

## テーブル設計及びER図

![ER最終](https://github.com/yuriF5/advance/assets/152612024/4dd2851f-00c1-4604-bcc2-45ae51bb0d8e)
![テーブル１](https://github.com/yuriF5/advance/assets/152612024/9af6adb8-e937-4920-a399-98ddfcbfd4bc)
![テーブル２](https://github.com/yuriF5/advance/assets/152612024/dcccd2ea-8e63-44e5-8d5b-f35f3bd3e0a3)
![テーブル３](https://github.com/yuriF5/advance/assets/152612024/61485a76-c3e8-428a-96b9-b59689d05c7d)


## 環境構築
### コマンドライン上
```
$ git clone 
```

```php
$ docker compose up -d --build
$ docker compose exec php bash
```
### PHPコンテナ内
```php
$ composer install
```

### src上
```php
$ cp .env.local .env
```

### PHPコンテナ内
```php
$ php artisan key:generate
$ php artisan migrate --seed
```

### src上
```php
$ sudo chmod -R 777 *
```

## ダミーデータの説明
### ユーザー一覧
1. 管理者　　　email: admin@admin.com
2. 店舗代表者　email: shop@shop.com
3. ユーザー　　email: test@test.com  

※パスワードは全て"password"でログインできます。