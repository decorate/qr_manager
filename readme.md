## QR_Manager

### install
``
composer require decorate/qr_manager
``

### usage

#### QRコード表示
```php
#controller
$user = User::query()->select(['id', 'name'])->first();
$qr = new QR_Manager($user);
$res = $qr->size(200)->show();
return view('index', ['data' => $res]);
```

```html
<div>
    {!! $data !!}
</div>
```

#### QRコードダウンロード
```php
#controller
$user = User::query()->select(['id', 'name'])->first();
$qr = new QR_Manager();
return $qr
    ->source($user)
    ->format('png')
    ->size(200)
    ->download('filename');
```

#### QRコードbase64
```php
#controller
$user = User::query()->select(['id', 'name'])->first();
$qr = new QR_Manager();
return $qr
    ->source($user)
    ->format('png')
    ->size(200)
    ->toBase64();
```

### Class Methods
|methods|args| output|
|--|--|--|
|source|Model or string|this|
|format|string|this|
|size|string|this|
|show|null|HtmlString|
|download|null|\Illuminate\Http\Response|
|toBase64|null|string|
