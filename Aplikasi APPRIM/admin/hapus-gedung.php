<?php
// Menghubungkan ke database
include "../koneksi/koneksi.php";

// Memastikan ID gedung diterima dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Mengambil ID gedung dari URL
    $id_gedung = $_GET['id'];

    // Query untuk mengecek apakah gedung ada di database
    $sql_check = "SELECT * FROM gedung WHERE id_gedung = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("i", $id_gedung);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika gedung ditemukan, maka hapus gedung tersebut
        $sql_delete = "DELETE FROM gedung WHERE id_gedung = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id_gedung);
        
        // Menjalankan query delete
        if ($stmt_delete->execute()) {
            // Menghapus foto gedung jika ada
            $row = $result->fetch_assoc();
            $foto_gedung = $row['foto_gedung'];
            if (file_exists("../images/" . $foto_gedung)) {
                unlink("../images/" . $foto_gedung);  // Menghapus file gambar gedung
            }

            // Menampilkan pesan sukses dan redirect
            echo "<script>
                    alert('Gedung berhasil dihapus!');
                    window.location.href = '../admin/home-admin.php';
                  </script>";
        } else {
            // Jika query gagal
            echo "<script>
                    alert('Terjadi kesalahan saat menghapus gedung.');
                    window.location.href = '../admin/home-admin.php';
                  </script>";
        }
    } else {
        // Jika gedung tidak ditemukan
        echo "<script>
                alert('Gedung tidak ditemukan!');
                window.location.href = '../admin/home-admin.php';
              </script>";
    }
} else {
    // Jika ID tidak diterima
    echo "<script>
            alert('ID gedung tidak valid.');
            window.location.href = '../admin/home-admin.php';
          </script>";
}

// Menutup koneksi
$stmt->close();
$stmt_delete->close();
$conn->close();
?>
