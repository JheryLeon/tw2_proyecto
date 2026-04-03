<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventosFixture
 */
class EventosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'titulo' => 'Lorem ipsum dolor sit amet',
                'fecha' => '2026-04-03',
                'ubicacion' => 'Lorem ipsum dolor sit amet',
                'capacidad' => 1,
                'estado' => 'Lorem ipsum dolor sit amet',
                'organizador' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1775229282,
                'updated_at' => 1775229282,
            ],
        ];
        parent::init();
    }
}
