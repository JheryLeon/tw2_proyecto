<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $correo
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property string|null $password
 * @property string|null $language
 * @property string|null $telefono
 */
class User extends Entity
{
    protected function _setPassword(string $password): ?string
    {
        if (mb_strlen($password) >= 6) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }

    protected array $_accessible = [
        'nombre' => true,
        'apellido' => true,
        'correo' => true,
        'created_at' => true,
        'updated_at' => true,
        'password' => true,
        'language' => true,
        'telefono' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}
