<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evento $evento
 */
?>
<div class="eventos add content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?= $this->Html->link(__('List Eventos'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-calendar-plus"></i> <?= __('Add Evento') ?></h3>
                    <?= $this->Form->create($evento) ?>
                        <?= $this->Form->control('titulo', ['class' => 'form-control', 'label' => 'Título']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('fecha', ['class' => 'form-control', 'label' => 'Fecha', 'type' => 'date']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('ubicacion', ['class' => 'form-control', 'label' => 'Ubicación']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('capacidad', ['class' => 'form-control', 'label' => 'Capacidad', 'type' => 'number']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('publico_objetivo', ['class' => 'form-control', 'label' => 'Público Objetivo']) ?>
                            </div>
                        </div>
                        <?= $this->Form->control('organizador', ['class' => 'form-control', 'label' => 'Organizador']) ?>
                        <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-success w-100 mt-3']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>