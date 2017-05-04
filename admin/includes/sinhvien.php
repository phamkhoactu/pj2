<?php 

	class SinhVien extends Db_object{
		 protected static $db_name         = "sinhvien";
    protected static $db_table_fields = array('id', 'ten','diem');

    public $id;
    public $ten;
    public $diem;
	}

 ?>