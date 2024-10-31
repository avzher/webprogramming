<?php

require_once 'database.php';

class Account{
    public $id = '';
    public $first_name = '';
    public $last_name = '';
    public $username = '';
    public $password = '';
    public $role = 'staff';
    public $is_staff = true;
    public $is_admin = false;


    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function add(){
        $sql = "INSERT INTO account (first_name, last_name, username, password, role, is_staff, is_admin) VALUES (:first_name, :last_name, :username, :password, :role, :is_staff, :is_admin);";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':first_name', $this->first_name);
        $query->bindParam(':last_name', $this->last_name);
        $query->bindParam(':username', $this->username);
        $hashpassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashpassword);
        $query->bindParam(':role', $this->role);
        $query->bindParam(':is_staff', $this->is_staff);
        $query->bindParam(':is_admin', $this->is_admin);

        return $query->execute();
    }

    function usernameExist($username, $excludeID){
        $sql = "SELECT COUNT(*) FROM account WHERE username = :username";
        if ($excludeID){
            $sql .= " and id != :excludeID";
        }

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':username', $username);

        if ($excludeID){
            $query->bindParam(':excludeID', $excludeID);
        }

        $count = $query->execute() ? $query->fetchColumn() : 0;

        return $count > 0;
    }

    function login($username, $password){
        $sql = "SELECT * FROM account WHERE username = :username LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam('username', $username);

        if($query->execute()){
            $data = $query->fetch();
            if($data && password_verify($password, $data['password'])){
                return true;
            }
        }

        return false;
    }

    function fetch($username){
        $sql = "SELECT * FROM account WHERE username = :username LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam('username', $username);
        $data = null;
        if($query->execute()){
            $data = $query->fetch();
        }

        return $data;
    }
    function getAllAccounts() {
        $sql = "SELECT * FROM account";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all accounts as associative arrays
        }

        return []; // Return an empty array if no accounts are found
    }

    // The delete() method removes an account from the database based on its ID.
    function delete($recordID) {
        // SQL query to delete an account by its ID.
        $sql = "DELETE FROM account WHERE id = :recordID;";

        // Prepare the SQL statement for execution.
        $query = $this->db->connect()->prepare($sql);

        // Bind the recordID parameter to the SQL query.
        $query->bindParam(':recordID', $recordID);
        
        // Execute the query. If successful, return true; otherwise, return false.
        return $query->execute();
    }
}

// $obj = new Account();

// $obj->add();