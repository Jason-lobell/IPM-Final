<?php 
class DataBase{
    public $pdo = '';
    const DB_DEBUG = false;

    public function __construct($dataBaseUser, $dataBaseName) {
        $this->pdo = null;

        $path = 'lib/';

        if (substr(BASE_PATH, -6) == 'admin/'){
            $path = '../' . $path;
        }

        include $path . 'pass.php';

        $DataBasePassword = '';
        switch (substr($dataBaseUser, strpos($dataBaseUser, "_") + 1)) {
            case 'reader':
                $DataBasePassword = $dbReader;
                break;
            case 'writer':
                $DataBasePassword = $dbWriter;
                break;
        }

        $query = NULL;

        $dsn = 'mysql:host=webdb.uvm.edu;dbname=';

        if(DEBUG == true){
            print '<p>';
            print 'Account: ' . $dataBaseUser . ' Password: ' . $DataBasePassword . ' dsn: ' . $dsn;
            print '</p>';
        }

        try {
            $this->pdo = new PDO($dsn . $dataBaseName, $dataBaseUser, $DataBasePassword);

            if (!$this->pdo) {
                if (self::DB_DEBUG) echo '<p>You are NOT connected to the database!</p>';
                return 0;
            } else {
                if (self::DB_DEBUG) echo '<p>You are connected to the database!!!</p>';
                return $this->pdo;
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            if (self::DB_DEBUG) echo "<p>An error occured while connecting to the database: $error_message </p>";
        }
    } // constructor

    public function select($query, $values = '') {

        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute();
        }

        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $recordSet;
    } // select method

    public function insert($query, $values = '') {
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }

        return $status;
    }

    public function update($query, $values = '') {
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }

        return $status;
    }

    public function delete($query, $values = '') {
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }

        return $status;
    }

    function displayQuery($query, $values = '') {
        if (is_array($values)){
            $needle = '?';
            $haystack = $query;
            foreach ($values as $value) {
                $pos = strpos($haystack, $needle);
                if ($pos !== false) {
                    
                    $haystack = substr_replace($haystack, '"' . $value . '"', $pos, strlen($needle));
                }
            }
            $query = $haystack;
        }
        return $query;
    }// Display query method

} // class DataBase
?>