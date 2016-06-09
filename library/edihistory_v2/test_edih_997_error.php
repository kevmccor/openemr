<?php
/*
 * edih_997_error.php
 * 
 * Copyright 2016 Kevin McCormick Longview, Texas
 * 
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 or later.  You should have 
 * received a copy of the GNU General Public License along with this program; 
 * if not, write to the Free Software Foundation, Inc., 
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *  <http://opensource.org/licenses/gpl-license.php>
 * 
 * 
 * @author Kevin McCormick
 * @link: http://www.open-emr.org
 * @package OpenEMR
 * @subpackage ediHistory
 */
 
// codes used in 997/999 files;
//require_once './codes/edih_997_codes.php';
//require_once 'test_edih_csv_inc.php'; 
//require_once 'test_edih_obj_2.php';


/** 
 * Extract information on rejected files or transactions
 *
 * @param object
 * @return array
 */ 
function edih_997_errdata($obj997) {
	//
	$segments = $obj997->edih_segments();
	$delims = $obj997->edih_delimiters();
	$de = $delims['e'];
	$ds = $delims['s'];
	$dr = $delims['r'];
	//
	$dt = '~';
	//
	$diag = array();
	$diag['err'] = array();
	$iserr = false;
	$idx = -1;
	//
	foreach($segments as $seg) {
		$sar = array();
		if (strncmp($seg, 'TA1'.$de, 4) == 0) {
			$sar = explode($de, $seg);
			//
			$sub_icn = (isset($sar[1]) && $sar[1]) ? $sar[1] : '';
			$subdate = (isset($sar[2]) && $sar[2]) ? $sar[2] : '';
			$subtime = (isset($sar[3]) && $sar[3]) ? $sar[3] : '';
			$ackcode = (isset($sar[4]) && $sar[4]) ? $sar[4] : '';
			$acknote = (isset($sar[5]) && $sar[5]) ? $sar[5] : '';
			//
			continue;
		}
		if (strncmp($seg, 'AK1'.$de, 4) == 0) {
			$sar = explode($de, $seg);
			//
			$fg_type = (isset($sar[1]) && $sar[1]) ? $sar[1] : '';
			$fg_id = (isset($sar[2]) && $sar[2]) ? $sar[2] : '';
			//
			continue;
		}
			
		if (strncmp($seg, 'AK2'.$de, 4) == 0 || strncmp($seg, 'IK2'.$de, 4) == 0 ) {
			$sar = explode($de, $seg);
			//
			$iserr = false;
			//
			$subtype = (isset($sar[1]) && $sar[1]) ? $sar[1] : '';
			$substn = (isset($sar[2]) && $sar[2]) ? $sar[2] : '';
			// AK2*837*0001
			continue;
		}
		if (strncmp($seg, 'AK3'.$de, 4) == 0 || strncmp($seg, 'IK3'.$de, 4) == 0 ) {
			$sar = explode($de, $seg);
			//$idx = count($diag);
			$idx++;
			$iserr = true;
			// debug
			csv_edihist_log("edih_997_errdata: index $idx $seg");
			//
			$diag['err'][$idx]['subtype'] = 'f'.$subtype;
			$diag['err'][$idx]['substn'] = $substn;
			//
			$diag['err'][$idx]['ik3segid'] = (isset($sar[1])) ?  $sar[1] : '';
			$diag['err'][$idx]['ik3segpos'] = (isset($sar[2])) ?  $sar[2] : '';
			$diag['err'][$idx]['ik3loop'] = (isset($sar[3])) ?  $sar[3] : '';
			$diag['err'][$idx]['ik3code'] = (isset($sar[4])) ?  $sar[4] : '';
			//
			continue;
		}
		if (strncmp($seg, 'CTX'.$de, 4) == 0) {
			$sar = explode($de, $seg);
			if (isset($sar[1]) && strpos($sar[1],'TRIG')) {
				// CTX*SITUATIONAL TRIGGER*
				$diag['err'][$idx]['ctxid'] = (isset($sar[2])) ?  $sar[2] : '';
				$diag['err'][$idx]['ctxpos'] = (isset($sar[3])) ?  $sar[3] : '';
				$diag['err'][$idx]['ctxloop'] = (isset($sar[4])) ?  $sar[4] : '';
				$diag['err'][$idx]['ctxelem'] = (isset($sar[5])) ?  $sar[5] : '';
				// $sar[6] Reference in Segment
				// Data Element Reference Number : Data Element Reference Number Composite 
			} else {
				// business unit identifier
				$diag['err'][$idx]['ctxacct'] =  (isset($sar[2])) ?  $sar[2] : '';
			}
			//
			continue;
		}
		if (strncmp($seg, 'AK4'.$de, 4) == 0 || strncmp($seg, 'IK4'.$de, 4) == 0 ) {
			$sar = explode($de, $seg);
			$diag['err'][$idx]['ik401'] = (isset($sar[1])) ?  $sar[1] : '';
			$diag['err'][$idx]['ik402'] = (isset($sar[2])) ?  $sar[2] : '';
			$diag['err'][$idx]['ik403'] = (isset($sar[3])) ?  $sar[3] : '';
			$diag['err'][$idx]['ik404'] = (isset($sar[4])) ?  $sar[4] : '';
			//
			continue;
		}
		if (strncmp($seg, 'AK5'.$de, 4) == 0 || strncmp($seg, 'IK5'.$de, 4) == 0 ) {
			if ($iserr) {
				$sar = explode($de, $seg);
				$diag['err'][$idx]['ik501'] = (isset($sar[1])) ?  $sar[1] : '';
				$diag['err'][$idx]['ik502'] = (isset($sar[2])) ?  $sar[2] : '';
				$diag['err'][$idx]['ik503'] = (isset($sar[3])) ?  $sar[3] : '';
				$diag['err'][$idx]['ik504'] = (isset($sar[4])) ?  $sar[4] : '';
				$diag['err'][$idx]['ik505'] = (isset($sar[5])) ?  $sar[5] : '';
				//
				$iserr = false;
			}
				//
			continue;
		}			
		if (strncmp($seg, 'AK9'.$de, 4) == 0) {
			$diag['summary']['sub_icn'] = $sub_icn;
			$diag['summary']['subtype'] = $subtype;
			$diag['summary']['subdate'] = $subdate;
			$diag['summary']['subtime'] = $subtime;
			$diag['summary']['ackcode'] = $ackcode;
			$diag['summary']['acknote'] = $acknote;
			$diag['summary']['fg_type'] = $fg_type;
			$diag['summary']['fg_id'] = $fg_id;
			//
			$sar = explode($de, $seg);
			$diag['summary']['ak901'] = (isset($sar[1])) ?  $sar[1] : ''; // AK901 A=Accepted R=Rejected.
			$diag['summary']['ak902'] = (isset($sar[2])) ?  $sar[2] : ''; // AK902  number of transaction sets
			$diag['summary']['ak903'] = (isset($sar[3])) ?  $sar[3] : ''; // AK903  number of transaction sets received by the translator.
			$diag['summary']['ak904'] = (isset($sar[4])) ?  $sar[4] : ''; // AK904  number of transaction sets accepted by the translator.
			$diag['summary']['ak905'] = (isset($sar[5])) ?  $sar[5] : ''; // codes
			$diag['summary']['ak906'] = (isset($sar[6])) ?  $sar[6] : '';
			$diag['summary']['ak907'] = (isset($sar[7])) ?  $sar[7] : '';
			$diag['summary']['ak908'] = (isset($sar[8])) ?  $sar[8] : '';
			$diag['summary']['ak909'] = (isset($sar[9])) ?  $sar[9] : ''; 
			//
			continue;
		}
	}
	return $diag;
}


/** 
 * Create an html report on rejected files or transactions
 *
 * @uses edih_997_ta1_code()
 * @uses edih_997_code_text()
 * @uses edih_rsp_st_match()
 * 
 * @param object
 * @return array
 */ 
function edih_997_err_report($err_array) {
	//
	if (!is_array($err_array) || !count($err_array)) {
		$str_html = "Error: invalid argument for error report";
		csv_edihist_log('edih_997_err_report: invalid function argument');
		return $str_html;
	}
	//		
	$str_html = "";
	//
	if (isset($err_array['summary'])) {
		extract($err_array['summary'], EXTR_OVERWRITE);
		$str_html .= "<p class='rpt997'>".PHP_EOL;
		$str_html .= (isset($sub_icn)) ? "<em>Submitted ICN</em> $sub_icn" : "Submitted file unknown";
		$str_html .= (isset($subdate)) ? " <em>Date</em> ".edih_format_date($subdate) : "";
		$str_html .= (isset($subtime)) ? " <em>Time</em> $subtime<br />" : "<br />";
		$str_html .= (isset($ackcode)) ? " TA1 $ackcode : ".edih_997_ta1_code($ackcode)." <br />" : "";
		$str_html .= (isset($acknote)) ? " TA1 $acknote : ".edih_997_ta1_code($acknote)." <br />".PHP_EOL : "<br />".PHP_EOL;
		if (isset($fg_type)) {
			$fgtp = csv_file_type($fg_type);
			$str_html .= " <em>Functional Group Type</em> $fg_type ($fgtp)";
			$str_html .= (isset($fg_id)) ? " <em>GS06</em> $fg_id <br />".PHP_EOL : "<br />".PHP_EOL;
		}
		//
		//$str_html .= "</p>".PHP_EOL;
		// 
		$str_html .= (isset($ak901)) ? "999/997 $ak901 ".edih_997_code_text('ak501',$ak901)."<br />" : "";
		$str_html .= (isset($ak902)) ? " Transactions: submitted $ak902" : " ";
		$str_html .= (isset($ak903)) ? " received $ak903" : "";
		$str_html .= (isset($ak904)) ? " accepted $ak904" : "";
		$str_html .= (isset($ak905) && $ak905) ? "<br />$ak905 ".edih_997_code_text('ak502',$ak905)."<br />" : "";
		$str_html .= (isset($ak906) && $ak906) ? $ak906." ".edih_997_code_text('ak502',$ak906)."<br />" : "";
		$str_html .= (isset($ak907) && $ak907) ? $ak907." ".edih_997_code_text('ak502',$ak907)."<br />" : "";
		$str_html .= (isset($ak908) && $ak908) ? $ak908." ".edih_997_code_text('ak502',$ak908)."<br />" : "";
		$str_html .= (isset($ak909) && $ak909) ? $ak909." ".edih_997_code_text('ak502',$ak909)."<br />" : "";
		//
		$str_html .= "</p>".PHP_EOL;
	}
	//	
	foreach($err_array['err'] as $k=>$v) {
		//
		$ct = $k + 1;
		$icn = (isset($sub_icn)) ? $sub_icn : '';
		$str_html .= "<p class='err997'>".PHP_EOL;
		$str_html .= "Error $ct<br />";
		if (isset($v['substn']) && isset($v['subtype'])) {
			$stn = $v['substn']; $rtp = $v['subtype']; 
			$trace = ($icn) ? sprintf("%s%04d", $icn, $stn) : "";
			$trn_ar = ($trace) ? edih_rsp_st_match($trace, $rtp) : "";
			if (is_array($trn_ar) && count($trn_ar)) {
				$pt_name = $trn_ar['pt_name'];
				$clm01 = $trn_ar['clm01'];
				$svcdate = $trn_ar['svcdate'];
				$str_html .= "$pt_name $svcdate $clm01<em>Trace</em> $stn <a class='sub' href='edih_main.php?gtbl=claim&ftype=f997&rsptype=$rtp&trace=$trace&fmt=seg'>$trace</a> <br />".PHP_EOL;
			} else {
				$str_html .= "Unable to locate transaction (type: $rtp icn: $icn st: $stn) <br />".PHP_EOL;
			}
		} else {
			$str_html .= "Unable to trace, did not get type or st number <br />".PHP_EOL;
		}
		//
		$str_html .= (isset($v['ctxacct'])) ? "<em>Transaction ID</em> ".$v['ctxacct'] : "";
		$str_html .= (isset($v['ik3segid'])) ? " <em>Segment</em> ".$v['ik3segid'] : "";
		$str_html .= (isset($v['ik3segpos'])) ? " <em>Position</em> ".$v['ik3segpos'] : "";
		$str_html .= (isset($v['ik3loop'])) ? " <em>Loop</em> ".$v['ik3loop'] : "";
		$str_html .= (isset($v['ik3code'])) ? " <em>Code</em> ".$v['ik3code'].PHP_EOL : PHP_EOL;
		$str_html .= (isset($v['ik3code'])) ? "<br /> ".$v['ik3code']." ".edih_997_code_text('ak304',$v['ik3code'])."<br />" : "";
		//
		$str_html .= (isset($v['ctxid'])) ? "Situational ".PHP_EOL."<em>Segment</em> ".$v['ctxid'] : "";
		$str_html .= (isset($v['ctxpos'])) ? " <em>Position</em> ".$v['ctxpos'] : ""; 
		$str_html .= (isset($v['ctxloop'])) ? " <em>Position</em> ".$v['ctxloop'] : "";
		$str_html .= (isset($v['ctxelem'])) ? " <em>Element</em> ".$v['ctxelem']."<br />".PHP_EOL : PHP_EOL;
		//
		$str_html .= (isset($v['ik401'])) ?  "Data Element <em>element</em> ".$v['ik401'] : "";
		$str_html .= (isset($v['ik402'])) ?  " <em>ref</em> ".$v['ik402'] : "";
		$str_html .= (isset($v['ik403'])) ?  " <em>code</em> ".$v['ik403'] : "";
		$str_html .= (isset($v['ik404'])) ?  " <em>data</em> ".$v['ik404'] : "";
		$str_html .= (isset($v['ik403'])) ? "<br />".$v['ik403']." ".edih_997_code_text('ak403',$v['ik403'])."<br />" : "";
		//
		$str_html .= (isset($v['ik501']) && $v['ik501']) ?  "<em>Status</em> ".$v['ik501']." ".edih_997_code_text('ak501',$v['ik501'])."<br />" : "";
		$str_html .= (isset($v['ik502']) && $v['ik502']) ?  " <em>code</em> ".$v['ik502']." ".edih_997_code_text('ak502',$v['ik502'])."<br />" : "";
		$str_html .= (isset($v['ik503']) && $v['ik503']) ?  " <em>code</em> ".$v['ik503']." ".edih_997_code_text('ak502',$v['ik503'])."<br />" : "";
		$str_html .= (isset($v['ik504']) && $v['ik504']) ?  " <em>code</em> ".$v['ik504']." ".edih_997_code_text('ak502',$v['ik504'])."<br />" : "";
		$str_html .= (isset($v['ik505']) && $v['ik505']) ?  " <em>code</em> ".$v['ik505']." ".edih_997_code_text('ak502',$v['ik505'])."<br />" : "";
		//
		$str_html .= "</p>".PHP_EOL;		
	}
	return $str_html;
}

/**
 * Main function in this script
 *
 * @uses csv_check_x12_obj()
 * @uses edih_997_errdata()
 * @uses edih_997_err_report()
 * 
 * @param string
 * @return string
 */							
function edih_997_error($filepath) {
	//
	$html_str = '';
	//
	$obj997 = csv_check_x12_obj($filepath, 'f997');
	if ($obj997 && ('edih_x12_file' == get_class($obj997))) {
		$data = edih_997_errdata($obj997);
		$html_str .= edih_997_err_report($data);
	} else {
		$html_str .= "<p>Error: invalid file path</p>".PHP_EOL;
		csv_edihist_log("edih_997_error: invalid file path $filepath");
	}
	return $html_str;
}




	
