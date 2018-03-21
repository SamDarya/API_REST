<?php
namespace model;
use core\model;

class User extends Model
{
    
    public static function generatePassword($password) {
        return md5(substr(sha1($password), 2, 10));
    }
    
    private function setSession($userID)
    {
        $token = uniqid('', true);
        $sql = 'SELECT * FROM Session WHERE id_user= :id';
        $query = $this->app->db->prepare($sql);
        $query->execute([':id'=>$userID]);
        $row = $query->fetchAll(\PDO::FETCH_COLUMN, 0);
        if (count($row) > 0)
        {
            $sql_session = 'DELETE FROM Session WHERE id_user= :id)';
            $query_session = $this->app->db->prepare($sql_session);
            $query_session->execute([':id'=>$userID]);
        }
        
        $sql_session = 'INSERT INTO Session (id_user,time_auth,token) VALUES (:id,:time,:token)';
        $query_session = $this->app->db->prepare($sql_session);
        $query_session->execute([':id'=>$userID, ':time'=>date("Y-m-d H:i:s"), ':token'=>$token]);
        return $token;
    }
    public function auth($login, $pass)
    {
        $password = self::generatePassword($pass);
        if (!empty($login) and (!empty($password)))
        {
            $sql = 'SELECT * FROM User WHERE (login= :login and password = :password)';
            
            $query = $this->app->db->prepare($sql);
            $query->execute([':login'=>$login, ':password'=> $password]);
            $row = $query->fetchAll(\PDO::FETCH_COLUMN, 0);
            if (count($row) > 0)
            {
                //$id_user = $query->fetchColumn(0);
                return $this->setSession($row[0]);
            }
            else 
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function isAuth ($token)
    {
        $sql = 'SELECT * FROM Session WHERE token= :token';
        $query = $this->app->db->prepare($sql);
        $query->execute([':token'=>$token]);
        $row = $query->fetchAll(\PDO::FETCH_OBJ);
        if (count($row) > 0)
        {
             return true;
        }
        else 
        {
                return false;
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

