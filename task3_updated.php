<?php require 'header.php';?>

<a href="/" class="btn btn-primary">На главную</a>
<h4>Задание.</h4>
<p>Написать PHP скрипт, который загружает из интернета любое изображение на ваш выбор,
 в загруженном изображении копирует левую половину изображения,
 зеркально ее отражает и вставляет вместо правой половины изображения. 
Полученый результат должен быть сохранен в ту же папку, где лежит скрипт в формате png.
 Скрипт должен быть назван task3_updated.php</p>

<form method="post" action="#">
    <span>Введите ссылку на картинку в интернете </span>
    <input type="text" name="userfile" placeholder="http://....../image.jpg" required>
    <input type="submit" value="Загрузить">
</form>

<?php
  
//загружаем наше изображение на сервер
if (isset($_POST['userfile'])){
$link = $_POST['userfile'];
$file = file_get_contents($link);
?>
<br />
<table>
    <tr><td>Исходное изображение</td><td>Полученное изображение</td></tr>
    <tr>
        <td>
            <img src="<?php echo $_POST['userfile'] ?>" width='300' >
        </td>

<?php
    $filename = preg_replace('"\.(bmp|gif|jpg|jpeg)$"', '.png', $link);//заменяем расширение на png
    $newname = basename($filename); //берем имя файла
    file_put_contents($newname, $file);
?>


<?php
//выбираем тип изображения
$info = getimagesize($newname);
switch ($info[2]) { 
    case 1: 
        $tmp = imageCreateFromGif($newname);
        break;                    
    case 2: 
        $tmp = imageCreateFromJpeg($newname);
        break;
    case 3: 
        $tmp = imageCreateFromPng($newname); 
        break;
}
$width  = $info[0];
$height = $info[1];
$type   = $info[2];

$main = $tmp;//берём наше изображение
$mainCrop = imagecrop($main,['x'=>0,'y'=>0, 'width'=>$width/2,'height'=>$height]);//обрезаем нужную часть
imageflip($mainCrop, IMG_FLIP_HORIZONTAL);//отображаем зеркально

// объединенияем наши изображения
imagecopymerge($main,$mainCrop, $width/2, 0, 0, 0, $width,$height, 100);

//сохраняем полученное изображение
imagejpeg($main,$newname);
// очищаем память
imagedestroy($main);
imagedestroy($mainCrop);
?>
        <td>
            <img src="<?php echo $newname?>"   width='300'>  
        </td>
    </tr>
</table>
<?php echo '</div>';}?>  
    

<?php require 'footer.php';?>