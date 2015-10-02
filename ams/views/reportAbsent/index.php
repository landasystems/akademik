<?php
$this->setPageTitle('Report Absensi (Bulanan)');
$this->breadcrumbs = array(
    'Report Absensi',
);
?>
<style>
    .label-reservation{
        background-color: #4AC3FF;
    }
    .dropdown-menu>li>a{
        padding:3px;
    }

    #absent {
        border: none;
        border: 0px;
        margin: 0px;
        padding: 0px;
        font: 67.5% 'Lucida Sans Unicode', 'Bitstream Vera Sans', 'Trebuchet Unicode MS', 'Lucida Grande', Verdana, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: auto;
    }
    #absent ul {
        background: #b94a48;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #absent li {
        float: left;
        padding: 0px;
    }
    #absent li a {
        background: #b94a48 bottom right no-repeat;
        display: block;
        font-weight: normal;
        line-height: 20px;
        margin: 0px;
        padding: 0px 10px;
        text-align: center;
        text-decoration: none;
    }
    #absent > ul > li > a {
        color: #cccccc;
    }
    #absent ul ul a {
        color: #161616;
        text-decoration: bold;
    }
    #absent li > a:hover,
    #absent ul li:hover > a {
        background: #2580a2 url('images/hover.png') bottom center no-repeat;
        color: #FFFFFF;
        text-decoration: none;
    }
    #absent li ul {
        background: #ffffff;
        display: none;
        height: auto;
        padding: 0px;
        margin: 0px;
        border: 0px;
        position: absolute;
        width: 125px;
        z-index: 200;

    }
    #absent li:hover ul {
        display: block;
    }
    #absent li li {
        background:  bottom left no-repeat;
        display: block;
        float: none;
        margin: 0px;
        padding: 0px;
        width: 125px;
    }
    #absent li:hover li a {
        background: none;
    }
    #absent li ul a {
        display: block;
        height: 35px;
        font-size: 12px;
        font-style: normal;
        margin: 0px;
        padding: 10px 10px 0px 15px;
        text-align: left;
    }
    #absent li ul a:hover,
    #absent li ul li:hover > a {
        background: #2580a2 center left no-repeat;
        border: 0px;
        color: #161616;
        text-decoration: none;
    }
    #absent p {
        clear: left;
    }

    #belumpulang {
        border: none;
        border: 0px;
        margin: 0px;
        padding: 0px;
        font: 67.5% 'Lucida Sans Unicode', 'Bitstream Vera Sans', 'Trebuchet Unicode MS', 'Lucida Grande', Verdana, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: auto;
    }
    #belumpulang ul {
        background: #333333;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #belumpulang li {
        float: left;
        padding: 0px;
    }
    #belumpulang li a {
        background: #333333 bottom right no-repeat;
        display: block;
        font-weight: normal;
        line-height: 20px;
        margin: 0px;
        padding: 0px 10px;
        text-align: center;
        text-decoration: none;
    }
    #belumpulang > ul > li > a {
        color: #cccccc;
    }
    #belumpulang ul ul a {
        color: #161616;
        text-decoration: bold;
    }
    #belumpulang li > a:hover,
    #belumpulang ul li:hover > a {
        background: #2580a2 url('images/hover.png') bottom center no-repeat;
        color: #FFFFFF;
        text-decoration: none;
    }
    #belumpulang li ul {
        background: #ffffff;
        display: none;
        height: auto;
        padding: 0px;
        margin: 0px;
        border: 0px;
        position: absolute;
        width: 125px;
        z-index: 200;
        /*top:1em;
              /*left:0;*/

    }
    #belumpulang li:hover ul {
        display: block;
    }
    #belumpulang li li {
        background:  bottom left no-repeat;
        display: block;
        float: none;
        margin: 0px;
        padding: 0px;
        width: 125px;
    }
    #belumpulang li:hover li a {
        background: none;
    }
    #belumpulang li ul a {
        display: block;
        height: 35px;
        font-size: 12px;
        font-style: normal;
        margin: 0px;
        padding: 10px 10px 0px 15px;
        text-align: left;
    }
    #belumpulang li ul a:hover,
    #belumpulang li ul li:hover > a {
        background: #2580a2 center left no-repeat;
        border: 0px;
        color: #161616;
        text-decoration: none;
    }
    #belumpulang p {
        clear: left;
    }

    #ijin {
        border: none;
        border: 0px;
        margin: 0px;
        padding: 0px;
        font: 67.5% 'Lucida Sans Unicode', 'Bitstream Vera Sans', 'Trebuchet Unicode MS', 'Lucida Grande', Verdana, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: auto;
    }
    #ijin ul {
        background: #f89406;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #ijin li {
        float: left;
        padding: 0px;
    }
    #ijin li a {
        background: #f89406 bottom right no-repeat;
        display: block;
        font-weight: normal;
        line-height: 20px;
        margin: 0px;
        padding: 0px 10px;
        text-align: center;
        text-decoration: none;
    }
    #ijin > ul > li > a {
        color: #cccccc;
    }
    #ijin ul ul a {
        color: #161616;
        text-decoration: bold;
    }
    #ijin li > a:hover,
    #ijin ul li:hover > a {
        background: #2580a2 url('images/hover.png') bottom center no-repeat;
        color: #FFFFFF;
        text-decoration: none;
    }
    #ijin li ul {
        background: #ffffff;
        display: none;
        height: auto;
        padding: 0px;
        margin: 0px;
        border: 0px;
        position: absolute;
        width: 125px;
        z-index: 200;

    }
    #ijin li:hover ul {
        display: block;
    }
    #ijin li li {
        background:  bottom left no-repeat;
        display: block;
        float: none;
        margin: 0px;
        padding: 0px;
        width: 125px;
    }
    #ijin li:hover li a {
        background: none;
    }
    #ijin li ul a {
        display: block;
        height: 35px;
        font-size: 12px;
        font-style: normal;
        margin: 0px;
        padding: 10px 10px 0px 15px;
        text-align: left;
    }
    #ijin li ul a:hover,
    #ijin li ul li:hover > a {
        background: #2580a2 center left no-repeat;
        border: 0px;
        color: #161616;
        text-decoration: none;
    }
    #ijin p {
        clear: left;
    }

    #masuk {
        border: none;
        border: 0px;
        margin: 0px;
        padding: 0px;
        font: 67.5% 'Lucida Sans Unicode', 'Bitstream Vera Sans', 'Trebuchet Unicode MS', 'Lucida Grande', Verdana, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: auto;
    }
    #masuk ul {
        background: #468847;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #masuk li {
        float: left;
        padding: 0px;
    }
    #masuk li a {
        background: #468847 bottom right no-repeat;
        display: block;
        font-weight: normal;
        line-height: 20px;
        margin: 0px;
        padding: 0px 10px;
        text-align: center;
        text-decoration: none;
    }
    #masuk > ul > li > a {
        color: #cccccc;
    }
    #masuk ul ul a {
        color: #161616;
        text-decoration: bold;
    }
    #masuk li > a:hover,
    #masuk ul li:hover > a {
        background: #2580a2 url('images/hover.png') bottom center no-repeat;
        color: #FFFFFF;
        text-decoration: none;
    }
    #masuk li ul {
        background: #ffffff;
        display: none;
        height: auto;
        padding: 0px;
        margin: 0px;
        border: 0px;
        position: absolute;
        width: 125px;
        z-index: 200;
        /*top:1em;
              /*left:0;*/

    }
    #masuk li:hover ul {
        display: block;
    }
    #masuk li li {
        background:  bottom left no-repeat;
        display: block;
        float: none;
        margin: 0px;
        padding: 0px;
        width: 125px;
    }
    #masuk li:hover li a {
        background: none;
    }
    #masuk li ul a {
        display: block;
        height: 35px;
        font-size: 12px;
        font-style: normal;
        margin: 0px;
        padding: 10px 10px 0px 15px;
        text-align: left;
    }
    #masuk li ul a:hover,
    #masuk li ul li:hover > a {
        background: #2580a2 center left no-repeat;
        border: 0px;
        color: #161616;
        text-decoration: none;
    }
    #masuk p {
        clear: left;
    }

    #sakit {
        border: none;
        border: 0px;
        margin: 0px;
        padding: 0px;
        font: 67.5% 'Lucida Sans Unicode', 'Bitstream Vera Sans', 'Trebuchet Unicode MS', 'Lucida Grande', Verdana, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: auto;
    }
    #sakit ul {
        background: #3a87ad;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #sakit li {
        float: left;
        padding: 0px;
    }
    #sakit li a {
        background: #3a87ad bottom right no-repeat;
        display: block;
        font-weight: normal;
        line-height: 20px;
        margin: 0px;
        padding: 0px 10px;
        text-align: center;
        text-decoration: none;
    }
    #sakit > ul > li > a {
        color: #cccccc;
    }
    #sakit ul ul a {
        color: #161616;
        text-decoration: bold;
    }
    #sakit li > a:hover,
    #sakit ul li:hover > a {
        background: #2580a2 url('images/hover.png') bottom center no-repeat;
        color: #FFFFFF;
        text-decoration: none;
    }
    #sakit li ul {
        background: #ffffff;
        display: none;
        height: auto;
        padding: 0px;
        margin: 0px;
        border: 0px;
        position: absolute;
        width: 125px;
        z-index: 200;
        /*top:1em;
              /*left:0;*/

    }
    #sakit li:hover ul {
        display: block;
    }
    #sakit li li {
        background:  bottom left no-repeat;
        display: block;
        float: none;
        margin: 0px;
        padding: 0px;
        width: 125px;
    }
    #sakit li:hover li a {
        background: none;
    }
    #sakit li ul a {
        display: block;
        height: 35px;
        font-size: 12px;
        font-style: normal;
        margin: 0px;
        padding: 10px 10px 0px 15px;
        text-align: left;
    }
    #sakit li ul a:hover,
    #sakit li ul li:hover > a {
        background: #2580a2 center left no-repeat;
        border: 0px;
        color: #161616;
        text-decoration: none;
    }
    #sakit p {
        clear: left;
    }
</style>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'room-view-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>


<div class="well">

    <div class="row-fluid">
        <div class="span12">
            <?php
            $class = CHtml::listData(Classroom::model()->findAll(), 'id', 'name');
            ?>
            Tahun : <?php echo CHtml::dropDownList('year', (!empty($year)) ? $year : '', landa()->yearly(date('Y') - 1), array('empty' => t('choose', 'global'))); ?> &nbsp;&nbsp;
            Bulan : <?php echo CHtml::dropDownList('month', (!empty($month)) ? $month : '', landa()->monthly(), array('empty' => t('choose', 'global'))); ?>&nbsp;&nbsp;
            Kelas : <?php echo CHtml::dropDownList('classroom', (!empty($kelas)) ? $kelas : '', $class, array('empty' => t('choose', 'global'))); ?>&nbsp;&nbsp;

            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'search white',
                'label' => 'View',
            ));
            echo '&nbsp;&nbsp;';
            if (!empty($classroom) and !empty($year) and !empty($month)) {
                $bln = str_replace(".html", "", $month);
                $this->widget('bootstrap.widgets.TbButton', array(
                    'url' => Yii::app()->controller->createUrl('GenerateExcelSentItem?kls='.$kelas.'&thn='.$year.'&bln='.$bln),
                    'type' => 'common',
                    'icon' => 'cut-icon-arrow-down ',
                    'label' => 'Export Excel',
                ));
            }
            ?>
        </div>         
    </div>
</div>
<hr/>
<div>Status Color Information : </div>
<span class="label label-success">Masuk</span>
<span class="label label-inverse">Masuk (Belum Pulang)</span>
<span class="label label-warning">Ijin</span>
<span class="label label-info">Sakit</span>
<span class="label label-important">Tidak Masuk</span>
<br><br>

<?php
if (!empty($year) && !empty($month) && !empty($classroom)) {
    if (isset($dateHoliday)) {
        $tanggalMerah = array();
        foreach ($dateHoliday as $hol) {
            $tanggalMerah[] = $hol;
        }
    } else {
        $tanggalMerah = '0';
    }
    ?>
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th colspan="2" style="text-align:center">Siswa</th>
                <th colspan="<?php echo $amountDay ?>" style="text-align:center">Hari</th>
                <th colspan="4" style="text-align:center">Jumlah</th>
            </tr>
            <tr>
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
        </thead>
        <tbody>
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
                    <td><?php echo $code ?></td>
                    <td><?php echo $nama ?></td>
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
                $columnColor = "";
                $tdDay = "";
                $jmlAbsent[$i]["keterangan"] = "Libur";
                $jmlPresent[$i]["keterangan"] = "Libur";
                $jmlPermit[$i]["keterangan"] = "Libur";
                $jmlSick[$i]["keterangan"] = "Libur";
            } else {
                /* memberi warna kolom */
                if (strtotime($thisDate) > strtotime(date('Ymd'))) {
                    $columnColor = '';
                    $jmlAbsent[$i]["keterangan"] = "Libur";
                    $jmlPresent[$i]["keterangan"] = "Libur";
                    $jmlPermit[$i]["keterangan"] = "Libur";
                    $jmlSick[$i]["keterangan"] = "Libur";
                } elseif (strtotime($thisDate) < strtotime(date('Ymd'))) {
                    $columnColor = 'lightgray';

                    if (isset($mAbsent[$i][$arr->user_id])) {
                        $status = $mAbsent[$i][$arr->user_id]->status;
                        $timeOut = $mAbsent[$i][$arr->user_id]->time_out;
                        $thisId = $mAbsent[$i][$arr->user_id]->id;
                        $tdDay = $this->renderPartial('_buttonCharting', array('status' => $status, 'timeOut' => $timeOut, 'thisDate' => $thisDate, 'thisId' => $thisId, 'tahun' => $tahun, 'bulan' => $bulan, 'kelas' => $kelas), true);
                    } else {
                        $status = 'absent';
                        $thisDate = $dateAbsent;
                        $UserId = $arr->User->id;
                        $tdDay = $this->renderPartial('_buttonCharting', array('status' => $status, 'thisDate' => $thisDate, 'userId' => $UserId, 'tahun' => $tahun, 'bulan' => $bulan, 'kelas' => $kelas), true);
                    }
                } elseif (strtotime($thisDate) == strtotime(date('m/d/Y'))) {
                    $columnColor = '';

                    if (isset($mAbsent[$i][$arr->user_id])) {
                        $status = $mAbsent[$i][$arr->user_id]->status;
                        $timeOut = $mAbsent[$i][$arr->user_id]->time_out;
                        $thisId = $mAbsent[$i][$arr->user_id]->id;
                        $tdDay = $this->renderPartial('_buttonCharting', array('status' => $status, 'timeOut' => $timeOut, 'thisId' => $thisId, 'tahun' => $tahun, 'bulan' => $bulan, 'kelas' => $kelas), true);
                    } else {
                        $status = 'absent';
                        $thisDate = $dateAbsent;
                        $userId = $arr->User->id;
                        $tdDay = $this->renderPartial('_buttonCharting', array('status' => $status, 'thisDate' => $thisDate, 'userId' => $userId, 'tahun' => $tahun, 'bulan' => $bulan, 'kelas' => $kelas), true);
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
                        <td style="background-color: <?php echo $columnColor ?>"><?php echo $tdDay; ?></td>
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
            <tr>
                <td rowspan="5" style="text-align: center; vertical-align: middle;">Jumlah</td>
            </tr>
            <tr>
                <td style="text-align:center"><span class="label label-success">Masuk</span></td>
    <?php
    for ($i = 1; $i <= $amountDay; $i++) {
        if (isset($jmlPresent[$i]) and !isset($jmlPresent[$i]['keterangan'])) {
            echo '<td>' . count($jmlPresent[$i]) . '</td>';
        } else if (isset($jmlPresent[$i]['keterangan'])) {
            echo '<td></td>';
        } else {
            echo '<td>0</td>';
        }
    }
    ?>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
            </tr>
            <tr>
                <td style="text-align:center"><span class="label label-warning">Ijin</span></td>
    <?php
    for ($i = 1; $i <= $amountDay; $i++) {
        if (isset($jmlPermit[$i]) and !isset($jmlPermit[$i]['keterangan'])) {
            echo '<td>' . count($jmlPermit[$i]) . '</td>';
        } else if (isset($jmlPermit[$i]['keterangan'])) {
            echo '<td></td>';
        } else {
            echo '<td>0</td>';
        }
    }
    ?>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
            </tr>
            <tr>
                <td style="text-align:center"><span class="label label-info">Sakit</span></td>
                <?php
                for ($i = 1; $i <= $amountDay; $i++) {
                    if (isset($jmlSick[$i]) and !isset($jmlSick[$i]['keterangan'])) {
                        echo '<td>' . count($jmlSick[$i]) . '</td>';
                    } else if (isset($jmlSick[$i]['keterangan'])) {
                        echo '<td></td>';
                    } else {
                        echo '<td>0</td>';
                    }
                }
                ?>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
            </tr>
            <tr>
                <td style="text-align:center"><span class="label label-important">Alpha</span></td>
                <?php
                for ($i = 1; $i <= $amountDay; $i++) {
                    if (isset($jmlAbsent[$i]) and !isset($jmlAbsent[$i]['keterangan'])) {
                        echo '<td>' . count($jmlAbsent[$i]) . '</td>';
                    } else if (isset($jmlAbsent[$i]['keterangan'])) {
                        echo '<td></td>';
                    } else {
                        echo '<td>0</td>';
                    }
                }
                ?>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
                <td style="background-color: lightgray"></td>
            </tr>
        </tbody>
    </table>
            <?php } ?>
            <?php $this->endWidget(); ?>

