<?php

if ($status == 'presen') {
    $sick = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=sick&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $permit = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=permit&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $absent = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=absent&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $presen = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=presen&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    if (empty($timeOut)) {
        echo '<div id="belumpulang">
<ul>
   <li class="has-sub last"><a href="#"><span>&nbsp;</span></a>
      <ul>
      <li><a href="' . $sick . '">Sakit</a></li>
      <li><a href="' . $permit . '">Ijin</a></li>
      <li><a href="' . $absent . '">Tidak Masuk</a></li>
      </ul>
   </li>
</ul>
</div>';
    } else {
        echo '<div id="masuk">
<ul>
   <li class="has-sub last"><a href="#"><span>&nbsp;</span></a>
      <ul>
       <li><a href="' . $sick . '">Sakit</a></li>
       <li><a href="' . $permit . '">Ijin</a></li>
       <li><a href="' . $absent . '">Tidak Masuk</a></li>
      </ul>
   </li>
</ul>
</div>';
    }
} elseif ($status == 'permit') {
    $sick = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=sick&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $permit = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=permit&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $absent = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=absent&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $presen = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=presen&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    echo '<div id="ijin">
<ul>
   <li class="has-sub last"><a href="#"><span>&nbsp;</span></a>
      <ul>
         <li><a href="' . $sick . '">Sakit</a></li>
         <li><a href="' . $presen . '">Masuk</a></li>
         <li><a href="' . $absent . '">Tidak Masuk</a></li>
      </ul>
   </li>
</ul>
</div>';
} elseif ($status == 'sick') {
    $sick = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=sick&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $permit = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=permit&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $absent = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=absent&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    $presen = Yii::app()->controller->createUrl('absent/change?absentId=' . $thisId . '&status=presen&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas);
    echo '<div id="sakit">
<ul>
   <li class="has-sub last"><a href="#"><span>&nbsp;</span></a>
      <ul>
         <li><a href="' . $permit . '">Ijin</a></li>
         <li><a href="' . $presen . '">Masuk</a></li>
         <li><a href="' . $absent . '">Tidak Masuk</a></li>
      </ul>
   </li>
</ul>
</div>';
} elseif ($status == 'absent') {
    echo '<div id="absent">
<ul>
   <li class="has-sub last"><a href="#"><span>&nbsp;</span></a>
      <ul>
         <li><a href="' . Yii::app()->controller->createUrl('absent/addabsent?date=' . $thisDate . '&userId=' . $userId . '&status=sick&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas) . '">Sakit</a></li>
         <li><a href="' . Yii::app()->controller->createUrl('absent/addabsent?date=' . $thisDate . '&userId=' . $userId . '&status=permit&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas) . '">Ijin</a></li>
         <li><a href="' . Yii::app()->controller->createUrl('absent/addabsent?date=' . $thisDate . '&userId=' . $userId . '&status=presen&tahun=' . $tahun . '&bulan=' . $bulan . '&kelas=' . $kelas) . '">Masuk</a></li>
      </ul>
   </li>
</ul>
</div>';
}
?>
