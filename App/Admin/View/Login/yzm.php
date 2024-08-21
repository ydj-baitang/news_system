<?php
session_start();
header('Content-type: image/png');
$num=range(0,9);// 数字数组
$char=range("A","Z");// 字母数组
$yzm_array=array_merge($num,$char);// 合并数字和字母数组

#从合并的数组里面随机取四个字符拼接在一起组成验证码
$yzm="";
$len=count($yzm_array);
for($i=0;$i<4;$i++){
    $yzm=$yzm.$yzm_array[rand(0,$len-1)];
}

$imge_w=100;// 图片宽度
$imge_h=25;// 图片高度

$img1=imagecreatetruecolor($imge_w,$imge_h);// 创建图片资源
$white=imagecolorallocate($img1,255,255,255);// 白色
$black=imagecolorallocate($img1,0,0,0); // 黑色

imagefill($img1,0,0,$white);// 填充背景色为白色
$fontfile=realpath("times.ttf");// 字体文件路径
// 在图片上随机生成干扰点
for($i=0;$i<100;$i++){
    imagesetpixel($img1,rand(0,$imge_w-1),rand(0,$imge_h-1),$black);
}
// 在图片上随机生成干扰线
for($i=0;$i<2;$i++){
    imageline($img1,rand(0,$imge_w-1),rand(0,$imge_h-1),rand(0,$imge_w-1),rand(0,$imge_h-1),$black);#使用调出的黑色额料画线
}
// 在图片上写入验证码
for($i=0;$i<4;$i++){
    $x=$i*($imge_w/4)+8; #写字x轴的起始位置
    $y=rand(16,19);#写字y轴的起始位置
    $color=imagecolorallocate($img1,rand(0,180),rand(0,180),rand(0,180),);#调出随机颜色的颜料
    $fontfile = realpath("times.ttf");
    imagettftext($img1,14,rand(-45,45),$x,$y,$color,$fontfile,$yzm[$i]);// 使用 TrueType 字体写入文字
}
imagepng($img1);// 输出验证码图片
imagedestroy($img1);// 销毁图片资源
$_SESSION['yzm'] = $yzm;// 将验证码保存到会话中p