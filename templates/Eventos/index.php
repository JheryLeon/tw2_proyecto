<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Evento> $eventos
 * @var array $publicos
 * @var string|null $search
 * @var string|null $publico
 * @var string|null $fechaDesde
 * @var string|null $fechaHasta
 */
?>
<div class="eventos index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-calendar-event"></i> <?= __('Eventos') ?></h3>
        <?= $this->Html->link(__('New Evento'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label"><?= __('Search') ?></label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="<?= __('Search by title...') ?>" value="<?= h($search ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label for="publico_objetivo" class="form-label"><?= __('Target Audience') ?></label>
                    <select name="publico_objetivo" id="publico_objetivo" class="form-select">
                        <option value=""><?= __('All') ?></option>
                        <?php foreach ($publicos as $p): ?>
                        <option value="<?= h($p) ?>" <?= ($publico ?? '') === $p ? 'selected' : '' ?>><?= h($p) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="fecha_desde" class="form-label"><?= __('Date') ?> (Desde)</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?= h($fechaDesde ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label for="fecha_hasta" class="form-label"><?= __('Date') ?> (Hasta)</label>
                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?= h($fechaHasta ?? '') ?>">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <div class="btn-group w-100">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', '#') ?></th>
                            <th><?= $this->Paginator->sort('titulo', 'Título') ?></th>
                            <th><?= $this->Paginator->sort('fecha', 'Fecha') ?></th>
                            <th><?= $this->Paginator->sort('ubicacion', 'Ubicación') ?></th>
                            <th><?= $this->Paginator->sort('capacidad', 'Capacidad') ?></th>
                            <th><?= $this->Paginator->sort('publico_objetivo', 'Público Objetivo') ?></th>
                            <th><?= $this->Paginator->sort('organizador', 'Organizador') ?></th>
                            <th class="text-center"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= $this->Number->format($evento->id) ?></td>
                            <td><?= h($evento->titulo) ?></td>
                            <td><?= h($evento->fecha) ?></td>
                            <td><?= h($evento->ubicacion) ?></td>
                            <td><?= $evento->capacidad === null ? '<span class="text-muted">-</span>' : $this->Number->format($evento->capacidad) ?></td>
                            <td><?= h($evento->publico_objetivo) ?></td>
                            <td><?= h($evento->organizador) ?></td>
                            <td class="text-center">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $evento->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evento->id], ['class' => 'btn btn-sm btn-outline-warning']) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['action' => 'delete', $evento->id],
                                    [
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $evento->id)
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if ($eventos->items()->isEmpty()): ?>
        <div class="text-center py-5">
            <i class="bi bi-calendar-x" style="font-size: 3rem; color: #6c757d;"></i>
            <p class="text-muted mt-3">No hay eventos disponibles</p>
            <?= $this->Html->link(__('Crear el primer evento'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <div class="pagination justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                <?= $this->Paginator->first(__('<<')) ?>
                <?= $this->Paginator->prev(__('<')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('>')) ?>
                <?= $this->Paginator->last(__('>>')) ?>
            </ul>
        </nav>
    </div>
    
    <p class="text-muted text-center mt-2">
        <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
    </p>
</div>