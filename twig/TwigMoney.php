<?php
namespace TwigMoney;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;
use Twig_Extension;
use Twig_SimpleFilter;

class TwigMoney extends Twig_Extension
{
    public function getName()
    {
        return 'TwigMoney';
    }

    public function getFilters()
    {
        $filter = new Twig_SimpleFilter('moneyformat', function (Money $money) {

            $currencies = new ISOCurrencies();

            $numberFormatter = new \NumberFormatter('de_DE', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            return $moneyFormatter->format($money);
        });

        return [$filter];
    }
}