<?php session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yurt Odası Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Yurt Odası Ekle</h5>
                    </div>
                    <div class="card-body">
                        <form action="add_room_process.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="room_name" class="form-label">Oda İsmi</label>
                                <input type="text" class="form-control" id="room_name" name="room_name">
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Kişi Kapasitesi</label>
                                <input type="number" class="form-control" id="capacity" name="capacity">
                            </div>
                            <div class="mb-3">
                                <label for="size_sqm" class="form-label">Metrekare</label>
                                <input type="number" class="form-control" id="size_sqm" name="size_sqm">
                            </div>
                            <div class="mb-3">
                                <label for="annual_price" class="form-label">Yıllık Fiyat</label>
                                <input type="number"  class="form-control" id="annual_price" name="annual_price">
                            </div>
                            <div class="mb-3">
                                <label for="room_quantity" class="form-label">Mevcut Oda Sayısı</label>
                                <input type="number"  class="form-control" id="room_quantity" name="room_quantity">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Özellikler</label>
                                <div class="row">
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Kartlı Giriş Sistemi" id="kartliGiris" name="features[]">
                                        <label class="form-check-label" for="kartliGiris">Kartlı Giriş Sistemi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Çekmeceli Yatak" id="cekmeceliYatak" name="features[]">
                                        <label class="form-check-label" for="cekmeceliYatak">Çekmeceli Yatak</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Mikro Dalga" id="mikrodalga" name="features[]">
                                        <label class="form-check-label" for="mikrodalga">Mikro Dalga</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Ocak" id="ocak" name="features[]">
                                        <label class="form-check-label" for="ocak">Ocak</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Mutfak" id="mutfak" name="features[]">
                                        <label class="form-check-label" for="mutfak">Mutfak</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Klima" id="klima" name="features[]">
                                        <label class="form-check-label" for="klima">Klima</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Kettle" id="kettle" name="features[]">
                                        <label class="form-check-label" for="kettle">Kettle</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Balkon" id="balkon" name="features[]">
                                        <label class="form-check-label" for="balkon">Balkon</label>
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Yemek Masası" id="yemekMasasi" name="features[]">
                                            <label class="form-check-label" for="yemekMasasi">Yemek Masası</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Çalışma Masası ve Sandalyesi" id="sandalyeMasa" name="features[]">
                                            <label class="form-check-label" for="sandalyeMasa">Çalışma Masası ve Sandalyesi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Kitaplık" id="kitaplik" name="features[]">
                                            <label class="form-check-label" for="kitaplik">Kitaplık</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Masa Lambası" id="masaLambasi" name="features[]">
                                            <label class="form-check-label" for="masaLambasi">Masa Lambası</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Boy Aynası" id="boyAynasi" name="features[]">
                                            <label class="form-check-label" for="boyAynasi">Boy Aynası</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Gardrop" id="gardrop" name="features[]">
                                            <label class="form-check-label" for="gardrop">Gardrop</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="TV" id="tv" name="features[]">
                                            <label class="form-check-label" for="tv">TV</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Buzdolabı" id="buzdolabi" name="features[]">
                                            <label class="form-check-label" for="buzdolabi">Buzdolabı</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Özel Tuvalet ve Banyo" id="wc" name="features[]">
                                            <label class="form-check-label" for="wc">Özel Tuvalet ve Banyo</label>
                                        </div>
                                    </div>
                                </div>
                               
                              
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Oda Resmi</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
