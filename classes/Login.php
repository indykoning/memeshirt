<?php
class Login extends PDO
{
    private static $instance;
    public static function getInstance ($db_host, $db_name, $db_username, $db_password){
        if (!self::$instance){
            self::$instance = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_username, $db_password);
        }
        return self::$instance;
    }

    private $pass_hash;
    public function __construct( $table = 'users', $id_rowName = 'id', $username_rowName = 'username', $password_rowName = 'password', $key_rowName = 'login_key', $db_host = DB_HOST, $db_name=DB_NAME, $db_username=DB_USERNAME, $db_password=DB_PASSWORD)
    {
        if(session_id() == '') {
            session_start();
        }
        $this->Return_array = [];
        $this->table = $table;
        $this->id_rowName = $id_rowName;
        $this->username_rowName = $username_rowName;
        $this->password_rowName = $password_rowName;
        $this->key_rowName = $key_rowName;

        $this->db = $this->getInstance($db_host, $db_name, $db_username, $db_password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(version_compare(phpversion(), '5.5', '<')){
            $this->pass_hash = 0;
        }else{
            $this->pass_hash = 1;
        }
    }

    public function loggedin($get_rows_array = array())
    {
            if (!empty($_SESSION['KEY']) && !empty( $_SESSION['ID']) && !empty($_SESSION['IP']) && $_SESSION['KEY'] !== '' && $_SESSION['IP'] == $_SERVER["REMOTE_ADDR"]) {
                $select_string = "";
                if (!empty($get_rows_array)) {
                    $select_string = ",".implode(",", $get_rows_array);
                }

                $id = $_SESSION['ID'];
                $stmt = $this->db->prepare("SELECT `" . $this->key_rowName. "` $select_string FROM `$this->table` WHERE `". $this->id_rowName. "`=".$id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row[$this->key_rowName] == $_SESSION['KEY']){
                    $this->Return_array = [];
                    for ($j = 0; $j<count($get_rows_array); $j++){
                        $this->Return_array[$get_rows_array[$j]] = $row[$get_rows_array[$j]];
                    }
                    return 1;
                }else{
                    return 0;
                }
            } else {
                return 0;
            }
    }

    public function logout($returnLocation = './'){
        session_start();
        $this->db->query("UPDATE `" . $this->table . "` SET `".$this->key_rowName. "`='' WHERE `". $this->id_rowName ."`=".$_SESSION['ID']);
        $_SESSION['ID'] = '';
        $_SESSION['KEY'] = '';
        $_SESSION['IP'] = '';
        session_unset();
        session_destroy();
//        header('location: ' . $returnLocation);
    }

    public function login($username, $password, $get_rows_array = array()){
        $select_string = "";
        if (!empty($get_rows_array)) {
        $select_string = ",".implode(",", $get_rows_array);
        }
        $stmt = $this->db->prepare("SELECT `" . $this->password_rowName . "`,`" . $this->id_rowName . "` $select_string FROM `" . $this->table . "` WHERE ". $this->username_rowName ." = :username");
        $stmt->bindValue(':username', filter_var($username, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
        if($stmt->execute()){
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
            $success = 0;
            switch ($this->pass_hash){
                case 1:
                    if(password_verify($password, $row[$this->password_rowName])){
                        $success = 1;
                    }else{
                        $success = 0;
                    }
                    break;
                case 0:
                    if(hash('whirlpool', $password) == $row[$this->password_rowName]){
                        $success = 1;
                    }else{
                        $success = 0;
                    }
                    break;
            }
            if($success){
                $_SESSION['ID'] = $row['id'];
                $_SESSION['IP'] = $_SERVER["REMOTE_ADDR"];
                $login_key = hash('whirlpool', rand(0, 500));
                $_SESSION['KEY'] = $login_key;
                $this->Return_array = [];
                for ($j = 0; $j<count($get_rows_array); $j++){
                $this->Return_array[$get_rows_array[$j]] = $row[$get_rows_array[$j]];
                }

                $this->db->query("UPDATE `" . $this->table . "` SET `".$this->key_rowName. "`='". $login_key. "' WHERE `". $this->id_rowName ."`=".$row['id']);

                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function register($username, $password, $additional_rows_assoc = array()){

        switch ($this->pass_hash){
            case 1:
                $password = password_hash($password, PASSWORD_DEFAULT);
                break;
            case 0:
                $password = hash('whirlpool', $password);
                break;
        }
        $rows = '';
        $values = '';
        foreach ($additional_rows_assoc as $key => $value){
        $rows .= ", `$key`";
        $values .= ", :" . str_replace(' ', '_', $key) . "PDO_VALUE";
        }
        $stmt = $this->db->prepare("INSERT INTO `". $this->table ."` (`". $this->username_rowName ."`, `" . $this->password_rowName ."` " . $rows . ") VALUES (:username, '$password' " . $values . ")");
        $stmt->bindValue(':username', filter_var($username, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
//        $stmt->bindValue(':password', $username, PDO::PARAM_STR);
        foreach ($additional_rows_assoc as $key => $value) {
            $stmt->bindValue(':' . str_replace(' ', '_', $key) . "PDO_VALUE", filter_var($value, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
        }
        if ($stmt->execute()){
            return 1;
        }else{
            return 0;
        }

    }
    public function getArray(){
        return $this->Return_array;

    }
}
