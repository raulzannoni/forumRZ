<?php
    namespace Model\Entities;

    use App\Entity;
    final class Category extends Entity{

        private $id;
        private $name;
        private $nbTopics;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        public function getId(){
                return $this->id;
        }

        public function setId($id){
                $this->id = $id;
                return $this;
        }

        public function getName(){
                return $this->name;
        }

        public function setName($name){
                $this->name = $name;
                return $this;
        }

        public function getNbTopics(){

                return $this->nbTopics;
        }

        public function setNbTopics($nbTopics) {

                $this->nbTopics = $nbTopics;
                return $this;
        }
    }