  <div class="well">
<?php
$this->setPageTitle('Lihat Invoices | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Invoices' => array('index'),
    $model->id,
);
?>
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
        array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'linkOptions' => array()),
        //array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
        array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
)));
$this->endWidget();
?>
<div class='printableArea'>



</div>
<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>

<body>
    <div class="container">


        <div class='printableArea'>


        </div>
        <style type="text/css" media="print">
            body {visibility:hidden;}
            .printableArea{visibility:visible;} 
        </style>
        <script type="text/javascript">
            function printDiv()
            {

                window.print();

            }
        </script>

        <img  src="<?php echo param('urlImg') ?>file/landa.png" width="230" height="240">
        <div class="span3 pull-right">
            <table>
                <tr style="background:#3366FF; color:#ffffff"><td colspan="12"><center><h4>INVOICE</h4></center></td>
                </tr>
                <tr><td><b>Invoice</td>
                    <td><b>:</td>
                    <td><?php echo $model->id ?></td></tr>
                <tr><td><b>Date</td>
                    <td><b>:</td>
                    <td><?php echo date('l, d F Y', strtotime($model->created)) ?></td></tr>
                <tr><td><b>Due</td>
                    <td><b>:</td>
                    <td><?php echo date('l, d F Y', strtotime($model->due_date)) ?> </td></tr>
                <tr><td><b>Bill To</td>
                    <td><b>:</td>
                    <td><?php echo $model->client ?></td></tr>
            </table>

        </div>
      
        <table width="1168" border="1">
            <tr style="background:#3366FF; color:#ffffff"><td colspan="2"><center><h4>Description</h4></center></td>

            <td><center><b>Price</b></center></td>
            </tr>
            <tbody>
                <?php
                $total = 0;
                foreach ($modelInvoicesDetail as $o) {
                    $total += $o->price;
                    ?>
                    <tr>
                        <td colspan="2"><b><?php echo $o->description ?></b><br> </td>
                        <td><?php echo landa()->rp($o->price) ?></td>
                    </tr>
                    <?php
                }
                ?>


                <tr>
                    <td colspan="2" style="background:#3366FF; color:#ffffff"><i><left><h4>Payments can be paid to : </h4></left></i></td>

                    <td>tes</td>
                </tr>
                <tr>
                    <td colspan="2"><b>
                            <div class="span6 pull-right">   
                                BCA	:	3150786303<br>
                                Mandiri	:	1440011957344<br>


                            </div>
                            <div class="span4 pull-left">   
                                Bank Jatim	:	0047329400<br>
                                Mualamalat	:	0140622441<br>
                                Name	:	Yulianto Frandi<br>
                            </div>
                          
                    </td>

                    <td>tes9</td>
                </tr>
                <tr>

                    <td colspan="2" style="text-align:Left"><b> Total</b></td>
                    <td><?php echo landa()->rp($total) ?></td>

                </tr>
                <tr>
                    <td colspan="2" style="text-align:left"><b>Payment</b></td>
                    <td><?php echo landa()->rp($model->payment) ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left"><b>Balance Due</b></td>
                    <td><b><?php echo landa()->rp($total - $model->payment) ?></b></td>
                </tr>

            </tbody>
        </table>

        <br>
        <div class="span1">
            <b>Created By</b><br></div>
        <br>
        <br>
        <br>
        <br>
        <br>



        <b><?php
            //           $listUser = User::model()->listUser()
            //        echo $listUser[]
            ?>
        </b><br>
        <div class="span1"><b>(Administrasi)</b></div>




        <hr color="#3366FF" size="4" width="95%">
        <center><hr color="#808080" size="3" width="76%"></center>
        <center><b>Perum Graha Accordion A1, Tunggul Wulung, Malang, Indonesia</b><br></center>
        <center><b>www.landa.co.id | info@landa.co.id | (0341) 495 482</b><br></center></hr>
        </div>