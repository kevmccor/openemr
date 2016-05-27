<?php
// edi files directory path
define('FDIR', '/project/directory');
define('DS', DIRECTORY_SEPARATOR);
define('PRJDIR', '');
//
echo '==== constants '.FDIR.' '.DS.' '.PRJDIR.PHP_EOL;
//
$test_cmp = false; // true; //
if ($test_cmp) {
	$n1 = '2015-03-09';
	$n2 = '';
	$ns = array('2015-02-27', '2015-05-30', '2016-01-01', '2015-12-31', '2015-07-12', '2014-09-27', '1998-09-14', '2015-03-09');
	foreach ($ns as $n) {
		echo '<'.strcmp($n, $n1).'>'.PHP_EOL;
		if (strcmp($n, $n1) > 0) {
			echo "$n is more than $n1".PHP_EOL;
		} elseif (strcmp($n, $n1) < 0) {
			echo 'It is less '.$n.PHP_EOL;
		} elseif (strcmp($n, $n2) == 0) {
			echo 'Yeh Yas! '.$n.PHP_EOL;
		} else {
			echo 'Huh! '.$n.PHP_EOL;
		}
	}
}

function html_head() {
	$str_html = "<!DOCTYPE html>".PHP_EOL."<html>".PHP_EOL."<head>".PHP_EOL."<title>segments text</title>".PHP_EOL;
	$str_html .= "<meta http-equiv='content-type' content='text/html; charset=UTF-8'>".PHP_EOL;
	$str_html .= "<meta http-equiv='content-type' content='application/xhtml+xml; charset=UTF-8'>".PHP_EOL;
	$str_html .= "<meta http-equiv='content-style-type' content='text/css'>".PHP_EOL;
	$str_html .= "<meta http-equiv='expires' content='0'>".PHP_EOL;
	$str_html .= "<link rel='stylesheet' id='edi_hist_css' href='./edi_history_v2.css' type='text/css' media='all'/>".PHP_EOL;
	$str_html .= "</head>".PHP_EOL."<body>".PHP_EOL;
	//
	return $str_html;
}
//
function html_tail() {
	$str_html = '</body>'.PHP_EOL.'</html>'.PHP_EOL;
	//
	return $str_html;	
}
//

$test_271code = false;  // true;  // 
if ($test_271code) {
	require_once './codes/edih_271_code_class.php';
	$cd271 = new edih_271_codes(':', '^');
	/*
	 * $code_str = '';
	foreach($cd271->code271 as $ky => $val) {
		$code_str .= "[\"$ky\"] = array(".PHP_EOL;
		if (is_array($val)) {
			$lv = end($val);
			reset($val);
			foreach($val as $k=>$v) {
				$cm = ($lv == $v) ? '' : ',';
				$code_str .= "\"$k\" => \"$v\"$cm".PHP_EOL;
			}
			$code_str .= ");".PHP_EOL.PHP_EOL;
		}
	}
	//
	
	$fn = FDIR.DS.'27x_codes_list.txt';
	$cdok = file_put_contents($fn, $code_str);
	if ($cdok) {
		echo '===== code list created'.PHP_EOL;
	} else {
		echo '===== code list failed'.PHP_EOL;
	}
	* */
	/*
	if ($cdok) {
		echo '===== code list from file'.PHP_EOL;
		//$cd_str = file_get_contents($fn);
		//echo '===== try_array str '.substr($cd_str,0, 25).PHP_EOL;
		
		$try_ar = parse_ini_file($fn, true, INI_SCANNER_RAW);
		if (is_array($try_ar) ) {
			var_dump( array_keys($try_ar) ).PHP_EOL;
		} else {
			echo '===== try_array failed'.PHP_EOL;
		}
	}
	*/
	/*
	$pos_ar = $cd271->code271['EB03'];
	$um_ar = $cd271->code271['UM03']; 
	foreach ($pos_ar as $ky=>$val) {
		if (isset($um_ar[$ky])) {
			echo "=== $ky ===".PHP_EOL;
			echo "pos $ky => $val".PHP_EOL;
			echo "um_ar $ky => ".$um_ar[$ky].PHP_EOL;
		} else {
			echo "=== missed on $ky".PHP_EOL;
		}
	}
	*/
	$entity_codes = array(
	'13', '17', '1E', '1G', '1H', '1I', '1O', '1P', '1Q', '1R',
	'1S', '1T', '1U', '1V',
	'1W', '1X', '1Y', '1Z', '28',
	'2A', '2B', '2E', '2I', '2K',
	'2P', '2Q', '2S', '2Z', '30',
	'36', '3A', '3C', '3D',
	'3E', '3F', '3G', '3H', '3I',
	'3J', '3K', '3L', '3M', '3N',
	'3O', '3P', '3Q', '3R',
	'3S', '3T', '3U', '3V',
	'3W', '3X', '3Y', '3Z',
	'40', '43', '44', '4A', '4B',
	'4C', '4D', '4E', '4F',
	'4G', '4H', '4I', '4J', '4L',
	'4M', '4N', '4O', '4P',
	'4Q', '4R', '4S', '4U',
	'4V', '4W', '4X', '4Y',
	'4Z', '5A', '5B', '5C',
	'5D', '5E', '5F', '5G',
	'5H', '5I', '5J', '5K', '5L',
	'5M', '5N', '5O', '5P',
	'5Q', '5R', '5S', '5T',
	'5U', '5V', '5W', '5X',
	'5Y', '5Z', '61', '6A', '6B',
	'6C', '6D', '6E', '6F',
	'6G', '6H', '6I', '6J', '6K',
	'6L', '6M', '6N', '6O',
	'6P', '6Q', '6R', '6S',
	'6U', '6V', '6W', '6X',
	'6Y', '71', '72', '73', '74',
	'77', '7C', '80', '82', '84',
	'85', '87', '95',
	'CK', 'CZ', 'D2', 'DD',
	'DJ', 'DK', 'DN', 'DO',
	'DQ', 'E1', 'E2', 'E7',
	'E9', 'FA', 'FD', 'FE',
	'G0', 'G3', 'GB', 'GD',
	'GI', 'GJ', 'GK', 'GM',
	'GY', 'HF', 'HH', 'I3', 'IJ',
	'IL', 'IN', 'LI', 'LR', 'MR',
	'OB', 'OD', 'OX', 'P0',
	'P2', 'P3', 'P4', 'P6',
	'P7', 'PT', 'PV', 'PW',
	'QA', 'QB', 'QC', 'QD',
	'QE', 'QH', 'QK', 'QL',
	'QN', 'QO', 'QS', 'QV',
	'QY', 'RC', 'RW', 'S4',
	'SJ', 'SU', 'T4', 'TQ',
	'TT', 'TU', 'UH', 'X3',
	'X4', 'X5', 'ZZ', '03', '2D',
	'MSC', 'PRP', 'SEP',
	'TL', 'TTP'
	);
	echo '===== test entity codes'.PHP_EOL;
	foreach($entity_codes as $c) {
		$cv = $cd271->get_271_code('NM101', $c);
		echo $c.' '.$cv.PHP_EOL;
	} 


}
//
// test 271 html
//
$test_271 = false; // true;  // 
if ($test_271) {
	require_once 'test_edih_obj_2.php';
	require_once 'test_edih_csv_inc.php';
	require_once 'edih_278_html.php';
	require_once 'edih_271_html.php';
	require_once 'edih_277_html.php';
	require_once 'edih_835_html.php';
	//require_once 'test_edih_277_html.php';
	require_once 'test_edih_segments_text.php';
	require_once 'test_edih_csv_parse.php';
	//
	echo '==== test 271 html'.PHP_EOL;
	//
	$lpid = '2010EA';
	$pos = (strpos($lpid, '010E') === false) ? 'false' : strpos($lpid, '010E' );
	echo $lpid.' '.(string)$pos.PHP_EOL;
	// erafiles/ERA-MCARE_B_TX-201110010930-001.era
	$fp = FDIR.DS.'f277/277-201211300835240172.277ebr'; //'erafiles/83505897.835.835_TX_G84980_4010'; //ERA-AETNA_INSC-201110311830-001.era'; //ERA-MCARE_B_TX-201110010930-001.era';  // f277/277-201211300835240172.277ebr';  // 'emedny_278_sample_req.dat'; //ghc_sample_271.dat';  // 
	$bht03 = '245-15742'; //'13-15688'; //'686115047'; //'2010122100001'; //'000253784A30'; /// 
	$str_html = html_head();
	//$str_html .= edih_271_html($fp, $bht03);
	//$str_html .= edih_278_html($fp, $bht03);
	$str_html .= edih_277_html($fp);
	// ==== 835
	//$fobj835 = new edih_x12_file($fp);
	//echo '====== edih_x12_file class name: '.$fobj835->classname().PHP_EOL;
	//echo '===== delimiters'.PHP_EOL;
	//var_dump( $fobj835->edih_delimiters() ).PHP_EOL;
	//$trc835 = '880700930';
	//$clm835 = '289-2010'; //'142-751';
	////$str_html .= edih_835_transaction_html($fobj835, '', $trc835);
	//// edih_835_html($filename, $trace='', $clm01='')
	//$str_html .= edih_835_html($fp, '', $clm835, true );
	// ====
	$str_html .= html_tail();
	$fsave = file_put_contents(FDIR.DIRECTORY_SEPARATOR.'sample271.html', $str_html);
	//
	//edih_display_text($filepath, $filetype='', $claimid='', $trace=false, $err_seg='')
	$segtxt = html_head();
	$segtxt .= edih_display_text($fp, 'f835');
	$segtxt .= html_tail();
	$fsave = file_put_contents(FDIR.DIRECTORY_SEPARATOR.'sample_27x_segs.html', $segtxt);
	//
	echo '==== test segment text html'.PHP_EOL;
	$segtxt = edih_parse_select($fp);
	var_dump( $segtxt).PHP_EOL;
	//echo $str_html.PHP_EOL;
}

// testing for test_edih_csv_parse.php'
$test_parse = false; //true; //
if ($test_parse) {
	include_once './test_edih_csv_parse.php';
	include_once './test_edih_csv_data.php';
	//
	$fp = FDIR.'';
	$tdata = edih_parse_select($fp);
	echo '====== test_parse tdata'.PHP_EOL;
	var_dump($tdata).PHP_EOL;
	//
	$write = edih_csv_order($tdata);
	echo '====== test_parse write'.PHP_EOL;
	var_dump($write).PHP_EOL;
	$prchtm = edih_csv_process_html($tdata);
	echo '====== test_data process html'.PHP_EOL;
	var_dump($prchtm).PHP_EOL;
}

// testing for test_edih_segments_text.php'
$test_text1 = false;  // true; //
if ($test_text1) {
	include_once './test_edih_segments_text.php';
	//
	$ik3seg = '|IK3*NM1*16*2010BA*8*1234567890002|CTX*SITUATIONAL TRIGGER*CLM*43**5:3*C023:1325'; //|IK3*NM1*16*2010BA*8|';
	$errar = edih_errseg_parse($ik3seg);
	var_dump($errar).PHP_EOL;
	echo strpos('|f837|batch|HC', 'HC').PHP_EOL;
}


$test_text2 = false; // true; // 
if ($test_text2) {
	// testing	
	include_once './test_edih_segments_text.php';
	//
	echo '===== testing segment text display'.PHP_EOL;
	$fp = FDIR.DS.'f277/277-201211300835240172.277ebr'; // 'erafiles/83566291.835.835_TX_G84980_4010'; // ERA-MCARE_B_TX-201111180930-001.era';  //'batch/2011-05-20-1850-batch.txt'; //  
	$clm = '74-15671'; //'169-2314'; //'1445-14988'; //'760-2486'; //'811136500002250'; //'522-801'; //'243-2137'; //'243-2136'; //'371-14992';  //;'1430-14743'
	$tst_str = html_head();
	$tst_str .= edih_display_text($fp, '', $clm, false);
	$tst_str .= html_tail();
	$fsave = file_put_contents(FDIR.DS.'segment_test.html', $tst_str);
	//print $tst_str;
}

$test_errparse = false; // true; // 
if ($test_errparse) {
	$errseg = '|IK3*NM1*16*2010BA*8*1234567890002|CTX*SITUATIONAL TRIGGER*CLM*43**5:3*C023:1325';
	$er = edih_errseg_parse($errseg);
	echo '==== error segment parse'.PHP_EOL;
	var_dump($er).PHP_EOL;
}

//'batch/2011-05-20-1850-batch.txt'; // 'f277/277-201211300835240172.277ebr'; // 'erafiles/83566291.835.835_TX_G84980_4010';
$test_data = false;  // true; // false;  // 
if ($test_data) {
	include_once './test_edih_csv_data.php';
	$fp = FDIR.DS.'batch/2011-05-20-1850-batch.txt'; //  'erafiles/ERA-MCARE_B_TX-201111180930-001.era';  
	echo '==== test_data '.$fp.PHP_EOL;
	$str_out = html_head();
	$str_out .= edih_csv_process_file($fp, $html=true, $err_only=true); 
	//edih_csv_test_display($fp);
	echo $str_out.PHP_EOL;
	//
	echo '==== csv table data '.$fp.PHP_EOL;
	$str_out .= edih_csv_to_html('f277', 'claim', 'ALL');
	$str_out .= html_tail();
	$fs = file_put_contents(FDIR.DS.'csv_datatest.html', $str_out);
	echo $str_out.PHP_EOL;
	//edih_csv_process_html($data_ar, $err_only=false);
}
// testing edih_x12_slice()
$test_slice = false; // true; // 
if ($test_slice) {
	/*
	 * ['trace'] => trace value from 835(TRN02) or 999(TA101) x12 type 
	 *  ['ISA13'] => ISA13
	 *  ['GS06'] => GS06   (sconsider also 'ISA13')
	 *  ['ST02'] => ST02   (condider also 'ISA13' and 'GS06')
	 *  ['keys'] => true to preserve segment numbering from original file
	 */
	include_once './test_edih_obj_2.php';
	$fp = FDIR.DS.'erafiles/ERA-MCARE_B_TX-201110010930-001.era';  // batch/2011-05-20-1850-batch.txt'; // '';  // 
	$ftest = file_get_contents($fp);
	$empty_obj = new edih_x12_file();
	$arg_ar = array('ST02'=>'1001','keys'=>true);
	$st_slice = $empty_obj->edih_x12_slice($arg_ar, $ftest);
	echo "======= test edih_x12_slice".PHP_EOL;
	//var_dump($st_slice).PHP_EOL;
	reset($st_slice);
	while ( list($key, $val) = each($st_slice) ) {
		echo "$key => $val".PHP_EOL;
	}
	echo "======= message".PHP_EOL;
	echo $empty_obj->edih_message().PHP_EOL;
	//
	echo "======= regular object ST keys".PHP_EOL;
	$my_obj = new edih_x12_file($fp);
	$segments = $my_obj->edih_segments();
	foreach($my_obj->edih_envelopes()['ST'] as $st) {
		$stky = key(array_slice($segments, $st['start'], 1, true));
		echo 'ST key '.$stky.PHP_EOL;
	}
	echo "======= regular object use reset, list, and each".PHP_EOL;
	reset($segments);
	while (list($key, $val) = each($segments)) {
	    echo "$key => $val\n";
	}		
}

// testing class edih_x12_file properties
$test_props =  false; // true; //  
if ($test_props) {
	include_once './test_edih_obj_2.php';
	//$fp = FDIR.DIRECTORY_SEPARATOR.'';   //
	$fp = FDIR.DS.'f277/277-201211300835240172.277ebr';  
	//
	if (is_readable($fp)) {
		$my_edi = new edih_x12_file($fp, true, true);
		//
		echo '======= <br />'.PHP_EOL;
		echo '===== properties test_edih_obj.php ==== '.$fp.' <br />'.PHP_EOL;
		echo $fp.PHP_EOL;
		echo '  path ', $my_edi->edih_filepath().PHP_EOL;
		echo 'length ', $my_edi->edih_length() .' <br />'.PHP_EOL;
		echo ' valid ', $my_edi->edih_valid() .' <br />'.PHP_EOL;
		echo ' isx12 ', $my_edi->edih_isx12() .' <br />'.PHP_EOL;
		echo ' hasGS ', $my_edi->edih_hasGS() .' <br />'.PHP_EOL;
		echo ' hasST ', $my_edi->edih_hasST() .' <br />'.PHP_EOL;
		echo '   ver ', $my_edi->edih_version() .' <br />'.PHP_EOL;
		echo '  type ', $my_edi->edih_type() .' <br />'.PHP_EOL;
		echo 'segment count: ' . count( $my_edi->edih_segments() ).' <br />'.PHP_EOL;
		echo 'seg delimiter count: '.substr_count($my_edi->edih_text(), $my_edi->edih_delimiters()['t']).PHP_EOL;
		echo ' testing reset for element delimiter'.PHP_EOL;	
		
		// ISA segment
		echo '==== ISA segment <br />'.PHP_EOL;
		var_dump( reset( $my_edi->edih_segments() ) ).PHP_EOL;
		echo '=== get element delimiter'.PHP_EOL;
		if ( substr(current( $my_edi->edih_segments() ), 0, 3) == 'ISA') {
			echo '== current() works!'.PHP_EOL;
		} else {
			echo '== current() failure!'.PHP_EOL;
		}
		$de = (substr(reset($my_edi->edih_segments() ), 0, 3) == 'ISA') ? substr(reset($my_edi->edih_segments()), 3, 1) : '';
		echo $de.' '.substr(reset($my_edi->edih_segments()), 3, 1).PHP_EOL;		
		// delimiters
		echo '==== Delimiters <br />'.PHP_EOL;
		var_dump( $my_edi->edih_delimiters() ).PHP_EOL;
		// envelopes
		echo '==== Envelopes <br />'.PHP_EOL;
		var_dump( $my_edi->edih_envelopes() ).PHP_EOL;
		// slice
		echo '==== slice<br />'.PHP_EOL;
		$arg_ar = array('ST02'=>'1003', 'keys'=>true);
		var_dump( $my_edi->edih_x12_slice($arg_ar) ).PHP_EOL;
		// message
		echo '==== message <br />'.PHP_EOL;
		echo $my_edi->edih_message() .' <br />'.PHP_EOL;
	} else {
		echo 'test_props: could not read file at '.$fp.PHP_EOL;
	}
}

// ============== test empty object ===========
$test_empty = false; // true; 
if ($test_empty) {
	include_once './test_edih_obj_2.php';
	$empty_obj = new edih_x12_file(); // false; //
	$testtype = true;
	$testenv = true;
	$testsegs = false; // true; //
	$testtrans = true; // false; //
	$testslice = true;
	$clm01 = "728-2111"; //"1219-15545";  // "1277-15449";
	$testID = true;
	$segID = 'BHT';
	$segs = array();
	// test file
	$fp2 = FDIR.DIRECTORY_SEPARATOR.'';  //f277/';  //  ebrfiles/';
	$fcont = file_get_contents($fp2);
	// get type
	if ($testtype) {
		$tp = $empty_obj->edih_x12_type($fcont);
		echo '====== type'.PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '====== type from file  <br />'.PHP_EOL;
		var_dump( $tp ).PHP_EOL;
	}
	// get envelopes
	if ($testenv) {
		$envs = $empty_obj->edih_x12_envelopes($fcont);
		echo '====== '.PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '====== envelopes from file  <br />'.PHP_EOL;
		var_dump( $envs ).PHP_EOL;
	}
	// get segments
	if ($testsegs) {
		$segs = $empty_obj->edih_x12_segments($fcont);
		echo '====== '.PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '====== segments from file  <br />'.PHP_EOL;
		var_dump( $segs ).PHP_EOL;
	}
	// get transaction
	if ($testtrans) {
		$trns = $empty_obj->edih_x12_transaction($clm01, '', $fcont);
		echo '====== '.PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '====== array_keys'.PHP_EOL;
		var_dump( array_keys($trns) ).PHP_EOL;
		echo '====== transaction from file  <br />'.$clm01.PHP_EOL;
		var_dump( $trns ).PHP_EOL;
	}
	// get segment by ID (need a segment array for 3rd argument)
	if ($testID && $trns) {
		$idsegs = $empty_obj->edih_get_segment($segID, '', $trns );
		echo '====== '.PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '====== segments by ID from file  <br />'.PHP_EOL;
		var_dump( $idsegs ).PHP_EOL;
	}
	// test edih_x12_slice  edih_x12_slice($arg_array, $file_text='')
	if ($testslice) {
		$st1 = '0001'; // 1002'; //
		$gs1 = '1';
		$is1 = '277533497';
		$ky = true;
		$sl_ar = array('ST02'=>$st1, 'keys'=>$ky); //'ISA13'=>$is1, 'GS06'=>$gs1,'ST02'=>$st1, 'GS06'=>$gs1,
		$slval = $empty_obj->edih_x12_slice($sl_ar, $fcont);
		echo '======= edih_x12_slice()'.PHP_EOL;
		var_dump( $slval ).PHP_EOL;
		echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
		echo '======= edih_x12_slice() with internal data'.PHP_EOL;
		// 451613218
		$slval = $empty_obj->edih_x12_slice(array('ST02'=>'1006', 'keys'=>$ky));		
		var_dump( $slval ).PHP_EOL;	
		echo '======= edih_x12_slice() with internal data'.PHP_EOL;
		$slval = $empty_obj->edih_x12_slice(array('trace'=>'451613218', 'keys'=>$ky));	
		var_dump( $slval ).PHP_EOL;	
	}
	//
	echo '====== END '.PHP_EOL;
	echo $empty_obj->edih_message() .' <br />'.PHP_EOL;
}

//
$test_fupl = false;  //true; // 

if ($test_fupl) {
	//
	function t87($f_uplz, &$f_zr) {
		//GLOBAL $f_zr;
		if (is_array($f_uplz) && count($f_uplz) > 0 ) {
			$t = $f_uplz['type'];
			$n = $f_uplz['name'];
			$f_zr[$t][] = $n;
			//$p_ct++;
		}
		echo 't87 '.$t.' '.$n.PHP_EOL;
		//var_dump( $f_zr ).PHP_EOL;
		//return $f_zr;
	} 
	$f_zr = array();
	$p_ct = 0;
	$ar_tp = array('f833', 'f845', 'f234', 'f123');
	$ar_nm = array('bob', 'joe', 'nancy', 'jane', 'mary', 'edward', 'leslie', 'susan', 'quenton');
	foreach($ar_tp as $ky=>$val) {
		$ftnm = array('type'=>$val, 'name'=>$ar_nm[$ky]);
		t87($ftnm, $f_zr);
		$p_ct++;
	}
	echo $p_ct.PHP_EOL;
	var_dump($f_zr).PHP_EOL;
	
	$ar12 = array('type'=>'f833', 'name'=>'sharon');
	$ar13 = array('type'=>'f234', 'name'=>'betsy');
	$ar14 = array('type'=>'f833', 'name'=>'suzy');
	t87($ar12, $f_zr);
	t87($ar13, $f_zr);
	t87($ar14, $f_zr);	
	echo '====== one more'.PHP_EOL;
	var_dump($f_zr).PHP_EOL;
}	

// multiple GS types
$test_gstp = false;
if ($test_gstp) {
$tp_tmp = array('HR', 'TC', 'ZF');
	if ( count($tp_tmp) ) {
		$tp3 = array_values( array_unique($tp_tmp) );
		// mixed should not happen -- concatenated ISA envelopes of different types?
		$tpstr = ( count($tp3) > 1 ) ? 'mixed|' . implode("|", $tp3) : $tp3[0];
		//$this->message[] = 'edih_x12_type: ' . $tpstr;
	} else {
		$this->message[] = 'edih_x12_type: error in identifying type ';
		return false;
	}
	var_dump($tpstr).PHP_EOL;
}
// csv_edihist_log
$test_log = false;  //true; // 
if ($test_log) {
	$logfile = './log/edi_history_log.txt';
	if ( is_file($logfile) ) {
		$fh = fopen($logfile, 'r');
	}
}
//
$test_date = false;  // true; // 
if ($test_date) {
	$tdt = array('1999/12/31', '03/14/1998', '5/2/2014', '2004-06-25', '03-14-1998', '5/17/05', '11/9/12');
	echo '==== using preg_split for dates'.PHP_EOL;
	foreach($tdt as $dt) {
		$dtval = preg_split("/\D/", $dt);
		$dtphp = implode('', preg_split("/\D/", $dt) );
		echo 'implode value: '.$dtphp.PHP_EOL;
		if (is_array($dtval)) {
			$isymd = false;
			foreach($dtval as $ky=>$df) {
				//echo 'foreach '.$ky.' => '.$df.PHP_EOL;
				if ($isymd) { continue; }
				echo 'foreach '.$ky.' => '.$df.PHP_EOL;
				if (strlen($df) == 4) {
					$isymd = true;
					if ($ky == 0) {
						$y=$dtval[0]; $m=$dtval[1]; $d=$dtval[2];
						$dt1 = $y.'-'.$m.'-'.$d;
						echo 'dt1 '.$dt1.PHP_EOL;
						$ymd = 'Y-m-d';
					} elseif ($ky == 2) {
						$y=$dtval[2]; $m=$dtval[0]; $d=$dtval[1];
						$dt1 = $m.'-'.$d.'-'.$y;
						$ymd = 'm-d-Y';
					}
				} else {
					$isymd = false;
					$y = ($dtval[2] < 39) ? 2000 + $dtval[2] : 1900 + $dtval[2]; 
					$m=$dtval[0]; 
					$d=$dtval[1];
					$dt1 = $m.'-'.$d.'-'.$y;
					$ymd = 'm-d-Y'; 
				}					
			}
			echo " m d y values: $m $d $y".PHP_EOL;
			if ( checkdate( $m, $d, $y) ) {
				$dt2 = date_create_from_format($ymd, $dt1); //"$m-$d-$y");
				$dtstr = date_format ( $dt2, 'Ymd' );
			} elseif ( checkdate( $d, $m, $y) ) {
				$dt2 = date_create_from_format($ymd, $dt1); //"$d-$m-$y");
				$dtstr = date_format ( $dt2, 'Ymd' );
			} else {
				$dtstr = 'unable to format';
			}
		}
		// ($ymd == 'Y-M-D') ? $y=$dtval[0]; $m=$dtval[1]; $d=$dtval[2];
		
		echo 'date given as '.$dt.' formatted to '.$dtstr.PHP_EOL;
		echo '=== testing strtotime'.PHP_EOL;
		$dt5 = strtotime('1998/12/24');
		var_dump($dt5).PHP_EOL;
		$dt6 = new DateTime('@'.$dt5); //
		var_dump($dt6).PHP_EOL;

	}
						
	$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
	echo date("Y-m-d").PHP_EOL;
	$dtobj = new DateTime(date("Y-m-d"));
	$dt2 = $dtobj->sub(new DateInterval('P10D'));
	echo $dtobj->format('Y-m-d').PHP_EOL;	
	var_dump(date_get_last_errors()).PHP_EOL;
	//
	echo '==== proxy functions'.PHP_EOL;
	$date = date_create( date("Y-m-d") );
	date_sub($date, date_interval_create_from_date_string('10 days'));
	$dt3 = date_format($date, 'Y/m/d');
	echo $dt3." ".date_format($date, 'Y-m-d').PHP_EOL;
	var_dump(preg_match('/(19|20)\d{2}\D[01][1-9]\D[0-3][0-9]/', $dt3)).PHP_EOL; // [\/\-]
	$dt4 = date_create($dt3);
	$dt5 = date_format($dt4, 'Ymd');
	echo 'date_format '.$dt4->format('Y-m-d') .' to '.$dt5.PHP_EOL;
	var_dump(date_get_last_errors()).PHP_EOL;
	//
	//$lognames = array('edih_log_2016-02-28.txt', 'edih_notes.txt', 'edih_log_2016-02-27.txt', 'edih_log_2016-02-26.txt', 'edih_log_2016-02-25.txt');
	//$datetime1 = date_create('2016-02-29');
	//foreach($lognames as $log) {
		//if (!strpos($log, '_log_')) { continue; }
		//$pos1 = strrpos($log, '_');
		//if ($pos1) {
			//$ldate = substr($log, $pos1+1, 10);
			//$datetime2 = date_create($ldate);
			//$interval = date_diff($datetime1, $datetime2);
			//echo '== date difference '.$ldate.' '.$interval->format('%R%a days').PHP_EOL;
			//if ($interval->format('%R%a') < -2) {
				//echo '===== too old'.PHP_EOL;
			//}
		//}
	//}
	//echo '==== sort'.PHP_EOL;
	//if (asort($lognames)) {
		//var_dump($lognames).PHP_EOL;
	//}
	//if (rsort($lognames) ) {
		//var_dump($lognames).PHP_EOL;
	//}
	//var_dump( json_encode($lognames) ).PHP_EOL;

	//
	$per_ar = array('1 week', '2 week', '1 month', '2 month', '3 month', '6 month', '1 year'); 
	echo '===== date formats and periods'.PHP_EOL;
	$gtdt = getdate();
	//$dtstr1 = $gtdt['mon'].'/'. ($gtdt['mday'] - $gtdt['wday'] + 1) .'/'.$gtdt['year'];
	$dtstr1 = $gtdt['mon'].'/01/'.$gtdt['year'];
	$dtpd1 = date_create($dtstr1);
	$dtpd1->format('Ymd');
	var_dump($gtdt).PHP_EOL;
	var_dump($dtstr1).PHP_EOL;
	var_dump($dtpd1).PHP_EOL;
	echo '==== modify'.PHP_EOL;
	$dtpd1->modify('-6 month');
	$dtpd2 = $dtpd1->format('Ymd');
	var_dump($dtpd2).PHP_EOL;
	foreach($per_ar as $per) {
		$modstr = '-'.$per;
		$dtpd1 = date_create($dtstr1);
		$dtpd1->modify($modstr);
		$dtpd2 = $dtpd1->format('Ymd');
		echo 'modify '.$modstr.' '.$dtpd2.PHP_EOL;
	}
	//$dt1 = '20130725';
	//echo substr($dt1, 0, 4) . '-' . substr($dt1, 4, 2) . '-' . substr($dt1, 6, 2).PHP_EOL;

	echo "==== strcmp date comparison".PHP_EOL;
	$testdate = '20150704';
	$dtar = array('20150705', '20150704', '20150703', '20150702', '20150701', '20150604', '', null, '19991231');
	foreach($dtar as $dt) {
		//if ( strcmp($dt, $testdate) < 0 ) {
		if ( intval($dt) < intval($testdate) ) {
			echo "yes $dt is less than $testdate".PHP_EOL;
		} else {
			echo "no $dt is not less than $testdate".PHP_EOL;
		}
	}		

	
}
//
//
// test telephone format
$test_tel = false;
if ($test_tel) {
	function fmt_telephone ($str_val) {
		$strtel = (string)$str_val;
		$strtel = preg_replace('/\D/', '', $strtel);
		echo 'fmt_telephone '.$strtel.PHP_EOL;
		if ( strlen($strtel) != 10 ) {
			return false;
		} else {
			$tel = substr($strtel,0,3) . "-" . substr($strtel,3,3) . "-" . substr($strtel,6);
		}
		return $tel;
	}
	$tel1 = '(210) 234-5678';
	$tel2 = 4159876543;
	$tel3 = '712-876-4321';
	echo '===== telephone'.PHP_EOL;
	echo $tel1.' '.fmt_telephone($tel1).PHP_EOL;
	echo $tel2.' '.fmt_telephone($tel2).PHP_EOL;
	echo $tel3.' '.fmt_telephone($tel3).PHP_EOL;
}
//
//
$test_pct = false;
if ($test_pct) {
	function format_percent ($str_val) { 
		$val = (float)$str_val;
		if (is_float($val)) { 
			//$pct = sprintf("%01.1f%%", 100 * $val);
			$pct = $val*100 . '%';
		} else {
			$pct = $str_val.'%';
		}
		return $pct;
	}
	//
	echo '===== format percent'.PHP_EOL;
	$pct1 = '.25';
	$pct2 = '.875';
	$pct3 = '.05';
	echo $pct1.' '.format_percent ($pct1).PHP_EOL;
	echo $pct2.' '.format_percent ($pct2).PHP_EOL;
	echo $pct3.' '.format_percent ($pct3).PHP_EOL;
}
//

$test_array = false; // true; // 
if ($test_array) {
	require_once 'test_edih_csv_inc.php';
	echo '==== array stuff'.PHP_EOL;
	$tar = array('abc'=>'ABC', '1'=>'one', 'last'=>'finish');
	foreach($tar as $k=>$v) {
		echo 'key '.$k.' value '.$v.PHP_EOL;
		echo 'key '.key($tar).' value '.current($tar).PHP_EOL;
	}
	echo current($tar).PHP_EOL;
	echo reset($tar).PHP_EOL;
	echo key($tar).PHP_EOL;
	$tar2 = array();
	$tar2['f837'][] = 'mysuperfile.txt';
	$tar2['f278'][] = 'anothersuperfile.dat';  //array("Z"=>array("Z"=>"Zebra", "H"=>"Hippo", "G"=>"Girafe"), "X"=>"Xylophone", "Q"=>"QUERTY",);
	if (reset($tar2) !== false) { $k = key($tar2); $v = reset($tar2); }
	echo 'reset again on tar2: k = '.$k.PHP_EOL;
	var_dump($v).PHP_EOL;
	if (end($tar2) !== false) { $k = key($tar2);  $v = end($tar2); }
	echo 'end again on tar2: k = '.$k.PHP_EOL;
	var_dump($v).PHP_EOL;	
	//$k = key(reset($tar2));
	$h = array_keys($tar2[$k]);
	echo '=== find key and keys'.PHP_EOL;
	var_dump($h).PHP_EOL;
	var_dump($tar2).PHP_EOL;
	echo '=== bounds'.PHP_EOL;
	$bounds = csv_array_bounds($tar2);
	var_dump($bounds).PHP_EOL;
	//
	//~ echo '==== test get segment'.PHP_EOL;
	//~ $de ='*';
	//~ $nm1[] = '';
	//~ $nm1[] = '';
	//~ $nm1_ar = (reset($nm1) !== false) ? explode( $de, current($nm1) ) : '';
	//~ $pt_name = ( isset($nm1_ar[3]) && isset($nm1_ar[4]) ) ? $nm1_ar[3].', '.$nm1_ar[4] : '';
	//~ echo $pt_name.PHP_EOL;
	//~ //
	//~ $bounds = csv_array_bounds($nm1_ar);
	//~ var_dump($bounds).PHP_EOL;
}

$test_pid = true; // false; // 
if ($test_pid) {
	echo '==== test pid'.PHP_EOL;
	$pid_ar = array('89324-20120721', '12-78934528', 'JL345/2178', 'AF345-23682');
	foreach($pid_ar as $pval) {	
		if ( strpos($pval, '-') ) {
			$pid = substr($pval, 0, strpos($pval, '-'));
			$enc = substr($pval, strpos($pval, '-')+1);
			echo 'strpos '.$pval.' pid '.$pid.' encounter '.$enc.PHP_EOL;
			echo 'strpos enc'.strpos($pval, $enc).' sub '.substr($pval, strpos($pval, $enc)).PHP_EOL;
		} elseif (	preg_match('/\D/', $pval, $match2, PREG_OFFSET_CAPTURE) ) {
			$inv_split = (count($match2)) ? preg_split('/\D/', $pval, 2, PREG_SPLIT_NO_EMPTY) : false;
			if ($inv_split) {
				$pid = $inv_split[0];
				$enc = $inv_split[1];	
			}
		}
		echo $pval.' pid '.$pid.' encounter '.$enc.PHP_EOL;
	}
}

$test_strcmp = false; // true; // 
if ($test_strcmp) {
	$str_ar = array('1234', '27', '687543', '20160321');
	$try_ar = array('123', '234', '1234', '675-1234',
					'27', '276', '3227', '527', '27-527', '10034-27',
					'687543', '6875', '87543', '1687543', '1234-1687543', '1234-687543',
					'20160321', '2016032', '20160', '820160321', '687543-20160321');
	//
	echo "==== test_strcmp".PHP_EOL;
	foreach($str_ar as $s) {
		$tn = '';
		foreach($try_ar as $t) {
			if (strlen($s) != strlen($t)) { 
				echo "unequal length s $s t $t".PHP_EOL;
				if (strpos($t, '-')) {
					$tn = substr($t,strpos($t, '-')+1);
					$te = substr($t, 0, strpos($t,'-'));
					echo "=== pid is te t $te".PHP_EOL;
				} else {
					$tn = $t;
					//	continue;
				}
				//else {
				
				//} 
				//$tn = ($tn) ? $tn : $t;
				//$ls = strlen($s);
				//$lt = strlen($s);
				// if (substr_compare($s, $tn, -$ls, $ls) === 0) {
				if (strcmp($s, $tn) === 0) {
					echo "match! s $s equals t $tn".PHP_EOL;
				} else {
					echo "no match! s $s != t $tn".PHP_EOL;
				}
			}
		}
	}
	// int substr_compare ( string $main_str , string $str , int $offset [, int $length [, bool $case_insensitivity = false ]] )


}

$test_archive = false; //true;  // 
if ($test_archive) {
	include_once "test_edih_archive.php";
	echo '==== test archive'.PHP_EOL;
	echo '==== preg match'.PHP_EOL;
	$pd = '1y';
	preg_match('/\d{1,2}(?=w|m|y)/', $pd, $matches);
	var_dump($matches).PHP_EOL;
	echo '== match: '.$matches[0].PHP_EOL;
	//
	echo '==== test archive'.PHP_EOL;
	$archdt = edih_archive_date($pd);
	echo ' archive period date: '.$archdt.PHP_EOL;

}
	

$test_math = false; // true; // 
if ($test_math) {
	$n1 = 1000;
	$n2 = 250;
	$n3 = $n1 - $n2 - 1;
	echo '==== math '.$n1.' '.$n2.' '.$n3.PHP_EOL;
}

$test_parms = false; // true; // 
if ($test_parms) {
	require_once './test_edih_csv_inc.php';
	//
	$params = csv_parameters();
	echo '===== test parameters'.PHP_EOL;
	var_dump($params);
	//
	echo '===== test setup'.PHP_EOL;
	$out_str = csv_setup();
	echo $out_str.PHP_EOL;	
}

$test_ini = false;  //true;  // 
if ($test_ini) {

	
	function return_bytes($val) {
	    $val = trim($val);
	    $last = strtolower($val[strlen($val)-1]);
	    switch($last) {
	        // The 'G' modifier is available since PHP 5.1.0
	        case 'g': $val *= 1024;
	        case 'm': $val *= 1024;
	        case 'k': $val *= 1024;
	    }
	
	    return $val;
	}
	
	function return_bytes2($val) {
	    assert('1 === preg_match("/^\d+([kmg])?$/i", $val)');
	    static $map = array ('k' => 1024, 'm' => 1048576, 'g' => 1073741824);
	    return (int)$val * @($map[strtolower(substr($val, -1))] ?: 1);
	}
	
	echo 'display_errors = ' . ini_get('display_errors').PHP_EOL;
	echo 'register_globals = ' . ini_get('register_globals').PHP_EOL;
	echo 'upload_max_filesize = ' . ini_get('upload_max_filesize').PHP_EOL;
	echo 'upload_max_filesize bytes v2 = ' . return_bytes2(ini_get('upload_max_filesize')).PHP_EOL;
    echo 'max_file_uploads = ' . ini_get('max_file_uploads').PHP_EOL;
	echo 'post_max_size = ' . ini_get('post_max_size').PHP_EOL;
	echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) .PHP_EOL;
	echo 'post_max_size in bytes = ' . return_bytes(ini_get('post_max_size')).PHP_EOL;
	echo 'post_max_size in bytes v2 = ' . return_bytes2(ini_get('post_max_size')).PHP_EOL;
}
$test_filter = false;  //true;  // 
if ($test_filter) {
	//function date_check($strdate) {
		//if ( preg_match('/(19|20)\d{2}\D[01][1-9]\D[0-3][0-9]/', $strdate) ) {
			//$dt = preg_replace('/\D/', '-', $strdate);
		//} elseif ( preg_match('/(\d{2}\D[01][1-9]\D[0-3][0-9]/', $strdate) ) {
			//if (substr(

			//$dt = preg_replace('/\D/', '-', $strdate);
		
	$var_date = '2015-12-21';
	$sn = filter_var($var_date, FILTER_SANITIZE_NUMBER_INT);
	echo '=== filter test'.PHP_EOL;
	echo "date $var_date filtered to $sn".PHP_EOL;
	echo '=== test separator '.strpos($sn, '-').PHP_EOL;
	$var_pd = '2w';
	$sn = filter_var($var_pd, FILTER_SANITIZE_STRING);
	echo '=== filter test'.PHP_EOL;
	echo "period $var_pd filtered to $sn".PHP_EOL;	
}

//
echo "=============".PHP_EOL;
echo "memory (byte): ", memory_get_peak_usage(true), "\n";
echo "==== included files".PHP_EOL;
$incl = get_included_files();
var_dump($incl).PHP_EOL;
?>
