<?php
namespace model;
use core\model;
class Category extends Model
{
    public function allCategory()
    {
        $query = $this->app->db->query("SELECT * FROM Category");
        $row = $query->fetchAll(\PDO::FETCH_OBJ);
        return $row;
    }
    public function createCategory($categoryTitle)
    {
        $sql = 'INSERT INTO Category (name) VALUES(:categoryTitle)';
        $query = $this->app->db->prepare($sql);
        $query->execute([':categoryTitle'=>$categoryTitle]);
        if ($query->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateCategory($categoryId,$categoryNewTitle)
    {
        $sql = 'UPDATE Category SET name =:categoryNewTitle WHERE id =:categoryId';
        $query = $this->app->db->prepare($sql);
        $query->execute([':categoryNewTitle'=>$categoryNewTitle,':categoryId'=>$categoryId]);
        if ($query->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        } 
    }
    public function deleteCategory($categoryIdDelete)
    {
        $sql = 'DELETE FROM Category WHERE id =:categoryIdDelete';
        $query = $this->app->db->prepare($sql);
        $query->execute([':categoryIdDelete'=>$categoryIdDelete]);
        if ($query->rowCount() > 0)
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

