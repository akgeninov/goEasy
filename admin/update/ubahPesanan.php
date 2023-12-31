<?php 
    include "../../connect/koneksi.php";

    $sql = mysqli_query($koneksi, "SELECT * FROM orderdetails where orderNumber = '$_GET[kode]'");
    $data = mysqli_fetch_array($sql);
?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Utama</title>
        <link rel="stylesheet" href="../css/stylehome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    </head>
    <body>
    <div class="content">
        <span>GO EASY</span>
    </div>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="../home.php">
                            <span class="icon">
                                <i class="fa fa-house"></i>
                            </span>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
                    <a href="#">
                        <span class="icon">
                            <i class="fa-solid fa-database"></i>
                        </span>
                        <span class="title">Data</span>
                    </a>
                    <div class="list">
                        <ul>
                            <li><a href="../view/tampilAdmin.php">Data Admin</a></li>
                            <li><a href="../view/tampilPelanggan.php">Data Pelanggan</a></li>
                            <li><a href="../view/tampilPegawai.php">Data Pegawai</a></li>
                            <li><a href="../view/tampilKantor.php">Data Kantor</a></li>
                            <li><a href="../view/tampilOrder.php">Data Pesanan</a></li>
                            <li><a href="../view/tampilProduk.php">Data Produk</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="../logout.php">
                        <div class="keluar">
                        <span class="icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        <span class="title">Keluar</span>
                    </a>
                </li>
                </ul>
            </div>
    
            <div class="main-content"> 
                <main>
                    <div class="data">
                        <span>Ubah Data Pesanan</span>
                    </div>
                    <form action="" method="post">
                        <fieldset>
                            <legend>Form Data Pesanan</legend>
                            <table>
                            <tr>
                                    <td>Order Number</td>
                                    <td> : </td>
                                    <td>
                                        <select name="order_number" required>
                                            <option><?php echo $data['orderNumber']; ?></option>
                                            <?php
                                                $impor_data = mysqli_query($koneksi, "SELECT * FROM orders");
                                                while($data_from = mysqli_fetch_array($impor_data)){
                                                    echo "<option value=$data_from[orderNumber]>$data_from[orderNumber]</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product Code</td>
                                    <td> : </td>
                                    <td>
                                        <select name="prod_code" required>
                                            <option><?php echo $data['productCode']; ?></option>
                                            <?php
                                                $impor_data = mysqli_query($koneksi, "SELECT * FROM products");
                                                while($data_from = mysqli_fetch_array($impor_data)){
                                                    echo "<option value=$data_from[productCode]>$data_from[productCode] - $data_from[productName]</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity Ordered</td>
                                    <td> : </td>
                                    <td><input type="text" name="quantity" value="<?php echo $data['quantityOrdered']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Price Each</td>
                                    <td> : </td>
                                    <td><input type="text" name="price_each" value="<?php echo $data['priceEach']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Order Line Number</td>
                                    <td> : </td>
                                    <td><input type="text" name="order_line" value="<?php echo $data['orderLineNumber']; ?>" required></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Simpan" name="proses" required>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>

                    <?php
                        $status = "";
                        if(isset($_POST['proses'])){
                            $query = mysqli_query($koneksi, "UPDATE orderdetails set
                            orderNumber = '$_POST[order_number]',
                            productCode = '$_POST[prod_code]',
                            quantityOrdered = '$_POST[quantity]',
                            priceEach = '$_POST[price_each]',
                            orderLineNumber = '$_POST[order_line]' WHERE orderNumber = '$_GET[kode]'");

                            $status = "berhasil";
                        }

                        if($status == "berhasil"){
                            echo "<script> alert('Ubah data berhasil!'); window.location='../view/tampilOrder.php';</script>";
                        }
                    ?>
                </main>
            </div>
    </body>
    </html>