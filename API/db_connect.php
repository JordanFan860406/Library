<?php
  /* Author: Joradn Fan
     Company:NKNU YUYT-Lab
     Date:2018/05/09
     Email:j860406g@gmail.com
  */
  class DB { //DB Class
    private $db_host = "140.127.74.184:3306";// DB Host
    private $db_name = "member"; // DB Name
    private $user_name = "root"; // DB User Name
    private $user_password = "jordan123451"; //DB User Password
    private $db; // Creat DB Object

    //DB Connect Function
    public function connect(){
  		try{
  			$dsn = "mysql:host=$this->db_host;dbname=$this->db_name";

  			$this->db = new PDO($dsn , $this->user_name , $this->user_password ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" , PDO::ATTR_PERSISTENT => true));

  			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  			return true;
  		}catch(Exception $e){
  			die("DB Connect Error");
  			return false;
  		}
  	}


	//update Far Infrared data to DB
	public function FIRdata_insert($bookcase_id, $touch_time){
		try{
			$sql = 'UPDATE bookcase SET touch_time=:touch_time WHERE bookcase_id=:bookcase_id';
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':touch_time', $touch_time);
			$stmt->bindParam(':bookcase_id', $bookcase_id);
			$stmt->execute();
			echo $stmt->rowCount() . " records UPDATED successfully";
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
	}

    // member register
    public function register($account,$password,$re_password,$name,$personID,$email){
      $sql = 'SELECT * FROM users WHERE account=:account OR name=:name '; //The sql of selecting account in DB
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':account', $account);
      $stmt->bindParam(':name', $name);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      if($password != $re_password) //Checking password and re_password are same
      {
        $result = array(
            msg  => "passwor_error"
        );
      }else if($row != null){ //Checking if account had already registered
        $result = array(
            msg  => "account_already"
        );
      }else{ //Account not in DB and Inserting new Data into DB
        $sql = 'INSERT INTO users(account,password,name,personID,email)VALUES(:account, :password, :name, :personID, :email)';
        $insertstmt = $this->db->prepare($sql);
        $insertstmt->bindParam(':account', $account);
        $insertstmt->bindParam(':password', $password);
        $insertstmt->bindParam(':name', $name);
        $insertstmt->bindParam(':personID', $personID);
        $insertstmt->bindParam(':email', $email);
        $insertstmt->execute();
        $result = array(
            msg  => "success"
        );
      }
      return $result;
    }

    //member login function
    public function check_login($account, $password){
      $sql = "SELECT password FROM users WHERE account = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($account));
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      if($row != null && $row->password == $password){
        $result = array(
            msg  => "success"
        );
        session_start();
        $_SESSION['account'] = $account;
      }
      else{
        $result = array(
            msg  => "fail"
        );
      }
      return $result;
    }

    public function logout(){
      session_start();
      session_destroy();
      header("location:https://henjorly.ddns.net/WEB/Library/View/index.html");
	  }


    //search member's name
    public function searchName($account){
      $sql = "SELECT name FROM users WHERE account = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($account));
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      if($row != null){
        $result = array(
            msg  => "success",
            name => $row->name
        );
        $_SESSION['account'] = $account;
      }
      else{
        $result = array(
            msg  => "fail"
        );
      }
      return $result;
    }

	}
?>
