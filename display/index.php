<?php 
include("../essentials/header.php");
include("../essentials/config.php");
include("nav.php");
$active="active";
?>
<style>
.col-lg-4:hover{
    box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;
}
</style>
<div class="container my-4">
<a href="index.php?get=all" class="btn btn-outline-primary rounded-3 <?=$active?>">ALL</a>
    <?php 
    $query="SELECT * FROM brands;";
    $result=mysqli_query($conn, $query) or die("failed to execute");
    if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
            ?>
            <a href="index.php?brand_id=<?=$row["brand_id"]?>" class="btn btn-outline-primary rounded-3 <?=$active?>"><?=$row["brand_name"]?></a>  
            <?php
        }
    }
    ?>
    <div class="row">
<?php 
if(isset($_GET['brand_id'])){
    $brand_id=$_GET['brand_id'];
    $getByBrand="SELECT * FROM `mobiles` as m inner JOIN brands as b on m.brand_id=b.brand_id where m.brand_id=$brand_id ORDER by id DESC ;";

    $result2=mysqli_query($conn, $getByBrand) or die("failed to execute");
    if(mysqli_num_rows($result2) > 0){
        while($row2=mysqli_fetch_assoc($result2)){
        $image=$row2["image"];    
    echo'
    <div class="col-lg-4 col-md-6 col-sm-12 my-4 rounded-4">
    <div class="card" style="border:none;">
      <img src="../file uploading/img/'.$image.'" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">'.$row2["name"].'</h5>
        <p>Powered by '.$row2["brand_name"].'</p>
        <a href="#" class="btn btn-primary">'.$row2["price"].'</a>
      </div>
    </div>
    </div>
    
    ';
        }}
}
else{
    $active="active";
        $getALL="SELECT * FROM `mobiles`";
        $result1=mysqli_query($conn, $getALL) or die("failed to execute");
        if(mysqli_num_rows($result1) > 0){
            while($row1=mysqli_fetch_assoc($result1)){
            $image=$row1["image"];    
        echo'
        <div class="col-lg-4 col-md-6 col-sm-12 my-4 rounded-4">
        <div class="card" style="border:none;" >
          <img src="../file uploading/img/'.$image.'" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">'.$row1["name"].'</h5>
            <a href="#" class="btn btn-primary">'.$row1["price"].'</a>
          </div>
        </div>
        </div>
        
        ';
            }}
        
        }

?>

    </div>
</div>


<?php

include("footer.php");

?>