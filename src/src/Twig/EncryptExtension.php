<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EncryptExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('encrypt', [$this, 'encrypt']),
        ];
    }

    public function encrypt($string): string
    {
        return openssl_encrypt($string, 'AES-128-ECB', 'fUv+vD/vPvUd6/NCQg==');
    }
}