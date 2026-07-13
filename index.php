<!DOCTYPE html>
<html>
<head>
    <title>Mod Auto Click Online (JS Version)</title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</head>
<body>
    <font color="black">Tool giúp bạn thêm chức năng auto click vào java online (Chạy hoàn toàn trên trình duyệt)<br></font>
    <br>
    <font color="red">
        Tải lên file .zip, .jar hoặc _jar:<br/>
        <input type="file" id="fileInput" accept=".zip,.jar,._jar"><br/><br>
        Nhập mã phím cài đặt auto (vd phím gọi nhập là -10):<br>
        <input type="text" id="phim" value="-10"><br><br>
        <button id="processBtn">Xong!</button>
    </font>
    <br><br>
    <div id="status"></div>
    <br>
    <b>DANH SÁCH MÃ PHÍM:</b><br>
    Phím chọn giữa : -5<br>Phím gọi : -10<br>phím chọn trái : -6<br>phím chọn phải : -7<br>
    phím chuyển lên : -1<br>phím chuyển xuống : -2<br>phím chuyển trái : -3<br>phím chuyển phải : -4<br>
    <i>... (và các phím số khác như bản gốc)</i>

    <script>
        document.getElementById('processBtn').addEventListener('click', async function() {
            const fileInput = document.getElementById('fileInput');
            const phim = document.getElementById('phim').value;
            const statusDiv = document.getElementById('status');

            if (fileInput.files.length === 0) {
                statusDiv.innerHTML = '<font color="black"><b>Vui lòng chọn file!</b></font>';
                return;
            }

            const file = fileInput.files[0];
            statusDiv.innerHTML = 'Đang xử lý...';

            try {
                // Đọc file jar/zip do người dùng up lên
                const zip = new JSZip();
                await zip.loadAsync(file);

                // Quét và mod các class
                for (let [filename, zipEntry] of Object.entries(zip.files)) {
                    if (!zipEntry.dir && filename.endsWith('.class')) {
                        let content = await zipEntry.async("binarystring");
                        
                        // Thay thế chuỗi như logic PHP cũ
                        content = content.replace(/javax\/microedition\/lcdui\/Canvas/g, 'javak/microedition/lcdui/Kalvaz');
                        content = content.replace(/keyPressed/g, 'KeyPressed');
                        content = content.replace(/keyReleased/g, 'KeyReleased');
                        content = content.replace(/keyRepeated/g, 'KeyRepeated');
                        content = content.replace(/javax\/microedition\/midlet\/MIDlet/g, 'javak/microedition/midlet/MiDlet');
                        content = content.replace(/Ljavak\/microedition\/midlet\/MiDlet;\)Ljavax\/microedition\/lcdui\/Display/g, 'Ljavax\/microedition\/midlet\/MIDlet;\)Ljavax\/microedition\/lcdui\/Display');
                        content = content.replace(/javak\/microedition\/midlet\/MiDletStateChangeException/g, 'javax\/microedition\/midlet\/MIDletStateChangeException');
                        
                        zip.file(filename, content, {binary: true});
                    }
                }

                // Cập nhật MANIFEST
                if (zip.file("META-INF/MANIFEST.MF")) {
                    let manifest = await zip.file("META-INF/MANIFEST.MF").async("string");
                    manifest = manifest.replace('MIDlet-Delete-Confirm: ', 'MIDlet-Delete-Confirm: Modded via Web JS ////');
                    zip.file("META-INF/MANIFEST.MF", manifest);
                }

                // Ghi file config từ mã phím nhập vào
                zip.file("javak/config.txt", phim);
                zip.file("khuonga2.txt", "mod addlight online by khuonga2 (JS Port)");

                // LƯU Ý: Chạy trên web tĩnh, bạn cần phải tải trước các file class của 'javak' vào Blob hoặc array buffer.
                // Để code này hoạt động 100%, bạn cần fetch các file Kalvaz.class, MiDlet.class từ thư mục của GitHub Repo.
                const classFiles = ['javak/K', 'javak/microedition/lcdui/Kalvaz.class', 'javak/microedition/lcdui/KalvazAutoClick.class', 'javak/microedition/lcdui/Kalvazkey.class', 'javak/microedition/midlet/MiDlet.class', 'javak/microedition/midlet/MiDletKeySelector.class'];
                
                for (let path of classFiles) {
                    try {
                        let response = await fetch(path);
                        if(response.ok) {
                            let blob = await response.blob();
                            zip.file(path, blob);
                        }
                    } catch (e) {
                        console.warn("Không tìm thấy file để chèn: " + path);
                    }
                }

                // Đóng gói và tải xuống
                const finalBlob = await zip.generateAsync({type:"blob"});
                saveAs(finalBlob, "modded_" + file.name.replace('.zip', '.jar'));
                statusDiv.innerHTML = '<font color="blue"><b>Mod thành công! Đang tải xuống...</b></font>';

            } catch (error) {
                console.error(error);
                statusDiv.innerHTML = '<font color="red">Mod thất bại: ' + error.message + '</font>';
            }
        });
    </script>
</body>
</html>
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
