<?php


/**
 * Using a slightly modified version of PDO CRUD
 * which can be see here
 *
 * @http://www.phpro.org/classes/PDO-CRUD.html
 *
 * Thank you to the phpro team!
 */
class CRUD
{
    private $db;

    private $dsn = "mysql:host=localhost;dbname=cwikiwebdevrinoa";
    private $username = "cwikiwebdevrinoa";
    private $password = "bwWpzTf7q7MYXHq4";

    /**
     *
     * @Connect to the database and set the error mode to Exception
     *
     * @Throws PDOException on failure
     *
     */
    public function conn()
    {
        if (!$this->db instanceof PDO) {
            $this->db = new PDO($this->dsn, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    /***
     *
     * @select values from table
     *
     * @access public
     *
     * @param string $table The name of the table
     *
     * @param string $fieldname
     *
     * @param string $id
     *
     * @return array on success or throw PDOException on failure
     *
     */
    public function dbSelect($table, $fieldname = null, $id = null)
    {
        $this->conn();
        $sql = "SELECT * FROM `$table` WHERE `$fieldname`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @execute a raw query
     *
     * @access public
     *
     * @param string $sql
     *
     * @return array
     *
     */
    public function rawSelect($sql)
    {
        $this->conn();
        return $this->db->query($sql);
    }

    /**
     *
     * @run a raw query
     *
     * @param string The query to run
     *
     */
    public function rawQuery($sql)
    {
        $this->conn();
        $this->db->query($sql);
    }

    /**
     *
     * @Insert a value into a table
     *
     * @acces public
     *
     * @param string $table
     *
     * @param array $values
     *
     * @return int The last Insert Id on success or throw PDOexeption on failure
     *
     */
    public function dbInsert($table, $values)
    {
        $this->conn();
        /*** snarg the field names from the first array member ***/
        $fieldnames = array_keys($values);
        /*** now build the query ***/

        $sql = "INSERT INTO $table";
        /*** set the field names ***/
        $fields = '( ' . implode(' ,', $fieldnames) . ' )';
        /*** set the placeholders ***/
        $bound = '(:' . implode(', :', $fieldnames) . ' )';
        /*** put the query together ***/
        $sql .= $fields . ' VALUES ' . $bound;

        /*** prepare and execute ***/
        $stmt = $this->db->prepare($sql);

        $stmt->execute($values);
    }


    /*ORIGINAL PDO CRUD*/
//    public function dbInsert($table, $values)
//    {
//        $this->conn();
//        /*** snarg the field names from the first array member ***/
//        $fieldnames = array_keys($values[0]);
//        /*** now build the query ***/
//
//
//        /*Do these actually do anything??*/
///*        $size = sizeof($fieldnames);
//        $i = 1;*/
//
//        $sql = "INSERT INTO $table";
//        /*** set the field names ***/
//        $fields = '( ' . implode(' ,', $fieldnames) . ' )';
//        /*** set the placeholders ***/
//        $bound = '(:' . implode(', :', $fieldnames) . ' )';
//        /*** put the query together ***/
//        $sql .= $fields.' VALUES '.$bound;
//
//        /*** prepare and execute ***/
//        $stmt = $this->db->prepare($sql);
//        echo $sql;
//        foreach($values as $vals)
//        {
//            $stmt->execute($vals);
//        }
//    }

    /**
     *
     * @Update a value in a table
     *
     * @access public
     *
     * @param string $table
     *
     * @param string $fieldname, The field to be updated
     *
     * @param string $value The new value
     *
     * @param string $pk The primary key
     *
     * @param string $id The id
     *
     * @throws PDOException on failure
     *
     */
    public function dbUpdate($table, $fieldname, $value, $pk, $id)
    {
        $this->conn();
        $sql = "UPDATE `$table` SET `$fieldname`='{$value}' WHERE `$pk` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    /*UPDATE  `setup` SET  `article_id` =  '3' WHERE `layout` =  'setup';*/

    /**
     *
     * @Delete a record from a table
     *
     * @access public
     *
     * @param string $table
     *
     * @param string $fieldname
     *
     * @param string $id
     *
     * @throws PDOexception on failure
     *
     */
    public function dbDelete($table, $fieldname, $id)
    {
        $this->conn();
        $sql = "DELETE FROM `$table` WHERE `$fieldname` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}