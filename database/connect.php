<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
mysql_select_db("banhang",$conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");
