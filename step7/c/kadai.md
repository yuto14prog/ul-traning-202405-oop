```php
public function setData($data)
{
    array_push($this->results, $data);
}
```

上記のコードについて、不正な値が引数に入らないかバリデーションをする
ケース「`['name' => string, 'point' => int]`の形になっているか」
