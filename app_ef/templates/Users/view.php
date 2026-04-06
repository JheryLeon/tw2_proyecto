<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Actions') ?></h5>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-outline-warning w-100 mb-2']) ?>
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
                    <h3><i class="bi bi-person"></i> <?= __('User Details') ?></h3>
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%"><?= __('Nombre') ?></th>
                            <td><?= h($user->nombre) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Apellido') ?></th>
                            <td><?= h($user->apellido) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Correo') ?></th>
                            <td><?= h($user->correo) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Teléfono') ?></th>
                            <td><?= h($user->telefono) ?: '<span class="text-muted">-</span>' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Idioma') ?></th>
                            <td><?= h($user->language) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created At') ?></th>
                            <td><?= h($user->created_at) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Updated At') ?></th>
                            <td><?= h($user->updated_at) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>