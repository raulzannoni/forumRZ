<?php
        namespace Model\Entities;

        use App\Entity;

        final class Post extends Entity{

                private $id;
                private $creationdate;
                private $text;
                private $topicId;
                private $userId;
                
                

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

                public function getCreationdate(){
                        $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
                        return $formattedDate;
                }

                public function setCreationdate($date){
                        $this->creationdate = new \DateTime($date);
                        return $this;
                }

                /**
                 * Get the value of text
                 */ 
                public function getText()
                {
                        return $this->text;
                }

                /**
                 * Set the value of text
                 *
                 * @return  self
                 */ 
                public function setText($text)
                {
                        $this->text = $text;

                        return $this;
                }

                /**
                 * Get the value of topicId
                 */ 
                public function getTopicId()
                {
                        return $this->topicId;
                }

                /**
                 * Set the value of topicId
                 *
                 * @return  self
                 */ 
                public function setTopicId($topicId)
                {
                        $this->topicId = $topicId;

                        return $this;
                }

                

                /**
                 * Get the value of userId
                 */ 
                public function getUserId(){
                        return $this->userId;
                }

                /**
                 * Set the value of userId
                 *
                 * @return  self
                 */ 
                public function setUserId($userId){
                        $this->userId = $userId;

                        return $this;
                }

        }