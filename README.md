<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 飲食店予約システム


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

## 店舗の新規作成、更新方法
1. 店舗代表者　email: shop@shop.comでログイン
2. "店舗代表者作成"で店舗代表者権限を持つユーザーを作成
3. 店舗代表者でログイン
4. 店舗情報の作成で作成する
5. 店舗一覧の各店舗ごと修正し更新する