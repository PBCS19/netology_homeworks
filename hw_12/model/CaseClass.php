<?php
class CaseClass
{
    function addCase($param) {
        $sth = Di::get()->db()->prepare(
                "INSERT INTO task (user_id, assigned_user_id, description) "
                . "VALUES (:user_id, :assigned_user_id, :description)");
        return $sth->execute($param);
    }
    
    function delCase($param) {
        $sth = Di::get()->db()->prepare(
                "DELETE FROM task WHERE user_id=:user_id AND id=:id LIMIT 1");
        return $sth->execute($param);
    }
    
    function delegateCase($param) {
        $sth = Di::get()->db()->prepare(
                "UPDATE task SET assigned_user_id=:assigned_user_id WHERE id=:id AND user_id=:user_id");
        return $sth->execute($param);
    }
    
    function updateCase($param) {
        $sth = Di::get()->db()->prepare(
                "UPDATE task SET is_done=1 WHERE (user_id=:user_id OR assigned_user_id=:user_id) AND id=:id LIMIT 1");
        return $sth->execute($param);
    }
    
    function selectUser() {
        $sth = Di::get()->db()->prepare("SELECT * FROM user"); 
        $sth->execute();
        $assignedUserList = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $assignedUserList;
    }
    
    function assignedUser() {
        $sth = Di::get()->db()->prepare("SELECT * FROM task WHERE user_id=:id OR assigned_user_id=:id ORDER BY date_added DESC"); 
        $sth->execute(['id'=>$_SESSION['user_id']]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function selectDelegate() {
        $sth = Di::get()->db()->prepare("SELECT * FROM task t INNER JOIN user u ON u.id=t.assigned_user_id WHERE t.user_id =:id OR t.assigned_user_id = :id"); 
        $sth->execute(['id'=>$_SESSION['user_id']]);
        $stmtDelegate = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $stmtDelegate;
    }
    
    function countCase() {
        $sth = Di::get()->db()->prepare("SELECT count(*) as c FROM task as t WHERE t.user_id = :id OR t.assigned_user_id = :id"); 
        $sth->execute(['id'=>$_SESSION['user_id']]);
        $countCase = $sth->fetch();
        return $countCase;
    }
}
