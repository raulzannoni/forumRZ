<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findAllAndCount() {
            $sql = "
                SELECT u.id_user, u.username, u.password, u.email, u.role, u.signInDate, u.status, COUNT(l.id_liking_post) AS likesCount
                FROM user u
                LEFT JOIN post p ON p.user_id = u.id_user
                LEFT JOIN liking_post l ON l.post_id = p.id_post
                GROUP BY u.id_user
                ORDER BY u.signInDate DESC
            ";

            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );
        }
    }