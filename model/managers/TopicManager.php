<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }
        public function findAllAndCount(){

            $sql = "SELECT t.id_topic, t.title_topic, t.date_topic, t.category_id, t.user_id, COUNT(p.id_post) AS nbPosts
                    FROM ".$this->tableName." t, post p
                    WHERE t.id_topic = p.topic_id
                    GROUP BY t.id_topic
                    ORDER BY t.date_topic DESC";

            return $this->getMultipleResults(
                    DAO::select($sql),
                    $this->className
                );
        }

        public function getTotalCountTopics() {
            $sql = "SELECT COUNT(*) AS count 
                    FROM ".$this->tableName. "";

            return $this->getSingleScalarResult(
                    DAO::select($sql)
                );
            
        }
        public function listTopicsByCategory($id){

            $sql = "SELECT t.id_topic, t.title_topic, t.date_topic, t.user_id, t.category_id, COUNT(p.id_post) AS nbPosts 
                    FROM " .$this->tableName. " t, post p
                    WHERE p.topic_id = t.id_topic
                    AND t.category_id = :id
                    GROUP BY t.id_topic
                    ORDER BY t.date_topic DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

    }