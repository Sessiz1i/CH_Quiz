<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Doğrulama
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki öğeler doğrulama(validation) işlemleri sırasında kullanılan varsayılan hata
    | mesajlarını içermektedir. `size` gibi bazı kuralların birden çok çeşidi
    | bulunmaktadır. Her biri ayrı ayrı düzenlenebilir.
    |
    */
    // Genel
    'manager-account' => 'Hesap Yönetimi',
    'register' => 'Kayıt Ol',
    'login' => 'Giriş',
    'logout' => 'Çıkış',
    'email' => 'E-Posta',
    'password' => 'Şifre',
    // Login Sayfası
    'login-page' => [
        'login-title'=>'Giriş Sayfasındasınız',
        'memberme' => 'Beni Hatırla',
        ],
    //Register Sayfası
    'reg-page'=>[
        'register-title'=>'Kayıt Sayfasındasınız',
        'name'=>'İsim',
        'config-pass'=>'Şifreyi Onayla',
        'already-registered'=>'Zaten kayıtlımısın?',
        'terms-service'=>' :terms_of_service ve :privacy_policy kabul ediyorum',
        'terms_of_service' => 'Hizmet Koşullarını',
        'privacy_policy' => 'Gizlilik Politikası',
        ],

    // Forgot your password?
    'forg-pass'=> [
        'forg-pass-title'=>'Şifre Sıfırlama Sayfasındasınız',
        'forgotpassword'=>'Parolanızı mı unuttunuz?',
        'fpass-not'=>'Parolanızı mı unuttunuz? Sorun değil. Sadece bize e-posta adresinizi bildirin ve size yeni bir tane seçmenize izin verecek bir şifre sıfırlama bağlantısı göndereceğiz.',
        'forg-pass-btn'=>'E-posta şifre sıfırlama bağlantısı',


    ],


];