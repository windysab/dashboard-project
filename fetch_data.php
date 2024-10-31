<?php
$servername = "localhost";
$username = "root";
$password = "kadatahu123db";
$dbname = "sipp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nomor_perkara, jenis_perkara_nama, majelis_hakim_nama, panitera_pengganti_text, tanggal_pendaftaran, penetapan_majelis_hakim, penetapan_hari_sidang, sidang_pertama, tanggal_putusan, status_putusan.`nama` AS amar, pekerjaan, perkara_pihak2.alamat AS alamat_pihak2, prodeo, pihak.email AS email_pihak1 
FROM perkara
LEFT JOIN perkara_penetapan ON perkara.perkara_id = perkara_penetapan.perkara_id
LEFT JOIN perkara_putusan ON perkara.perkara_id = perkara_putusan.perkara_id
LEFT JOIN status_putusan ON status_putusan.id = perkara_putusan.status_putusan_id 
LEFT JOIN perkara_pihak1 ON perkara.perkara_id = perkara_pihak1.perkara_id
LEFT JOIN perkara_pihak2 ON perkara.perkara_id = perkara_pihak2.perkara_id
LEFT JOIN pihak ON perkara_pihak1.pihak_id = pihak.id
LEFT JOIN perkara_efiling_id ON perkara.perkara_id = perkara_efiling_id.perkara_id
WHERE perkara_pihak1.pihak_id != '1'
AND perkara_pihak1.urutan = '1'
AND pekerjaan NOT LIKE '%Pensiunan%'
AND nomor_perkara = '7/Pdt.G/2024/PA.Amt'
GROUP BY perkara.perkara_id
ORDER BY tanggal_pendaftaran DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Nomor Perkara: " . $row["nomor_perkara"]. " - Jenis Perkara: " . $row["jenis_perkara_nama"]. " - Majelis Hakim: " . $row["majelis_hakim_nama"]. " - Panitera Pengganti: " . $row["panitera_pengganti_text"]. " - Tanggal Pendaftaran: " . $row["tanggal_pendaftaran"]. " - Penetapan Majelis Hakim: " . $row["penetapan_majelis_hakim"]. " - Penetapan Hari Sidang: " . $row["penetapan_hari_sidang"]. " - Sidang Pertama: " . $row["sidang_pertama"]. " - Tanggal Putusan: " . $row["tanggal_putusan"]. " - Amar: " . $row["amar"]. " - Pekerjaan: " . $row["pekerjaan"]. " - Alamat Pihak 2: " . $row["alamat_pihak2"]. " - Prodeo: " . $row["prodeo"]. " - Email Pihak 1: " . $row["email_pihak1"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>