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
            $sql = "SELECT u.id_user, u.nickname_user AS nickname , u.password_user AS password, u.mail_user AS mail, u.date_user AS date
                    FROM ".$this->tableName." u
                    LEFT JOIN post p ON p.user_id = u.id_user
                    
                    GROUP BY u.id_user
                    ORDER BY u.date_user DESC";

            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );
        }

        public function findOneByMail($mail){

            $sql = "SELECT * FROM ".$this->tableName."
                    WHERE mail_user = :mail";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['mail' => $mail], false), 
                $this->className
            );
        }

        public function findOneByNickname($nickname){

            $sql = "SELECT * FROM ".$this->tableName."
                    WHERE nickname_user = :nickname";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['nickname' => $nickname], false), 
                $this->className
            );
        }


        public function getPasswordByMail($mail) {
            $sql = "SELECT password_user
                    FROM ".$this->tableName."
                    WHERE mail_user = :mail";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['mail' => $mail], false), 
                $this->className
            );
        }


    }