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
                    <?= $this->Html->link(__('List Events'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-calendar-plus"></i> <?= __('Add Event') ?></h3>
                    <?= $this->Form->create($evento) ?>
                        <?= $this->Form->control('titulo', ['class' => 'form-control', 'label' => __('Title'), 'required' => true]) ?>
                        
                        <div class="mb-3">
                            <label class="form-label"><?= __('Description (Spanish)') ?></label>
                            <?= $this->Form->textarea('descripcion_es', ['class' => 'form-control', 'rows' => 3]) ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><?= __('Description (English)') ?></label>
                            <?= $this->Form->textarea('descripcion_en', ['class' => 'form-control', 'rows' => 3]) ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('fecha', ['class' => 'form-control', 'label' => __('Date'), 'type' => 'date', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('ubicacion', ['class' => 'form-control', 'label' => __('Location'), 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('capacidad', ['class' => 'form-control', 'label' => __('Capacity'), 'type' => 'number']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('publico_objetivo', ['class' => 'form-control', 'label' => __('Target Audience')]) ?>
                            </div>
                        </div>
                        <?= $this->Form->control('organizador', ['class' => 'form-control', 'label' => __('Organizer')]) ?>
                        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success w-100 mt-3']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>