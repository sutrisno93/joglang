<?php
function terbilang($i){
	$huruf = array("". "satu", "dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas",);
	
	if($i < 12)return " " . $huruf[$i];
	elseif ($i <20) return terbilang($i-10) . "belas";
	elseif ($i <100) return terbilang($i/10) . "puluh" . terbilang($i%10);
	elseif ($i <200) return terbilang "seratus" . terbilang($i - 100);
	elseif ($i <1000) return terbilang ($i /100) . "ratus" . terbilang($i % 100);
	elseif

}
?>