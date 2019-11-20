<?php

namespace Core;

abstract class Validation
{
    /**
     * @var bool
     */
    private $passed = false;
    /**
     * @var array
     */
    private $errors = array();

    /**
     * Except mostly form data which need to be validated
     *
     * @param $variable
     * @param array $fields
     * @return $this
     */
    protected function check($variable, array $fields = array())
    {
        foreach ($fields as $field => $rules) {

          $field = explode('|', $field);

          foreach ($rules as $rule => $rule_value) {

            $value = trim($variable[$field[0]]);
            $name = isset($field[1]) ? $field[1] : $field[0];

            if ($rule === 'required' && empty($value)) {
              $this->addError($field[0], "{$name} is required.");
            } else if (!empty($value)) {
              switch ($rule) {
                  case 'min':
                      if(strlen($value) < $rule_value) {
                        $this->addError($field[0], "{$name} must contain at least {$rule_value} characters.");
                      }
                  break;
                  case 'max':
                      if(strlen($value) > $rule_value) {
                        $this->addError($field[0], "{$name} can have max {$rule_value} characters.");
                      }
                  break;
              }
            }

          }
        }

        if (empty($this->errors)) {
          $this->passed = true;
        }

        return $this;
    }

    /**
     * Add error to error array
     *
     * @param $field
     * @param $error
     */
    private function addError($field, $error)
    {
      $this->errors[$field] = $error;
    }

    /**
     * Retrieve errors
     *
     * @return array
     */
    public function errors()
    {
      return $this->errors;
    }

    /**
     * Check does validation passed or not
     *
     * @return bool
     */
    public function passed()
    {
      return $this->passed;
    }
}
