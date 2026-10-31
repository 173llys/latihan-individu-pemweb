<?php
$matkul = [
    ["nama" => "Pemrograman Web",   "sks" => 3, "nilai" => 90],
    ["nama" => "Sistem Basis Data",        "sks" => 3, "nilai" => 88],
    ["nama" => "Algoritma",         "sks" => 4, "nilai" => 78],
    ["nama" => "Jaringan Komputer", "sks" => 2, "nilai" => 72],
    ["nama" => "Bahasa Inggris",    "sks" => 2, "nilai" => 92],
    ["nama" => "Statistika",        "sks" => 3, "nilai" => 45],
];
 
function hitungBobot($nilai)
{
    if ($nilai >= 85) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 55) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 40) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}
 
$totalSks = 0;
$totalMutu = 0;
foreach ($matkul as $mk) {
    $hasil = hitungBobot($mk["nilai"]);
    $totalSks = $totalSks + $mk["sks"];
    $totalMutu = $totalMutu + ($mk["sks"] * $hasil["bobot"]);
}
 
if ($totalSks > 0) {
    $ips = $totalMutu / $totalSks;
} else {
    $ips = 0;
}
 
if ($ips >= 3.00) {
    $maxSks = 24;
} else {
    $maxSks = 20;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Individu - Nilai Mata Kuliah</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: center; }
        th { background: #000000; color: #fff; }
        td.kiri { text-align: left; }
        tr.mengulang { background: #ffcccc; color: #b00000; font-weight: bold; }
        .ringkasan { margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Daftar Nilai Mata Kuliah</h2>
 
    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Status</th>
        </tr>
        <?php
        $no = 1;
        foreach ($matkul as $mk) {
            $h = hitungBobot($mk["nilai"]);
 
            if ($h["bobot"] >= 2.0) {
                $status = "LULUS";
            } else {
                $status = "MENGULANG";
            }
 
            if ($status == "MENGULANG") {
                $kelas = "mengulang";
            } else {
                $kelas = "";
            }
 
            echo "<tr class='" . $kelas . "'>";
            echo "<td>" . $no . "</td>";
            echo "<td class='kiri'>" . $mk["nama"] . "</td>";
            echo "<td>" . $mk["sks"] . "</td>";
            echo "<td>" . $mk["nilai"] . "</td>";
            echo "<td>" . $h["huruf"] . "</td>";
            echo "<td>" . $status . "</td>";
            echo "</tr>";
 
            $no++;
        }
        ?>
    </table>
 
    <div class="ringkasan">
        <h3>Ringkasan IPS</h3>
        <?php
        echo "<p>Total SKS: <b>" . $totalSks . "</b></p>";
        echo "<p>Total Mutu: <b>" . number_format($totalMutu, 1) . "</b></p>";
        echo "<p>IPS: <b>" . number_format($ips, 2) . "</b></p>";
        echo "<p>Batas maksimal SKS semester depan: <b>" . $maxSks . " SKS</b></p>";
        ?>
    </div>
</body>
</html>