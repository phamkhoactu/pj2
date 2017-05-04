 <?php include 'includes/init.php'; ?>
 <?php
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;

$items_per_page = 5;

$items_total_count = SinhVien::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM sinhvien";
$sql .= " LIMIT {$items_per_page}";
$sql .= " OFFSET {$paginate->offset()}";

$svs = SinhVien::find_by_query($sql);

?>

 <?php 
if(isset($_POST['them'])){
	$sinhvien = new SinhVien();
	$sinhvien->id = $_POST['id'];
	$sinhvien->ten = $_POST['ten'];
	$sinhvien->diem = $_POST['diem'];

	$sinhvien->create();
}


if(isset($_POST['sua'])){
	
	//$sql = "select * from sinhvien where ten='vinh' "; // neu tim sinh vien khong dua vao id
	//$sinhvien = SinhVien::find_by_query($sql); // truyen sql
	//$id = $_POST['id-sua'];
	//$ten = $_POST['ten-sua'];
	//$diem = $_POST['diem-sua'];

	
	$sinhvien = SinhVien::find_by_id($_POST['id-sua']);
	
	$sinhvien->ten = $_POST['ten-sua'];
	$sinhvien->diem = $_POST['diem-sua'];


	$sinhvien->save();
}

if(isset($_POST['xoa'])){
	
	//$sql = "select * from sinhvien where ten='vinh' "; // neu tim sinh vien khong dua vao id
	//$sinhvien = SinhVien::find_by_query($sql); // truyen sql
	
	$sinhvien = SinhVien::find_by_id($_POST['id-xoa']);


	$sinhvien->delete();
}




  ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <h1>THÊM</h1>
 <form action="trangchu.php" method="post" accept-charset="utf-8">
 	<input type="text" name="id" value="" placeholder="Nhap id">
 	<input type="text" name="ten" value="" placeholder="Nhap ten">
 	<input type="text" name="diem" value="10" >

 
 	<input type="submit" name="them" value="THÊM">

 </form>
<br>
<hr>
  <h1>SỬA</h1>
 <form action="trangchu.php" method="post" accept-charset="utf-8">
 	<input type="text" name="id-sua" value="" placeholder="Nhap id can sua">
 	<input type="text" name="ten-sua" value="" placeholder="Nhap ten can sua">
 	<input type="text" name="diem-sua" value="" placeholder="Nhap diem can sua">

 
 	<input type="submit" name="sua" value="SỬA">

 </form>

 <br>
<hr>
  <h1>XÓA</h1>
 <form action="trangchu.php" method="post" accept-charset="utf-8">
 	<input type="text" name="id-xoa" value="" placeholder="Nhap id can xoa">
 	

 
 	<input type="submit" name="xoa" value="XÓA">

 </form>

 <br>
<hr>
<h1>PHÂN TRANG</h1>

 <table >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ten</th>
                                    <th>Diem</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($svs as $sv): ?>
                                <tr>
                                    
                                    <td><?php echo $sv->id; ?></td>
                                    <td><?php echo $sv->ten; ?></td>
                                    <td><?php echo $sv->diem; ?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table> <!-- end table -->	

 <ul class="pagination">

        	<?php

if ($paginate->page_total() > 1) {
   

    if ($paginate->has_previous()) {
        echo "<li><a href='trangchu.php?page={$paginate->previous()}'>Prev</a></li>";
    }



    	for($i=1; $i <= $paginate->page_total(); $i++){
    		
    		if($i == $paginate->current_page){
    			echo "<li><a href='trangchu.php?page={$i}' >{$i}</a></li>";
    		} else {
    			echo "<li ><a href='trangchu.php?page={$i}' >{$i}</a></li>";
    		}

    	}




 if ($paginate->has_next()) {
        echo "<li><a href='trangchu.php?page=" . $paginate->next() . "'>Next</a></li>";
    }






}
?>
        	</ul>

 </body>
 </html>