<div class="nextMessage"></div>
<?php
$listUser = User::model()->listUser();
foreach ($userMessageDetails as $userMessageDetail):
    $type = (!empty($userMessageDetail->created_user_id) || $userMessageDetail->is_autoreply) ? 'admin' : 'user';
    if ($type == 'user') {
        if (array_key_exists($phone, $listUserPhone))
            $name = $listUserPhone[$phone]['name'];
        else
            $name = landa()->hp($phone);
        $img = Yii::app()->landa->urlImg('avatar/', '', '');
    } else {
        if ($userMessageDetail->is_autoreply) {
            $siteConfig = SiteConfig::model()->listSiteConfig();
            $name = 'Autoreply Systems';
            $img = Yii::app()->landa->urlImg('site/', $siteConfig->client_logo, param('id'));
        } else {
            $name = $listUser[$userMessageDetail->created_user_id]['name'];
            $img = Yii::app()->landa->urlImg('avatar/', $listUser[$userMessageDetail->created_user_id]['avatar_img'], $userMessageDetail->created_user_id);
        }
    }
    $this->renderPartial('_viewDetailLi', array('type' => $type, 'userMessageDetail' => $userMessageDetail, 'img' => $img, 'name' => $name));
endforeach;
?>

<div class="msgDetLoad"></div>
<?php
$this->widget('application.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.msgDetLoad',
    'itemSelector' => 'li.msgDet',
    'donetext' => '-- this is the end of data --',
    'pages' => $pages,
));
?>

