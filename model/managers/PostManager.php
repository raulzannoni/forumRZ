<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        public function __construct(){
            parent::connect();
        }

        public function findAllByTopic($id){
                    $sql = "SELECT p.id_post, p.text_post, CAST(p.date_post AS DATETIME) AS date_post, p.topic_id, p.user_id
                    FROM ".$this->tableName." p
                    WHERE p.topic_id = :id
                    ORDER BY p.date_post DESC"; 
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }
        public function countAllPostsByTopic($id){
                $sql = "SELECT COUNT(p.id_post) AS NbPosts
                FROM ".$this->tableName." p
                WHERE p.topic_id = :id"; 
        
        return $this->getSingleScalarResult(
            DAO::select($sql, ['id' => $id])
            );
        }

    }