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

    /**
     * Model constructor.
     * Check does child class implements required fields
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $className = get_class($this);

        if ($this->table == '')     throw new \Exception("You need to define 'table' field in: {$className}");
        if (empty($this->fillable)) throw new \Exception("You need to define 'fillable' field in: {$className}");

        $this->className = $className;
    }

    /**
     * Take all rows from database
     * Fetch results into child class object
     *
     * @param string $filterQuery
     * @return array[objects]
     * @throws \Exception
     */
    public static function selectAll($filterQuery = '')
    {
        $instance = new static();

        return App::get('db')->query("
            SELECT * FROM {$instance->table} {$filterQuery}
        ")->resultSet($instance->className);
    }

    /**
     * Take row filtered by specific field and value for that field
     * Fetch result into child class object
     *
     * @param string $field
     * @param $value
     * @return object
     * @throws \Exception
     */
    public static function findBy(string $field, $value)
    {
        $instance = new static();

        return App::get('db')->query("
            SELECT * FROM {$instance->table}
            WHERE {$field} = :{$field}
        ")
            ->bind(':' . $field, $value)
            ->single($instance->className);
    }

    /**
     * Store data in database
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
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

        $query = App::get('db')->query("
            INSERT INTO {$instance->table} ({$insertFields}) VALUES ({$insertValues})
        ");

        foreach ($queryData as $key => $value) {
            $query->bind(':' . $key, $value);
        }

        return $query->execute();
    }

    /**
     * Update data in database
     *
     * @param array $data
     * @return mixed
     */
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

        $query = App::get('db')->query("
            UPDATE {$this->table} SET {$updateParams} WHERE id = {$this->id}
        ");

        foreach ($this->fillable as $field) {
            $query->bind(':' . $field, $this->$field);
        }

        return $query->execute();
    }

    /**
     * Delete data from database
     *
     * @return bool
     */
    public function delete()
    {
        return App::get('db')->query("
            DELETE FROM {$this->table} WHERE id = {$this->id}
        ")->execute();
    }
}