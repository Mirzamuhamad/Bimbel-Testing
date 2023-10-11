<?php

// 	$koneksi = mysqli_connect("localhost", "root", "", "absensi");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DB9758_bimbel";

// $servername = "202.67.10.126";
// $username = "DB9758_bimbel";
// $password = "Dpgp@12345";
// $dbname = "DB9758_bimbel";




// Create connection
$koneksi = new mysqli($servername, $username, $password, $dbname);
// Check connection

date_default_timezone_set("Asia/Jakarta");



function query($query)
{

	global $koneksi;
	$looping = mysqli_query($koneksi, $query);
	$baris = [];
	while ($isi = mysqli_fetch_assoc($looping)) {
		$baris[] = $isi;
	}

	return $baris;
}


function inputtgl($tanggal)
{
	$pisah = explode('-', $tanggal);
	$lari = array($pisah[2], $pisah[1], $pisah[0]);
	$satukan = implode('-', $lari);

	return $satukan;
}

// register company
function registrasi($userCompany)
{
	global $koneksi;
	$date = date("Y-m-d H:i:s");
	$Id_Company	 = htmlspecialchars($userCompany["Id_Company"]);
	$Company	 = htmlspecialchars($userCompany["Company"]);
	$Kota		 = htmlspecialchars($userCompany["Kota"]);
	$JmlEmployee = htmlspecialchars($userCompany["JmlEmployee"]);
	$Telp 		 = htmlspecialchars($userCompany["Telp"]);
	$Email		 = htmlspecialchars($userCompany["Email"]);
	$vnama 		 = "/^[a-zA-Z-. ]+$/";
	$Password 	 = htmlspecialchars(mysqli_real_escape_string($koneksi, $userCompany["Password"]));
	$Password2	 = htmlspecialchars(mysqli_real_escape_string($koneksi, $userCompany["Password2"]));


	//Pengecekan username udah ada apa belom
	$cekUsername = mysqli_query($koneksi, "SELECT Email FROM mscompany WHERE Email = '$Email'");

	if (mysqli_fetch_assoc($cekUsername)) {
		echo "<script>
             			 alert('Username sudah terdaftar ');
          			  </script>
         			 ";
		return false;
	}

	if (!preg_match($vnama, $Company)) {
		echo "<script>
             	alert('nama tidak valid');
          	</script>
		";
		return false;
	}

	if (!preg_match($vnama, $Kota)) {
		echo "<script>
             	alert('nama tidak valid');
          	</script>
		";
		return false;
	}

	if (strlen($Password) < 6) {
		echo "<script>
					alert('Password harus lebih dari 6 karakter ');
				</script>
			";
		return false;
	}

	if (strlen($Password2) < 6) {
		echo "<script>
					alert('Password harus lebih dari 6 karakter');
				</script>
			";
		return false;
	}

	//cek konfirmasi password

	if ($Password !== $Password2) {
		echo "<script>
					alert('konfirmasi password tidak sesuai! ')

			  </script>";

		return false;
	}



	// Encripsi password atau merubah data menjadi acak
	$Password = password_hash($Password, PASSWORD_DEFAULT);


	//tambah company baru
	mysqli_query($koneksi, "INSERT INTO mscompany VALUES('$Id_Company','$Company','$Kota', '$JmlEmployee','$Telp', '$Email', '$Password',null, '$date','','',0)");


	return mysqli_affected_rows($koneksi);
}
// Register company


// Update Company
function updateCompany($updateCompany)
{
	global $koneksi;
	$AdminID = $updateCompany["AdminID"];
	$AdminName = $updateCompany["AdminName"];
	$Phone = $updateCompany["Phone"];
	$Email = $updateCompany["Email"];
	$Kota = $updateCompany["Kota"];
	$Alamat = $updateCompany["Alamat"];
	$TglLahir = Inputtgl($updateCompany["TglLahir"]);

	$update = "UPDATE mscompany SET
				AdminName = '$AdminName',
				Phone = '$Phone',
				Email = '$Email',
				Kota = '$Kota',
				Alamat = '$Alamat',
				TglLahir = '$TglLahir'
				WHERE AdminID = '$AdminID'
				";

	mysqli_query($koneksi, $update);

	return mysqli_affected_rows($koneksi);
}

// koding ganti password user

function gantiPassword($gantiPassword)
{
	global $koneksi;

	// $cekPass  = $_SESSION['log-in']['password'];
	$AdminID  = $gantiPassword["AdminID"];
	$passLama =  $gantiPassword["OldPassword"];
	$passBaru = mysqli_real_escape_string($koneksi, $gantiPassword['NewPassword']);
	$passBaru2 = mysqli_real_escape_string($koneksi, $gantiPassword['RetypeNewPassword']);

	$cekPass = mysqli_query($koneksi, "SELECT Password FROM mscompany WHERE AdminID = '$AdminID'");
	$row = mysqli_fetch_array($cekPass);

	if (password_verify($passLama, $row['Password'])) {

		if (strlen($passBaru) < 6) {
			echo "<script>
				alert('Password Harus 6 karakter')
			  </script>
			  		  ";

			return false;
		}
		if (strlen($passBaru2) < 6) {
			echo "<script>
					alert('Password Harus 6 karakter')
				  </script>
				  		  ";

			return false;
		}

		if ($passBaru !== $passBaru2) {
			echo "<script>
					alert('konfirmasi password salah')
				  </script>
				  		  ";

			return false;
		}
		// encripsi password
		$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);


		$ganti = "UPDATE mscompany SET
			  Password = '$passBaru'
			  WHERE AdminID = '$AdminID'";

		mysqli_query($koneksi, $ganti);

		return mysqli_affected_rows($koneksi);
	} else {
		echo "<script>
				alert('PASSWORD LAMA TIDAK DI TEMUKAN !')
			  </script>
			  		  ";
	}
}



// update logo company
function ubahLogo($logo)
{
	global $koneksi;
	$AdminID = $logo["AdminID"];
	$Lokasi = "../Logo/";
	//Upload gambar
	$Logo = upload($Lokasi);
	if (!$Logo) {
		return false;
	}

	$update = "UPDATE mscompany SET
				LogoCompany = '$Logo'
				WHERE AdminID = '$AdminID'
				";

	mysqli_query($koneksi, $update);

	return mysqli_affected_rows($koneksi);
}


//coding untuk upload gambar dan cara validasinya 
function upload($Lokasi)
{
	$namaFile 	= $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error 		= $_FILES['gambar']['error'];
	$lokasiFile = $_FILES['gambar']['tmp_name'];

	//Cek Apakah tidak ada gambar yang di upload...?
	//$eror === 4 adalah eror jiks tidak ada gambar yang di upload


	if ($error === 4) {
		echo "<script>
				alert('Anda belum memilih gambar') 
			 </script>";
		return false;
	}

	//Cek apakah yang di upload gambar atau bukan

	$extensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];  // code file yang bisa di upload
	$extensiGambar = explode('.', $namaFile); //digunakan untuk memecah sebuah string menjadi array menggunakan delimiter
	$extensiGambar = strtolower(end($extensiGambar));
	if (!in_array($extensiGambar, $extensiGambarValid)) {
		echo "<script>
				alert('Yang anda upload bukan gambar!') 
			 </script>";
		return false;
	}

	//cek jika gambar yang di upload terlalu besar //max 200kb
	if ($ukuranFile > 200000) {
		echo "<script>
				alert('Ukuran Gambar terlalu besar!') 
			 </script>";
		return false;
	}

	//setelah pengecekan gambar berhasil selanjutnya upload gambarnya
	//generate file baru atau menggantai nama file agar tidak sama

	$namaFileBaru  = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $extensiGambar;

	move_uploaded_file($lokasiFile, $Lokasi . $namaFileBaru);

	return $namaFileBaru;
}

//Finish Koding upload Gambar

//coding untuk upload gambar 2 dan cara validasinya 
function upload2($Lokasi)
{
	$namaFile2 	= $_FILES['gambar2']['name'];
	$ukuranFile2 = $_FILES['gambar2']['size'];
	$error2 		= $_FILES['gambar2']['error'];
	$lokasiFile2 = $_FILES['gambar2']['tmp_name'];

	//Cek Apakah tidak ada gambar yang di upload...?
	//$eror === 4 adalah eror jiks tidak ada gambar yang di upload


	if ($error2 === 4) {
		echo "<script>
				alert('Anda belum memilih gambar 2') 
			 </script>";
		return false;
	}

	//Cek apakah yang di upload gambar atau bukan

	$extensiGambarValid2 = ['jpg', 'jpeg', 'png', 'gif'];  // code file yang bisa di upload
	$extensiGambar2 = explode('.', $namaFile2); //digunakan untuk memecah sebuah string menjadi array menggunakan delimiter
	$extensiGambar2 = strtolower(end($extensiGambar2));
	if (!in_array($extensiGambar2, $extensiGambarValid2)) {
		echo "<script>
				alert('Yang anda upload bukan gambar!') 
			 </script>";
		return false;
	}

	//cek jika gambar yang di upload terlalu besar //max 200kb
	if ($ukuranFile2 > 200000) {
		echo "<script>
				alert('Ukuran Gambar 2 terlalu besar!') 
			 </script>";
		return false;
	}

	//setelah pengecekan gambar berhasil selanjutnya upload gambarnya
	//generate file baru atau menggantai nama file agar tidak sama

	$namaFileBaru2  = uniqid();
	$namaFileBaru2 .= '.';
	$namaFileBaru2 .= $extensiGambar2;

	move_uploaded_file($lokasiFile2, $Lokasi . $namaFileBaru2);

	return $namaFileBaru2;
}

//Finish Koding upload Gambar




//Add data User
function userEmployee($userEmployee)
{
	global $koneksi;
	$EmpNumber = htmlspecialchars($userEmployee["EmpNumber"]);
	$EmpName = htmlspecialchars($userEmployee["EmpName"]);
	$CompanyCode = htmlspecialchars($userEmployee["CompanyCode"]);
	$Phone = htmlspecialchars($userEmployee["Telp"]);
	$Email = htmlspecialchars($userEmployee["Email"]);
	$Tgl_Lahir = htmlspecialchars($userEmployee["Tgl_Lahir"]);
	$Gender = htmlspecialchars($userEmployee["Gender"]);


	// membuat kode menu
	$query = "SELECT max(EmpID) as maxKode FROM msemployee";
	$hasil = mysqli_query($koneksi, $query);
	$data  = mysqli_fetch_array($hasil);
	$kodeMenu = substr($data["maxKode"], 5, 8) + 1;
	if ($data['maxKode'] = '') {
		$kode = "USR00001";
	} else {
		$char = "USR";
		$kode = $char . sprintf("%05s", $kodeMenu);
	}
	// kode menu finish

	$saveUser = "INSERT INTO msemployee (EmpID, Emp_Number, Emp_Name, CompanyCode, Telp, email, Gender, Tgl_Lahir ) VALUES
			   ('$kode', '$EmpNumber', '$EmpName', '$CompanyCode','$Phone','$Email','$Gender', '$Tgl_Lahir' )";

	mysqli_query($koneksi, $saveUser);

	return mysqli_affected_rows($koneksi);
}


//Edit User
function EditEmployee($EditEmployee)
{

	global $koneksi;
	$EmpID = htmlspecialchars($EditEmployee["EmpCode"]);
	$EmpNumber = htmlspecialchars($EditEmployee["EmpNumber"]);
	$EmpName = htmlspecialchars($EditEmployee["EmpName"]);
	$Phone = htmlspecialchars($EditEmployee["Telp"]);
	$Email = htmlspecialchars($EditEmployee["Email"]);
	$Tgl_Lahir = htmlspecialchars($EditEmployee["Tgl_Lahir"]);
	$Gender = htmlspecialchars($EditEmployee["Gender"]);
	$Imei = htmlspecialchars($EditEmployee["Imei"]);


	$EditUser = "UPDATE msemployee SET 
	Emp_Number 	 = '$EmpNumber', 
	Emp_Name	 = '$EmpName', 
	Telp 		 = '$Phone',
	email 		 = '$Email',
	Gender 		 = '$Gender', 
	Tgl_Lahir 	 = '$Tgl_Lahir',
	Imei 		 = '$Imei'   
	WHERE EmpID  = '$EmpID' ";

	mysqli_query($koneksi, $EditUser);

	return mysqli_affected_rows($koneksi);
}

// Edit user
function HapusEmployee($hapusEmployee)
{

	global $koneksi;
	$EmpID = htmlspecialchars($hapusEmployee["EmpCode"]);

	$hapusEmp  = "DELETE FROM msemployee WHERE EmpID = '$EmpID' ";


	mysqli_query($koneksi, $hapusEmp);

	return mysqli_affected_rows($koneksi);
}




// Add Course
function CourseAdd($CourseAdd)
{
	global $koneksi;



	$Tanggal = date("Y-m-d H:i:s");
	$CourseID = htmlspecialchars($CourseAdd["CourseID"]);
	$CourseName = htmlspecialchars($CourseAdd["CourseName"]);
	// $UrlImage = htmlspecialchars($CourseAdd["UrlImage"]);
	$Fgactive = htmlspecialchars($CourseAdd["FgActive"]);
	$CreatedBy = htmlspecialchars($CourseAdd["CreatedBy"]);

	$UrlImage = '';
	$namaFile 	= $_FILES['gambar']['name'];
	$Lokasi = "../image/Course/";
	//Upload gambar
	if ($namaFile) {
		$UrlImage = upload($Lokasi);
		if (!$UrlImage) {
			return false;
		}
	}


	$saveCourse = "INSERT INTO MsCourse (CourseID, CourseName,UrlImage, FgActive, CreatedDate, CreatedBy) VALUES
			   ('$CourseID', '$CourseName', '$UrlImage', '$Fgactive', '$Tanggal', '$CreatedBy')";

	mysqli_query($koneksi, $saveCourse);

	return mysqli_affected_rows($koneksi);
}

//Edit Course
function EditCourse($EditCourse)
{

	global $koneksi;
	$CourseID = htmlspecialchars($EditCourse["CourseID"]);
	$CourseName = htmlspecialchars($EditCourse["CourseName"]);
	//$UrlImage = htmlspecialchars($EditCourse["UrlImage"]);
	$Fgactive = htmlspecialchars($EditCourse["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditCourse["ModifiedBy"]);
	$tanggal = date("Y-m-d H:i:s");

	$UrlImage = '';
	$namaFile 	= $_FILES['gambar']['name'];
	$Lokasi = "../image/Course/";
	//Upload gambar
	if ($namaFile) {
		$UrlImage = upload($Lokasi);
		if (!$UrlImage) {
			return false;
		}
	}

	if ($UrlImage) {
		$EditCourse = "UPDATE mscourse SET 
	CourseName 	 = '$CourseName', 
	UrlImage	 = '$UrlImage', 
	FgActive 	 = '$Fgactive',
	ModifiedDate = '$tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE CourseID  = '$CourseID' ";
	} else {
		$EditCourse = "UPDATE mscourse SET 
	CourseName 	 = '$CourseName',  
	FgActive 	 = '$Fgactive',
	ModifiedDate = '$tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE CourseID  = '$CourseID' ";
	}

	mysqli_query($koneksi, $EditCourse);

	return mysqli_affected_rows($koneksi);
}


// Edit Course
function HapusCourse($hapusCourse)
{

	global $koneksi;
	$CourseID = htmlspecialchars($hapusCourse["CourseID"]);

	$hapusCourse  = "DELETE FROM mscourse WHERE CourseID = '$CourseID' ";


	mysqli_query($koneksi, $hapusCourse);

	return mysqli_affected_rows($koneksi);
}

function generateRandomString($length = 32)
{
	return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

// Add Guru
function GuruAdd($GuruAdd)
{
	global $koneksi;

	$Tanggal = date("Y-m-d H:i:s");
	$UserLogin = htmlspecialchars($GuruAdd["UserLogin"]);
	$UserName = htmlspecialchars($GuruAdd["UserName"]);
	$Gender = htmlspecialchars($GuruAdd["Gender"]);
	// $UrlImage = htmlspecialchars($GuruAdd["UrlImage"]);
	$BirthDate = Inputtgl(htmlspecialchars($GuruAdd["BirthDate"]));
	$Email = htmlspecialchars($GuruAdd["Email"]);
	$Handphone = htmlspecialchars($GuruAdd["Handphone"]);
	$AddressHome = htmlspecialchars($GuruAdd["AddressHome"]);
	$Fgactive = htmlspecialchars($GuruAdd["FgActive"]);
	$CreatedBy = htmlspecialchars($GuruAdd["CreatedBy"]);
	$UserType = "Teacher";

	$UrlPhoto = '';
	$namaFile 	= $_FILES['gambar']['name'];
	$Lokasi = "../image/Teacher/";
	//Upload gambar
	if ($namaFile) {
		$UrlPhoto = upload($Lokasi);
		if (!$UrlPhoto) {
			return false;
		}
	}


	$saveGuru = "INSERT INTO mslogin (UserLogin, UserName,Gender,BirthDate,Email,Handphone,AddressHome,UrlPhoto, FgActive, CreatedDate, CreatedBy, UserType) VALUES
			   ('$UserLogin', '$UserName','$Gender','$BirthDate','$Email','$Handphone','$AddressHome', '$UrlPhoto', '$Fgactive', '$Tanggal', '$CreatedBy','$UserType')";

	mysqli_query($koneksi, $saveGuru);

	return mysqli_affected_rows($koneksi);
}

//Edit Guru
function EditGuru($EditGuru)
{

	global $koneksi;
	$UserLogin = $EditGuru["UserLogin"];
	$UserName = htmlspecialchars($EditGuru["UserName"]);
	$Gender = htmlspecialchars($EditGuru["Gender"]);
	//$UrlImage = htmlspecialchars($EditGuru["Gambar"]);
	$BirthDate = Inputtgl(htmlspecialchars($EditGuru["BirthDate"]));
	$Email = htmlspecialchars($EditGuru["Email"]);
	$Handphone = htmlspecialchars($EditGuru["Handphone"]);
	$AddressHome = htmlspecialchars($EditGuru["AddressHome"]);
	$Fgactive = htmlspecialchars($EditGuru["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditGuru["ModifiedBy"]);
	$tanggal = date("Y-m-d H:i:s");

	$UrlPhoto = '';
	$namaFile 	= $_FILES['gambar']['name'];
	$Lokasi = "../image/Teacher/";
	//Upload gambar
	if ($namaFile) {
		$UrlPhoto = upload($Lokasi);
		if (!$UrlPhoto) {
			return false;
		}
	}

	if ($UrlPhoto) {
		$EditGuru = "UPDATE mslogin SET 
	UserName 	 = '$UserName', 
	Gender		 = '$Gender',
	BirthDate	 = '$BirthDate',
	Email		 = '$Email',
	Handphone	 = '$Handphone',
	AddressHome	 = '$AddressHome',
	UrlPhoto	 = '$UrlPhoto', 
	FgActive 	 = '$Fgactive'
	WHERE UserLogin  = '$UserLogin' ";
	} else {
		$EditGuru = "UPDATE mslogin SET 
	UserName 	 = '$UserName', 
	Gender		 = '$Gender',
	BirthDate	 = '$BirthDate',
	Email		 = '$Email',
	Handphone	 = '$Handphone',
	AddressHome	 = '$AddressHome',
	FgActive 	 = '$Fgactive'
	WHERE UserLogin  = '$UserLogin' ";
	}


	mysqli_query($koneksi, $EditGuru);

	return mysqli_affected_rows($koneksi);
}


// Edit Guru
function HapusGuru($hapusGuru)
{

	global $koneksi;
	$UserLogin = $hapusGuru["UserLogin"];

	$hapusGuru  = "DELETE FROM mslogin WHERE UserLogin = '$UserLogin' ";


	mysqli_query($koneksi, $hapusGuru);

	return mysqli_affected_rows($koneksi);
}



//Add data User
function KurikulumAdd($KurikulumAdd)
{
	global $koneksi;



	$Tanggal = date("Y-m-d H:i:s");
	$Kurikulum = htmlspecialchars($KurikulumAdd["Kurikulum"]);
	$Fgactive = htmlspecialchars($KurikulumAdd["FgActive"]);
	$CreatedBy = htmlspecialchars($KurikulumAdd["CreatedBy"]);


	$saveCourse = "INSERT INTO mskurikulum (kurikulum, FgActive, CreatedDate, CreatedBy) VALUES
			   ('$Kurikulum','$Fgactive', '$Tanggal', '$CreatedBy')";

	mysqli_query($koneksi, $saveCourse);

	return mysqli_affected_rows($koneksi);
}
//add data



//Edit Kurikulum
function EditKurikulum($EditKurikulum)
{

	global $koneksi;
	$Kurikulum = htmlspecialchars($EditKurikulum["Kurikulum"]);
	$Fgactive = htmlspecialchars($EditKurikulum["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditKurikulum["ModifiedBy"]);
	$tanggal = date("Y-m-d H:i:s");


	$EditKurikulum = "UPDATE mskurikulum SET 
	-- kurikulum 	 = '$Kurikulum', 
	FgActive 	 = '$Fgactive',
	ModifiedDate = '$tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE kurikulum  = '$Kurikulum' ";

	mysqli_query($koneksi, $EditKurikulum);

	return mysqli_affected_rows($koneksi);
}


// Edit Kurikulum
function HapusKurikulum($hapusKurikulum)
{

	global $koneksi;
	$KurikulumID = htmlspecialchars($hapusKurikulum["Kurikulum"]);

	$hapusKurikulum  = "DELETE FROM mskurikulum WHERE Kurikulum = '$KurikulumID' ";


	mysqli_query($koneksi, $hapusKurikulum);

	return mysqli_affected_rows($koneksi);
}



//Add Kwalifikasi
function KwalifikasiAdd($KwalifikasiAdd)
{
	global $koneksi;

	$Tanggal = date("Y-m-d H:i:s");
	$Teacher = htmlspecialchars($KwalifikasiAdd["Teacher"]);
	$Kurikulum = htmlspecialchars($KwalifikasiAdd["Kurikulum"]);
	$Fgactive = htmlspecialchars($KwalifikasiAdd["FgActive"]);
	$CreatedBy = htmlspecialchars($KwalifikasiAdd["CreatedBy"]);
	$Course = $KwalifikasiAdd['Course'];

	foreach ($Course as $CourseList) {
		$saveKwalifikasi = "INSERT INTO mskwalifikasi (Teacher,kurikulum,Course, FgActive, CreatedDate, CreatedBy) VALUES
			   ('$Teacher','$Kurikulum', '$CourseList','$Fgactive', '$Tanggal', '$CreatedBy')";
		mysqli_query($koneksi, $saveKwalifikasi);
	}
	return mysqli_affected_rows($koneksi);
}

//Edit Kwalifikasi
function EditKwalifikasi($EditKwalifikasi)
{

	global $koneksi;
	$tanggal = date("Y-m-d H:i:s");
	$Teacher = htmlspecialchars($EditKwalifikasi["Teacher"]);
	$Kurikulum = htmlspecialchars($EditKwalifikasi["Kurikulum"]);
	$Course = htmlspecialchars($EditKwalifikasi["Course"]);
	$Fgactive = htmlspecialchars($EditKwalifikasi["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditKwalifikasi["UpdatedBy"]);



	$EditKwalifikasi = "UPDATE mskwalifikasi SET 
	Teacher 	 = '$Teacher',
	Kurikulum = '$Kurikulum',
	Course 	 = '$Course',
	FgActive = '$Fgactive',
	ModifiedDate = '$tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE Teacher = '$Teacher' AND Kurikulum = '$Kurikulum' AND Course='$Course'  ";

	mysqli_query($koneksi, $EditKwalifikasi);

	return mysqli_affected_rows($koneksi);
}


// Edit kwalifikasi
function HapusKwalifikasi($hapusKwalifikasi)
{

	global $koneksi;
	$Teacher = htmlspecialchars($hapusKwalifikasi["Teacher"]);
	$Kurikulum = htmlspecialchars($hapusKwalifikasi["Kurikulum"]);
	$Course = htmlspecialchars($hapusKwalifikasi["Course"]);

	$hapusKwalifikasi  = "DELETE FROM mskwalifikasi WHERE Teacher = '$Teacher' AND Kurikulum = '$Kurikulum' AND Course='$Course' ";


	mysqli_query($koneksi, $hapusKwalifikasi);

	return mysqli_affected_rows($koneksi);
}

//Order Approved
function orderApprove($orderApprove)
{

	global $koneksi;
	$tanggal = date("Y-m-d H:i:s");
	$OrderID = htmlspecialchars($orderApprove["OrderID"]);



	$orderApprove = "UPDATE trorderhd SET 
	Status 	 = 'Approved'
	WHERE OrderID = '$OrderID'";

	mysqli_query($koneksi, $orderApprove);

	return mysqli_affected_rows($koneksi);
}

//Order Rejected
function orderReject($orderReject)
{

	global $koneksi;
	$tanggal = date("Y-m-d H:i:s");
	$OrderID = htmlspecialchars($orderReject["OrderID"]);



	$orderReject = "UPDATE trorderhd SET 
	Status 	 = 'Rejected'
	WHERE OrderID = '$OrderID'";

	mysqli_query($koneksi, $orderReject);

	return mysqli_affected_rows($koneksi);
}


//Add olimpiade
function OlimpiadeAdd($OlimpiadeAdd)
{
	global $koneksi;



	$Tanggal = date("Y-m-d H:i:s");
	$OlimpiadeID = htmlspecialchars($OlimpiadeAdd["OlimpiadeID"]);
	$OlimpiadeName = htmlspecialchars($OlimpiadeAdd["OlimpiadeName"]);
	$EligibleClassStart = htmlspecialchars($OlimpiadeAdd["EligibleClassStart"]);
	$EligibleClassEnd = htmlspecialchars($OlimpiadeAdd["EligibleClassEnd"]);
	$EligibleAgeStart = htmlspecialchars($OlimpiadeAdd["EligibleAgeStart"]);
	$EligibleAgeEnd = htmlspecialchars($OlimpiadeAdd["EligibleAgeEnd"]);
	$ExamDateStart = Inputtgl(htmlspecialchars($OlimpiadeAdd["ExamDateStart"]));
	$ExamDateEnd = Inputtgl(htmlspecialchars($OlimpiadeAdd["ExamDateEnd"]));
	$RegistrationDate = Inputtgl(htmlspecialchars($OlimpiadeAdd["RegistrationDate"]));
	//$UrlImage = htmlspecialchars($OlimpiadeAdd["UrlImage"]);
	//$UrlImage2 = htmlspecialchars($OlimpiadeAdd["UrlImage2"]);
	$Price = htmlspecialchars($OlimpiadeAdd["Price"]);
	$Venue = htmlspecialchars($OlimpiadeAdd["Venue"]);
	$Organizer = htmlspecialchars($OlimpiadeAdd["Organizer"]);
	$Fgactive = htmlspecialchars($OlimpiadeAdd["FgActive"]);
	$CreatedBy = htmlspecialchars($OlimpiadeAdd["CreatedBy"]);

	$UrlImage2 = '';
	$namaFile 	= $_FILES['gambar2']['name'];
	$Lokasi = "../image/Olimpiade/";
	//Upload gambar
	$UrlImage = upload($Lokasi);
	if (!$UrlImage) {
		return false;
	}
	if ($namaFile) {
		$UrlImage2 = upload2($Lokasi);
		if (!$UrlImage2) {
			return false;
		}
	}


	$saveOlimpiade = "INSERT INTO msolimpiade (OlimpiadeID,OlimpiadeName,EligibleClassStart, EligibleClassEnd, EligibleAgeStart,EligibleAgeEnd,ExamDateStart,ExamDateEnd,RegistrationDate,UrlImage,UrlImage2,Price,Venue,Organizer,FgActive, CreatedDate, CreatedBy) VALUES
			   ('$OlimpiadeID','$OlimpiadeName', '$EligibleClassStart','$EligibleClassEnd','$EligibleAgeStart','$EligibleAgeEnd','$ExamDateStart','$ExamDateEnd','$RegistrationDate','$UrlImage','$UrlImage2','$Price','$Venue','$Organizer','$Fgactive', '$Tanggal', '$CreatedBy')";

	mysqli_query($koneksi, $saveOlimpiade);

	return mysqli_affected_rows($koneksi);
}

//Edit olimpiade
function EditOlimpiade($EditOlimpiade)
{

	global $koneksi;
	$tanggal = date("Y-m-d H:i:s");
	$OlimpiadeID = htmlspecialchars($EditOlimpiade["OlimpiadeID"]);
	$OlimpiadeName = htmlspecialchars($EditOlimpiade["OlimpiadeName"]);
	$EligibleClassStart = htmlspecialchars($EditOlimpiade["EligibleClassStart"]);
	$EligibleClassEnd = htmlspecialchars($EditOlimpiade["EligibleClassEnd"]);
	$EligibleAgeStart = htmlspecialchars($EditOlimpiade["EligibleAgeStart"]);
	$EligibleAgeEnd = htmlspecialchars($EditOlimpiade["EligibleAgeEnd"]);
	$ExamDateStart = Inputtgl(htmlspecialchars($EditOlimpiade["ExamDateStart"]));
	$ExamDateEnd = Inputtgl(htmlspecialchars($EditOlimpiade["ExamDateEnd"]));
	$RegistrationDate = Inputtgl(htmlspecialchars($EditOlimpiade["RegistrationDate"]));
	$UrlImage = htmlspecialchars($EditOlimpiade["UrlImage"]);
	$UrlImage2 = htmlspecialchars($EditOlimpiade["UrlImage2"]);
	$Price = htmlspecialchars($EditOlimpiade["Price"]);
	$Venue = htmlspecialchars($EditOlimpiade["Venue"]);
	$Organizer = htmlspecialchars($EditOlimpiade["Organizer"]);
	$Fgactive = htmlspecialchars($EditOlimpiade["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditOlimpiade["UpdatedBy"]);

	// $UrlImage = '';
	$namaFile 	= $_FILES['gambar']['name'];
	$Lokasi = "../image/Olimpiade/";
	//Upload gambar
	if ($namaFile) {
		$UrlImage = upload($Lokasi);
		if (!$UrlImage) {
			return false;
		}
	};
	// $UrlImage2 = '';
	$namaFile2 	= $_FILES['gambar2']['name'];
	if ($namaFile2) {
		$UrlImage2 = upload2($Lokasi);
		if (!$UrlImage2) {
			return false;
		}
	};



	$EditOlimpiade = "UPDATE msolimpiade SET 
	OlimpiadeID = '$OlimpiadeID',
	OlimpiadeName = '$OlimpiadeName',
	EligibleClassStart = '$EligibleClassStart',
	EligibleClassEnd = '$EligibleClassEnd',
	EligibleAgeStart = '$EligibleAgeStart',
	EligibleAgeEnd = '$EligibleAgeEnd',
	ExamDateStart = '$ExamDateStart',
	ExamDateEnd = '$ExamDateEnd',
	RegistrationDate = '$RegistrationDate',
	UrlImage = '$UrlImage',
	UrlImage2 = '$UrlImage2',
	Price = '$Price',
	Venue = '$Venue',
	Organizer = '$Organizer',
	FgActive = '$Fgactive',
	ModifiedDate = '$tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE OlimpiadeID = '$OlimpiadeID'";

	mysqli_query($koneksi, $EditOlimpiade);

	return mysqli_affected_rows($koneksi);
}


// Edit olimpiade
function HapusOlimpiade($hapusOlimpiade)
{

	global $koneksi;
	$OlimpiadeID = htmlspecialchars($hapusOlimpiade["OlimpiadeID"]);

	$hapusOlimpiade  = "DELETE FROM msolimpiade WHERE OlimpiadeID = '$OlimpiadeID'";


	mysqli_query($koneksi, $hapusOlimpiade);

	return mysqli_affected_rows($koneksi);
}

// Add Venue
function addVenue($addVenue)
{
	global $koneksi;



	$Tanggal = date("Y-m-d H:i:s");
	$VenueID = htmlspecialchars($addVenue["VenueID"]);
	$VenueName = htmlspecialchars($addVenue["VenueName"]);
	$VenueAddr = htmlspecialchars($addVenue["VenueAddr"]);
	$ContactPerson = htmlspecialchars($addVenue["ContactPerson"]);
	$ContactHP = htmlspecialchars($addVenue["ContactHP"]);
	$ContactEmail = htmlspecialchars($addVenue["ContactEmail"]);
	$Capacity = htmlspecialchars($addVenue["Capacity"]);
	$Fgactive = htmlspecialchars($addVenue["FgActive"]);
	$CreatedBy = htmlspecialchars($addVenue["CreatedBy"]);

	$addVenue = "INSERT INTO MsVenue (VenueID, VenueName,VenueAddr,ContactPerson, ContactHP,ContactEmail,Capacity,FgActive, CreatedDate, CreatedBy) VALUES
			   ('$VenueID', '$VenueName', '$VenueAddr', '$ContactPerson','$ContactHP','$ContactEmail','$Capacity','$Fgactive', '$Tanggal', '$CreatedBy')";

	mysqli_query($koneksi, $addVenue);

	return mysqli_affected_rows($koneksi);
}

//Edit Venue
function EditVenue($EditVenue)
{

	global $koneksi;
	$Tanggal = date("Y-m-d H:i:s");
	$VenueID = htmlspecialchars($EditVenue["VenueID"]);
	$VenueName = htmlspecialchars($EditVenue["VenueName"]);
	$VenueAddr = htmlspecialchars($EditVenue["VenueAddr"]);
	$ContactPerson = htmlspecialchars($EditVenue["ContactPerson"]);
	$ContactHP = htmlspecialchars($EditVenue["ContactHP"]);
	$ContactEmail = htmlspecialchars($EditVenue["ContactEmail"]);
	$Capacity = htmlspecialchars($EditVenue["Capacity"]);
	$Fgactive = htmlspecialchars($EditVenue["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditVenue["ModifiedBy"]);


	$EditVenue = "UPDATE msVenue SET 
	VenueName 	 = '$VenueName', 
	VenueAddr	 = '$VenueAddr', 
	ContactPerson	 = '$ContactPerson', 
	ContactHP	 = '$ContactHP', 
	ContactEmail	 = '$ContactEmail', 
	Capacity	 = '$Capacity',  
	FgActive 	 = '$Fgactive',
	ModifiedDate = '$Tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE VenueID  = '$VenueID' ";

	mysqli_query($koneksi, $EditVenue);

	return mysqli_affected_rows($koneksi);
}


// Edit Venue
function HapusVenue($hapusVenue)
{

	global $koneksi;
	$VenueID = htmlspecialchars($hapusVenue["VenueID"]);

	$hapusVenue  = "DELETE FROM msVenue WHERE VenueID = '$VenueID' ";


	mysqli_query($koneksi, $hapusVenue);

	return mysqli_affected_rows($koneksi);
}

// Add Organizer
function addOrganizer($addOrganizer)
{
	global $koneksi;
	$Tanggal = date("Y-m-d H:i:s");
	$OrganizerID = htmlspecialchars($addOrganizer["OrganizerID"]);
	$OrganizerName = htmlspecialchars($addOrganizer["OrganizerName"]);
	$OrganizerAddr = htmlspecialchars($addOrganizer["OrganizerAddr"]);
	$ContactPerson = htmlspecialchars($addOrganizer["ContactPerson"]);
	$ContactHP = htmlspecialchars($addOrganizer["ContactHP"]);
	$ContactEmail = htmlspecialchars($addOrganizer["ContactEmail"]);
	$Fgactive = htmlspecialchars($addOrganizer["FgActive"]);
	$CreatedBy = htmlspecialchars($addOrganizer["CreatedBy"]);

	$addOrganizer = "INSERT INTO MsOrganizer (OrganizerID, OrganizerName,OrganizerAddr,ContactPerson, ContactHP,ContactEmail,FgActive, CreatedDate, CreatedBy) VALUES
			   ('$OrganizerID', '$OrganizerName', '$OrganizerAddr', '$ContactPerson','$ContactHP','$ContactEmail','$Fgactive', '$Tanggal', '$CreatedBy')";

	mysqli_query($koneksi, $addOrganizer);

	return mysqli_affected_rows($koneksi);
}

//Edit Organizer
function EditOrganizer($EditOrganizer)
{

	global $koneksi;
	$Tanggal = date("Y-m-d H:i:s");
	$OrganizerID = htmlspecialchars($EditOrganizer["OrganizerID"]);
	$OrganizerName = htmlspecialchars($EditOrganizer["OrganizerName"]);
	$OrganizerAddr = htmlspecialchars($EditOrganizer["OrganizerAddr"]);
	$ContactPerson = htmlspecialchars($EditOrganizer["ContactPerson"]);
	$ContactHP = htmlspecialchars($EditOrganizer["ContactHP"]);
	$ContactEmail = htmlspecialchars($EditOrganizer["ContactEmail"]);
	$Fgactive = htmlspecialchars($EditOrganizer["FgActive"]);
	$ModifiedBy = htmlspecialchars($EditOrganizer["ModifiedBy"]);


	$EditOrganizer = "UPDATE msOrganizer SET 
	OrganizerName 	 = '$OrganizerName', 
	OrganizerAddr	 = '$OrganizerAddr', 
	ContactPerson	 = '$ContactPerson', 
	ContactHP	 = '$ContactHP', 
	ContactEmail	 = '$ContactEmail',  
	FgActive 	 = '$Fgactive',
	ModifiedDate = '$Tanggal',
	ModifiedBy = '$ModifiedBy'
	WHERE OrganizerID  = '$OrganizerID' ";

	mysqli_query($koneksi, $EditOrganizer);

	return mysqli_affected_rows($koneksi);
}


// Edit Organizer
function HapusOrganizer($hapusOrganizer)
{

	global $koneksi;
	$OrganizerID = htmlspecialchars($hapusOrganizer["OrganizerID"]);

	$hapusOrganizer  = "DELETE FROM msOrganizer WHERE OrganizerID = '$OrganizerID' ";


	mysqli_query($koneksi, $hapusOrganizer);

	return mysqli_affected_rows($koneksi);
}








//Tambah Data BUku========================================================================================

function menu($data)
{

	global $koneksi;
	// $id_menu= htmlspecialchars($data["id_menu"]);


	//Upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stock = htmlspecialchars($data["stock"]);

	// membuat kode menu
	$query = "SELECT max(id_menu) as maxKode FROM menu";
	$hasil = mysqli_query($koneksi, $query);
	$data  = mysqli_fetch_array($hasil);
	$kodeMenu = substr($data["maxKode"], 3, 6) + 1;
	if ($data['maxKode'] = '') {
		$kode = "MNU001";
	} else {
		$char = "MNU";
		$kode = $char . sprintf("%03s", $kodeMenu);
	}
	// kode menu finish

	$upload = "INSERT INTO menu VALUES
				   ('$kode', '$gambar', '$nama', '$harga','$stock')";

	mysqli_query($koneksi, $upload);

	return mysqli_affected_rows($koneksi);
}









// Code menghapus data buku

function hapusMenu($id_menu)
{
	global $koneksi;

	$hapus = "DELETE FROM menu WHERE id_menu = $id_menu";
	mysqli_query($koneksi, $hapus);

	return mysqli_affected_rows($koneksi);
}


// Ubah Data buku

function ubahMenu($data)
{
	global $koneksi;
	$id_menu = $data["id_menu"];
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$nama = $data["nama"];
	$harga = htmlspecialchars($data["harga"]);
	$stock = htmlspecialchars($data["stock"]);

	$update = "UPDATE menu SET
					gambar 		= '$gambar',
					nama_menu 	= '$nama',
					harga 		= '$harga',
					stock 		= '$stock'
					WHERE id_menu = '$id_menu'
					";

	mysqli_query($koneksi, $update);

	return mysqli_affected_rows($koneksi);
}

//Finish ubah data buku

///===========================================================================================================



//Koding Untuk mencari menu

function cari($keyword)
{

	$menu = "SELECT * FROM menu
				WHERE 
			  id_menu 	LIKE '%$keyword%' OR
			  nama_menu LIKE '%$keyword%' OR 
			  harga 	LIKE '%$keyword%'
			  ";



	return query($menu);
}


// hapus semua menu_cart

function hapusSemua()
{

	global $koneksi;

	$hapus = "DELETE FROM keranjang ";
	mysqli_query($koneksi, $hapus);

	return mysqli_affected_rows($koneksi);
}

// finish


//kodin form massage


function massage($contact)
{

	global $koneksi;

	$nama 	= htmlspecialchars($contact["nama"]);
	$email 	= htmlspecialchars($contact["email"]);
	$phone 	= htmlspecialchars($contact["phone"]);
	$alamat = htmlspecialchars($contact["alamat"]);
	$pesan 	= htmlspecialchars($contact["pesan"]);

	$queryContact = "INSERT INTO contact VALUES
				   ('','$nama', '$email', '$phone', '$alamat', '$pesan')";

	mysqli_query($koneksi, $queryContact);

	return mysqli_affected_rows($koneksi);
}

//Koding Untuk mencari pesan masuk

function cariPesan($keyword)
{

	$menu = "SELECT * FROM contact
				WHERE 
			  nama 	LIKE '%$keyword%' OR
			  email LIKE '%$keyword%' OR
			  phone	LIKE '%$keyword%' OR
			  alamat LIKE '%$keyword%'
			  ";



	return query($menu);
}



//kode hapus pesan
function hapusPesan($id_inbok)
{
	global $koneksi;

	$hapus = "DELETE FROM contact WHERE id_inbok = $id_inbok";
	mysqli_query($koneksi, $hapus);

	return mysqli_affected_rows($koneksi);
}



function biayaKirim($kirim)
{
	global $koneksi;
	$id_biaya	= $kirim["id_biaya"];
	$daerah 	= $kirim["daerah"];
	$harga 		= $kirim["harga"];

	$insertBiaya = "INSERT INTO ongkir VALUES  ('$id_biaya', '$daerah', '$harga')";

	mysqli_query($koneksi, $insertBiaya);
	return mysqli_affected_rows($koneksi);
}

//kode hapus ongkir
function hapusOngkir($id_biaya)
{
	global $koneksi;

	$hapus = "DELETE FROM ongkir WHERE id_biaya = $id_biaya";
	mysqli_query($koneksi, $hapus);

	return mysqli_affected_rows($koneksi);
}


function UpdateOngkir($ongkirUpdate)
{
	global $koneksi;

	$id_biaya 	 = $ongkirUpdate["id_biaya"];
	$daerah 	 = $ongkirUpdate["daerah"];
	$biaya_kirim = $ongkirUpdate["biaya_kirim"];


	$UpOngkir = "UPDATE ongkir SET 
				daerah 		= '$daerah',
				biaya_kirim = '$biaya_kirim'
				WHERE
				id_biaya 	= '$id_biaya' ";

	mysqli_query($koneksi, $UpOngkir);
	return mysqli_affected_rows($koneksi);
}





//Koding untuk keranjang belanja

function keranjang($cart)
{
	date_default_timezone_set("Asia/Jakarta");
	$date = date('Y/m/d H:i:s');



	global $koneksi;
	$nama 		= $cart["nama"];
	$gambar 	= $cart["gambar"];
	$id_menu 	= $cart["id_menu"];
	$harga 		= $cart["harga"];
	$jml_beli 	= $cart["jml_beli"];
	$level 		= $cart["level"];
	$subttl 	= $harga * $jml_beli;
	$tgl_beli 	= $date;
	$id_user	= $cart["id_user"];

	//Pengecekan stock
	$cekStock	 = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id_menu' ");
	$barangRow 	 = mysqli_fetch_assoc($cekStock);
	$stock 		 = $barangRow["stock"];

	$qty = mysqli_num_rows($cekStock);

	if ($jml_beli > $stock) {
		echo "<script>
             			 alert('Mohon Maaf Stock Kami Tidak Cukup, Silahkan Kurangi pesanan anda atau pilih Menu Lain!!');
         			  </script>
         			 ";

		return false;
	}

	if ($jml_beli <= 0) {
		echo "<script>
	             			 alert('Belum memasukan Jumlah porsi');
	         			  </script>
	         			 ";

		return false;
	}

	if ($qty <= 0) {
		echo "<script>
	             			 alert('Menu Iini Telah Habis');
	         			  </script>
	         			 ";

		return false;
	}

	// $query12 = "SELECT * FROM keranjang";
	// $ek 	= mysqli_query($koneksi, $query12);
	// $cek2 = mysqli_fetch_array($ek);
	// $g = $ek2['id_menu'];

	// $query1 = "SELECT * FROM keranjang WHERE id_menu = $g;";
	// $ek1 	= mysqli_query($koneksi, $query1);
	// $cekID = mysqli_fetch_array($ek2);
	// $ID = $cekID['id_menu'];
	// $nm = $cekID['nama_menu'];
	// $lv = $cekID['level'];

	// if ($nm == $nama) {
	// 	$update = updatePorsi();
	// } else{
	$insertCart = "INSERT INTO keranjang VALUES ('', '$nama', '$gambar', '$id_menu', '$harga', '$jml_beli', '$level', '$subttl', '$tgl_beli','$id_user')";

	mysqli_query($koneksi, $insertCart);
	return mysqli_affected_rows($koneksi);
}


// transaksi

function transaksi($trans)
{
	date_default_timezone_set("Asia/Jakarta");
	$date = date('l, d/m/Y H:ia');

	global $koneksi;
	$nama 		= $trans["nama"];
	$id_menu 	= $trans["id_menu"];
	$harga 		= $trans["harga"];
	$jml_beli	= $trans["jml_beli"];
	$level 		= $trans["level"];
	$subttl 	= $trans["subttl"];
	$tgl_beli 	= $trans["tgl_beli"];

	$query = "INSERT INTO transaksi (id_transaksi,nama, id_menu, harga, jml_beli, level, subttl, tgl_beli) VALUES ('', '$nama', 'id_menu', '$harga', '$jml_beli', '$level', 'subttl', '$tgl_beli')";

	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}


function ttl_keranjang()
{

	global $koneksi;

	$total1 = "SELECT SUM(ttl_bayar) as ttl_bayar FROM keranjang";

	$query = mysqli_query($koneksi, $total1);
	$ext = mysqli_fetch_array($query);

	$total = $ext['ttl_bayar'];
	echo $total;
}

function jml_beli()
{

	global $koneksi;

	$total1 = "SELECT SUM(jml_beli) as jml_beli FROM keranjang";

	$query = mysqli_query($koneksi, $total1);
	$ext = mysqli_fetch_array($query);

	$total_beli = $ext['jml_beli'];
	echo $total_beli;
}

//kode hapus pesan
function hapusChart($id_cart)
{
	global $koneksi;

	$hapus = "DELETE FROM keranjang WHERE id_cart = $id_cart";
	mysqli_query($koneksi, $hapus);

	return mysqli_affected_rows($koneksi);
}



function UpdatePorsi($menu_cart)
{
	global $koneksi;
	$id_menu 	= $_POST["id_menu"];
	$id_cart 	= $_POST["id_cart"];
	$harga 		= $_POST["harga"];
	$jml_beli	= $_POST["jml_beli"];
	$level 		= $_POST["level"];
	$subtotal	= $harga * $jml_beli;

	$cekS = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id_menu' ");
	$barangRow = mysqli_fetch_array($cekS);
	$stock = $barangRow["stock"];
	$qty = mysqli_num_rows($cekS);

	if ($jml_beli > $stock) {
		echo "<script>
             			 alert('Mohon Maaf Porsi Kami Tidak Cukup, Silahkan Kurangi Pesanan Anda!!');
         			  </script>
         			 ";

		return false;
	}

	if ($jml_beli <= 0) {
		echo "<script>
	             			 alert('Ups, Menu Kamu Kosong, Gagal Update Deh Mari Coba Lagi!');
	         			  </script>
	         			 ";

		return false;
	}

	if ($qty <= 0) {
		echo "<script>
	             			 alert('Menu ini Telah Habis');
	         			  </script>
	         			 ";

		return false;
	}



	$updatePorsi = "UPDATE keranjang SET 
	harga 		 = '$harga',
	jml_beli 	 = '$jml_beli',
	level 		 = '$level',
	subttl 		 = '$subtotal' 
	WHERE id_cart = '$id_cart' ";

	mysqli_query($koneksi, $updatePorsi);

	return mysqli_affected_rows($koneksi);
}
