<?php

class Like {
    private $uid; //user ID
    private $aid; //article ID
    private $db;

    public function __construct($aid) {
        $this->db = new PDO('mysql:host=localhost;dbname=wordpress;charset=utf8', 'wordpressuser', 'password');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $this->aid = $aid;
    }

    //function changing, or adding likes
    public function addLike($uid, $type) {
        if(trim($uid)!="" && trim($type)!="") {
            try {
                //detecting if specific article like already exists
                $command = "SELECT ID, Type FROM likes WHERE UserID=? AND ArticleID=?";
                $query = $this->db->prepare($command);
                $query->execute(array($uid, $this->aid));

                //if like exists
                if($query->rowCount()>0) {
                    $like = $query->fetch(PDO::FETCH_ASSOC);

                    //if new like type is the same as in the database, delete it
                    if($like['Type']==$type) {
                        $deleteCommand = "DELETE FROM likes WHERE ID=?";
                        $deleteQuery = $this->db->prepare($deleteCommand);
                        $deleteQuery->execute(array($like['ID']));
                        $deleteQuery->closeCursor();

                        return 1;
                    }
                    //else change like type to new value
                    else {
                        $updateCommand = "UPDATE likes SET Type=? WHERE ID=?";
                        $updateQuery = $this->db->prepare($updateCommand);
                        $updateQuery->execute(array($type, $like['ID']));
                        $updateQuery->closeCursor();

                        return 2;
                    }

                    $query->closeCursor();
                }
                //if like for specific article doesn't exist, add it
                else {
                    $command = "INSERT INTO likes(`UserID`,`ArticleID`,Type) VALUES(?, ?, ?)";
                    $query = $this->db->prepare($command);
                    $query->execute(array($uid, $this->aid, $type));
                    $query->closeCursor();

                    return 3;
                }
            }
            catch(PDOException $ex) {
                return 0;
            }
        }
    }

    //checking like type, return type when succeeds, else 0
    public function checkLike($uid) {
        try {
            $command = "SELECT ID, Type FROM likes WHERE UserID=? AND ArticleID=?";
            $query = $this->db->prepare($command);
            $query->execute(array($uid, $this->aid));

            if($query->rowCount()>0) {
                $like = $query->fetch(PDO::FETCH_ASSOC);
                return $like['Type'];
            }
            else {
                return 0;
            }
        }
        catch(PDOException $ex) {
            return 0;
        }
    }

    ///function to get likes count
    public function getLikesCount() {
        try {
            $command = "SELECT (COUNT(case when Type='U' then 1 end) - COUNT(case when Type='D' then 1 end)) as count FROM likes WHERE ArticleID = ?";
            $query = $this->db->prepare($command);
            $query->execute(array($this->aid));

            //if($query->rowCount()>0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                //var_dump($data);
                $data = $data['count'];
                
                return $data;
            //}
            //else {
            //    return 0;
            //}
        }
        catch(PDOException $e) {
            return 0;
        }
    }
}