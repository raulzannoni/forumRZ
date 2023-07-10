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

            $sql = "SELECT t.id_topic, t.title_topic, CAST(t.date_topic AS DATETIME) AS date_topic, t.category_id, t.user_id, COUNT(p.id_post) AS nbPosts
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

        public function getTotalCountTopicsByCategory($id){
            $sql = "SELECT COUNT(*) as count
                    FROM ".$this->tableName." t
                    WHERE t.category_id = :id";

            return $this->getSingleScalarResult(
                    DAO::select($sql, ["id" => $id])
            );
        }
        public function listTopicsByCategory(array $order = null, int $id){

            $orderQuery = ($order) ?
                        "ORDER BY ".$order[0]." ".$order[1] :
                        "";

            $sql = "SELECT t.id_topic, t.title_topic, t.date_topic, t.user_id, t.category_id, COUNT(p.id_post) AS nbPosts 
                    FROM " .$this->tableName. " t, post p
                    WHERE p.topic_id = t.id_topic
                    AND t.category_id = :id
                    GROUP BY t.id_topic
                    ORDER BY ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

    }