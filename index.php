<?php
session_start();
include "model/pdo.php";
include "model/sanpham.php";
include "model/taikhoan.php";
include "model/danhmuc.php";
include "global.php";
$sanpham=loadall_sanpham_home();
$dsdm=loadall_danhmuc();
$dstop10=loadall_sanpham_top10();
include "view/header.php";
if((isset($_GET['act']))&&($_GET['act']!="")){
    $act = $_GET['act'];
    switch($act){
        case "sanphamct":

            if(isset($_GET['idsp']) && ($_GET['idsp']>0)){
                $id=$_GET['idsp'];
                $sp_cung_loai=load_sanpham_cungloai($id);
                $onesp=loadone_sanpham($id);
                include "view/chitietsanpham.php";
            }else{
                include "view/home.php";
            }

            break;

        case "dangnhap":
            if(isset($_POST['dangnhap']) && ($_POST['dangnhap'])){
                $user=$_POST['user'];
                $pass=$_POST['pass'];
                $checkuser=checkuser($user,$pass);
                if(is_array($checkuser)){
                    $_SESSION['user']=$checkuser;
                    $_SESSION['pass']=$checkuser;
                    header('Location: index.php');
                    // $thongbao="bạn đã đăng nhập thành công ";
                }else{
                    $thongbao="tài khoản không tồn tại. Vui lòng đăng ký";
                }
            }
            include "view/home.php";
            break;

        default:
            include "view/home.php";
            break;
    }
}else{
    include "view/home.php";
}
include "view/footer.php";

?>