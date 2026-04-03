<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\BaseCommand;
use Cake\Console\ConsoleIo;
use Cake\Datasource\FactoryLocator;
use Cake\ORM\TableRegistry;

class MigratePasswordsCommand extends BaseCommand
{
    public function execute(Arguments $args, ConsoleIo $io): int
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        
        $users = $usersTable->find()->all();
        
        $migrated = 0;
        $skipped = 0;
        
        foreach ($users as $user) {
            $password = $user->password;
            
            // Verificar si ya está hasheado (los hash bcrypt empiezan con $2)
            if (!empty($password) && !preg_match('/^\$2[ayb]\$/', $password)) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $user->password = $hashed;
                $usersTable->save($user);
                $io->out("Usuario ID {$user->id} ({$user->correo}) - migrado");
                $migrated++;
            } else {
                $io->out("Usuario ID {$user->id} ({$user->correo}) - ya hasheado o vacío");
                $skipped++;
            }
        }
        
        $io->success("Migración completada: {$migrated} usuarios migrados, {$skipped} omitidos");
        
        return static::CODE_SUCCESS;
    }
}