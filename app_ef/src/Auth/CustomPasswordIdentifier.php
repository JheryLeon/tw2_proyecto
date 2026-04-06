<?php
declare(strict_types=1);

namespace App\Auth;

use Authentication\Identifier\PasswordIdentifier;

class CustomPasswordIdentifier extends PasswordIdentifier
{
    protected array $_defaultConfig = [
        'fields' => [
            self::CREDENTIAL_USERNAME => 'correo',
            self::CREDENTIAL_PASSWORD => 'password',
        ],
        'resolver' => 'Authentication.Orm',
        'passwordHasher' => 'Default',
    ];
}