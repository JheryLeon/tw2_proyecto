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
 * @property string|null $descripcion_es
 * @property string|null $descripcion_en
 * @property int|null $user_id
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
        'descripcion_es' => true,
        'descripcion_en' => true,
        'user_id' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
    
    protected array $_hidden = [
        'user_id',
    ];
}
