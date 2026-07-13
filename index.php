<html>
<head>
<title>mod auto click</title>
<meta http-equiv="content-type" content="application/xhtml xml; charset=utf-8"/>
</head>
<body>
<?php
if(!file_exists('file')){
mkdir('file');}
echo '<font color="black">toot giúp bạn thêm chức năng auto click vào java online <br></font>';
echo '<br>';
$text='code by khuonga2';
$submit=$_POST["submit"];
if(!$submit){echo'<form method="post" enctype="multipart/form-data"><font color="red">Tải lên file.zip .jar _jar:<br/><input type="file" name="file"><br/>hoặc import link file .zip .jar (không dùng link xtgem,wmp)<br>
<input type="text" name="link" value="http://">
<br>Nhập mã phím cài đặt auto </font>( vd phím gọi nhập là -10 ,danh sách mã phím ở dưới,sau khi mod xong ,giữ phím cài đặt để sử dụng)<br><input type="text"name=
"phim"value="-10"><br><input type="submit" name="submit" value="xong!"></form><br><br>DANH SÁCH MÃ PHÍM:<br>
Phím chọn giữa : -5<br>
Phím gọi : -10<br>
phím chọn trái : -6<br>
phím chọn phải : -7<br>
phím chuyển lên : -1<br>
phím chuyển xuống : -2<br>
phím chuyển trái : -3<br>
phím chuyển phải : -4<br>
phím số 1 : 49<br>
phím số 2 : 50<br>
phím số 3 : 51<br>
phím số 4 : 52<br>
phím số 5 : 53<br>
phím số 6 : 54<br>
phím số 7 : 55<br>
phím số 8 : 56<br>
phím số 9 : 57<br>
phím số 0 : 48<br>
phím sao (*) : 42<br>
phím # : 35<br>';}else{$file=$_FILES['file']['name'];
$link=$_POST['link'];
$phim=$_POST['phim'];
if($file){$type=$_FILES['file']['type'];
if(($type!="application/zip")&&($type!="application/x-java-archive")&&($type!="application/octet-stream")){echo'<font color="black"><b>định dạng tập tin không hợp lệ.Chỉ cho phép .zip .jar _jar !</b></font>';
exit("</body></html>");}
$file=str_replace(' ','_',$file);
$file=str_replace('.zip','.jar',$file);
$file=str_replace('_jar','.jar',$file);
$file=rand(100,900).'_'.$file;
move_uploaded_file($_FILES['file']['tmp_name'],"file/".$file);}
if(($link)&&($link!="http://")){$file=basename($link);
$ex=explode('.',$file);
if((end($ex)!='zip')&&(end($ex)!='jar')){echo'<font color="black"><b>link không hợp lệ.Chỉ cho phép .zip .jar!</b></font><br>';
exit("</body></html>");}else{
$file=str_replace('.zip','.jar',$file);
$file=rand(100,900).'_'.$file;
copy($link,"file/".$file);}}
if($file){$zip=new ZipArchive();
if($zip->open('file/'.$file)===TRUE){$zip1=zip_open('file/'.$file);
if($zip1){while($entry=zip_read($zip1)){$name=zip_entry_name($entry);
$size=zip_entry_filesize($entry);
$nd=zip_entry_read($entry,$size);
$nd=str_replace('javax/microedition/lcdui/Canvas','javak/microedition/lcdui/Kalvaz',$nd);
$nd=str_replace('keyPressed','KeyPressed',$nd);
$nd=str_replace('keyReleased','KeyReleased',$nd);
$nd=str_replace('keyRepeated','KeyRepeated',$nd);
$nd=str_replace('javax/microedition/midlet/MIDlet','javak/microedition/midlet/MiDlet',$nd);
$nd=str_replace('Ljavak/microedition/midlet/MiDlet;)Ljavax/microedition/lcdui/Display','Ljavax/microedition/midlet/MIDlet;)Ljavax/microedition/lcdui/Display',$nd);
$nd=str_replace('javak/microedition/midlet/MiDletStateChangeException','javax/microedition/midlet/MIDletStateChangeException',$nd);
$zip -> addFromString($name,$nd);}}
zip_close($zip1);
$zip -> addFile('javak/K');
$zip -> addFile('javak/microedition/lcdui/Kalvaz.class');
$zip -> addFile('javak/K');
$zip -> addFile('javak/microedition/lcdui/Kalvaz.class');
$zip -> addFile('javak/microedition/lcdui/KalvazAutoClick.class');
$zip -> addFile('javak/microedition/lcdui/Kalvazkey.class');
$zip -> addFile('javak/microedition/midlet/MiDlet.class');
$zip -> addFile('javak/microedition/midlet/MiDletKeySelector.class');
$zip -> addFromString('javak/config.txt',$phim);
$zip->addFromString('khuonga2.txt','mod addlight online by khuonga2');
$zip->close();
$zip2=new ZipArchive();
if($zip2->open('file/'.$file)===TRUE){
$kh=$zip2 -> getFromName('META-INF/MANIFEST.MF');
$wap='http://'.$_SERVER['HTTP_HOST'];
$kh=str_replace('MIDlet-Delete-Confirm: ','MIDlet-Delete-Confirm: vào '.$wap.' để mod auto click online đơn giản nhất ////',$kh);
$zip2 -> addFromString('META-INF/MANIFEST.MF',$kh);
$zip2 ->close();}
echo '<a href="file/'.$file.'"><font color="blue"><b>Tải xuống</b></font></a><br>Mod thành công<br>';}else{echo'<br><br><font color="red">mod thất bại</font><br>';}}}
echo 'coder: <b>khuonga2</b>';
?>
</body></html>
</body></html>
