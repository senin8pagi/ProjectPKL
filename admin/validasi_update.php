<?php 
    include '../koneksi.php';		
	$id       = $_POST['id'];
	$approval = $_POST['btnapproval'];
	$blokir   = $_POST['btnblokir'];
    $norek    = $_POST['btnnorek'];	
	$rand     = rand();	
	if(isset($approval)){		    	    
		$query = "update validasi set pegawai_level= 'Aktif' where pegawai_id = '$id'";	
		$query2 = "update loket set status = 'Aktif' where id = '$id'";
        mysqli_query($koneksi, $query2);		
		
		$result = mysqli_query($koneksi, $query);					
		if ($result){
		   header("location:validasi.php");
		} else
		{
		   echo "gagal"	;
		}			
		
	} else 
	if(isset($blokir)){		    	    
		$query = "update validasi set pegawai_level= 'Blokir' where pegawai_id = '$id'";			
		$qloket = "update loket set status = 'Blokir' where id = '$id'";		
		mysqli_query($koneksi, $qloket);
		
		$result = mysqli_query($koneksi, $query);					
		if ($result){
		   header("location:validasi.php");
		} else
		{
		   echo "gagal"	;
		}			
		
	} else 
	if(isset($norek)){		
        $rek = $rand;
		$query = "update validasi set no_rek_giro = '$rek' where pegawai_id = '$id'";		
        $result = mysqli_query($koneksi, $query);					
		
        //		
		$q = mysqli_query($koneksi, "select no_rek_giro from  validasi where pegawai_id = '$id'");	
		$data = mysqli_fetch_assoc($q);
		$norek= $data['no_rek_giro'];
			
		$query2 = "update loket set norek = '$norek' where id = '$id'";		
		mysqli_query($koneksi, $query2);					
		
		
		if ($result){			
		   header("location:validasi_baca.php?id=".$id);
		} else
		{
		   echo "gagal"	;
		}			
		
	}		
	
	
	
	
?>