<?php
namespace controller;
use core\Controller;
use model\Category;
use model\User;
use model\Product;
class controller_product extends Controller
{
    public function action_test() {
        $this->app->response(['test'=>'test']);
    }
    public function action_allcategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $model = new Category;
            $result = $model->allCategory();
            $this->app->response($result);
        }
    }
    public function action_getproduct() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            if (isset($_GET['id_category'])) 
            {
                $product = new Product;
                $result = $product->getProduct($_GET['id_category']);
                $this->app->response($result);
               
            }
            else
            {
                $this->sendError("Id продукта пусто");
            }
            
        }
    }
    public function action_category()
    {
        $methodVar = '_'.$_SERVER['REQUEST_METHOD'];
        parse_str(file_get_contents('php://input'), $$methodVar);
        if (isset($$methodVar['token'])) 
        {
            $user = new User();
            $result = $user->isAuth($$methodVar['token']);
            if ($result==false) 
            {
                $this->sendError('Пользователь не авторизован');
            }
            switch ($_SERVER['REQUEST_METHOD']) 
            {
                case 'POST':
                    if(isset($_POST['title']))
                    {
                        $create_category = new Category();
                        $create_result = $create_category->createCategory($_POST['title']);
                        if ($create_result == true) 
                        {
                            $this->app->response(['title' => $_POST['title'], 'text' => "Вы успешно добавили категорию!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при добавлении категории");
                        }
                    }
                    else
                    {
                        $this->sendError("Наименование категории пусто");
                    }

                break;

                case 'PUT':
                    if(isset($_PUT['title']) && isset($_PUT['id']))
                    {
                        $update_category = new Category();
                        $update_result = $update_category->updateCategory($_PUT['id'],$_PUT['title']);
                        if ($update_result == true) 
                        {
                            $this->app->response(['id' => $_PUT['id'],'title' => $_PUT['title'], 'text' => "Вы успешно отредактировали категорию!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при редактировании категории");
                        }
                    }
                    else
                    {
                        $this->sendError("Наименование категории или Id категории пусто");
                    }

                break;

                case 'DELETE':
                    if(isset($_DELETE['id']))
                    {
                        $delete_category = new Category();
                        $delete_result = $delete_category->deleteCategory($_DELETE['id']);
                        if ($delete_result == true) 
                        {
                            $this->app->response(['id' => $_DELETE['id'],'text' => "Вы успешно удалили категорию!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при удалении категории");
                        }
                    }
                    else
                    {
                        $this->sendError("Id категории пусто");
                    }

                break;

                default :
                    $this->sendError('Используйте PUT,DELETE,POST');
                break;
            }
        }
        else
        {
            $this->sendError('Токен отсутствует');
        }
    }
     public function action_product()
    {
        $methodVar = '_'.$_SERVER['REQUEST_METHOD'];
        parse_str(file_get_contents('php://input'), $$methodVar);
        if (isset($$methodVar['token'])) 
        {
            $user = new User();
            $result = $user->isAuth($$methodVar['token']);
            if ($result==false) 
            {
                $this->sendError('Пользователь не авторизован');
            }
            switch ($_SERVER['REQUEST_METHOD']) 
            {
                case 'POST':
                    if(isset($_POST['title'])&& isset($_POST['id_category']))
                    {
                        $create_product = new Product();
                        $create_result = $create_product->createProduct($_POST['title'],$_POST['id_category']);
                        if ($create_result == true) 
                        {
                            $this->app->response(['title' => $_POST['title'],'id_category' => $_POST['id_category'], 'text' => "Вы успешно добавили продукт!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при добавлении продукта");
                        }
                    }
                    else
                    {
                        $this->sendError("Наименование продукта или id категории пусто");
                    }

                break;

                case 'PUT':
                    if(isset($_PUT['id_product']) && isset($_PUT['title'])&& isset($_PUT['id_category']))
                    {
                        $update_product = new Product();
                        $update_result = $update_product->updateProduct($_PUT['id_product'],$_PUT['title'],$_PUT['id_category']);
                        if ($update_result == true) 
                        {
                            $this->app->response(['id_product' => $_PUT['id_product'],'title' => $_PUT['title'],'id_category' => $_PUT['id_category'], 'text' => "Вы успешно отредактировали продукт!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при редактировании продукта");
                        }
                    }
                    else
                    {
                        $this->sendError("Наименование продукта, Id продукта или Id категории пусто");
                    }

                break;

                case 'DELETE':
                    if(isset($_DELETE['id']))
                    {
                        $delete_product = new Product();
                        $delete_result = $delete_product->deleteProduct($_DELETE['id']);
                        if ($delete_result == true) 
                        {
                            $this->app->response(['id' => $_DELETE['id'],'text' => "Вы успешно удалили продукт!"]);
                        }
                         else
                        {
                           $this->sendError("Произошла ошибка при удалении продукта");
                        }
                    }
                    else
                    {
                        $this->sendError("Id продукта пусто");
                    }

                break;

                default :
                    $this->sendError('Используйте PUT,DELETE,POST');
                break;
            }
        }
        else
        {
            $this->sendError('Токен отсутствует');
        }
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

