<?php

namespace Core;

abstract class Model
{
    /**
     * @var string
     */
    private $className;

    protected $table = '';
    protected $fillable = [];

    public function __construct()
    {
        $className = get_class($this);

        if ($this->table == '')     throw new \Exception("You need to define 'table' field in: {$className}");
        if (empty($this->fillable)) throw new \Exception("You need to define 'fillable' field in: {$className}");

        $this->className = $className;
    }

    public static function selectAll($filterQuery = '')
    {
        $instance = new static();

        return Database::getInstance($instance->className)->query("
            SELECT * FROM {$instance->table} {$filterQuery}
        ")->resultSet($instance->className);
    }

    public static function findBy(string $field, $value)
    {
        $instance = new static();

        return Database::getInstance($instance->className)->query("
            SELECT * FROM {$instance->table}
            WHERE {$field} = :{$field}
        ")
            ->bind(':' . $field, $value)
            ->single($instance->className);
    }

    public static function create(array $data)
    {
        $instance = new static();

        $queryData = [];
        foreach ($instance->fillable as $field) {
            if (array_key_exists($field, $data)) {
                $queryData[$field] = $data[$field];
            }
        }

        $fields = array_keys($queryData);
        $insertFields = implode(', ', $fields);
        $insertValues = ':' . implode(', :', $fields);

        $query = Database::getInstance($instance->className)->query("
            INSERT INTO {$instance->table} ({$insertFields}) VALUES ({$insertValues})
        ");

        foreach ($queryData as $key => $value) {
            $query->bind(':' . $key, $value);
        }

        return $query->execute();
    }

    public function update(array $data = [])
    {
        if (!empty($data)) {
            foreach ($this->fillable as $field) {
                if (array_key_exists($field, $data)) {
                    $this->$field = $data[$field];
                }
            }
        }

        $updateFieldsArray = array_map(function ($field){
            return "{$field} = :{$field}";
        }, $this->fillable);

        $updateParams = implode(', ', $updateFieldsArray);

        $query = Database::getInstance($this->className)->query("
            UPDATE {$this->table} SET {$updateParams} WHERE id = {$this->id}
        ");

        foreach ($this->fillable as $field) {
            $query->bind(':' . $field, $this->$field);
        }

        return $query->execute();
    }

    public function delete()
    {
        return Database::getInstance()->query("
            DELETE FROM {$this->table} WHERE id = {$this->id}
        ")->execute();
    }
}