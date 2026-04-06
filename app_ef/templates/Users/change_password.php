<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users change-password content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4"><i class="bi bi-key"></i> Change Password</h3>
                    <?= $this->Form->create($user) ?>
                        <div class="mb-3">
                            <?= $this->Form->control('current_password', [
                                'type' => 'password', 
                                'label' => 'Contraseña Actual',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => '••••••••'
                            ]) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('new_password', [
                                'type' => 'password', 
                                'label' => 'Nueva Contraseña',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => '••••••••'
                            ]) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('confirm_password', [
                                'type' => 'password', 
                                'label' => 'Confirmar Nueva Contraseña',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => '••••••••'
                            ]) ?>
                        </div>
                        <?= $this->Form->button(__('Change Password'), ['class' => 'btn btn-primary w-100']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>