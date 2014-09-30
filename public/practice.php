<?php

$arr =array(
			array(
				"a"=>1,
				"b"=>2,
				"c"=>3
			),
			array(
				"d"=>4,
				"e"=>5,
				"f"=>6
			),
			array(
				"g"=>7,
				"h"=>8,
				"i"=>9
			)		
		);
		
foreach($arr as $c){
	while(list($k,$v) = each($c)){
		echo "$k...$v<br>";
	}
	echo "<hr>";
}

$arr2 =array(
			array(
				1,
				2,
				3
			),
			array(
				4,
				5,
				6
			),
			array(
				7,
				8,
				9
			)		
		);
list(list($a,$b,$c),list($d,$e,$f),list($g,$h,$i)) = $arr2;
echo $a."<br>";
echo $b."<br>";
echo $c."<br>";
echo $d."<br>";
echo $e."<br>";
echo $f."<br>";
echo $g."<br>";
echo $h."<br>";
echo $i."<br>";