# eRede API for Laravel

This package makes it easy to use [eRede PHP SDK](https://github.com/DevelopersRede/erede-php) with Laravel framework.

## Contents

- [Installation](#installation)

- [Usage](#usage)

- [Changelog](#changelog)

- [Testing](#testing)

- [Security](#security)

- [Contributing](#contributing)

- [Credits](#credits)

- [License](#license)

## Installation

This package can be installed via composer:

`composer require lucasgiovanny/laravel-erede`

Set the enviroments variables in your `.env` file

```
REDE_PV=
REDE_TOKEN=
REDE_SANDBOX=false
```

## Usage

To use this package, you just need to import the Rede Facades.

```php
use  lucasgiovanny\ERede\Facades\Rede;
```

### Available methods

- [`authorize`](#authorize): Authorize a transaction with creditcard.
- [`cancel`](#cancel): Cancel a transaction.
- [`get`](#get): Find a transaction by id.
- [`getByReference`](#getByReference): Find a transaction by reference.
- [`getRefunds`](#getRefunds): Find transaction refunds.

#### authorize

| Param        | Type                    |Default |
| ------------ | ----------------------- | ------ |
| total        | _float_ (**required**)  |        |
| reference    | _string_ (**required**) |        |
| creditcard   | _array_ (**required**)  |        |
| capture      | _bool_                  | `true` |
| installments | _int_                   | `1`    |

Example:

```php
use  lucasgiovanny\ERede\Facades\Rede;

$creditCard = [
'cardNumber'  =>  "5448280000000007",
'cardCvv' => '123'
'cardExpirationMonth'  =>  '12',
'cardExpirationYear'  =>  '2020',
'cardHolder'  =>  'Walter White',
];

$transaction = Rede::authorize(100.99, 'Order 45', $creditCard);

if ($transaction->getReturnCode() == '00') {
    printf("Success! tid=%s\n", $transaction->getTid());
}
```

- Transactions are captured by default, if you don't want this, you can set the capture parameter to `false`.

- To set installments, just use the last parameter.

#### cancel

| Param        | Type                    |
| ------------ | ----------------------- |
| transaction  | _string_ (**required**) |

Example:

```php
use  lucasgiovanny\ERede\Facades\Rede;

$transaction = Rede::cancel('TID123');
```

#### get

| Param        | Type                    |
| ------------ | ----------------------- |
| transaction  | _string_ (**required**) |

Example:

```php
use  lucasgiovanny\ERede\Facades\Rede;

$transaction = Rede::get('TID123');
```

#### getByReference

| Param        | Type                    |
| ------------ | ----------------------- |
| reference    | _string_ (**required**) |

Example:

```php
use  lucasgiovanny\ERede\Facades\Rede;

$transaction = Rede::getByReference('TID123');
```

#### getRefunds

| Param        | Type                    |
| ------------ | ----------------------- |
| transaction  | _string_ (**required**) |

Example:

```php
use  lucasgiovanny\ERede\Facades\Rede;

$transaction = Rede::getRefunds('TID123');
```

## To do List

- Tests

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Test needs to be written. Feel free to collaborate.

## Security

If you discover any security related issues, please email lucasgiovanny@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Lucas Giovanny](https://github.com/lucasgiovanny)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
