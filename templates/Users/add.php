<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users add content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100 mb-2']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-person-plus"></i> <?= __('Add User') ?></h3>
                    <?= $this->Form->create($user) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => 'Nombre']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => 'Apellido']) ?>
                            </div>
                        </div>
                        <?= $this->Form->control('correo', ['class' => 'form-control', 'label' => 'Correo', 'type' => 'email']) ?>
                        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Contraseña']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('telefono', ['class' => 'form-control', 'label' => 'Teléfono']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('language', ['class' => 'form-control', 'label' => 'Idioma']) ?>
                            </div>
                        </div>
                        <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-success w-100 mt-3']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>