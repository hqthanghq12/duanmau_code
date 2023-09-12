<main class="catalog  mb ">

    <div class="boxleft">
        <div class="banner">
            <img id="banner" src="./img/anh0.jpg" alt="">
            <button class="pre" onclick="pre()">&#10094;</button>
            <button class="next" onclick="next()">&#10095;</button>
        </div>

        <div class="items">

            <?php
            $i=0;
            foreach($sanpham as $sp){
                extract($sp);
                $linksp="index.php?act=sanphamct&idsp=".$id;
                $hinh=$img_path.$img;
                if(($i==2)||($i==5)||($i==8)){
                    $mr="";
                }else{
                    $mr="mr";
                }

                echo '<div  class="box_items '.$mr.'">
                <a href="'.$linksp.'"><div class="row img"><img src="'.$hinh.'" alt=""></div></a>
               <p>'.$price.'</p>
               <a href="'.$linksp.'">'.$name.'</a>
             </div>';
                $i+=1;
            }

            ?>
        </div>
    </div>
<?php
    include "boxright.php";
?>

</main>