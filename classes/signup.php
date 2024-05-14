<?php 
    class Signup{
        private $error = "";

        public function evaluate($data){
            foreach($data as $key => $value){
                if(empty($value)){
                    $this->error .= $key . "is empty!<br>";
                }

                if($key == "email"){
                   if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)){
                    $this->error = $this->error . "invalid email adress!<br>";
                   }
                }

                if($key == "first_name"){
                    if(is_numeric($value) || strstr($value, " ")){
                     $this->error = $this->error . "first name cant be a number<br>";
                    }
                 }

                 if($key == "last_name" || strstr($value, " ")){
                    if(is_numeric($value) || strstr($value, " ")){
                     $this->error = $this->error . "last name cant be a number<br>";
                    }
                 }
            }

            if($this->error == ""){
                $this->create_user($data);
            }else{
                return $this->error;
            }
        }

        public function create_user($data){
            $firstName = ucfirst($data['first_name']);
            $lastName = ucfirst($data['last_name']);
            $gender = $data['gender'];
            $email = $data['email'];
            $password = $data['password'];
            $urlAddress = strtolower($firstName) . "." . strtolower($lastName);
            $userid = $this->create_userid();

            $query = "insert into users(userid, first_name, last_name, gender, email, password, url_address) values('$userid', '$firstName', '$lastName', '$gender', '$email', '$password', '$urlAddress')";

            $DB = new Database();
            $DB->save($query);
        }

        private function create_userid(){
            $length = rand(4, 19);
            $number = "";
            for($i = 0; $i < $length; $i++){
                $new_rand = rand(0, 9);

                $number = $number . $new_rand;
            }

            return $number;
        }
    }
?>