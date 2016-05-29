<?php
/*
 * edih_csv_data.php
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
 *
 * @link: http://www.open-emr.org
 * @package ediHistory
 */

// functions to parse csv data from files
//require_once("$srcdir/edihistory_v2/test_edih_csv_parse.php");
//require_once("$srcdir/edihistory_v2/test_edih_csv_inc.php");



/**
 * Display csv table data in an HTML table for newly processed files
 * 
 * This function uses the csv table header row to order the csv data
 * The data array should be file table rows and claim table rows,
 * and have this structure:
 *    array[icn]['type'] => x12 type
 *    array[icn]['file'][i][array( --- data row---) ]      
 *    array[icn]['claim'][i][array( --- data row---) ]  
 * 
 * @uses csv_table_header()
 * @uses csv_thead_html()
 * @param array
 * @param bool
 * @return string
 */

/* *****************
function edih_csv_process_html($data_ar, $err_only=false) {
	//
	$str_html = '';
	$clm_html = '';
	//$dtl = ($err_only) ? "Errors only" : "All claims";
	//
	// debug
	$dbg_str = 'edih_csv_process_html: data_ar'.PHP_EOL;
	foreach($data_ar as $icn=>$csvdata) {
		$dbg_str .= $icn.' csvdata '.$csvdata['type'].' files '.count($csvdata['file']).' claims '.count($csvdata['claim']).PHP_EOL;
	}
	csv_edihist_log($dbg_str);
	//
	foreach ($data_ar as $icn=>$csvdata) {
		if ( array_key_exists('type', $csvdata) ) {
			$ft = $csvdata['type'];
		} else {
			$str_html .= 'edih_csv_process_html() for '.$icn.' did not get type value';
			csv_edihist_log('edih_csv_process_html: for '.$icn.' did not get type value');
			return $str_html;
		}
		if ( array_key_exists('file', $csvdata) ) {
			//
			//$hvals = csv_table_header($ft, 'file');
			//$col_ct = count($hvals); 
			// cols=$col_ct <caption>$ft Files Summary</caption>
			$str_html .= "<table class='$ft'>".PHP_EOL;
			$str_html .= csv_thead_html($ft, 'file');
			$str_html .= "<tbody>".PHP_EOL;
			$fidx = 0;
			foreach($csvdata['file'] as $key=>$csvfile) {
				//
				//'f997': $hdr = array('Date', 'FileName', 'Control', 'Trace', 'RspType', 'RejCt');
				$oe = ( $fidx % 2 == 1 ) ? 'fodd' : 'feven';
				$cls = (strpos('|f837|f270|f276|f278', $ft)) ? 'sub' : 'rsp';
			//case 'f837': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'x12_partner'); break;
			//case 'ta1': $hdr = array('Date', 'FileName', 'Control', 'Trace', 'Code'); break;
			//case 'f997': $hdr = array('Date', 'FileName', 'Control', 'Trace', 'RspType', 'RejCt'); break;
			//case 'f276': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'x12_partner'); break;
			//case 'f277': $hdr = array('Date', 'FileName', 'Control', 'Accept', 'AccAmt', 'Reject', 'RejAmt'); break;
			//case 'f270': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'x12_partner'); break;
			//case 'f271': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'Denied', 'Payer'); break;
			//case 'f278': $hdr = array('Date', 'FileName', 'Control', 'TrnCount', 'Auth', 'Payer'); break;
			//case 'f835': $hdr = array('Date', 'FileName', 'Control', 'Trace', 'Claim_ct', 'Denied', 'Payer'); break;				//
				$dte = (isset($csvfile['Date'])) ? $csvfile['Date'] : '';
				$fn1 = (isset($csvfile['FileName'])) ? $csvfile['FileName'] : '';
				$ctl = (isset($csvfile['Control'])) ? $csvfile['Control'] : '';
				$clmct = (isset($csvfile['Claim_ct'])) ? $csvfile['Clain_ct'] : '';
				$trc = (isset($csvfile['Trace'])) ? $csvfile['Trace'] : '';
				$typ = (isset($csvfile['RspType'])) ? $csvfile['RspType'] : '';
				$rej = (isset($csvfile['RejCt'])) ? $csvfile['RejCt'] : '';
				//
				$str_html .= "<tr class=$oe>".PHP_EOL;
				//
				$dt_str .= ($fn1) ? "<a class='$cls' href='edih_main.php?gtbl=file&fname=$fn1&ftype=$ft&fmt=seg'>$fn1</a>" : "";
				$dt_str .= ($dte) ? " ".$dte : "";
				$dt_str .= ($clmct) ? "<em>Claims</em> ".$clmct : "";
				if ($ft == 'f997' || $ft == 'ta1') {
					$dt_str .= ($typ) ? " ".$typ : "";
					$dt_str .= ($rej) ? " ".$rej : "";
					$dt_str .= ($trc) ? " <a class='$cls' title=$trc href='edih_main.php?gtbl=file&trace=$trc&ftype=$typ'><em>trace</em></a>" : "";
				} elseif ($ft == 'f277') {
					$dt_str .= (isset($csvfile['Accept'])) ? " <em>Accpt</em> " $csvfile['Accept'] : "";
					$dt_str .= (isset($csvfile['Reject'])) ? " <em>Rej</em> ".$csvfile['Reject'] : "";
				} elseif ($ft == 'f835') {
					$dt_str .= ($trc) ? " <em>Chk</em> <a class='$cls' href='edih_main.php?gtbl=file&trace=$trc&ftype=$typ&fmt=htm'>$trc</a>" : "";
					$dt_str .= (isset($csvfile['Denied'])) ? " <em>Denied</em> " $csvfile['Denied'] : "";
					$dt_str .= (isset($csvfile['Payer'])) ? " ".$csvfile['Payer'] : "";
				}
				//
				$str_html .= "<dt class=$oe>$dt_str</dt>".PHP_EOL;
				// to make sure we have data matching column headings  FileName: fname type  Control: fname trace type
				for ($i=0; $i<$col_ct; $i++) {
					// 
					if ($hvals[$i] == 'FileName') {
						$str_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&fname=$fn1&ftype=$ft&fmt=seg'>$fn1</a></td>".PHP_EOL;
					} elseif ($hvals[$i] == 'Control') {
						$str_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&icn=$ctl&ftype=$ft'>$ctl</a></td>".PHP_EOL;
					} elseif ($hvals[$i] == 'Trace') {
						$str_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&trace=$trc&ftype=$typ'>$trc</a></td>".PHP_EOL;
					} elseif ($ft == 'f835' && $hvals[$i] == 'Claim_ct') {
						$str_html .= "<td>{$csvfile[$hvals[$i]]} <a class='sub' href='edih_main.php?tracecheck=$trc&ckprocessed=yes'>P?</a></td>".PHP_EOL;
					} else {
						$str_html .= "<td>{$csvfile[$hvals[$i]]}</td>";
					}
				}
				$str_html .= PHP_EOL."</tr>".PHP_EOL;
				$fidx++;
			}
			$str_html .= PHP_EOL."</tbody>".PHP_EOL;
		}
		//
		// handle the claim array
		if ( array_key_exists('claim', $csvdata) ) {
			$hvals = csv_table_header($ft, 'claim');
			$col_ct = count($hvals);
			$tcls = 'c'.$ft;
			//<caption>$ft Claims ($dtl)</caption>
			//$clm_html = "</tbody></table>".PHP_EOL;
			$clm_html .= "<table class='$tcls' cols='$col_ct'>".PHP_EOL;
			$clm_html .= csv_thead_html($ft, 'claim');
			$clm_html .= "<tbody>".PHP_EOL;
			//
			$cidx = 0;
			$errct = 0;
			//
			foreach($csvdata['claim'] as $csvclaim) {
				if ($err_only) {
					// output err_only is when claim status is a rejected type or payment amount is 0
					if ( strpos('|f835|era', $ft) ) {
						if ( !in_array($csvclaim['Status'], array('4', '22', '23')) ) { continue; }
					}
					if ( strpos('|f277', $ft) && strpos('|A1|A2|A5', $csvclaim['Status']) ) { continue; }
					if ( strpos('|f997|f999|f271', $ft) && $csvclaim['Status'] == "A") { continue; }
					if ( strpos('|f837|f270|f276', $ft) ) { continue; }
				} 
				//
				$errct++;
				//
			//case 'f837': $hdr = array('PtName', 'SvcDate', 'CLM01', 'InsLevel', 'Control', 'FileName', 'Fee', 'PtPaid', 'Provider' ); break;
			//case 'f997': $hdr = array('PtName', 'RspDate', 'Trace', 'Status', 'Control', 'FileName', 'RspType', 'err_seg'); break;
			//case 'f276': $hdr = array('PtName', 'ReqDate', 'CLM01', 'ClaimID', 'BHT03', 'FileName', 'Payer', 'Trace'); break;
			//case 'f277': $hdr = array('PtName', 'SvcDate', 'CLM01', 'Status', 'BHT03', 'FileName', 'Payer', 'Trace'); break;
			//case 'f270': $hdr = array('PtName', 'ReqDate', 'Trace', 'InsBnft', 'BHT03', 'FileName', 'Payer'); break;
			//case 'f271': $hdr = array('PtName', 'RspDate', 'Trace', 'Status', 'BHT03', 'FileName', 'Payer'); break;
			//case 'f278': $hdr = array('PtName', 'FileDate', 'Trace', 'Status', 'BHT03', 'FileName', 'Auth', 'Payer'); break;
			//case 'f835': $hdr = array('PtName', 'SvcDate', 'CLM01', 'Status', 'Trace', 'FileName', 'ClaimID', 'Pmt', 'PtResp', 'Payer'); break;
		//}
				$ptn = (isset($csvclaim['PtName'])) ? $csvclaim['PtName'] : '';
				$fn1 = (isset($csvclaim['FileName'])) ? $csvclaim['FileName'] : '';
				$ctl = (isset($csvclaim['Control'])) ? $csvclaim['Control'] : '';
				$pid = (isset($csvclaim['CLM01'])) ? $csvclaim['CLM01'] : '';
				$sts = (isset($csvclaim['Status'])) ? $csvclaim['Status'] : '';
				$err = (isset($csvclaim['err_seg'])) ? $csvclaim['err_seg'] : '';
				$trc = (isset($csvclaim['Trace'])) ? $csvclaim['Trace'] : '';
				$bht03 = (isset($csvclaim['BHT03'])) ? $csvclaim['BHT03'] : '';
				$pay = (isset($csvclaim['Payer'])) ? $csvclaim['Payer'] : '';	
				$typ = (isset($csvfile['RspType'])) ? $csvclaim['RspType'] : '';
				$auth = (isset($csvfile['Auth'])) ? $csvclaim['Auth'] : '';
				//	
				$ins = (isset($csvfile['InsBnft'])) ? $csvclaim['InsBnft']	 : '';
				$ins = (isset($csvfile['InsLevel'])) ? $csvclaim['InsLevel'] : $ins;
				//
				$dte = (isset($csvclaim['SvcDate'])) ? $csvclaim['SvcDate'] : '';
				$dte = (isset($csvclaim['ReqDate'])) ? $csvclaim['ReqDate'] : $dte;
				$dte = (isset($csvclaim['RspDate'])) ? $csvclaim['RspDate'] : $dte;
				$dte = (isset($csvclaim['FileDate'])) ? $csvclaim['FileDate'] : $dte;
				
				$dd_str .= ($ptn) ? $ptn.' ' : '';
				$dd_str .= ($dte) ? $dte.' ' : '';
				if (strpos('|f277|f276|f270|f271|f278', $ft)) {
					$dd_str .= ($bht03) ? "<em>view</em> <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=htm'>H</a> <a class='seg' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=seg'>T</a>" : "";
					$dd_str .= ($pid) ? "<a class='sub' href='edih_main.php?gtbl=claim&rsptype=f837&trace=$pid&fmt=seg'>$pid</a>" : "";
					$dd_str .= ($auth && $auth == 'Rsp' || $auth == 'Reply') ?  "<a class='sub' href='edih_main.php?gtbl=claim&rsptype=f278&trace=$trc&fmt=seg'><em>trace</em></a>" : "";
				} elseif ($ft == 'f835') {
					$dd_str .= ($pid) ? "$pid <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=htm'>H</a> <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=seg'>T</a>" : "";
					$dd_str .= ($ins) ? "<em>InsLevel</em> $ins" : "";
				}  elseif ($ft == 'f997') {
					$dd_str .= ($trc) ? " <a class='$cls' title='$trc' href='edih_main.php?gtbl=claim&trace=$trc&rsptype=$typ&errseg=$err&fmt=seg'><em>trace</em></a>" : "";
					$dd_str .= ($err) ? " $err" : "";
				} else {
					$dd_str .= ($pid) ? "<a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=seg'>$pid</a>" : "";
				}
				$dd_str .= ($fn1) ? " <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&fmt=htm'>$fn1</a>";
				//
				$oe = ( $cidx % 2 ) ? 'codd' : 'ceven';
				$cidx++;
				//
				$clm_html .= "<dd class='$oe'>$dd_str</dd>".PHP_EOL;
				//
				
				$cls = (strpos('|f837|f270|f276|f278', $ft)) ? 'sub' : 'rsp';
				//
				$clm_html .= "<tr class='$oe'>".PHP_EOL;
				//
				for ($i=0; $i<$col_ct; $i++) {
					//
					if ($hvals[$i] == 'FileName') {						
						$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&fmt=htm'>".$fn1."</a></td>";
					} elseif ($hvals[$i] == 'Control') {						
						$clm_html .= "<td><a class='seg' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&icn=$ctl&fmt=seg'>".$ctl."</a></td>";
					} elseif ($hvals[$i] == 'CLM01') {
						if ($ft == 'f277') {
							$clm_html .= "<td>$sts <a class='sub' href='edih_main.php?gtbl=claim&rsptype=f837&trace=$pid&fmt=seg'>$pid</a></td>";
						} else {						
							$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid'>$pid</a></td>";
						}
					} elseif ($hvals[$i] == 'Status') {						
						if ( strpos('|f997|999', $ft) ) {
							$clm_html .= ($sts=='A') ?"<td>$sts</td>" : "<td class='reject'>".$sts."</td>";
						} else {
							$clm_html .= "<td>$sts <a class='sub' href='edih_main.php?gtbl=claim&fname=$fn1&rsptype=f837&trace=$pid&summary=yes'>S</a>&nbsp; <a href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&summary=no'>D</a></td>".PHP_EOL;
						}
					} elseif ($hvals[$i] == 'Trace') {
						if ( strpos('|f997|999', $ft) ) {
							$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&trace=$trc&rsptype=$typ&ftype=$ft'>$trc</a></td>";
						} elseif ($ft == 'f277') {
							$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&trace=$trc&rsptype=f276&ftype=$ft'>$trc</a></td>";
						} elseif ($ft == 'f271') {
							$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&trace=$trc&rsptype=f270&ftype=$ft'>$trc</a></td>";
						} else {
							$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&trace=$trc'>$trc</a></td>";
						}
					} elseif ($hvals[$i] == 'BHT03') {
						$clm_html .= "<td>$bht03 <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=htm'>H</a> <a class='seg' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=seg'>T</a></td>";
					} elseif ($hvals[$i] == 'err_seg') {
						$clm_html .= "<td><a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&trace=$trc&rsptype=$typ&err=$err><abbr title='$err'>".substr($err, 0, 7)."</abbr></a></td>".PHP_EOL;
					} else {
						$clm_html .= "<td>{$csvclaim[$hvals[$i]]}</td>".PHP_EOL;
					}
				}
			}
			$clm_html .= "</tr>".PHP_EOL;		
		}
		$clm_html .= "</tbody>".PHP_EOL."</table>".PHP_EOL;	
		//
		if ($err_only) {
			if ($errct) { $str_html .= $clm_html; }
		} else {
			$str_html .= $clm_html;
		}						
	}  // end foreach ($data_ar as $icn=>$csvdata) 
	//
	return $str_html;
}
**************/

/**
 * Display csv table data in an HTML table for newly processed files
 * 
 * This function uses the csv table header row to order the csv data
 * The data array should be file table rows and claim table rows,
 * and have this structure:
 *    array[icn]['type'] => x12 type
 *    array[icn]['file'][i][array( --- data row---) ]      
 *    array[icn]['claim'][i][array( --- data row---) ]  
 * 
 * @uses csv_table_header()
 * @uses csv_thead_html()
 * @param array
 * @param bool
 * @return string
 */
function edih_csv_process_html($data_ar, $err_only=false) {
	//
	$str_html = '';
	$clm_html = '';
	//$dtl = ($err_only) ? "Errors only" : "All claims";
	//
	// debug
	$dbg_str = 'edih_csv_process_html: data_ar with err '.strval($err_only).PHP_EOL;
	foreach($data_ar as $icn=>$csvdata) {
		$dbg_str .= $icn.' csvdata '.$csvdata['type'].' files '.count($csvdata['file']).' claims '.count($csvdata['claim']).PHP_EOL;
	}
	csv_edihist_log($dbg_str);
	//
	foreach ($data_ar as $icn=>$csvdata) {
		if ( array_key_exists('type', $csvdata) ) {
			$ft = $csvdata['type'];

		} else {
			$str_html .= 'edih_csv_process_html() for '.$icn.' did not get type value';
			csv_edihist_log('edih_csv_process_html: for '.$icn.' did not get type value');
			return $str_html;
		}
		//
		$cls = (strpos('|f837|f270|f276|f278', $ft)) ? 'sub' : 'rsp';
		//
		if ( array_key_exists('file', $csvdata) ) {
			//
			$fidx = 0;
			foreach($csvdata['file'] as $key=>$csvfile) {
				//
				$oe = ( $fidx % 2 == 1 ) ? 'fodd' : 'feven';
				$cls = (strpos('|f837|f270|f276|f278', $ft)) ? 'sub' : 'rsp';
				//
				$dt_str = "";
				//
				$dte = (isset($csvfile['Date'])) ? $csvfile['Date'] : '';
				$fn1 = (isset($csvfile['FileName'])) ? $csvfile['FileName'] : '';
				$ctl = (isset($csvfile['Control'])) ? $csvfile['Control'] : '';
				$clmct = (isset($csvfile['Claim_ct'])) ? $csvfile['Claim_ct'] : '';
				$trc = (isset($csvfile['Trace'])) ? $csvfile['Trace'] : '';
				$typ = (isset($csvfile['RspType'])) ? $csvfile['RspType'] : '';
				$rej = (isset($csvfile['RejCt'])) ? $csvfile['RejCt'] : '';
				//
				$dt_str .= ($fn1) ? "<a class='$cls' href='edih_main.php?gtbl=file&fname=$fn1&ftype=$ft&fmt=seg'>$fn1</a>&nbsp;" : "";
				$dt_str .= ($dte) ? " &nbsp;".substr($dte,0,4)."-".substr($dte,4,2)."-".substr($dte,6,2) : "";
				$dt_str .= ($clmct) ? " &nbsp;<em>Claims</em> ".$clmct : "";
				if ($ft == 'f997' || $ft == 'ta1') {
					$dt_str .= ($typ) ? " &nbsp;".$typ : "";
					$dt_str .= ($rej) ? " &nbsp;".$rej : "";
					$dt_str .= ($trc) ? "&nbsp; <a class='$cls' title=$trc href='edih_main.php?gtbl=file&trace=$trc&ftype=$typ'><em>trace</em></a>&nbsp;" : "";
				} elseif ($ft == 'f277') {
					$dt_str .= (isset($csvfile['Accept'])) ? " &nbsp;<em>Accpt</em> ".$csvfile['Accept'] : "";
					$dt_str .= (isset($csvfile['Reject'])) ? " &nbsp;<em>Rej</em> ".$csvfile['Reject'] : "";
				} elseif ($ft == 'f835') {
					$dt_str .= (isset($csvfile['Denied'])) ? " &nbsp;<em>Denied</em> ".$csvfile['Denied'] : "";
					$dt_str .= ($trc) ? " &nbsp;<em>Chk</em> <a class='$cls' href='edih_main.php?gtbl=file&trace=$trc&ftype=$ft&fmt=htm'>$trc</a>&nbsp;" : "";
					$dt_str .= (isset($csvfile['Payer'])) ? " &nbsp;".$csvfile['Payer'] : "";
				}
				//
				$str_html .= "<dt class=$oe>$dt_str</dt>".PHP_EOL;
				$fidx++;
			}
		}
		// &nbsp;&nbsp;
		// handle the claim array
		if ( array_key_exists('claim', $csvdata) ) {
			//
			$cidx = 0;
			$errct = 0;
			//
			foreach($csvdata['claim'] as $claim) {
				if ($err_only) {
					// output err_only is when claim status is a rejected type
					if ($ft == 'f835') {
						if ( !in_array($claim['Status'], array('4', '22', '23', '25')) ) {
							continue;
						}
					} elseif ($ft == 'f277') {
						if (substr_count($claim['Status'],'A1') || substr_count($claim['Status'],'A2') || substr_count($claim['Status'],'A5')) {
							continue;
						}
					} elseif (strpos('|f997|f999|f271', $ft) && $claim['Status'] == 'A') {
						continue;
					} elseif ( strpos('|f837|f270|f276', $ft) ) {
						continue;
					}
				} 
				//
				$errct++;
				$dd_str = "";
				$oe = ( $errct % 2 ) ? 'codd' : 'ceven';
				//
				$ptn = (isset($claim['PtName'])) ? $claim['PtName'] : '';
				$fn1 = (isset($claim['FileName'])) ? $claim['FileName'] : '';
				$ctl = (isset($claim['Control'])) ? $claim['Control'] : '';
				$pid = (isset($claim['CLM01'])) ? $claim['CLM01'] : '';
				$sts = (isset($claim['Status'])) ? $claim['Status'] : '';
				$err = (isset($claim['err_seg'])) ? $claim['err_seg'] : '';
				$trc = (isset($claim['Trace'])) ? $claim['Trace'] : '';
				$bht03 = (isset($claim['BHT03'])) ? $claim['BHT03'] : '';
				$pay = (isset($claim['Payer'])) ? $claim['Payer'] : '';	
				$typ = (isset($csvfile['RspType'])) ? $claim['RspType'] : '';
				$auth = (isset($csvfile['Auth'])) ? $claim['Auth'] : '';
				//	
				$ins = (isset($csvfile['InsBnft'])) ? $claim['InsBnft']	 : '';
				$ins = (isset($csvfile['InsLevel'])) ? $claim['InsLevel'] : $ins;
				//
				$clm = (isset($csvfile['ClaimID'])) ? $claim['ClaimID'] : $ins;
				//
				$dte = (isset($claim['SvcDate'])) ? $claim['SvcDate'] : '';
				$dte = (isset($claim['ReqDate'])) ? $claim['ReqDate'] : $dte;
				$dte = (isset($claim['RspDate'])) ? $claim['RspDate'] : $dte;
				$dte = (isset($claim['FileDate'])) ? $claim['FileDate'] : $dte;
				
				$dd_str .= ($ptn) ? $ptn."&nbsp; " : "";
				$dd_str .= ($dte) ? " &nbsp;".substr($dte,0,4)."-".substr($dte,4,2)."-".substr($dte,6,2) : "";
				if (strpos('|f277|f276|f270|f271|f278', $ft)) {
					$dd_str .= ($sts) ? " &nbsp;$sts" : "";
					$dd_str .= ($ins) ? " &nbsp;$ins" : "";
					$dd_str .= ($clm) ? " &nbsp;$clm" : ""; 
					$dd_str .= ($bht03) ? " &nbsp;<em>view</em> <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=htm'>H</a>&nbsp; <a class='seg' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&bht03=$bht03&fmt=seg'>T</a>&nbsp;" : "";
					$dd_str .= ($pid) ? " &nbsp;<em>trace</em> <a class='sub' href='edih_main.php?gtbl=claim&rsptype=f837&trace=$pid&fmt=seg'>$pid</a>" : "";
					$dd_str .= ($auth && $auth == 'Rsp' || $auth == 'Reply') ?  "<a class='sub' href='edih_main.php?gtbl=claim&rsptype=f278&trace=$trc&fmt=seg'><em>trace</em></a>" : "";
				} elseif ($ft == 'f835') {
					$dd_str .= ($clm) ? " &nbsp;<em>Claim ID</em> $ins" : "";
					$dd_str .= ($ins) ? " &nbsp;<em>InsLevel</em> $ins" : ""; 
					$dd_str .= ($pid) ? " &nbsp;$pid <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=htm'>H</a> <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=seg'>T</a>" : "";
				}  elseif ($ft == 'f997') {
					$dd_str .= ($trc) ? " &nbsp;<a class='$cls' title='$trc' href='edih_main.php?gtbl=claim&trace=$trc&rsptype=$typ&errseg=$err&fmt=seg'><em>trace</em></a>" : "";
					$dd_str .= ($err) ? " &nbsp;".substr($err, 0, 8) : "";
				} else {
					$dd_str .= ($pid) ? " &nbsp;<a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn1&ftype=$ft&pid=$pid&fmt=seg'>$pid</a>" : "";
				}
				$dd_str .= ($fn1) ? " &nbsp;<a class='$cls' title='$fn1' href='edih_main.php?gtbl=file&fname=$fn1&ftype=$ft&fmt=htm'><em>file</em></a>" : "";
				//
				$clm_html .= "<dd class='$oe'>$dd_str</dd>".PHP_EOL;
				//
			}		
		}
		//
		if ($err_only) {
			if ($errct) { $str_html .= $clm_html; }
		} else {
			$str_html .= $clm_html;
		}						
	}  // end foreach ($data_ar as $icn=>$csvdata) 
	//
	return $str_html;
}


function edih_list_denied_claims($filetype, $filename, $trace='') {
	//
	$str_html = '';
	$row_ar = array();
	//
	$ft = csv_file_type($filetype);
	if (strpos('|f271|f277|f835', $ft)) {
		$row_ar = csv_denied_by_file($ft, $filename, $trace);
	} else {
		$str_html .= "Invalid file type $filetype for denied claim search<br />";
		csv_edihist_log("edih_list_denied_claims: wrong filetype $filetype");
		return $str_html;
	}
	//
	if (count($row_ar)) {
		$rw_ct = count($row_ar);
		$str_html .= "<h4>Denied/Rejected Claims Listing</h4>".PHP_EOL;
		$str_html .= "<dl>$rw_ct claims <em>File</em> $filename ";
		$str_html .= ($trace) ? "<em>Trace</em> $trace</dl>".PHP_EOL : "".PHP_EOL;
		if ($ft == 'f835') {
			foreach($row_ar as $row) {
				$str_html .= "<dt>{$row[0]} <a class='rsp' href='edih_main.php?gtbl=claim&fname={$row[5]}&ftype=$ft&pid={$row[2]}&fmt=htm'>{$row[2]}</a></dt>".PHP_EOL;
			}
		} elseif ($ft == 'f277') {
			foreach($row_ar as $row) {
				$str_html .= "<dt>{$row[0]} <a class='rsp' href='edih_main.php?gtbl=claim&fname={$row[5]}&ftype=$ft&bht03={$row[4]}&fmt=htm'>{$row[4]}</a></dt>".PHP_EOL;
			}
		} elseif ($ft == 'f271') {
			foreach($row_ar as $row) {
				$str_html .= "<dt>{$row[0]} <a class='rsp' href='edih_main.php?gtbl=claim&fname={$row[5]}&ftype=$ft&bht03={$row[4]}&fmt=htm'>{$row[4]}</a></dt>".PHP_EOL;
			}
		} elseif ($ft == 'f997') {
			foreach($row_ar as $row) {
				//'f997': $hdr = array('PtName', 'RspDate', 'Trace', 'Status', 'Control', 'FileName', 'RspType', 'err_seg'); break;
				$str_html .= "<dt>{$row[0]} <a class='rsp' href='edih_main.php?gtbl=claim&ftype=$tp&trace={$row[2]}&rsptype={$row[6]}&err={$row[7]}'>{$row[2]}</a></dt>".PHP_EOL;
			}
		}
		//
		$str_html .= "</dl>".PHP_EOL;
	} else {
		$str_html .= "Search returned no data rows from file $filename<br />";
		csv_edihist_log("edih_list_denied_claims: no rows returned $filetype $filename $trace");
	}
	//
	return $str_html;
}
			

/**
 * check the csv claims tables and return rows for a particular encounter
 *
 * @uses csv_pid_enctr_parse()
 * @uses csv_file_with_pid_enctr()
 * @uses csv_table_select_list()
 * @uses csv_search_record()
 * @param string       encounter number
 * @return string
 */
function edih_claim_history($encounter) {
	//
	if ($encounter) {
		$e = (string)$encounter;
	} else {
		return 'invalid encounter value '.$encounter.'<br />'.PHP_EOL;
	}
	// use function csv_table_select_list() so that only
	// existing csv tables are queried
	$tbl2 = csv_table_select_list('array');
	// debug
	$dbg = '';
	foreach($tbl2 as $key=>$val) {
		$dbg .= "$key : ";
		if (is_array($val)) {
			foreach($val as $k=>$v) {
				$dbg .= "$k=>$v ";
			}
		} else {
			$dbg .= "$val ";
		}
	}
	csv_edihist_log("edih_claim_history: tbl2 $dbg");
	//
	$rtypes = array();
	if (is_array($tbl2['claims']) && count($tbl2['claims']) ) {
		$rtypes = array_keys($tbl2['claims']);
	} else {
		csv_edihist_log("csv_claim_history: failed to get csv table names");
		return "failed to get csv table names";
	}
	// debug
	$dbg = '';
	foreach($rtypes as $key=>$val) {
		$dbg .= "$key : ";
		if (is_array($val)) {
			foreach($val as $k=>$v) {
				$dbg .= "$k=>$v ";
			}
		} else {
			$dbg .= "$val ";
		}
	}
	csv_edihist_log("edih_claim_history: rtypes $dbg");
	//
	//
	$ch_html .= "<table class='clmhist' columns=4><caption>Encounter Record for $e</caption>";
	$ch_html .= "<tbody>".PHP_EOL;
	//
	if (in_array('f837', $rtypes)) {
		$tp = 'f837';
		$btar = csv_file_by_enctr($e, $tp);
		//
		if (is_array($btar) && count($btar)) {
			$ch_html .= "<tr class='chhead'>".PHP_EOL;
			$ch_html .= "<td>Name</td><td>SvcDate</td><td>CLM01</td><td>File</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
			foreach($btar as $ch) {
				$dt = substr($ch['SvcDate'], 0, 4).'-'.substr($ch['SvcDate'], 4, 2).'-'.substr($ch['SvcDate'], 6, 2);
				//array('PtName', 'SvcDate', 'CLM01', 'InsLevel', 'Control', 'FileName', 'Fee', 'PtPaid', 'Provider' );
				$ch_html .= "<tr class='ch837'>".PHP_EOL;
				//
				$ch_html .= "<td>{$ch['PtName']}</td>".PHP_EOL;
				$ch_html .= "<td>$dt</td>".PHP_EOL;
				$ch_html .= "<td><a class='seg' href='edih_main.php?gtbl=hist&fname={$ch['FileName']}&ftype=$tp&pid={$ch['CLM01']}&fmt=seg'>{$ch['CLM01']}</a></td>".PHP_EOL;
				$ch_html .= "<td title='{$ch['Control']}'><a  class='seg' href='edih_main.php?gtbl=file&fname={$ch['FileName']}&ftype=$tp&fmt=seg'>{$ch['FileName']}</a></td>".PHP_EOL;
				//
				$ch_html .= "</tr>".PHP_EOL;
			}
		} else {
			$ch_html .= "<tr class='ch837'>".PHP_EOL;
			$ch_html .= "<td colspan=4>837 Claim -- Nothing found for $pe in $tp record</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
		}
	}
	//
	if (in_array('f997', $rtypes)) {
		$tp = 'f997';
		$f997ar = csv_file_by_enctr($e, $tp);
		//
		
		if (is_array($f997ar) && count($f997ar)) {
			$ch_html .= "<tr class='chhead'>".PHP_EOL;
			$ch_html .= "<td colspan=3>Acknowledgement File</td><td>Notes</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
			foreach($f997ar as $ch)	{
				//
				$msg = strlen($ch[7]) ? $ch[7] : 'ST Number';
				//array('PtName', 'RspDate', 'Trace', 'Status', 'Control', 'FileName', 'RspType', 'err_seg');;
				$ch_html .= "<tr class='ch997'>";
				$ch_html .= "<td>Rsp Ack</td>".PHP_EOL;
				$ch_html .= "<td><a class='rsp' target='_blank' href='edih_main.php?gtbl=hist&fname={$ch['FileName']}&ftype=$tp&trace={$ch['Trace']}&rsptype={$ch['RspType']}&errseg={$ch['err_seg']}'>{$ch['Status']}</a></td>".PHP_EOL;
				$ch_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&fname={$ch['FileName']}&ftype=$tp&fmt=seg'>{$ch['FileName']}</a></td>".PHP_EOL;
				$ch_html .= "<td title='Response type/date'>{$ch['RspType']} {$ch['RspDate']}</td>".PHP_EOL;
				$ch_html .= "</tr>".PHP_EOL;
			}
		} else {
			$ch_html .= "<tr class='ch997'>";
			$ch_html .= "<td colspan=4>Ack 997/999 -- Nothing found for $pe</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
		}
	}
	//
	if (in_array('f277', $rtypes)) {
		$tp = 'f277';
		$f277ar = csv_file_by_enctr($e, $tp);
		//
		if (is_array($f277ar) && count($f277ar)) {
			$ch_html .= "<tr class='chhead'>".PHP_EOL;
			$ch_html .= "<td>Response</td><td>Status</td><td>File</td><td>ClaimID</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
			foreach($f277ar as $ch) {
				//'f277':array('PtName', 'SvcDate', 'CLM01', 'Status', 'BHT03', 'FileName', 'Payer', 'Trace'); 
				$ch_html .= "<tr class='ch277'>";
				//
				$ch_html .= "<td>Claim Status</td>".PHP_EOL;
				$ch_html .= "<td><a class='rsp' href='edih_main.php?gtbl=hist&fname={$ch['FileName']}&ftype=$tp&bht03={$ch['BHT03']}&fmt=htm'>{$ch['Status']}</a></td>".PHP_EOL;
				$ch_html .= "<td title='{$ch['FileName']}'><a href='edih_main.php?gtbl=file&fname={$ch['FileName']}&ftype=$tp&fmt=seg'>{$ch['FileName']}</a></td>".PHP_EOL;
				$ch_html .= "<td title='Payer {$ch['Payer']}'>{$ch['Trace']}</td>".PHP_EOL;
				//
				$ch_html .= "</tr>".PHP_EOL;
			}
		} else {
			$ch_html .= "<tr class='ch277'>";
			$ch_html .= "<td colspan=4>277 Status-- Nothing found for $e</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
		}
	}
	//
	if (in_array('f835', $rtypes)) {
		$tp = 'f835';
		$f835ar = csv_file_by_enctr($e, $tp);
		//
		if (is_array($f835ar) && count($f835ar)) {
			$ch_html .= "<tr class='chhead'>".PHP_EOL;
			$ch_html .= "<td>Response</td><td>Status</td><td>Trace</td><td>Payer</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
			foreach($f835ar as $ch) {
				//
				$msg = $ch['ClaimID'] .' '.$ch['Pmt'].' '.$ch['PtResp'];
				// array('PtName', 'SvcDate', 'CLM01', 'Status', 'Trace', 'FileName', 'ClaimID', 'Pmt', 'PtResp', 'Payer');
				$ch_html .= "<tr class='ch835'>";
				//
				$ch_html .= "<td>Claim Payment</td>".PHP_EOL;
				$ch_html .= "<td><a class='rsp' href='edih_main.php?gtbl=hist&fname={$ch['FileName']}&ftype=$tp&pid={$ch['CLM01']}&summary=no'>{$ch['Status']}</a></td>".PHP_EOL;
				$ch_html .= "<td><a href='edih_main.php?gtbl=file&fname={$ch['FileName']}&ftype=$tp&trace={$ch['Trace']}&fmt=htm'>{$ch['Trace']}</a></td>".PHP_EOL;
				$ch_html .= "<td title=$msg>{$ch['Payer']}</td>".PHP_EOL;
				//
				$ch_html .= "</tr>".PHP_EOL;
			}
		} else {
			$ch_html .= "<tr class='ch835'>";
			$ch_html .= "<td colspan=4>835 Payment -- Nothing found for $e</td>".PHP_EOL;
			$ch_html .= "</tr>".PHP_EOL;
		}
		//
	} // end if($tp ...
	// -- this is where a query on the payments datatable could be used to show if payment
	//    has been received, even if no era file shows the payment.
    //
    $ch_html .= "</tbody>".PHP_EOL;
    $ch_html .= "</table>".PHP_EOL;
    //
    return $ch_html;
}


/**
 * Render one of our csv record files as an html table
 *
 * This function determines the actual csv file from the file_type and the
 * csv_type.  Tthe date field of each row is checked against the optional
 * lookback period or date parameters.
 * 
 * @uses csv_file_type()
 * @uses csv_parameters()
 * @uses csv_thead_html()
 * 
 * @param string      $file_type -- see function csv_file_type()
 * @param string      $csv_type -- either "file" or "claim"
 * @param string      $period -- lookback 2 weeks, 1 month, ALL, etc
 * @param string      $datestart -- from date  CCYYMMDD
 * @param string      $dateend -- to date  CCYYMMDD
 * @return string
 */
function edih_csv_to_html($file_type, $csv_type, $period='', $datestart='', $dateend='') {
	//
	$csv_html = "";
	$modstr = '';
	$csv_d = array();
	// debug
	csv_edihist_log("edih_csv_to_html: period $period datestart $datestart dateend $dateend");
	//
	$is_date = false;
	$is_period = false;
	//
	if ($file_type && $csv_type) {
		$csv_ar = csv_assoc_array($file_type, $csv_type);
		if (is_array($csv_ar) && count($csv_ar) ) {
			$rwct = count($csv_ar);
		} else {
			csv_edihist_log("edih_csv_to_html: error opening csv file $file_type $csv_type");
			$csv_html .= "error opening csv file $file_type $csv_type<br>";
			return false;
		}
	} else {
		$csv_html .= "invalid arguments for opening csv table<br>";
		return false;
	}
		
	$tp = csv_file_type($file_type);
	if ($tp) {
		$params = csv_parameters($tp);
	} else {
		csv_edihist_log("csv_to_html error: incorrect file type $file_type");
		$csv_html .= "csv_to_html error: incorrect file type $file_type <br />".PHP_EOL;
		return false;
	}
	// csv tables date is in col 0 for file, col 5 for claim
	// file name is under FileName for all tables
	$dtcol = (strpos($csv_type, "aim")) ? $params['claimdate'] : $params['filedate'];
	$tp_lbl = (strpos($csv_type, "aim")) ? 'Claims' : 'Files';
	//
	// given dates shold be in CCYY-MM-DD or CCYY/MM/DD format
	// edih_view_v2.php is supposed to use CCYY-MM-DD
	if ( preg_match('/(19|20)\d{2}\D[01][1-9]\D[0-3][0-9]/', $datestart) ) {
		$dts = implode('', preg_split("/\D/", $datestart) );
		if ( $dateend && preg_match('/(19|20)\d{2}\D[01][1-9]\D[0-3][0-9]/', $dateend) ) {
			$dt4 = implode('', preg_split("/\D/", $dateend) );
		} else {
			$dt4 = date_create(date('Y-m-d'));
			$dte = date_format($dte, 'Ymd');
		}
		// php DateTime is poorly documented
		//
	} elseif ($period) {
		$dtstr1 = '';
		$is_period = preg_match('/\d{1,2}(?=w|m|y)/', $period, $matches);
		if ( count($matches) ) {
			$pd = $matches[0];
			$gtdt = getdate();
			$mon = (string)$gtdt['mon'];
			$day = (string)($gtdt['mday'] - $gtdt['wday'] + 1);
			$yr = (string)$gtdt['year'];
			if ( strtoupper($period) == 'ALL' ) {
				$is_period = false;
				$modstr = '';
			} elseif ( strpos($period, 'w') ) {
				// take the first character of 'period'
				$modstr = '-'.$pd.' week';			
				$dtstr1 = $mon.'/'.$day.'/'.$yr;
			} elseif ( strpos($period, 'm') ) {
				$modstr = '-'.$pd.' month';
				$dtstr1 = $mon.'/01/'.$yr;
			}  elseif ( strpos($period, 'y') ) {
				$modstr = '-'.$pd.' year';
				$dtstr1 = $mon.'/01/'.$yr;
			} else {
				csv_edihist_log("csv_to_html error: incorrect date period $period");
				return false;
			}
		}
		//
		// debug
		csv_edihist_log("edih_csv_to_html: period $period modstr $modstr dtstr1 $dtstr1");
		//
		if ($is_period && $modstr) {
			$dtpd1 = date_create( $dtstr1 );
			$dtm = date_modify($dtpd1, $modstr);
			$dtpd2 = $dtm->format('Ymd');
			$dtpdlbl = $dtm->format('Y-m-d');
		} else {
			$dtpd2 = '';
			$dtpdlbl = 'All Dates';
		}
	}
	//
	if ($is_date) {
		$isok = false;
		$idx = 0;
		foreach($csv_ar as $data) {
			$isok = (strcmp($data[$dtcol], $dts) >= 0) ? true : false;
			$isok = (strcmp($data[$dtcol], $dte) > 0) ? false : $isok;
			//
			if ($isok) { $csv_d[] = $data; }
		}
	} elseif ($is_period) {
		foreach($csv_ar as $data) {
			if (strcmp($data[$dtcol], $dtpd2) > 0) { $csv_d[] = $data; }
		}
	} else {
		$csv_d = &$csv_ar;
	}
	//
	$ln_ct = count($csv_d);
	//
	if ($is_date) {
		//$csv_html .= "<div id='dttl'>".PHP_EOL;
		$csv_html .= "<h4>Table: $tp_lbl &nbsp;$tp &nbsp; Start: $datestart &nbsp; End: $dateend &nbsp;Rows: $rwct &nbsp;Shown: $ln_ct</h4>".PHP_EOL;
		//$csv_html .= "</div>".PHP_EOL;
	} elseif ($is_period) {
		//div id='dttl'></div>
		$csv_html .= "<h4>Table: $tp_lbl &nbsp;$tp &nbsp;From Date: $dtpdlbl &nbsp;Rows: $rwct &nbsp;Shown: $ln_ct</h4>".PHP_EOL;
	} else {
		//<div id='dttl'></div>
		$csv_html .= "<h4>Table: $tp_lbl &nbsp;$tp &nbsp;All Dates Rows: $rwct &nbsp; Shown: $ln_ct</h4>".PHP_EOL;
	}
	//
	//$csv_html .= "<table id='csvTable' class='csvDisplay'>".PHP_EOL;
	$csv_html .= "<table id='csvTable' class='display'>".PHP_EOL;
	$csv_html .= csv_thead_html($tp, $csv_type);
	$csv_html .= "<tbody>".PHP_EOL;
	//
	// now create the body of the table
	//
	$cls = (strpos('|f837|f270|f276|f278', $tp)) ? 'sub' : 'rsp';
	//
	$idx = 0;					
	if ($csv_type == 'file') {
		//	
		if ($tp == 'f835') {
			//array('Date', 'FileName', 'Control', 'Trace', 'Claim_ct', 'Denied', 'Payer')
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				foreach($val as $k=>$v) {
					if ($k == 'Date') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$fn = $v;
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Control') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&icn=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Trace') {
						$trc = $v;
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&trace=$v&ftype=$tp&fmt=htm'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Claim_ct') {
						$csv_html .= "<td>$v <a class='sub' href='edih_main.php?tracecheck=$trc&ckprocessed=yes'><em>P?</em></a></td>".PHP_EOL;
					} elseif ($k == 'Denied') {
						if ((int)$v > 0) {
							$csv_html .= "<td><a class='sub' href='edih_main.php?chkdenied=yes&fname=$fn&ftype=$tp&trace=$trc'>$v</a></td>".PHP_EOL;
						} else {
							$csv_html .= "<td>$v</td>".PHP_EOL;
						}
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		} elseif ($tp == 'f997') {	
			//array('Date', 'FileName', 'Control', 'Trace', 'RspType', 'RejCt')
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				//
				$rsp = $val['RspType'];
				foreach($val as $k=>$v) {
					if ($k == 'Date') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$fn = $v;
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Trace') {						
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&trace=$v&ftype=$tp&rsptype=$rsp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'RejCt') {
						if ((int)$v > 0) {
							$csv_html .= "<td><a class='sub' href='edih_main.php?chkdenied=yes&fname=$fn&ftype=$tp'>$v</a></td>".PHP_EOL;
						} else {
							$csv_html .= "<td>$v</td>".PHP_EOL;
						}
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
			//
		} else {
			// the generic case -- for 'file' type tables
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				foreach($val as $k=>$v) {
					if ($k == 'Date') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=htm'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Control') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&icn=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Reject') {
						if ((int)$v > 0) {
							$csv_html .= "<td><a class='sub' href='edih_main.php?&chkdenied=yes&fname={$val['FileName']}&ftype=$tp'>$v</a></td>".PHP_EOL;
						} else {
							$csv_html .= "<td>$v</td>".PHP_EOL;
						}
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		}
	} elseif ($csv_type == 'claim') {
		//
		if ($tp == 'f837') {
			// array('PtName', 'SvcDate', 'CLM01', 'InsLevel', 'Control', 'FileName', 'Fee', 'PtPaid', 'Provider' );
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];
				foreach($val as $k=>$v) {
					if ($k == 'CLM01') {
						$csv_html .= "<td><a class='sub' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&pid=$v'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'SvcDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		} elseif ($tp == 'f835') {
			// array('PtName', 'SvcDate', 'CLM01', 'Status', 'Trace', 'FileName', 'ClaimID', 'Pmt', 'PtResp', 'Payer')
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$pid = $val['CLM01'];
				foreach($val as $k=>$v) {
					if ($k == 'SvcDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'CLM01') {
						$csv_html .= "<td>$v <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&pid=$pid&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='seg' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&pid=$pid&fmt=seg'>T</a></td>".PHP_EOL;
					} elseif ($k == 'Trace') {
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&trace=$v&ftype=$tp&fmt=htm'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td title='$v'><a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=seg'>T</a></td>".PHP_EOL;
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		} elseif ($tp == 'f277') {
			// array('PtName', 'SvcDate', 'CLM01', 'Status', 'BHT03', 'FileName', 'Payer', 'Ins_ID', 'Trace');
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='{$bgc}'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$bht03 = $val['BHT03'];
				$trc = $val['CLM01'];
				foreach($val as $k=>$v) {
					if ($k == 'SvcDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'CLM01') {
						$csv_html .= "<td><a class='sub' href='edih_main.php?gtbl=claim&trace=$v&ftype=$tp&rsptype=f837&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'BHT03') {
						$csv_html .= "<td>$v <a class='rsp' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='seg' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=seg'>T</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td title='$v'>File <a class='rsp' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='seg' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>T</a></td>".PHP_EOL;
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}					
		} elseif ($tp == 'f276') {
			// array('PtName', 'ReqDate', 'CLM01', 'InsBnft', 'BHT03', 'FileName', 'Payer', 'Trace'); 
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$bht03 = $val['BHT03'];
				$trc = $val['CLM01'];
				foreach($val as $k=>$v) {
					if ($k == 'ReqDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'CLM01') {
						$csv_html .= "<td><a class='sub' href='edih_main.php?gtbl=claim&trace=$v&ftype=$tp&rsptype=f837&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'BHT03') {
						$csv_html .= "<td>$v <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='seg' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=seg'>T</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}		
		} elseif ($tp == 'f270') {
			// array('PtName', 'ReqDate', 'Trace', 'InsBnft', 'BHT03', 'FileName', 'Payer'); 
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$bht03 = $val['BHT03'];
				foreach($val as $k=>$v) {
					if ($k == 'ReqDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'BHT03') {
						$csv_html .= "<td> <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}							
		} elseif ($tp == 'f271') {
			// array('PtName', 'RspDate', 'Trace', 'Status', 'BHT03', 'FileName', 'Payer'); 
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$bht03 = $val['BHT03'];
				foreach($val as $k=>$v) {
					if ($k == 'RspDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'BHT03') {
						$csv_html .= "<td>$v <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=htm'>H</a>&nbsp;".PHP_EOL;
						$csv_html .= "&nbsp;<a class='seg' target='_blank' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=seg'>T</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td title='$v'> File <a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=htm'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='$cls' href='edih_main.php?gtbl=file&fname=$fn&ftype=$tp&fmt=seg'>T</a></td>".PHP_EOL;
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}					
		} elseif ($tp == 'f278') {
			// array('PtName', 'FileDate', 'Trace', 'Status', 'BHT03', 'FileName', 'Auth', 'Payer')
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];				
				$bht03 = $val['BHT03'];
				foreach($val as $k=>$v) {
					if ($k == 'FileDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'BHT03') {
						$csv_html .= "<td>$v <a class='$cls' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=htm'>H</a>&nbsp;".PHP_EOL;
						$csv_html .= "&nbsp;<a class='seg' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&bht03=$v&fmt=seg'>T</a></td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td title='$v'> File <a class='$cls' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>H</a>&nbsp;";
						$csv_html .= "&nbsp;<a class='$cls' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>H</a></td>".PHP_EOL;
					}  else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}						
		} elseif ($tp == 'f997') {
			// array('PtName', 'RspDate', 'Trace', 'Status', 'Control', 'FileName', 'RspType', 'err_seg');
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				// needed values for links
				$fn = $val['FileName'];
				$rsp = $val['RspType'];				
				$err = $val['err_seg'];
				foreach($val as $k=>$v) {
					if ($k == 'RspDate') {
						$csv_html .= "<td>".substr($v, 0, 4).'-'.substr($v, 4, 2).'-'.substr($v, 6, 2)."</td>".PHP_EOL;
					} elseif ($k == 'FileName') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'Trace') {
						$csv_html .= "<td><a class='seg' href='edih_main.php?gtbl=claim&fname=$fn&ftype=$tp&trace=$v&rsptype=$rsp&err=$err&fmt=seg'>$v</a></td>".PHP_EOL;
					} elseif ($k == 'err_seg') {
						$csv_html .= "<td>".substr($v, 0, 8)." ...</td>".PHP_EOL;
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		} else {
			// all types in the tables are covered in an elseif, so this is unexpected
			foreach($csv_d as $val) {
				$bgc = ($idx % 2 == 1 ) ? 'odd' : 'even';
				$csv_html .= "<tr class='$bgc'>".PHP_EOL;
				foreach($val as $k=>$v) {
					if ($k == 'FileName') {
						$csv_html .= "<td><a class='$cls' href='edih_main.php?gtbl=file&fname=$v&ftype=$tp&fmt=seg'>$v</a></td>".PHP_EOL;
					} else {
						$csv_html .= "<td>$v</td>".PHP_EOL;
					}
				}
				$csv_html .= "</tr>".PHP_EOL;
				$idx++;
			}
		}
	} // end body of the table
	//$csv_html .= "</tbody>".PHP_EOL."</table>".PHP_EOL."</div>".PHP_EOL;
	$csv_html .= "</tbody>".PHP_EOL."</table>".PHP_EOL;
	//
	return $csv_html;
}


