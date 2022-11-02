<?php 

session_start();

include "../config/database.php";

class oop {

  function simpan($table, $field, $redirect) {
    global $conn;
    $sql = "INSERT INTO $table SET";
    foreach ($field as $key => $value) {
      $sql .= " $key = '$value',";
    }
    $sql = rtrim($sql, ",");
    $jalan = mysqli_query($conn, $sql);
    if ($jalan) { 
      echo "
        <script>
          alert('Berhasil');
          document.location.href='$redirect'
        </script>
      ";
    } else {
      echo mysqli_error($conn);
    }
  }

  function tampil($table) {
    global $conn;
    $sql = "SELECT * FROM $table";
    $tampil = mysqli_query($conn, $sql);
    if (mysqli_num_rows($tampil) != 0) {
      while ($data = mysqli_fetch_assoc($tampil)) {
        $isi[] = $data;
      }
    } else {
      $isi = [];
    }
    return $isi;
  }

  function hapus($table, $where, $redirect) {
    global $conn;
    $sql = "DELETE FROM $table WHERE $where";
    $jalan = mysqli_query($conn, $sql);
    if ($jalan) {
      echo "
        <script>
          alert('Berhasil');
          document.location.href='$redirect'
        </script>
      ";
    } else {
      echo mysqli_error($conn);
    }
  }

  function edit($table, $where) {
    global $conn;
    $sql = "SELECT * FROM $table WHERE $where";
    $jalan = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $jalan;
  }

  function ubah($table, $field, $where, $redirect) {
    global $conn;
    $sql = "UPDATE $table SET";
    foreach ($field as $key => $value) {
      $sql .= " $key = '$value',";
    }
    $sql = rtrim($sql, ",");
    $sql .= "WHERE $where";
    $jalan = mysqli_query($conn, $sql);
    if ($jalan) {
      echo "
        <script>
          alert('Berhasil');
          document.location.href='$redirect'
        </script>
      ";
    } else {
      echo mysqli_error($conn);
    }
  }

  function upload($foto, $tempat) {
    $alamat = $foto['tmp_name'];
    $namafile = $foto['name'];
    move_uploaded_file($alamat, "$tempat/$namafile");
    return $namafile;
  }

  function login($table, $username, $password, $nama_form) {
    global $conn;
    $sql = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
    $jalan = mysqli_query($conn, $sql);
    $tampil = mysqli_fetch_assoc($jalan);
    $cek = mysqli_num_rows($jalan);
    if ($cek > 0) {
      $_SESSION['username'] = $username;
      echo "
        <script>
          alert('Login Berhasil!'); 
          document.location.href='$nama_form'
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Login gagal cek username dan password!!')
        </script>
      ";
    }
  }
  
}
