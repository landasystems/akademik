<?php
if (isset($dateHoliday)) {
    $tanggalMerah = array();
    foreach ($dateHoliday as $hol) {
        $tanggalMerah[] = $hol;
    }
} else {
    $tanggalMerah = '0';
}
?>
<h2>Rekap Kehadiran Siswa Kelas <?php echo $kelas ?> Bulan <?php echo $month ?> Tahun <?php echo $year ?></h2>

<table border="1">
    <tr style="height: 35px; background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <th colspan="2" style="text-align:center">Siswa</th>
        <th colspan="<?php echo $amountDay ?>" style="text-align:center">Tanggal</th>
        <th colspan="4" style="text-align:center">Jumlah</th>
    </tr>
    <tr style="height: 35px; background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <th style="text-align:center">Nis</th>
        <th style="text-align:center;">Nama</th>
        <?php
        if (!empty($year) && !empty($month)) {
            for ($i = 1; $i <= $amountDay; $i++) {
                echo '<th>' . $i . '</th>';
            }
        }
        ?>
        <td style="text-align:center"><span class="label label-success">Masuk</span></td>
        <td style="text-align:center"><span class="label label-warning">Ijin</span></td>
        <td style="text-align:center"><span class="label label-info">Sakit</span></td>
        <td style="text-align:center"><span class="label label-important">Alpha</span></td>
    </tr>
    <?php
    $no = 0;
    $jmlAbsent = array();
    $jmlPresent = array();
    $jmlPermit = array();
    $jmlSick = array();
    $jMasuk = 0;
    $jIjin = 0;
    $jSakit = 0;
    $jAbsen = 0;

    foreach ($classroom as $arr) {
        $code = (isset($arr->User->code)) ? $arr->User->code : '-';
        $nama = (isset($arr->User->name)) ? $arr->User->name : '-';
        ?>
        <tr>
            <td align="left"><?php echo $code ?></td>
            <td align="left"><?php echo $nama ?></td>
            <?php
            $absen = 0;
            $permit = 0;
            $sick = 0;
            $present = 0;

            for ($i = 1; $i <= $amountDay; $i++) {
                $status = "";
                $thisDate = $month . '/' . $i . '/' . $year;
                $dateAbsent = date("Y-m-d", strtotime($year . '-' . $month . '-' . $i));
                $tahun = $year;
                $bulan = $month;
                $kelas = $kelas;
                $tdDay = '';

                /* Mengecek apakah hari minggu */
                $tanggal = strtotime($dateAbsent);
                $hari_en = date('l', $tanggal);
                $hari_ar = array("Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jumat", "Saturday" => "Sabtu", "Sunday" => "Minggu");
                $hari_id = $hari_ar[$hari_en];

                if ($hari_id == "Minggu" or in_array($dateAbsent, $tanggalMerah)) {
                    $columnColor = "white";
                    $tdDay = "";
                    $jmlAbsent[$i]["keterangan"] = "Libur";
                    $jmlPresent[$i]["keterangan"] = "Libur";
                    $jmlPermit[$i]["keterangan"] = "Libur";
                    $jmlSick[$i]["keterangan"] = "Libur";
                } else {
                    /* memberi warna kolom */
                    if (strtotime($thisDate) > strtotime(date('Ymd'))) {
                        $columnColor = 'white';
                        $jmlAbsent[$i]["keterangan"] = "Libur";
                        $jmlPresent[$i]["keterangan"] = "Libur";
                        $jmlPermit[$i]["keterangan"] = "Libur";
                        $jmlSick[$i]["keterangan"] = "Libur";
                    } elseif (strtotime($thisDate) < strtotime(date('Ymd')) or strtotime($thisDate) == strtotime(date('m/d/Y'))) {
                       
                        if (isset($mAbsent[$i][$arr->user_id])) {
                            $status = $mAbsent[$i][$arr->user_id]->status;
                            if ($status == "presen") {
                                $tdDay = "M";
                                $columnColor = "#00b050";
                            } else if ($status == "sick") {
                                $tdDay = "S";
                                $columnColor = "#00b0f0";
                            } else if ($status == "permit") {
                                $tdDay = "I";
                                $columnColor = "#ffff00";
                            }
                        } else {
                            $status = 'absent';
                            $tdDay = "A";
                            $columnColor = "#e02424";
                        }
                    }
                    if ($status == 'absent') {
                        $absen += 1;
                        $jmlAbsent[$i][$no] = 1;
                    } else if ($status == 'permit') {
                        $permit += 1;
                        $jmlPermit[$i][$no] = 1;
                    } else if ($status == 'sick') {
                        $sick += 1;
                        $jmlSick[$i][$no] = 1;
                    } else if ($status == 'presen') {
                        $present += 1;
                        $jmlPresent[$i][$no] = 1;
                    }
                }
                ?>
                <td style="background-color: <?php echo $columnColor ?>; text-align: center;" width="25"><?php echo $tdDay; ?></td>
                <?php
            }
            ?>
            <td style="text-align:center"><?php echo $present ?></td>
            <td style="text-align:center"><?php echo $permit ?></td>
            <td style="text-align:center"><?php echo $sick ?></td>
            <td style="text-align:center"><?php echo $absen ?></td>
        </tr>
        <?php
        $no++;
    }
    ?>

    <tr style="background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <td rowspan="4" style="text-align: center; vertical-align: middle; background-color: #404040; color: #FFFFFF;">Jumlah</td>
        <td style="text-align:center" ><span class="label label-success">Masuk</span></td>
        <?php
        for ($i = 1; $i <= $amountDay; $i++) {
            if (isset($jmlPresent[$i]) and !isset($jmlPresent[$i]['keterangan'])) {
                echo '<td>' . count($jmlPresent[$i]) . '</td>';
            } else if (isset($jmlPresent[$i]['keterangan'])) {
                echo '<td bgcolor="#404040"></td>';
            } else {
                echo '<td>0</td>';
            }
        }
        ?>
        <td style="background-color: lightgray" rowspan="4" colspan="4"></td>
    </tr>
    <tr style="background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <td style="text-align:center"><span class="label label-warning">Ijin</span></td>
        <?php
        for ($i = 1; $i <= $amountDay; $i++) {
            if (isset($jmlPermit[$i]) and !isset($jmlPermit[$i]['keterangan'])) {
                echo '<td>' . count($jmlPermit[$i]) . '</td>';
            } else if (isset($jmlPermit[$i]['keterangan'])) {
                echo '<td  bgcolor="#404040"></td>';
            } else {
                echo '<td>0</td>';
            }
        }
        ?>
    </tr>
    <tr style="background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <td style="text-align:center"><span class="label label-info">Sakit</span></td>
        <?php
        for ($i = 1; $i <= $amountDay; $i++) {
            if (isset($jmlSick[$i]) and !isset($jmlSick[$i]['keterangan'])) {
                echo '<td>' . count($jmlSick[$i]) . '</td>';
            } else if (isset($jmlSick[$i]['keterangan'])) {
                echo '<td  bgcolor="#404040"></td>';
            } else {
                echo '<td>0</td>';
            }
        }
        ?>
    </tr>
    <tr style="background-color: #404040; color: #FFFFFF; text-align: center; vertical-align: middle;">
        <td style="text-align:center"><span class="label label-important">Alpha</span></td>
        <?php
        for ($i = 1; $i <= $amountDay; $i++) {
            if (isset($jmlAbsent[$i]) and !isset($jmlAbsent[$i]['keterangan'])) {
                echo '<td>' . count($jmlAbsent[$i]) . '</td>';
            } else if (isset($jmlAbsent[$i]['keterangan'])) {
                echo '<td  bgcolor="#404040"></td>';
            } else {
                echo '<td>0</td>';
            }
        }
        ?>
    </tr>
</table>