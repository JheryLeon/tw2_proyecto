<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users login">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                    </h3>
                    <?= $this->Form->create() ?>
                        <div class="mb-3">
                            <?= $this->Form->control('correo', [
                                'label' => 'Correo',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'correo@ejemplo.com'
                            ]) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('password', [
                                'label' => 'Contraseña',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => '••••••••'
                            ]) ?>
                        </div>
                        <?= $this->Form->button('Iniciar Sesión', ['class' => 'btn btn-primary w-100 mb-3']) ?>
                    <?= $this->Form->end() ?>
                    <div class="text-center">
                        <p class="mb-0">¿No tienes cuenta?</p>
                        <?= $this->Html->link('Registrarse', ['action' => 'register'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
