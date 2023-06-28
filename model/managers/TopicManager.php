<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }
        public function findAllAndCount(){

            $sql = "SELECT t.id_topic, t.title_topic, t.date_topic, t.category_id, t_user_id, COUNT(m.id_message) AS nbMessages
                    FROM ".$this->tableName." t, post p
                    WHERE p     
                    "
        }

    }