<?php
        namespace Model\Entities;

        use App\Entity;

        final class User extends Entity{

                private $id;
                private $nickname;
                private $mail;
                private $password;
                private $creationdate;
                

                public function __construct($data){         
                        $this->hydrate($data);        
                }

                /**
                 * Get the value of id
                 */ 
                public function getId()
                {
                        return $this->id;
                }

                /**
                 * Set the value of id
                 *
                 * @return  self
                 */ 
                public function setId($id)
                {
                        $this->id = $id;

                        return $this;
                }

                /**
                 * Get the value of nickname
                 */ 
                public function getNickname()
                {
                        return $this->nickname;
                }

                /**
                 * Set the value of nickname
                 *
                 * @return  self
                 */ 
                public function setNickname($nickname)
                {
                        $this->nickname = $nickname;

                        return $this;
                }

                /**
                 * Get the value of mail
                 */ 
                public function getMail()
                {
                        return $this->mail;
                }

                /**
                 * Set the value of mail
                 *
                 * @return  self
                 */ 
                public function setMail($mail)
                {
                        $this->mail = $mail;

                        return $this;
                }

                public function getCreationdate(){
                        $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
                        return $formattedDate;
                }

                public function setCreationdate($date){
                        $this->creationdate = new \DateTime($date);
                        return $this;
                }

                /**
                 * Get the value of password
                 */ 
                public function getPassword(){
                        return $this->password;
                }

                /**
                 * Set the value of password
                 *
                 * @return  self
                 */ 
                public function setPassword($password){
                        $this->password = $password;

                        return $this;
                }

        }