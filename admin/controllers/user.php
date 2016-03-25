<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "../../database/connect.php";
include_once "../includes/libs.php";
include_once '../../includes/Bcrypt.php';


class UserController {

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
        $role_id = isset($_POST["role_id"]) ? $_POST["role_id"] : 0;
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $password = isset($_POST["password"]) ? $_POST["password"] : '';
        $password_confirm = isset($_POST["password_confirm"]) ? $_POST["password_confirm"] : 0;
        $username = isset($_POST["username"]) ? $_POST["username"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $actived = isset($_POST['actived']) ? 1 : 0;


//          Kiem tra username co trung
        if (mysql_num_rows(mysql_query("select * from users where username='$username'")) == 0) {
            if ($password == $password_confirm) {
                $hash_for_user = Bcrypt::hash($password);
                $vSQL_Ins = "INSERT INTO users(role_id, name, password, username, email, actived)
				VALUES($role_id, '$name', '$hash_for_user', '$username', '$email', $actived)";
            }
            mysql_query($vSQL_Ins);
            if (mysql_affected_rows() > 0) {
                setFlash('message', "Bạn đã thêm mới một tài khoản thành công!");
                setFlash('alert-class', 'alert-success');
            }
        } else {
            setFlash('message', "Thao tác không thành công!");
            setFlash('alert-class', 'alert-danger');
        }
        return header('Location: ../?mod=user');
    }

    public function edit() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $role_id = isset($_POST["role_id"]) ? $_POST["role_id"] : 0;
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $password = isset($_POST["password"]) ? $_POST["password"] : '';
        $password_confirm = isset($_POST["password_confirm"]) ? $_POST["password_confirm"] : 0;
        $username = isset($_POST["username"]) ? $_POST["username"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $actived = isset($_POST['actived']) ? 1 : 0;

        $vPassword = "";
        if ($password == $password_confirm) {
            $hash_for_user = Bcrypt::hash($password);
            $vPassword = ",password='$hash_for_user' ";
        }
//        Kiem tra username co trung
        if (mysql_num_rows(mysql_query("select * from users where (username='$username' and id<>$id)")) == 0) {
            if (!empty($id)) {
                $vSQL_Upd = "UPDATE users 
			SET name = '$name', username= '$username', role_id=$role_id, actived=$actived, 
                            email='$email' $vPassword
				WHERE ID=$id";
                mysql_query($vSQL_Upd);
                if (mysql_affected_rows() > 0) {
                    setFlash('message', "Bạn đã cập nhật tài khoản thành công!");
                    setFlash('alert-class', 'alert-success');
                }
            }
        } else {
//            die();
            setFlash('message', "Thao tác không thành công!");
            setFlash('alert-class', 'alert-danger');
        }
        return header('Location: ../?mod=user');
    }

    public function delete() {
        if (isset($_POST['type'])) {
            switch ($_POST['type']) {
                case 'one':
                    $vSQL_Del = "DELETE from users where id=" . $_POST['id'];
                    mysql_query($vSQL_Del);
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá tài khoản thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;

                case 'multi':
                    $multi = explode(',', $_POST['id']);
                    foreach ($multi as $id) {
                        $vSQL_Del = "DELETE from users where id=$id";
                        mysql_query($vSQL_Del);
                    }
                    if (mysql_affected_rows() > 0) {
                        setFlash('message', "Bạn đã xoá tài khoản thành công!");
                        setFlash('alert-class', 'alert-success');
                    } else {
                        setFlash('message', "Thao tác không thành công!");
                        setFlash('alert-class', 'alert-danger');
                    }
                    break;
            }
        }
        return header('Location: ../?mod=user');
    }

    public function actived() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $actived = $_POST["actived"] == 0 ? 1 : 0;
        if (!empty($id)) {
            $vSQL_Upd = "UPDATE users SET actived=$actived WHERE ID=$id";
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

new UserController();
?>