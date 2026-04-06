<?php
declare(strict_types=1);

namespace App\Auth;

use ArrayAccess;
use Cake\Core\InstanceConfigTrait;
use Cake\ORM\Locator\LocatorAwareTrait;

class CustomOrmResolver
{
    use InstanceConfigTrait;
    use LocatorAwareTrait;

    protected array $_defaultConfig = [
        'userModel' => 'Users',
        'finder' => 'all',
    ];

    public function __construct(array $config = [])
    {
        $this->setConfig($config);
    }

    public function find(array $conditions, string $type = 'AND'): ArrayAccess|array|null
    {
        $table = $this->getTableLocator()->get($this->_config['userModel']);

        $query = $table->selectQuery();
        $finders = (array)$this->_config['finder'];
        foreach ($finders as $finder => $options) {
            if (is_string($options)) {
                $query->find($options);
            } else {
                $query->find($finder, $options);
            }
        }

        $usernameField = 'correo';
        if (isset($conditions['username'])) {
            $conditions[$usernameField] = $conditions['username'];
            unset($conditions['username']);
        }

        $where = [];
        foreach ($conditions as $field => $value) {
            $field = $table->aliasField($field);
            if (is_array($value)) {
                $field = $field . ' IN';
            }
            $where[$field] = $value;
        }

        return $query->where([$type => $where])->first();
    }
}