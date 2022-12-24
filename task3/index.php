<?php

$m = $_GET['m'];
$n = $_GET['n'];

$map = array();

$form = '<form action="index.php">
            <input name="m" />
            <input name="n" />
            <button type="submit">Send</button>
         </form>';
 
if(!isset($m) && !isset($n)){
    echo $form;
}else{
    prepareGame($m, $n, $map);
}

function prepareGame($m, $n, $map){
    echo "Подождите, скоро все выведу! <br>";
    //ob_implicit_flush(true);
    //ob_end_flush();

    $map = createMap($m, $n, $map);

    $img = createImg($m, $n, $map);
    imagepng($img, 'imgs/startimage.png');
    echo '<img src="imgs/startimage.png"><br>';

    startGame($m, $n, $map);
}

function createMap($m, $n, $map){
    for ($i=$m; $i>0; $i--) {
        for ($j=$n; $j>0; $j--) {
            $map[$i][$j] = mt_rand(0, 1);
        }
    }
    return $map;
}

function createImg($m, $n, $map){

    $img = imagecreatetruecolor($m, $n);
    $white = imagecolorallocate($img, 255, 255, 255);
    $red   = imagecolorallocate($img, 255, 0, 0);
    imagefill($img, 0, 0, $white);

    for ($i=$m; $i>0; $i--) {
        for ($j=$n; $j>0; $j--) {
            if($map[$i][$j] == 1){
                imagesetpixel($img, $i, $j, $red);
            }
        }
    }
    return $img;
}

function startGame($m, $n, $map){
    $c=0;
    while(checkEnd($m, $n, $map)) {

        $map = lifeСycle($m, $n, $map);

        $img = createImg($m, $n, $map);
        imagepng($img, 'imgs/image'.$c.'.png');
        echo '<img src="imgs/image'.$c.'.png"><br>';

        $c++;
    }
}

function lifeСycle($m, $n, $map){
    $map2 = array();
    for ($i=$m; $i>0; $i--) {
        for ($j=$n; $j>0; $j--) {
            $neighbors = 0;
            if($map[OMM($i, $m)-1][$j] == 1) $neighbors++;
            if($map[$i][OMP($j, $n)+1] == 1) $neighbors++;
            if($map[OMP($i, $m)+1][$j] == 1) $neighbors++;
            if($map[$i][OMM($j, $n)-1] == 1) $neighbors++;
            if($map[OMP($i, $m)+1][OMP($j, $n)+1] == 1) $neighbors++;
            if($map[OMM($i, $m)-1][OMM($j, $n)-1] == 1) $neighbors++;
            if($map[OMP($i, $m)+1][OMM($j, $n)-1] == 1) $neighbors++;
            if($map[OMM($i, $m)-1][OMP($j, $n)+1] == 1) $neighbors++;

            if($map[$i][$j] == 0 && $neighbors == 3){ $map2[$i][$j] = 1; } // Активация

            if($map[$i][$j] == 1 && $neighbors >= 4){ $map2[$i][$j] = 0; } // Перегрузка

            if($map[$i][$j] == 1 && $neighbors <= 1){ $map2[$i][$j] = 0; } // Изоляция

            ($map[$i][$j] == 1 && $neighbors == 2 || $neighbors == 3) ? $map2[$i][$j] = 1 : $map2[$i][$j] = 0; // Вымирание
        }
    }
    return $map2;
}

// out of map 
function OMP($i, $m){
    if($i == 0) return $m;
    else return $i;
}

function OMM($j, $n){
    if($j == $n-1) return -1;
    else return $j;
}

function checkEnd($m, $n, $map){
    $check = 0;
    for ($i=$m; $i>0; $i--) {
        for ($j=$n; $j>0; $j--) {
            $check += $map[$i][$j];
            if($map[$i][$j] == 1){
                break;
            }
        }
    }
    if($check == 0){
        return false;
    }else{
        return true;
    }
}

?>