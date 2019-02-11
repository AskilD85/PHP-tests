<?php require 'header.php';?>


<a href="/" class="btn btn-primary">На главную</a>
<h2>Двумерный массив заполняется числами Фиббоначи</h2>

<form method="post" action="#">
    <span>Введите размерность массива </span>
    <input type="text" name="x" placeholder="x" required>
    <input type="text" name="y" placeholder="y" required>
    <input type="submit" value="Отправить">
</form>
<?php
echo 'по умолчанию - размерность 6х6<br/>';
if( isset($_POST['x']) and isset($_POST['y'])){
    $x = $_POST['x'];
    $y = $_POST['y'];
    echo 'Размерность массива - строк - '.$x.', столбцов - '.$y.'<br/>';
}else{
    $x=6;$y=6;
}
$razmer = $x*$y;

// массив для элементов ряда Фиббоначи
$fibb = array();
// первые два - единицы    
$fibb[0] = '1'; // они в виде строки!
$fibb[1] = '1';
// а дальше - просто складываем два предыдущих
for ($i = 2; $i < $razmer; $i++){
        $fibb[$i]= bcadd($fibb[$i-1], $fibb[$i-2]);
    }


$keys =array();//массив ключей для двумерного массива
for ($i=0; $i<=$x-1; $i++){
    $keys[]= (string)$i; //записываем в виде строк
}
$new_arr = array();//Наш основной массив

for ($i=0; $i<count($fibb); $i++)
    $new_arr[$i/count($keys)][$keys[$i % count($keys)]] = $fibb[$i]; //запись ряда Фиббоначи в двумерный массив
?>
<table> 
<?php
    for ($k=0;$k<count($keys);$k++) { 
	print "<tr>"; 
	for ($j=0;$j<count($keys);$j++) 
                echo "<td>".$new_arr[$j][$k]."</td>";
	print "</tr>"; 
    }
?>
<?php
//подсчитаем сумму чисел второстепенной диагонали
for($i=1;$i<count($keys)+1;$i++){
    $sum[] = $new_arr[$i-1][count($keys)-$i];
}
$arr = count($keys)-1;//размер массива
echo 'Сумма чисел находящихся на диагонали ['.$arr.'][0]-[0]['.$arr.'] - '.array_sum($sum);
echo'&nbsp(';
foreach ($sum as $array){
    echo $array.',';
};
echo')<br /><br />';
?> 
    
    
</table> 


<?php require 'footer.php';?>