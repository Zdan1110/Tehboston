<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link rel="stylesheet" href="{{ asset('bootstrap/css/styles.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" cssorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 1px 0;
                font-size: 18px;
                text-align: left;
            }
            th, td {
                width: auto;
                padding: 12px;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f8f9fa;
                font-weight: bold;
                text-transform: uppercase;
            }
            img{
                width: 10%;
                height: 10%;
            }
          
        </style>
    </head>
    <body class="sb-nav-fixed">
        @include ('layouts.nav')

        @yield ('tabel')
                            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                <input class="form-control my-2" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
                            <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>BRG001</td>
                                        <td>Samsung M30s</td>
                                        <td>7</td>
                                        <td>Rp2.520.000</td>
                                        <td>Rp2.700.000</td>
                                        <td><img src="gambar/735-samsung m30s.jpeg" alt=""></td>
                                        <td><button class='btn btn-primary'>Perbarui</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>BRG002</td>
                                        <td>Redmi Note 6</td>
                                        <td>20</td>
                                        <td>Rp2.200.000</td>
                                        <td>Rp2.500.000</td>
                                        <td><img src="gambar/784-xiaomi-redmi-note-6-pro-f.jpg" alt=""></td>
                                        <td><button class='btn btn-primary'>Perbarui</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>BRG003</td>
                                        <td>Xiaomi Redmi Note 9 Pro</td>
                                        <td>11</td>
                                        <td>Rp3.200.000</td>
                                        <td>Rp3.350.000</td>
                                        <td><img src="gambar/220-redmi note 9 pro.jpg" alt=""></td>
                                        <td><button class='btn btn-primary'>Perbarui</button></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>BRG004</td>
                                        <td>Xiaomi Redmi Note 8</td>
                                        <td>6</td>
                                        <td>Rp2.600.000</td>
                                        <td>Rp2.850.000</td>
                                        <td><img src="gambar/340-redmi note 8.jpg" alt=""></td>
                                        <td><button class='btn btn-primary'>Perbarui</button></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>BRG005</td>
                                        <td>Iphone 11</td>
                                        <td>8</td>
                                        <td>Rp4.600.000</td>
                                        <td>Rp5.800.000</td>
                                        <td><img src="gambar/697-apple_iphone_11_black_1_2_1_1_1_1.jpg" alt=""></td>
                                        <td><button class='btn btn-primary'>Perbarui</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
