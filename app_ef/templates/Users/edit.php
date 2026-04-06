<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var bool $isAdmin
 */
?>
<div class="users edit content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $user->id],
                        ['class' => 'btn btn-outline-danger w-100 mb-2', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                    ) ?>
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><i class="bi bi-person-check"></i> <?= __('Edit User') ?></h3>
                    <?= $this->Form->create($user) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => 'Nombre', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => 'Apellido', 'required' => true]) ?>
                            </div>
                        </div>
                        <?= $this->Form->control('correo', ['class' => 'form-control', 'label' => 'Correo', 'type' => 'email', 'required' => true]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('telefono', ['class' => 'form-control', 'label' => 'Teléfono']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('language', ['class' => 'form-control', 'label' => 'Idioma']) ?>
                            </div>
                        </div>
                        <?php if (!empty($isAdmin)): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('role', [
                                    'type' => 'select',
                                    'options' => ['user' => 'Usuario', 'admin' => 'Administrador'],
                                    'selected' => $user->role,
                                    'class' => 'form-select', 
                                    'label' => 'Rol'
                                ]) ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success w-100 mt-3']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>