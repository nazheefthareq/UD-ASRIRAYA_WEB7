<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../../../controllers/laporanController.php" method="POST">
        <input type="hidden" name="tambah" value="1">
        <input type="date" name="tanggal" required>
        <select name="jenis" required>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select>
        <input type="text" name="deskripsi" required>
        <input type="number" name="nominal" required>
        <button type="submit">Simpan</button>
    </form>

</body>

</html>