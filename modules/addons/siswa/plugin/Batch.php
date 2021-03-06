<?php
/**
 * htdocs
 * Batch.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 18/07/2020
 * Time  : 16:56
 */

namespace Modules\Siswa\Plugin;


class Batch extends \Phalcon\Mvc\User\Component
{
    /** @var string */
    public $table = null;

    /** @var array */
    public $rows = [];

    /** @var array */
    public $values = [];

    // --------------------------------------------------------------

    public function __construct($table = false)
    {
        if ($table) {
            $this->table = (string) $table;
        }

        $di = \Phalcon\DI::getDefault();
        $this->db = $di->get('db');

        return $this;
    }

    // --------------------------------------------------------------

    /**
     * Set the Rows
     *
     * @param array $rows
     *
     * @return object Batch
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
        $this->rowsString = sprintf('`%s`', implode('`,`', $this->rows));

        return $this;
    }

    // --------------------------------------------------------------

    /**
     * Set the values
     *
     * @param $values Array of Arrays
     *
     * @return object Batch
     */
    public function setValues($values)
    {
        if (!$this->rows) {
            throw new \Exception('You must setRows() before setValues');
        }
        $this->values = $values;

        $valueCount = count($values);
        $fieldCount = count($this->rows);

        // Build the Placeholder String
        $placeholders = [];
        for ($i = 0; $i < $valueCount; $i++) {
            $placeholders[] = '(' . rtrim(str_repeat('?,', $fieldCount), ',') . ')';
        }
        $this->bindString = implode(',', $placeholders);

        // Build the Flat Value Array
        $valueList = [];
        foreach ($values as $value)
        {
            if (is_array($value))
            {
                foreach ($value as $v)
                {
                    $valueList[] = $v;
                }
            }
            else
            {
                $valueList[] = $values;
            }
        }
        $this->valuesFlattened = $valueList;
        unset($valueList);

        return $this;
    }

    // --------------------------------------------------------------

    /**
     * Insert into the Database
     *
     * @param boolean $ignore Use an INSERT IGNORE (Default: false)
     *
     * @return void
     */
    public function insert($ignore = false)
    {
        $this->_validate();

        // Optional ignore string
        if ($ignore) {
            $insertString = "INSERT IGNORE INTO `%s` (%s) VALUES %s";
        } else {
            $insertString = "INSERT INTO `%s` (%s) VALUES %s";
        }

        $query = sprintf($insertString,
            $this->table,
            $this->rowsString,
            $this->bindString
        );

        $this->db->execute($query, $this->valuesFlattened);
    }

    // --------------------------------------------------------------

    /**
     * Validates the data before calling SQL
     *
     * @return void
     */
    private function _validate()
    {
        if (!$this->table) {
            throw new \Exception('Batch Table must be defined');
        }

        $requiredCount = count($this->rows);

        if ($requiredCount == 0) {
            throw new \Exception('Batch Rows cannot be empty');
        }

        foreach ($this->values as $value) {
            if (count($value) !== $requiredCount) {
                throw new \Exception('Batch Values must match the same column count of ' . $requiredCount);
            }
        }
    }

}