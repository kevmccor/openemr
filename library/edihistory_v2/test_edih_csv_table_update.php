<?php



require_once('test_edih_csv_inc.php');
require_once('test_edih_csv_data.php');


/**
 *   old table headings

	// dataTables: | 'date' | 'file_name (link)' | 'file_text (link fmt)' | 'claim_ct' | 'reject_ct' |
	$csv_hd_ar['ack']['file'] = array('Date', 'FileName', 'isa13', 'ta1ctrl', 'Code');
	$csv_hd_ar['ebr']['file'] = array('Date', 'FileName', 'clrhsid', 'claim_ct', 'reject_ct', 'Batch');
	$csv_hd_ar['ibr']['file'] = array('Date', 'FileName', 'clrhsid', 'claim_ct', 'reject_ct', 'Batch');
	//
	// dataTables: | 'date' | 'file_name (link)' | 'file_text (link fmt)' | 'claim_ct' | 'partner' |
	$csv_hd_ar['batch']['file'] = array('Date', 'FileName', 'Ctn_837', 'claim_ct', 'x12_partner');
	$csv_hd_ar['ta1']['file'] =   array('Date', 'FileName', 'Ctn_ta1', 'ta1ctrl', 'Code');
	$csv_hd_ar['f997']['file'] =  array('Date', 'FileName', 'Ctn_999', 'ta1ctrl', 'RejCt');
	$csv_hd_ar['f277']['file'] =  array('Date', 'FileName', 'Ctn_277', 'Accept', 'AccAmt', 'Reject', 'RejAmt');
	$csv_hd_ar['f270']['file'] =  array('Date', 'FileName', 'Ctn_270', 'claim_ct', 'x12_partner');
	$csv_hd_ar['f271']['file'] =  array('Date', 'FileName', 'Ctn_271', 'claim_ct', 'Denied', 'Payer');
	$csv_hd_ar['era']['file'] =   array('Date', 'FileName', 'Trace', 'claim_ct', 'Denied', 'Payer');
	//
	// dataTables: | 'pt_name' | 'svc_date' | 'clm01 (link clm)' | 'status (mouseover)' | b f t (links to files) | message (mouseover) |
	$csv_hd_ar['ebr']['claim'] = array('PtName','SvcDate', 'clm01', 'Status', 'Batch', 'FileName', 'Payer');
	$csv_hd_ar['ibr'][array('Date', 'FileName', 'Trace', 'claim_ct', 'Denied', 'Payer');'claim'] = array('PtName','SvcDate', 'clm01', 'Status', 'Batch', 'FileName', 'Payer');
	$csv_hd_ar['dpr']['claim'] = array('PtName','SvcDate', 'clm01', 'Status', 'Batch', 'FileName', 'Payer');
	//
	// dataTables: | 'pt_name' | 'svc_date' | 'clm01 (link clm)' | 'status (mouseover)' | 'bht03_837 (link rsp)' | message (mouseover) |
	$csv_hd_ar['batch']['claim'] = array('PtName', 'SvcDate', 'clm01', 'InsLevel', 'Ctn_837', 'File_837', 'Fee', 'PtPaid', 'Provider' );
	$csv_hd_ar['f997']['claim'] =  array('PtName', 'SvcDate', 'clm01', 'Status', 'ak_num', 'File_997', 'Ctn_837', 'err_seg');
	$csv_hd_ar['f277']['claim'] =  array('PtName', 'SvcDate', 'clm01', 'Status', 'st_277', 'File_277', 'payer_name', 'claim_id', 'bht03_837');
	$csv_hd_ar['f270']['claim'] =  array('PtName', 'SvcDate', 'clm01', 'InsLevel', 'st_270', 'File_270', 'payer_name', 'bht03_270');
	$csv_hd_ar['f271']['claim'] =  array('PtName', 'SvcDate', 'clm01', 'Status', 'st_271', 'File_271', 'payer_name', 'bht03_270');
	$csv_hd_ar['era']['claim'] =   array('PtName', 'SvcDate', 'clm01', 'Status', 'trace', 'File_835', 'claimID', 'Pmt', 'PtResp', 'Payer');
	//
*/

/*
 * **** new table headings
	if ($csv_type == 'file') {
		switch((string)$ft) {
			case 'ack': $hdr = array('Date', 'FileName', 'isa13', 'ta1ctrl', 'Code'); break;
			case 'ebr': $hdr = array('Date', 'FileName', 'clrhsid', 'claim_ct', 'reject_ct', 'Batch'); break;
			case 'ibr': $hdr = array('Date', 'FileName', 'clrhsid', 'claim_ct', 'reject_ct', 'Batch'); break;
			//
			case 'f837': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'x12_partner'); break;
			case 'ta1': $hdr = array('Date', 'FileName', 'Control', 'TA1ctrl', 'Code'); break;
			case 'f997': $hdr = array('Date', 'FileName', 'Control', 'TA1ctrl', 'RejCt'); break;
			case 'f277': $hdr = array('Date', 'FileName', 'Control', 'Accept', 'AccAmt', 'Reject', 'RejAmt'); break;
			case 'f270': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'x12_partner'); break;
			case 'f271': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'Denied', 'Payer'); break;
			case 'f835': $hdr = array('Date', 'FileName', 'Control', 'Claim_ct', 'Denied', 'Payer'); break;
		}
	} elseif ($csv_type == 'claim') {
		switch((string)$ft) {
			case 'ebr': $hdr = array('PtName','SvcDate', 'CLM01', 'Status', 'Batch', 'FileName', 'Payer'); break;
			case 'ibr': $hdr = array('PtName','SvcDate', 'CLM01', 'Status', 'Batch', 'FileName', 'Payer'); break;
			case 'dpr': $hdr = array('PtName','SvcDate', 'CLM01', 'Status', 'Batch', 'FileName', 'Payer'); break;
			//
			case 'f837': $hdr = array('PtName', 'SvcDate', 'CLM01', 'InsLevel', 'Control', 'FileName', 'Fee', 'PtPaid', 'Provider' ); break;
			case 'f997': $hdr = array('PtName', 'SvcDate', 'CLM01', 'Status', 'Control', 'FileName', 'Trace', 'err_seg'); break;
			case 'f277': $hdr = array('PtName', 'SvcDate', 'CLM01', 'Status', 'FileName', 'Payer', 'Ins_ID', 'ClaimID', 'BHT03'); break;
			case 'f270': $hdr = array('PtName', 'ReqDate', 'PtAcct', 'InsLevel', 'FileName', 'Payer', 'BHT03'); break;
			case 'f271': $hdr = array('PtName', 'RspDate', 'PtAcct', 'Status', 'FileName', 'Payer', 'BHT03'); break;
			case 'f835': $hdr = array('PtName', 'SvcDate', 'CLM01', 'Status', 'Trace', 'FileName', 'ClaimID', 'Pmt', 'PtResp', 'Payer'); break;
		}
* */

function edih_map_old_table($ftype, $csvtype) {
	//
	$ret_ar = array();
	$f = array();
	$c = array();
	//
	if ($csvtype == 'file') {
		if ($ftype == 'f837') {
			// old = array('Date', 'FileName', 'Ctn_837', 'claim_ct', 'x12_partner');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'Claim_ct'=>3, 'x12_partner'=>4);
		} elseif ($ftype == 'f997') {
			// old = array('Date', 'FileName', 'Ctn_999', 'ta1ctrl', 'RejCt');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'TA1ctrl'=>3, 'RejCt'=>4);
		} elseif ($ftype =='f277') {
			// old = array('Date', 'FileName', 'Ctn_277', 'Accept', 'AccAmt', 'Reject', 'RejAmt');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'Accept'=>3, 'AccAmt'=>4, 'Reject'=>5, 'RejAmt'=>6);
		} elseif ($ftype =='f270') {
			// old = array('Date', 'FileName', 'Ctn_270', 'claim_ct', 'x12_partner');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'Claim_ct'=>3, 'x12_partner'=>4);
		} elseif ($ftype =='f271') {
			// old =array('Date', 'FileName', 'Ctn_271', 'claim_ct', 'Denied', 'Payer');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'Claim_ct'=>3, 'Denied'=>4, 'Payer'=>5); 
		} elseif ($ftype =='f835') {
			// old = array('Date', 'FileName', 'Trace', 'claim_ct', 'Denied', 'Payer');
			$f = array('Date'=>0, 'FileName'=>1, 'Control'=>2, 'Claim_ct'=>3, 'Denied'=>4, 'Payer'=>5); break;
		}
	} elseif ($csvtype == 'claim') {
		if ($ftype == 'f837') {
			// old = array('PtName'=>0, 'SvcDate', 'clm01', 'InsLevel', 'Ctn_837', 'File_837', 'Fee', 'PtPaid', 'Provider' );
			$f = array('PtName'=>0, 'SvcDate'=>1, 'CLM01'=>2, 'InsLevel'=>3, 'Control'=>4, 'FileName'=>5, 'Fee'=>6, 'PtPaid'=>7, 'Provider'=>8 );
		} elseif ($ftype == 'f997') {
			// old = array('PtName'=>0, 'SvcDate'=>0, 'clm01'=>0, 'Status'=>0, 'ak_num', 'File_997', 'Ctn_837', 'err_seg');
			$f = array('PtName'=>0, 'SvcDate'=>1, 'CLM01'=>2, 'Status'=>3, 'Control'=>4, 'FileName'=>5, 'Trace'=>6, 'err_seg'=>7);
		} elseif ($ftype == 'f277') {
			// old = array('PtName', 'SvcDate', 'clm01', 'Status', 'st_277', 'File_277', 'payer_name', 'claim_id', 'bht03_837');
			$hf = array('PtName', 'SvcDate', 'CLM01', 'Status', 'FileName', 'Payer', 'Ins_ID', 'ClaimID', 'BHT03');
		} elseif ($ftype == 'f270') {
			//['f270']['claim'] =  array('PtName', 'SvcDate', 'clm01', 'InsLevel', 'st_270', 'File_270', 'payer_name', 'bht03_270');
			$f = array('PtName', 'ReqDate', 'PtAcct', 'InsLevel', 'FileName', 'Payer', 'BHT03');
		} elseif ($ftype == 'f271') { 
			// old = array('PtName', 'SvcDate', 'clm01', 'Status', 'st_271', 'File_271', 'payer_name', 'bht03_270');
			$f = array('PtName', 'RspDate', 'PtAcct', 'Status', 'FileName', 'Payer', 'BHT03'); 
		} elseif ($ftype == 'f835') {
			// old = array('PtName', 'SvcDate', 'clm01', 'Status', 'trace', 'File_835', 'claimID', 'Pmt', 'PtResp', 'Payer');
			$f = array('PtName', 'SvcDate', 'CLM01', 'Status', 'Trace', 'FileName', 'ClaimID', 'Pmt', 'PtResp', 'Payer');
		}
	}
	//
		
			
			
function edih_upgrade_csv_table($ftype) {
	//
	$adle = ini_set("auto_detect_line_endings", true);
	if ( empty($adle) || ini_get("auto_detect_line_endings") === false ) { 
		echo "auto_detect_line_endings ini setting cannot be set"; 
	}
	$tp = csv_file_type($ftype);
	//
	if (!$tp) { 
		csv_edihist_log ( 'edih_upgrade_csv_tables(): invalid file type '.$ftype );
		return false; 
	}
	//
	$param = csv_parameters($tp);
	$csvclaim = (isset($param['claims_csv']) ? $param['claims_csv'] : '';
	$csvfile = (isset($param['files_csv']) ? $param['files_csv'] : '';
	//
	if ( !$csvclaim || !$csvfile ) {
		csv_edihist_log ( 'edih_upgrade_csv_tables(): invalid csv file path ' );
		return false; 
	}
	//
	$old_filehdr = csv_files_header($tp, 'file');
	$old_claimhdr = csv_files_header($tp, 'claim');
	$new_filehdr = edih_csv_files_header($tp, 'file');
	$new_claimhdr = edih_csv_files_header($tp, 'claim');
	//
	$fh_old = fopen( $csvfile, 'r');
	$fh_new = fopen( $csvfile, 'a');		
	
