
<?php
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../model/sanpham.php";
//include "../model/taikhoan.php";
    include "header.php";


//controler
    if(isset($_GET['act'])){
        $act=$_GET['act'];
        switch($act){

            case 'addsp':

                // kiểm tra xem người dùng có click vào add hay k
                if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
                    $iddm=$_POST['iddm'];
                    $tensp=$_POST['tensp'];
                    $giasp=$_POST['giasp'];
                    $mota=$_POST['mota'];

                    $hinh=$_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        // echo "The file ". htmlspecialchars( basename( $_FILES["hinh"]["name"])). " has been uploaded.";
                    } else {
                        // echo "Sorry, there was an error uploading your file.";
                    }

                    insert_sanpham($tensp,$giasp,$hinh,$mota,$iddm);
                    // phải có iddm vì nó là khóa ngoại
                    $thongbao="thêm thành công!";
                }
                $listdanhmuc=loadall_danhmuc();
                //var_dump($listdanhmuc);
                include "sanpham/add.php";
                break;
            case "listsp":
                if(isset($_POST['clickOK'])&&($_POST['clickOK'])){
                    $keyw=$_POST['keyw'];
                    $iddm=$_POST['iddm'];
                }else{
                    $keyw="";
                    $iddm=0;
                }
                $listdanhmuc=loadall_danhmuc();
                $listsanpham=loadall_sanpham($keyw,$iddm);
                include "sanpham/list.php";
                break;
            case 'xoasp':
                // muốn xóa thì phải kiểm tra id
                if(isset($_GET['id'])&&($_GET['id'])>0){
                    delete_sanpham($_GET['id']);
                }

                $listsanpham=loadall_sanpham("",0);
                include "sanpham/list.php";
                break;
            case "suasp":
                //vì là hàm có trả về nên
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $sanpham=loadone_sanpham($_GET['id']);
                }
                $listdanhmuc=loadall_danhmuc();
                include "sanpham/update.php";
                break;
            case "updatesp":
                if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                    $iddm=$_POST['iddm'];
                    $id=$_POST['id'];
                    $tensp=$_POST['tensp'];
                    $giasp=$_POST['giasp'];
                    $mota=$_POST['mota'];
                    $hinh=$_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        // echo "The file ". htmlspecialchars( basename( $_FILES["hinh"]["name"])). " has been uploaded.";
                    } else {
                        // echo "Sorry, there was an error uploading your file.";
                    }
                    update_sanpham($id,$iddm,$tensp,$giasp,$mota,$hinh);
                    $thongbao="cập nhật thành công!";
                }
                $listsanpham=loadall_sanpham("",0);
                $listdanhmuc=loadall_danhmuc();
                include "sanpham/list.php";
                break;
            default:
                include "sanpham/list.php";
                break;
        }
    }else{
        include "home.php";
    }

    include "footer.php";

?>