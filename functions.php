<?php

	include 'koneksi.php';

	// VALIDASI LOGIN
	function isUser($nim, $password){
	    global $koneksi;
	    $encrypted_password = md5($password);
	    $query = "SELECT * FROM user WHERE nim = '$nim' AND password = '$encrypted_password'";
	    $result = mysqli_query($koneksi, $query);

	    if (mysqli_num_rows($result) == 1) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function generateSoftColorHex() {
	    // Menghasilkan komponen warna merah, hijau, dan biru secara acak
	    $red = mt_rand(0, 127);
	    $green = mt_rand(0, 127);
	    $blue = mt_rand(0, 127);

	    // Mengonversi nilai-nilai RGB ke format heksadesimal
	    $hex = sprintf("#%02x%02x%02x", $red, $green, $blue);

	    return $hex;
	}


	function isAdmin($nim) {
	    global $koneksi;

	    $query = "SELECT status FROM user WHERE nim = '$nim'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_assoc($result);
	        $status = $row['status'];

	        if ($status == 1) {
	            return true;
	        } else {
	            return false;
	        }
	    } else {
	        return false;
	    }
	}


	function jmlDataTable($table) {
	    global $koneksi;

	    $query = "SELECT COUNT(*) as total_rows FROM $table";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_assoc($result);
	        $totalRows = $row['total_rows'];

	        return $totalRows;
	    } else {
	        return 0;
	    }
	}


	function jmlDataInUser($nim) {
	    global $koneksi;

	    $query = "SELECT COUNT(*) as total_rows FROM transaksi WHERE nim='$nim'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_assoc($result);
	        $totalRows = $row['total_rows'];

	        return $totalRows;
	    } else {
	        return 0;
	    }
	}

	function jmlDataTableMinjam($status) {
	    global $koneksi;

	    $query = "SELECT COUNT(*) as total_rows FROM transaksi WHERE status='$status'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_assoc($result);
	        $totalRows = $row['total_rows'];

	        return $totalRows;
	    } else {
	        return 0;
	    }
	}



	function getAllinTable($table) {
	    global $koneksi;

	    $query = "SELECT * FROM $table";
	    $result = mysqli_query($koneksi, $query);
	    $rows = array();

	    while ($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }

	    return $rows;
	}


	function getAllinUserWith($nim) {
	    global $koneksi;

	    $query = "SELECT * FROM transaksi WHERE nim='$nim'";
	    $result = mysqli_query($koneksi, $query);
	    $rows = array();

	    while ($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }

	    return $rows;
	}


	function getDataFromId($table, $id) {
	    global $koneksi;

	    $kolom = 'id';
	    if($table == 'user'){
	    	$kolom = 'nim';
	    }

	    $query = "SELECT * FROM $table WHERE $kolom=$id";
	    $result = mysqli_query($koneksi, $query);
	    $row = mysqli_fetch_assoc($result);
	    return $row;
	}


	function tglIndo($tanggal) {
		if($tanggal == '0000-00-00'){
			return '-';
		}
	    $bulanIndonesia = array(
	        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
	        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	    );

	    $tanggalPisah = explode('-', $tanggal);
	    $tanggalBaru = $tanggalPisah[2] . ' ' . $bulanIndonesia[intval($tanggalPisah[1]) - 1] . ' ' . $tanggalPisah[0];

	    return $tanggalBaru;
	}

	function simpanBuku($data) {
	    global $koneksi;

	    $judul = $data['judul'];
	    $penerbit = $data['penerbit'];
	    $tahun = $data['tahun'];
	    $tgl_masuk = $data['tgl_masuk'];

	    $query = "INSERT INTO buku (judul, penerbit, tahun, tgl_masuk) VALUES ('$judul', '$penerbit', '$tahun', '$tgl_masuk')";
	    $gas = mysqli_query($koneksi, $query);
	    if($gas){
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function simpanUser($data) {
	    global $koneksi;

	    $nim = $data['nim'];
	    $password = md5($data['nim']);
	    $nama = $data['nama'];
	    $jenis_kelamin = $data['jenis_kelamin'];
	    $telepon = $data['telepon'];
	    $alamat = $data['alamat'];
	    $status = $data['status'];


	    $query = "INSERT INTO user (nim, password, nama, jenis_kelamin, telepon, alamat, status) VALUES ('$nim', '$password', '$nama', '$jenis_kelamin', '$telepon', '$alamat', '$status')";
	    $result = mysqli_query($koneksi, $query);
	    if($result){
	        return true;
	    }else{
	        return false;
	    }
	}



	function editBuku($id, $data) {
	    global $koneksi;

	    $judul = $data['judul'];
	    $penerbit = $data['penerbit'];
	    $tahun = $data['tahun'];
	    $tgl_masuk = $data['tgl_masuk'];

	    $query = "UPDATE buku SET judul='$judul', penerbit='$penerbit', tahun='$tahun', tgl_masuk='$tgl_masuk' WHERE id=$id";
	    $gas = mysqli_query($koneksi, $query);
	    if($gas){
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function hapusBuku($id) {
	    global $koneksi;

	    $query = "DELETE FROM buku WHERE id=$id";
	    $gas = mysqli_query($koneksi, $query);
	    if($gas){
	    	return true;
	    }else{
	    	return false;
	    }
	}


	function hapusTransaksi($id) {
	    global $koneksi;

	    $query = "DELETE FROM transaksi WHERE id=$id";
	    $gas = mysqli_query($koneksi, $query);
	    if($gas){
	    	return true;
	    }else{
	    	return false;
	    }
	}


	function hapusUser($id) {
	    global $koneksi;

	    $query = "DELETE FROM user WHERE nim=$id";
	    $gas = mysqli_query($koneksi, $query);
	    if($gas){
	    	return true;
	    }else{
	    	return false;
	    }
	}


	function simpanTransaksi($data) {
	    global $koneksi;

	    $nim = $data['nim'];
	    $id_buku = $data['buku'];
	    $tgl_pinjam = $data['tgl_pinjam'];
	    $tgl_kembali = $data['tgl_kembali'];
	    $status = $data['status'];
	    $denda = $data['denda'];
	    if($tgl_kembali == 'null'){
	    	$tgl_kembali = null;
	    }

	    $query = "INSERT INTO transaksi (nim, id_buku, tgl_pinjam, tgl_kembali, status, denda) VALUES ('$nim', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$status', '$denda')";
	    $result = mysqli_query($koneksi, $query);
	    
	    if ($result) {
	        return true;
	    } else {
	        return false;
	    }
	}


	function editTransaksi($id, $data) {
	    global $koneksi;

	    $nim = $data['nim'];
	    $id_buku = $data['buku'];
	    $tgl_pinjam = $data['tgl_pinjam'];
	    $tgl_kembali = $data['tgl_kembali'];
	    $status = $data['status'];
	    $denda = $data['denda'];

	    if ($tgl_kembali == 'null') {
	        $tgl_kembali = null;
	    }

	    $query = "UPDATE transaksi SET nim='$nim', id_buku='$id_buku', tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', status='$status', denda='$denda' WHERE id ='$id'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        return true;
	    } else {
	        return false;
	    }
	}



	function cekInTransaksi($kategori, $id) {
    	global $koneksi;

    	$kolom = 'id_buku';
    	if($kategori == 'user'){
    		$kolom = 'nim';
    	}

	    // Kueri SQL untuk memeriksa apakah ID ada dalam tabel transaksi
	    $query = "SELECT COUNT(*) FROM transaksi WHERE $kolom = '$id'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_row($result);
	        $jumlah = $row[0];

	        if ($jumlah > 0) {
	            return true; // ID ditemukan dalam transaksi
	        } else {
	            return false; // ID tidak ditemukan dalam transaksi
	        }
	    } else {
	        return false; // Error dalam menjalankan kueri SQL
	    }
	}


	function cekBukuInTransaksi($nim, $id) {
    	global $koneksi;

	    // Kueri SQL untuk memeriksa apakah ID ada dalam tabel transaksi
	    $query = "SELECT COUNT(*) FROM transaksi WHERE id_buku = '$id' AND nim = '$nim' AND status = '0'";
	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        $row = mysqli_fetch_row($result);
	        $jumlah = $row[0];

	        if ($jumlah > 0) {
	            return true; // ID ditemukan dalam transaksi
	        } else {
	            return false; // ID tidak ditemukan dalam transaksi
	        }
	    } else {
	        return false; // Error dalam menjalankan kueri SQL
	    }
	}

	function ubahUser($data, $gambar) {
    global $koneksi;

    // Mendapatkan data dari parameter
    $nama = $data['nama'];
    $nim = $data['id'];
    $jenisKelamin = $data['jenis_kelamin'];
    $telepon = $data['telepon'];
    $alamat = $data['alamat'];
    $status = $data['status'];

    // Memeriksa apakah gambar diisi atau kosong
    if (!empty($gambar['name'])) {
        // Mendapatkan nama dan ekstensi file gambar
        $gambarNama = $gambar['name'];
        $gambarEkstensi = pathinfo($gambarNama, PATHINFO_EXTENSION);

        // Menentukan lokasi file gambar yang akan disimpan
        $gambarTujuan = '../assets/img/profil/' . $nim . '.' . $gambarEkstensi;

        // Memindahkan file gambar ke lokasi yang ditentukan
        if (move_uploaded_file($gambar['tmp_name'], $gambarTujuan)) {
            // Mengubah nama file gambar yang disimpan di database
            $gambarNamaDatabase = $nim . '.' . $gambarEkstensi;

            // Melakukan pembaruan data pengguna dalam database
            $query = "UPDATE user SET
                      nama = '$nama',
                      jenis_kelamin = '$jenisKelamin',
                      telepon = '$telepon',
                      alamat = '$alamat',
                      status = '$status',
                      img = '$gambarNamaDatabase'
                      WHERE nim = '$nim'";

            $result = mysqli_query($koneksi, $query);

            if ($result) {
                // Pengguna berhasil diubah
                return true;
            } else {
                // Terjadi kesalahan dalam mengubah pengguna
                return false;
            }
        } else {
            // Terjadi kesalahan dalam memindahkan file gambar
            return false;
        }
    } else {
        // Gambar kosong atau tidak diisi, tidak perlu diubah dalam database dan tidak disimpan di folder
        $query = "UPDATE user SET
                  nama = '$nama',
                  jenis_kelamin = '$jenisKelamin',
                  telepon = '$telepon',
                  alamat = '$alamat',
                  status = '$status'
                  WHERE nim = '$nim'";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Pengguna berhasil diubah
            return true;
        } else {
            // Terjadi kesalahan dalam mengubah pengguna
            return false;
        }
    }
}





	function ubahPass($data) {
	    global $koneksi;

	    // Mendapatkan data dari parameter
	    $id = $data['id'];
	    $passwordLama = md5($data['lama']);
	    $passwordBaru = md5($data['baru']);

	    // Memeriksa apakah password lama yang diinputkan benar
	    $query = "SELECT * FROM user WHERE nim = '$id' AND password = '$passwordLama'";
	    $result = mysqli_query($koneksi, $query);

	    if (mysqli_num_rows($result) > 0) {
	        // Password lama benar, melakukan pembaruan password dalam database
	        $queryUpdate = "UPDATE user SET password = '$passwordBaru' WHERE nim = '$id'";
	        $resultUpdate = mysqli_query($koneksi, $queryUpdate);

	        if ($resultUpdate) {
	            // Password berhasil diubah
	            return true;
	        } else {
	            // Terjadi kesalahan dalam mengubah password
	            return false;
	        }
	    } else {
	        // Password lama salah
	        return false;
	    }
	}

	function gantiStatus($id, $status) {
	    global $koneksi;

	    // Melakukan pembaruan data pengguna dalam database
	    $query = "UPDATE user SET status = '$status' WHERE nim = '$id'";

	    $result = mysqli_query($koneksi, $query);

	    if ($result) {
	        // Pengguna berhasil diubah
	        return true;
	    } else {
	        // Terjadi kesalahan dalam mengubah pengguna
	        return false;
	    }
	}





?>