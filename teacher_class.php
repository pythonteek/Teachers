<?php
class teacher{
    public $id;
    public $name;
    public $phone;
    public $password;
    
    function login($username, $password){
        include("db_connect.php");
        session_start();
        $uname = $username;
    	$pass = $password;
    	$pass=md5($pass);
    	if (empty($uname)) {
    		return 1;
    	    exit();
    	}else if(empty($pass)){
            return 2;
    	    exit();
    	}else{
    		$sql = "SELECT * FROM subjects WHERE phone='$uname' AND password='$pass'";
    		$result = mysqli_query($conn, $sql);
    		if (mysqli_num_rows($result) === 1) {
    			$row = mysqli_fetch_assoc($result);
                if ($row['phone'] === $uname && $row['password'] === $pass) {
                	$_SESSION['username'] = $row['phone'];
                	$_SESSION['name'] = $row['name'];
                	$_SESSION['id'] = $row['id'];
                	return 0;
    		        exit();
                }else{
    				return 3;
    		        exit();
    			}
    		}else{
    			return 3;
    	        exit();
    		}
    	}
    }
    
    function find_class($id) {
        //global $conn;
        include("db_connect.php");
        $data = array();
        $sql = "SELECT * FROM class_subject WHERE subject_id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            //echo "id: " . $row["email"] . "<br>";
            $class_id = $row["class_id"];
            //echo $class_id . " ";
    
            $sql2 = "SELECT * FROM class";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $my_class = array();
                    if($row2['id'] == $class_id){
                        $cur_class = $row2['level'] . " " . $row2['section'] . " " . $row2['status'] . "</br>";
                        array_push($my_class, $row2['id']);
                        array_push($my_class, $row2['level']);
                        array_push($my_class, $row2['section']);
                        array_push($my_class, $row2['status']);
                        array_push($data, $my_class);
                        //echo $cur_class;
                    }
                }
            } else {
              echo "0 results";
            }
          }
        } else {
          echo "0 results";
        }
        return($data);
        //$conn->close();
    }
    
    function find_student($id){
        //global $conn;
        include("db_connect.php");
        $students = array();
        $sql = "SELECT * FROM students WHERE class_id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $curr_student = array();
                //echo $row['id_no'] . " " . $row['laptop'] . " " . $row['name'] . " " . $row['section'] . "</br>";
                
                array_push($curr_student, $row['id_no']);
                array_push($curr_student, $row['laptop']);
                array_push($curr_student, $row['name']);
                array_push($curr_student, $row['section']);
                array_push($students, $curr_student);
            }
        }
        return($students);
    }
    
    function upload_image($filename, $size, $file, $token){
        $conn = mysqli_connect('localhost','pythonte_sajjad','@saj1085442','pythonte_DB');
        
        $sql = "SELECT * FROM files";
        $result = mysqli_query($conn, $sql);
        
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $destination = 'images/' . $filename;
        
        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        
        if (!in_array($extension, ['jpeg', 'png', 'jpg'])) {
            return 3;
        } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            return 4;
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                
                
                $sql = "SELECT * FROM teachers_profile_image WHERE token='$token'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $sql2 = "DELETE FROM teachers_profile_image WHERE token=$token";
                    if ($conn->query($sql2) === TRUE) {
                        $sql3 = "INSERT INTO teachers_profile_image (name, size, downloads, token) VALUES ('$filename', $size, 0, '$token')";
                    }
                }else{
                    $sql3 = "INSERT INTO teachers_profile_image (name, size, downloads, token) VALUES ('$filename', $size, 0, '$token')";
                }
                if (mysqli_query($conn, $sql3)) {
                    return 1;
                }
            } else {
               return 2;
            }
        }
    }
    
    function find_profile_image($token){
        //global $conn;
        include("db_connect.php");
        $sql = "SELECT * FROM teachers_profile_image WHERE token='$token'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $image = "images/" . $row['name'];
            }
        }
        else{
            $image = "images/img.jpg";
        }
        return($image);
    }
}

?>
