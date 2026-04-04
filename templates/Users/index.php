<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="users index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-people"></i> <?= __('Users') ?></h3>
        <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', '#') ?></th>
                            <th><?= $this->Paginator->sort('nombre', 'Nombre') ?></th>
                            <th><?= $this->Paginator->sort('apellido', 'Apellido') ?></th>
                            <th><?= $this->Paginator->sort('correo', 'Correo') ?></th>
                            <th><?= $this->Paginator->sort('telefono', 'Teléfono') ?></th>
                            <th><?= $this->Paginator->sort('language', 'Idioma') ?></th>
                            <th class="text-center"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->nombre) ?></td>
                            <td><?= h($user->apellido) ?></td>
                            <td><?= h($user->correo) ?></td>
                            <td><?= h($user->telefono) ?></td>
                            <td><?= h($user->language) ?></td>
                            <td class="text-center">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-outline-warning']) ?>
                                <?= $this->Html->link(__('Password'), ['action' => 'changePassword', $user->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['action' => 'delete', $user->id],
                                    [
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $user->id)
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

    <div class="pagination justify-content-center">
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