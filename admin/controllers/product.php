<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "../../database/connect.php";
include_once "../includes/libs.php";

class ProductController {

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
        $category_id = isset($_POST["category_id"]) ? $_POST["category_id"] : 0;
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $sku = isset($_POST["sku"]) ? $_POST["sku"] : '';
        $price = isset($_POST["price"]) ? $_POST["price"] : 0;
        $imageName = isset($_POST["image"]) ? $_POST["image"] : '';
        $os = isset($_POST['os']) ? $_POST['os'] : '';
        $screen = isset($_POST['screen']) ? $_POST['screen'] : '';
        $cpu = isset($_POST['cpu']) ? $_POST['cpu'] : '';
        $ram = isset($_POST['ram']) ? $_POST['ram'] : '';
        $camera = isset($_POST['camera']) ? $_POST['camera'] : '';
        $pin = isset($_POST['pin']) ? $_POST['pin'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $actived = isset($_POST['actived']) ? 1 : 0;

//        Phần upload hình ảnh sản phẩm
        if ($_FILES["image"]["error"] == 0 && $_FILES["image"]["size"] > 0) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../../uploaded_files/" . $_FILES['image']['name']))
                $imageName = 'uploaded_files/' . $_FILES['image']['name'];
        }

        $vSQL_Ins = "INSERT INTO product(category_id, name, sku, price, image, os, screen, cpu, ram, camera,pin, description,actived)
				VALUES($category_id, '$name', '$sku', $price, '$imageName', '$os','$screen','$cpu','$ram','$camera','$pin','$description',$actived)";
        mysql_query($vSQL_Ins);

        if (mysql_affected_rows() > 0) {
            setFlash('message', "Bạn đã thêm mới một loại sản phẩm thành công!");
            setFlash('alert-class', 'alert-success');
        } else {
            setFlash('message', "Thao tác không thành công!");
            setFlash('alert-class', 'alert-danger');
        }
        return header('Location: ../?mod=product');
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
                    $imagename = mysql_fetch_row(mysql_query("select image from product where id=" . $_POST['id']))[0];
                    if ($imagename <> "")
                        unlink("../../" . $imagename);
                    $vSQL_Del = "DELETE from product where id=" . $_POST['id'];
                    mysql_query($vSQL_Del);
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá sản phẩm thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;

                case 'multi':
                    $multi = explode(',', $_POST['id']);
                    foreach ($multi as $id) {
                        $imagename = mysql_fetch_row(mysql_query("select image from product where id=$id"))[0];
                        if ($imagename <> "")
                            unlink("../../" . $imagename);
                        $vSQL_Del = "DELETE from product where id=$id";
                        mysql_query($vSQL_Del);
                    }
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá sản phẩm thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;
            }
        }
        return header('Location: ../?mod=product');
    }

    public function actived() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $actived = $_POST["actived"] == 0 ? 1 : 0;
        if (!empty($id)) {
            $vSQL_Upd = "UPDATE product SET actived=$actived WHERE ID=$id";
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

new ProductController();
?>