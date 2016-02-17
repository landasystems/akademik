<?php
if (isset($dateHoliday)) {
    $tanggalMerah = array();
    foreach ($dateHoliday as $hol) {
        $tanggalMerah[] = $hol;
    }
} else {
    $tanggalMerah = '0';
}

$dateNow = date("Y-m-d");

/* Mengecek apakah hari minggu */
$tanggal = strtotime($dateNow);
$hari_en = date('l', $tanggal);
$hari_ar = array("Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jumat", "Saturday" => "Sabtu", "Sunday" => "Minggu");
$hari_id = $hari_ar[$hari_en];

if ($hari_id == "Minggu" or in_array($dateNow, $tanggalMerah)) {
    ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <center>
                <div class="span8" id="eror">
                    <label><h1>Mohon Maaf <br> Selama Libur Aplikasi Absensi Dinonaktifkan</h1></label>
                    <img src="<?php echo bu('images/libur.jpg') ?>">
                </div>
            </center>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="row-fluid">
        <div class="span12">
            <div id="header">
                <img src="<?php echo bu('images/logo.png') ?>">
            </div>
        </div>
    </div>
    <div style="margin-top: 30px; margin-left: 5%; margin-right: 5%;">
        <div class="row-fluid">
            <div class="span12">
                <div id="left" class="span5" style="background-color: white;padding-top: 5px !important">
                    <fieldset>
                        <legend style="text-align: center">Absensi Hari Ini</legend>
                    </fieldset>
                    <div style="height: 300px;overflow-y: scroll;padding: 5px;">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center">NIS</th>
                                    <th style="text-align:center">Nama</th>
                                    <th style="text-align:center">Masuk</th>
                                    <th style="text-align:center">Keluar</th>
                                </tr>
                            </thead>
                            <tbody id="listAbsent">
                                <?php
                                echo $grid;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="span7">
                    <div id="right" style="    padding-top: 25px;">
                        <div class="row-fluid">
                            <div class="span7">
                                <center>
                                    <img src="<?php echo bu('images/250x250-noimage.jpg') ?>" class="img-polaroid" id="avatarSiswa" width="200" height="300">
                                </center>
                                <br><br>
                                <table style="font-weight: bold; margin-right: 20px;" width="100%">
                                    <tr>
                                        <td style="text-align: right; vertical-align: middle;" width="35%">NIS</td>
                                        <td id="nimSiswa"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; vertical-align: middle;">Nama</td>
                                        <td id="namaSiswa"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; vertical-align: middle;">Kelas</td>
                                        <td id="kelasSiswa"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; vertical-align: middle;">Waktu Absen</td>
                                        <td id="waktuAbsensi"></td>
                                    </tr>
                                </table>
                                <br>
                            </div>
                            <div class="span5">
                                <div class="span11" id="time" align="center">
                                    <div class="control-group">
                                        <label class="control-label" for="codeSiswa"></label>
                                        <div class="controls">
                                            <input class="span12" type="text" id="codeSiswa" placeholder="Barcode Scanner">
                                        </div>
                                    </div>
                                    <p style="text-transform:capitalizeCapitalized;text-shadow: 0 0 5px #00c6ff;"><?php echo date("D, d M Y") ?></p>
                                    <p id="clock" style="text-shadow: 0 0 5px #00c6ff;"></p>
                                </div>
                            </div>
                            <br>
                            <div class="span5"></div>
                            <div class="span5" id="ket">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>