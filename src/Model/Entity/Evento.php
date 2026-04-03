<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evento Entity
 *
 * @property int $id
 * @property string $titulo
 * @property \Cake\I18n\Date $fecha
 * @property string $ubicacion
 * @property int|null $capacidad
 * @property string|null $publico_objetivo
 * @property string|null $organizador
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 */
class Evento extends Entity
{
    protected array $_accessible = [
        'titulo' => true,
        'fecha' => true,
        'ubicacion' => true,
        'capacidad' => true,
        'publico_objetivo' => true,
        'organizador' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
