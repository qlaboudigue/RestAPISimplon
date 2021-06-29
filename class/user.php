<?php
    class User {

        // Columns
        public $id;
        public $email;
        public $password;
        public $birthDate;
        
        // Getters
        public function getId(){
            return $this->id;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function getPassword(){
            return $this->password;
        }
        
        public function getBirthDate(){
            return $this->birthDate;
        }
        
        // Setters
        public function setId($id){
            $this->id = $id;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        
        public function setPassword($password){
            $this->password = $password;
        }
        
        public function setBirthDate($birthDate){
            $this->birthDate = $birthDate;
        }




    }

?>
