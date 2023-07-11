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

            $sql = "SELECT t.id_topic, t.title_topic, CAST(t.date_topic AS DATETIME) AS creationdate, t.category_id, t.user_id, COUNT(p.id_post) AS nbPosts
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

        public function getTopicsByUser($id){
            $sql = "SELECT t.id_topic AS id, t.title_topic AS title, t.date_topic AS creationdate, t.category_id AS category, t.user_id as user
                    FROM ".$this->tableName." t, user u
                    WHERE u.id_user = :id
                    AND u.id_user = t.user_id";
                    
            return $this->getMultipleResults(
                        DAO::select($sql, ['id' => $id]),
                        $this->className
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

        public function getLastPostByTopic($id){
            $sql = "SELECT p.id_post, p.date_post, p.text_post, p.topic_id, p.user_id
                    FROM " .$this->tableName. " t, post p
                    WHERE p.topic_id = t.id_topic
                    AND t.id_topic = :id
                    AND p.date_post = (SELECT MAX(p.date_post) FROM post p)";

            return $this->getSingleScalarResult(
                    DAO::select($sql, ["id" => $id])
                );
        }

    }