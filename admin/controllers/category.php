<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "../../database/connect.php";
include_once "../includes/libs.php";

class CategoryController {

    public function __construct() {
        if (isset($_POST["submit"])) {
            switch ($_POST['submit']) {
                case 'add':
                    $this->add();
                    break;
                case 'edit':
                    $this->edit();
                    break;
                case 'del':
                    $this->delete();
                    break;
                case 'actived':
                    $this->actived();
                    break;
            }
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "<h1>404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            exit();
        }
    }

    public function add() {
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $description = isset($_POST["description"]) ? $_POST["description"] : '';
        $position = isset($_POST["position"]) ? $_POST["position"] : 0;
        $actived = isset($_POST["actived"]) ? 1 : 0;

        $vSQL_Ins = "INSERT INTO category(name, description, position, actived)
				VALUES('$name', '$description',$position,$actived)";
        mysql_query($vSQL_Ins);

        if (mysql_affected_rows() > 0) {
            setFlash('message', "Bạn đã thêm mới một loại sản phẩm thành công!");
            setFlash('alert-class', 'alert-success');
        } else {
            setFlash('message', "Thao tác không thành công!");
            setFlash('alert-class', 'alert-danger');
        }
        return header('Location: ../?mod=category');
    }

    public function edit() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST["description"]) ? $_POST["description"] : '';
        $position = isset($_POST["position"]) ? $_POST["position"] : 0;
        $actived = isset($_POST["actived"]) ? 1 : 0;

        if (!empty($id)) {
            $vSQL_Upd = "UPDATE category 
			SET name = '$name', description= '$description', position=$position, actived=$actived
				WHERE ID=$id";
            mysql_query($vSQL_Upd);
            if (mysql_affected_rows() > 0) {
                setFlash('message', "Bạn đã cập nhật một loại sản phẩm thành công!");
                setFlash('alert-class', 'alert-success');
            } else {
                setFlash('message', "Thao tác không thành công!");
                setFlash('alert-class', 'alert-danger');
            }
        }
        return header('Location: ../?mod=category');
    }

    public function delete() {
        if (isset($_POST['type'])) {
            switch ($_POST['type']) {
                case 'one':
                    $vSQL_Del = "DELETE from category where id=" . $_POST['id'];
                    mysql_query($vSQL_Del);
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá loại sản phẩm thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;

                case 'multi':
                    $multi = explode(',', $_POST['id']);
                    foreach ($multi as $id) {
                        $vSQL_Del = "DELETE from category where id=$id";
                        mysql_query($vSQL_Del);
                    }
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá loại sản phẩm thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;
            }
        }
        return header('Location: ../?mod=category');
    }

    public function actived() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $actived = $_POST["actived"] == 0 ? 1 : 0;
        if (!empty($id)) {
            $vSQL_Upd = "UPDATE category SET actived=$actived WHERE ID=$id";
            mysql_query($vSQL_Upd);
        }
        if (mysql_affected_rows() > 0)
            echo json_decode('OK');
        else {
            header('HTTP/1.1 500 Internal Server');
            echo json_decode("Error!");
        }
    }

}

new CategoryController();
?>