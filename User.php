<?php
class User
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // CREATE a new user
    public function createUser($matric, $name, $password, $role)
    {
        // Hashes the password for security.
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepares an INSERT statement.
        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            // Binds the parameters and executes the statement.
            $stmt->bind_param("ssss", $matric, $name, $password, $role);
            $result = $stmt->execute();

            // Returns true if successful, otherwise returns an error message.
            if ($result) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error: " . $stmt->error;
            }
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // READ all users
    public function getUsers()
    {
        $sql = "SELECT matric, name, role FROM users";
        $result = $this->conn->query($sql);
        return $result;
    }

    // READ a single user by matric
    public function getUser($matric)
    {
        // Prepares a SELECT statement to fetch a single user by matric.
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            // Binds the matric parameter and executes the statement.
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result(); 
            $user = $result->fetch_assoc(); 
            $stmt->close(); 

            // Returns the user data if successful, otherwise returns false
            return $user ? $user : false;
        } else {
            return false;
        }
    }

    // UPDATE a user's information
    public function updateUser($matric, $name, $role)
    {
        // Prepares an UPDATE statement.
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            // Binds the parameters and executes the statement.
            $stmt->bind_param("sss", $name, $role, $matric);
            $result = $stmt->execute();

            // Returns true if successful, otherwise returns an error message.
            if ($result) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error: " . $stmt->error;
            }
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // DELETE a user by matric
    public function deleteUser($matric)
    {
        // Prepares a DELETE statement.
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            // Binds the matric parameter and executes the statement.
            $stmt->bind_param("s", $matric);
            $result = $stmt->execute();

            // Returns true if successful, otherwise returns an error message.
            if ($result) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error: " . $stmt->error;
            }
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}
?>
