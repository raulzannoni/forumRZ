<?php
        namespace Model\Entities;

        use App\Entity;

        final class Topic extends Entity{

                private $id;
                private $title;
                private $user;
                private $creationdate;
                private $closed;
                private $category;
                private $nbPosts;

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
                 * Get the value of title
                 */ 
                public function getTitle()
                {
                        return $this->title;
                }

                /**
                 * Set the value of title
                 *
                 * @return  self
                 */ 
                public function setTitle($title)
                {
                        $this->title = $title;

                        return $this;
                }

                /**
                 * Get the value of user
                 */ 
                public function getUser()
                {
                        return $this->user;
                }

                /**
                 * Set the value of user
                 *
                 * @return  self
                 */ 
                public function setUser($user)
                {
                        $this->user = $user;

                        return $this;
                }

                public function getCreationdate(){
                        //$formattedDate = $this->creationdate->format("Y-m-d H:i:s");
                        //return $formattedDate;
                        return $this->creationdate->format("Y-m-d H:i:s");
                }

                public function setCreationdate($date){
                        $this->creationdate = new \DateTime($date);
                        return $this;
                }

                /**
                 * Get the value of closed
                 */ 
                public function getClosed(){
                        return $this->closed;
                }

                /**
                 * Set the value of closed
                 *
                 * @return  self
                 */ 
                public function setClosed($closed){
                        $this->closed = $closed;

                        return $this;
                }

                /**
                 * Get the value of category
                 */ 
                public function getCategory()
                {
                        return $this->category;
                }

                /**
                 * Set the value of category
                 *
                 * @return  self
                 */ 
                public function setCategory($category)
                {
                        $this->category = $category;

                        return $this;
                }

                public function getNbPosts(){
                        return $this->nbPosts;
                }

                public function setNbPosts($nbPosts){
                        $this->nbPosts = $nbPosts;
                        return $this;
                }
        }
