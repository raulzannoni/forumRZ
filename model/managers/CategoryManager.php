<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";

        public function __construct(){
            parent::connect();
        }
        public function findAllAndCount() {

            $sql=  "SELECT c.id_category, c.name_category, COUNT(t.id_topic) AS nbTopics
                    FROM topic t, ".$this->tableName." c
                    WHERE c.id_category = t.category_id
                    GROUP BY c.id_category
                    ORDER BY c.name_category";

            return $this->getMultipleResults(
                    DAO::select($sql),
                    $this->className
                );
        }

    }