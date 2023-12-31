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

        public function findAllUsersByTopic($id) {
            $sql = "SELECT u.id_user, u.nickname_user AS nickname , u.password_user AS password, u.mail_user AS mail, u.date_user AS creationDate, p.topic_id, u.role_user AS role
                    FROM ".$this->tableName." u, post p
                    WHERE p.topic_id = :id
                    AND p.user_id = u.id_user";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function findUserById($id){

            $sql = "SELECT id_user AS id, nickname_user as nickname, mail_user as mail, date_user as creationdate, role_user as role
                    FROM ".$this->tableName."
                    WHERE id_user = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
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

            $sql = "SELECT id_user AS id, nickname_user as nickname, mail_user as mail, date_user as creationdate, role_user as role
                    FROM ".$this->tableName."
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