<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evento $evento
 * @var string|null $locale
 */
$locale = $locale ?? 'es';
$descField = 'descripcion_' . ($locale === 'en' ? 'en' : 'es');
$descLabel = $locale === 'en' ? 'Description' : 'Descripción';
?>
<div class="eventos view content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?php 
                    $identity = $this->request->getAttribute('identity');
                    if ($identity && $evento->user_id == $identity->id): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evento->id], ['class' => 'btn btn-outline-warning w-100 mb-2']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $evento->id],
                            ['class' => 'btn btn-outline-danger w-100 mb-2', 'confirm' => __('Are you sure you want to delete # {0}?', $evento->id)]
                        ) ?>
                    <?php endif; ?>
                    <?= $this->Html->link(__('List Eventos'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-calendar-event"></i> <?= h($evento->titulo) ?></h3>
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%"><?= __('Título') ?></th>
                            <td><?= h($evento->titulo) ?></td>
                        </tr>
                        <?php if (!empty($evento->$descField)): ?>
                        <tr>
                            <th><?= $descLabel ?></th>
                            <td><?= h($evento->$descField) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?= __('Fecha') ?></th>
                            <td><?= h($evento->fecha) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Ubicación') ?></th>
                            <td><?= h($evento->ubicacion) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Capacidad') ?></th>
                            <td><?= $evento->capacidad === null ? '<span class="text-muted">-</span>' : $this->Number->format($evento->capacidad) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Público Objetivo') ?></th>
                            <td><?= h($evento->publico_objetivo) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Organizador') ?></th>
                            <td><?= h($evento->organizador) ?: '<span class="text-muted">-</span>' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created At') ?></th>
                            <td><?= h($evento->created_at) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Updated At') ?></th>
                            <td><?= h($evento->updated_at) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>