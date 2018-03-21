<?php
namespace model;
use core\model;
class Product extends Model
{
    
    public function getProduct($categoryId) 
    {
        $sql = 'SELECT id_product FROM relations_category_product WHERE id_category=:id_category';
        $query = $this->app->db->prepare($sql);
        $query->execute([':id_category'=>$categoryId]);
        $products = $query->fetchAll(\PDO::FETCH_COLUMN);
        if(count($products)>0)
        {
            $in  = str_repeat('?,', count($products) - 1) . '?';
            $sql_list = "SELECT * FROM product WHERE id IN ({$in})";
            $query_list = $this->app->db->prepare($sql_list);
            $query_list->execute($products);
            return $query_list->fetchAll(\PDO::FETCH_OBJ);
        }
        else
        {
            return false;
        }
    }
    public function createProduct($productName,$categoryId)
    {
        
        $sql = 'INSERT INTO product (name) VALUES(:productName)';
        $query = $this->app->db->prepare($sql);
        $query->execute([':productName'=>$productName]);
        
        if ($query->rowCount() > 0)
        {
            $category_arr = explode(",",$categoryId);
            $id = $this->app->db->lastInsertId();
            foreach ($category_arr as $value)
            {
                $sql_relations = 'INSERT INTO relations_category_product (id_category,id_product) VALUES(:id_category,:id_product)';
                $query_relations = $this->app->db->prepare($sql_relations);
                $query_relations->execute([':id_category'=>$value, ':id_product'=>$id]);
            }
            return true;
            /*$sql_relations = 'INSERT INTO relations_category_product (id_category,id_product) VALUES(:id_category,:id_product)';
            $query_relations = $this->app->db->prepare($sql_relations);
            $query_relations->execute([':id_category'=>$categoryId, ':id_product'=>$id]);*/
        }
        else
        {
            return false;
        }
        
        
    }
    public function updateProduct($productId,$productName,$categoryId)
    {
        
        $sql = 'UPDATE Product SET name =:productName WHERE id =:productId';
        $query = $this->app->db->prepare($sql);
        $query->execute([':productName'=>$productName,':productId'=>$productId]);
        
        if ($query->rowCount() > 0)
        {
            
            $category_arr = explode(",",$categoryId);
            $sql ='DELETE FROM relations_category_product WHERE id_product = :productID';
            $query_delete = $this->app->db->prepare($sql);
            $query_delete->execute([':productID'=>$productId]);
            foreach ($category_arr as $value) {
                $sql_relations = 'INSERT INTO relations_category_product (id_category,id_product) VALUES(:id_category,:id_product)';
                $query_relations = $this->app->db->prepare($sql_relations);
                $query_relations->execute([':id_category'=>$value, ':id_product'=>$productId]);
            }
            
            
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
    public function deleteProduct($productId)
    {
        $sql_delete ='DELETE FROM relations_category_product WHERE id_product = :productID';
        $query_delete = $this->app->db->prepare($sql_delete);
        $query_delete->execute([':productID'=>$productId]);
        $sql_product = 'DELETE FROM product WHERE id = :productID';
        $query_product = $this->app->db->prepare($sql_product);
        $query_product->execute([':productID'=>$productId]);
        if ($query_product->rowCount() > 0)
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

