<html>
<body>
    <style type="text/css">
   TABLE {
    background: aliceblue; /* Цвет фона таблицы */
    border: 1px double #000; /* Рамка вокруг таблицы */
   }
   TD, TH {
    padding: 5px; /* Поля вокруг текста */
    border: 1px solid #000; /* Рамка вокруг ячеек */
   }
  </style>
<h2>Двумерный массив заполняется числами Фиббоначи</h2>

<form method="post" action="#">
    <span>Введите размерность массива</span>
    <input type="text" name="x" placeholder="x">
    <input type="text" name="y" placeholder="y">
    <input type="submit" value="Отправить">
</form>
<?php
if( isset($_POST['x']) and isset($_POST['y'])){
    $x = $_POST['x'];
    $y = $_POST['y'];
    echo 'Размерность массива - строк - '.$x.', столбцов - '.$y;
}
$razmer = $x*$y;
?>
<?php
// массив для элементов
$a = array();
// первые два - единицы    
$a[0] = '1'; // они в виде строки!
$a[1] = '1';
// а дальше - просто складываем два предыдущих
for ($i = 2; $i < $razmer; $i++){
        $a[$i]= bcadd($a[$i-1], $a[$i-2]);
    }
?>

<?php

$keys =array();
for ($i=0; $i<=$x-1; $i++){
    $keys[]= (string)$i;
}
$new_arr = array();

for ($i=0; $i<count($a); $i++)
    $new_arr[$i/count($keys)][$keys[$i % count($keys)]] = $a[$i];
echo '<PRE>'; ?>
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
for($i=1;$i<count($keys)+1;$i++){
    $sum[] = $new_arr[$i-1][count($keys)-$i];
}
echo 'Сумма чисел находящихся на диагонали ['.count($keys).'][0]-[0]['.count($keys).'] - '.array_sum($sum);
echo'&nbsp(';
foreach ($sum as $array){
    echo $array.',';
};
echo')';
?> 
    
    
</table> 

</body>
</html> 