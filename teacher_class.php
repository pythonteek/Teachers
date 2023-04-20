class teacher{
        public $id;
        public $name;
        public $phone;
        public $major;
        public $edu;
        
        function set_teacher($mobile) {
            //global $conn;
            include("db_connect.php");
            $sql = "SELECT * FROM subjects WHERE phone='$mobile'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["email"] . "<br>";
                $this->id = $row["id"];
                $this->name = $row["name"];
              }
            } else {
              echo "0 results";
            }
            //$conn->close();
        }
        
        function find_class($id) {
            //global $conn;
            include("db_connect.php");
            $sql = "SELECT * FROM class_subject WHERE subject_id='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["email"] . "<br>";
                $class_id = $row["class_id"];
                echo $class_id . " ";
                
                $sql2 = "SELECT * FROM class";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        if($row2['id'] == $class_id){
                            echo $row2['level'] . " " . $row2['section'] . " " . $row2['status'] . "</br>";
                        }
                    }
                } else {
                  echo "0 results";
                }
              }
            } else {
              echo "0 results";
            }
            //$conn->close();
        }
        
        
        function my_students($class_id){
            //global $conn;
            include("db_connect.php");
            $sql = "SELECT * FROM students WHERE class_id='$class_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo $row['name'];
              }
            } else {
              echo "0 results";
            }
            //$conn->close();
            
        }
        
        
        function edit_pass($id, $pass1, $pass2){
            $t = $conn->query("SELECT password FROM subjects WHERE name='$name'");
            while($row=$t->fetch_assoc())
            {
                $pass = $row['password'];
            }
            if($pass == $pass1){
                if($pass3 == $pass2){
                    $sql = "UPDATE subjects SET password='$pass2' WHERE name='$name'";
                    if ($conn->query($sql) === TRUE) {
                      $error = 0;//success...
                    } else {
                      echo "Error updating record: " . $conn->error;
                      return 3;
                    }
                }
                else
                {
                    return 2;//incorrect pass2 and pass3...
                }
            }
            else
            {
                return 1;//pass1 is incorrect...
            }
        }
        
        
        function get_data(){
            return $this->name;
        }
        function get_id(){
            return $this->id;
        }
        
        
    }
