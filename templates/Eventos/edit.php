<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evento $evento
 */
?>
<div class="eventos edit content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $evento->id],
                        ['class' => 'btn btn-outline-danger w-100 mb-2', 'confirm' => __('Are you sure you want to delete # {0}?', $evento->id)]
                    ) ?>
                    <?= $this->Html->link(__('List Eventos'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-calendar-check"></i> <?= __('Edit Evento') ?></h3>
                    <?= $this->Form->create($evento) ?>
                        <?= $this->Form->control('titulo', ['class' => 'form-control', 'label' => 'Título', 'required' => true]) ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción en Español</label>
                            <?= $this->Form->textarea('descripcion_es', ['class' => 'form-control', 'rows' => 3]) ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description in English</label>
                            <?= $this->Form->textarea('descripcion_en', ['class' => 'form-control', 'rows' => 3]) ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('fecha', ['class' => 'form-control', 'label' => 'Fecha', 'type' => 'date', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('ubicacion', ['class' => 'form-control', 'label' => 'Ubicación', 'required' => true]) ?>
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