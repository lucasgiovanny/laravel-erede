# eRede API for Laravel

This package makes it easy to use [eRede PHP SDK](https://github.com/DevelopersRede/erede-php) with Laravel framework.

THIS IS A BETA PACKAGE. FEEL FREE TO HELP IMPROVE IT.

<a href="https://www.buymeacoffee.com/lucasgiovanny" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>

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

#### authorize

| Param      | Type                    |
| ---------- | ----------------------- |
| total      | _float_ (**required**)  |
| reference  | _string_ (**required**) |
| creditcard | _array_ (**required**)  |

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

## To do List

- Tests
- Implement others methods from eRede PHP SDK

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
