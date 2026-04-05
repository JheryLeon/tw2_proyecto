<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users register">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">
                        <i class="bi bi-person-plus"></i> Registrarse
                    </h3>
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
                        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Contraseña', 'required' => true]) ?>
                        <?= $this->Form->control('telefono', ['class' => 'form-control', 'label' => 'Teléfono']) ?>
                        <?= $this->Form->button('Registrarse', ['class' => 'btn btn-success w-100 mt-3']) ?>
                    <?= $this->Form->end() ?>
                    <div class="text-center mt-3">
                        <p class="mb-0">¿Ya tienes cuenta?</p>
                        <?= $this->Html->link('Iniciar Sesión', ['action' => 'login'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
