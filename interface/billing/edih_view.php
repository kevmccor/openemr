<?php
/**
 * edih_view.php
 * 
 * Copyright 2012 Kevin McCormick Longview, Texas
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
 * @author Kevin McCormick
 * @link: http://www.open-emr.org
 * @package OpenEMR
 * @subpackage ediHistory
 */

$sanitize_all_escapes = true;
$fake_register_globals = false;
require_once(dirname(__FILE__) . '/../globals.php');
//
if (!acl_check('acct', 'eob')) die(xlt("Access Not Authorized"));
//
//include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php");
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?php echo xlt("edi history"); ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <!-- jQuery-ui and datatables  -->
    <link rel="stylesheet" href="<?php echo $web_root?>/library/js/jquery-ui-1.10.4.custom/css/custom-theme/jquery-ui-1.10.4.custom.min.css" />
<!-- -->
    <link rel="stylesheet" href="<?php echo $web_root?>/library/js/DataTables-1.10.11/DataTables-1.10.11/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="<?php echo $web_root?>library/js/DataTables-1.10.11/DataTables-1.10.11/css/dataTables.jqueryui.min.css" />
	<link rel="stylesheet" href="<?php echo $web_root?>/library/js/DataTables-1.10.11/Scroller-1.4.1/css/scroller.jqueryui.min.css" />
<!-- -->
    <!-- edi_history css -->
    <link rel="stylesheet" href="<?php echo $web_root?>/library/css/edi_history_v2.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $web_root?>/library/dynarch_calendar.css" type="text/css" />
	
    <script type="text/javascript" src="<?php echo $web_root?>/library/dynarch_calendar.js"></script>
    <script type="text/javascript" src="<?php echo $web_root?>/library/dynarch_calendar_setup.js"></script>
    <script type="text/javascript" src="<?php echo $web_root?>/library/textformat.js"></script>
    
    <?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
</head>
<body>

<!-- Begin tabs section  class="Clear"-->
<div id="tabs" style="visibility:hidden">
  <ul>
   <li><a href="#newfiles" id="btn-newfiles"><?php echo xlt("New Files"); ?></a></li>
   <li><a href="#csvdatatables" id="btn-csvdatatables"><?php echo xlt("CSV Tables"); ?></a></li>
   <li><a href="#x12text" id="btn-x12text"><?php echo xlt("EDI File"); ?></a></li>
   <li><a href="#edinotes" id="btn-edinotes"><?php echo xlt("Notes"); ?></a></li>
   <li><a href="#archive" id="btn-archive"><?php echo xlt("Archive"); ?></a></li>
  </ul> 	

    <div id="newfiles">
        <table> 
        <tr vertical-align="middle">
         <td align="center">       
            <form id="formupl" name="form_upl" action="edih_main.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                <legend><?php echo xlt("Select one or more files to upload"); ?></legend> 
                <input type="file" id="uplmulti" name="fileUplMulti[]" multiple />
                <input type="hidden" name="NewFiles" form="formupl" value="ProcessNew" />
                <input type="submit" id="uplsubmit" name="upl_submit" form="formupl" value=<?php echo xla("Submit"); ?> />
                <input type="reset" id="uplreset" name="upl_reset" form="formupl" value=<?php echo xla("Reset"); ?> />
                </fieldset>
            </form>
         </td>
         <td align="center">
            <form id="processnew" name="process_new" action="edih_main.php" method="GET">
                <fieldset>
                <legend><?php echo xlt("Process new files for CSV records"); ?>:</legend>
                <input type="checkbox" id="processhtml" name="process_html" form="processnew"  value="htm" checked /> <?php echo xlt("HTML Output?"); ?> 
                <input type="checkbox" id="processerr" name="process_err" form="processnew"  value="err" checked /> <?php echo xlt("Show Errors Only?"); ?> &nbsp;&nbsp;<br>
                <input type="hidden" name="ProcessFiles" form="processnew" value="ProcessNew" />
                <label for="process"><?php echo xlt("Process New Files"); ?></label>
                <input type="submit" id="fuplprocess" name="process" form="processnew" value=<?php echo xla("Process"); ?> />
                </fieldset>
            </form>
         </td>
        </tr>
        </table>
        
		<div id="fileupl1"></div>
		<div id="fileupl2"></div>
		<div id="processed"></div>
        <div id="rsp" title="<?php echo xla("Response"); ?>"></div>
        <div id="sub" title="<?php echo xla("Submitted"); ?>"></div>
        <div id="seg" title="<?php echo xla("x12 Segments"); ?>"></div>
    </div> 
    
    <div id="csvdatatables">
		<table>
		<tr>
		<td colspan=4>
		
		<form id="formcsvtables" name="form_csvtables" action="edih_main.php" method="GET">
			<fieldset>
				<legend><?php echo xlt("View CSV tables"); ?>:</legend>
				<table>
					<tr>
						<td colspan=4><?php echo xlt("Choose a period or dates (YYYY-MM-DD)"); ?></td>
					</tr>
					<tr>
						<td align='center'><?php echo xlt("Choose CSV table"); ?>:</td>
						<td align='center'><?php echo xlt("From Period"); ?></td>
						<td align='center'><?php echo xlt("Start Date"); ?>: &nbsp;&nbsp <?php echo xlt("End Date"); ?>:</td>
						<td align='center'><?php echo xlt("Submit"); ?></td>
					</tr>
					<tr height='1.5em'>
						<td align='center'>
							<select id="csvselect" name="csvtables"></select>
						</td>						
						<td align='center'>
							<select id="csvperiod" name="csv_period">
								<option value='2w' selected='selected'>2 weeks</option>
								<option value='1m'>1 month</option>
								<option value='2m'>2 months</option>
								<option value='3m'>3 months</option>
								<option value='6m'>6 months</option>
								<option value='9m'>9 months</option>
								<option value='1y'>1 year</option>
								<option value='ALL'>All Dates</option>
							</select>
						</td>
                        <!-- datekeyup(e, defcc, withtime)  dateblur(e, defcc, withtime) -->
                        <td align='left'>
						   <input type='text' size='10' name="csv_date_start" id="caldte1" value="" title="yyyy-mm-dd Start Date" />
                           <img src="<?php echo $web_root?>/interface/pic/show_calendar.gif" align='absbottom' width='24' height='22'
                              id="csvdate1_cal" border="0" alt="[?]" style="cursor:pointer;cursor:hand" title="Start date">
                        
                           <input type="text" size="10" name="csv_date_end" id="caldte2" value="" title="yyyy-mm-dd End Date" />
                           <img src="../pic/show_calendar.gif" align="absbottom" width="24" height="22"
                              id="csvdate2_cal" border="0" alt="[?]" style="cursor:pointer;cursor:hand" title="End date">
                        </td>
                        <!-- OEMR calendar srcipt -->
                        <script type="text/javascript"> 
                            Calendar.setup({inputField:"caldte1", ifFormat:"%Y-%m-%d", button:"csvdate1_cal"});
                            Calendar.setup({inputField:"caldte2", ifFormat:"%Y-%m-%d", button:"csvdate2_cal"});
                        </script>

						<td align='center'>
							<input type="hidden" name="csvShowTable" form="formcsvtables" value="gettable">
							<input id="csvshow" type="submit" name="csv_show" form="formcsvtables" value="<?php echo xla("Submit"); ?>" />
						</td>
                        
					</tr>
                </table>
           </fieldset>
        </form> 
        
        </td>
        <td colspan=2>
	        <form id="formcsvhist" name="hist_csv" action="edih_main.php" method="get">
	           <fieldset>
				  <legend><?php echo xlt("Per Encounter"); ?></legend>
				  <table cols='2'> 
				        <tr><td colspan='2'><?php echo xlt("Enter Encounter Number"); ?></td></tr>
						<tr>
							<td><?php echo xlt("Encounter"); ?></td>
							<td><?php echo xlt("Submit"); ?></td>	
						</tr>
						<tr>
							<td><input id="histenctr" type="text" size=10 name="hist_enctr" value="" /></td>
							<td><input id="histsbmt" type="submit" name="hist_sbmt" form="formcsvhist" value="<?php echo xla("Submit"); ?>" /></td>
						</tr>
				  </table>
				</fieldset>
			</form>   
		</td>
		</tr> 
		</table>
		
        <div id='tblshow'></div>
        <div id='tbcsvhist'></div> 
		<div id='tbrsp'></div>
        <div id='tbsub'></div> 
        <div id='tbseg'></div>
     
    </div>
 <!--     erafiles to be replaced by functionality in x12text
    <div id='erafiles'>

    </div>
 -->
 
	<div id="x12text" > 
		<form id="x12view" name="x12_view" action="edih_main.php" enctype="multipart/form-data" method="post">
		<fieldset>
		<legend><?php echo xlt("View EDI x12 file"); ?>:</legend>
		<table>
			<tr>
			  <td align='left'><label for="x12htm"><?php echo xlt("Report?"); ?></label></td>
			  <td align='center'><label for="x12file"><?php echo xlt("Choose File"); ?>:</label></td>
			  <td align='left'><label for="x12_filebtn"><?php echo xlt("Submit"); ?>:</label></td>
			  <td align='center'><label for="x12_filereset"><?php echo xlt("Reset"); ?>:</label></td>
			</tr>
			<tr>  	
			  <td align='left'>
				<input type="hidden" name="viewx12Files" value="view_x12">
			    <input type="checkbox" id="x12htm" name="x12_html" value="html"  />
			  </td>
			  <td align='left'><input id="x12file" type="file" size=30 name="fileUplx12" /></td>
			  <td align='center'>
				  <input type="submit" id="x12filebtn" name="x12_filebtn" form="x12view" value="<?php echo xla("Submit"); ?>" />
			  </td>
			  <td align='center'>
				  <input type="button" id="x12filerst" name="x12_filereset" form="x12view" value="<?php echo xla("Reset"); ?>" />
			  </td>
		    </tr>
	    </table>
		</fieldset>
		</form>
		
		<div id="x12rsp"></div> 
    
	</div> 
        
    <div id="edinotes">
		<table>
			<tr>
				<td colspan=2><a href="<?php echo $web_root?>/Documentation/Readme_edihistory.html" target="_blank"><?php echo xlt("View the README file"); ?></a></td>
			</tr>
			<tr>
				<td>
					<form id ="formlog" name="form_log" action="edih_main.php" enctype="multipart/form-data" method="post">
					<fieldset><legend><?php echo xlt("Inspect the log"); ?></legend>
					<label for="logfile"><?php echo xlt("View Log"); ?></label>			
					<select id="logselect" name="log_select"> </select>	
					<input type="hidden" name="logshowfile" value="getlog">
					<input id="logshow" type="submit" form="formlog" value="<?php echo xla("Submit"); ?>" />								
					<input id="logclose" type="button" form="formlog" value="<?php echo xla("Close"); ?>" />
					<input id="logarch" type="button" form="formlog" value="<?php echo xla("Archive"); ?>" />
					</fieldset>
					</form>
				</td>
				<td><form id ="formnotes" name="form_notes" action="edih_main.php" enctype="multipart/form-data" method="post">
					<fieldset><legend><?php echo xlt("Notes"); ?></legend>
					<label for="notesget"><?php echo xlt("Notes"); ?></label>
					<input id="notesget" type="button" name="notes_get" form="formnotes" value="<?php echo xla("Open"); ?>" />
					<input id="noteshidden" type="hidden" name="notes_hidden" value="putnotes" />
					<input id="notessave" type="submit" name="notes_save" form="formnotes" value="<?php echo xla("Save"); ?>" />
					<input id="notesclose" type="button" name="notes_close" form="formnotes" value="<?php echo xla("Close"); ?>" />
					</fieldset>
					</form>
				</td>
			</tr>
		</table>
        
		<div id='logrsp'></div> 
		<div id='notesrsp'></div>

    </div>
    
    <div id="archive">
		<table>
			<tr>
				<td colspan=3><?php echo xlt("Selected files and data will be removed from folders and tables"); ?></td>
			</tr>
			<tr>
				<td colspan=2>
					<form id="formarchive" name="form_archive" action="edih_main.php" enctype="multipart/form-data" method="POST">
					<fieldset><legend><?php echo xlt("Archive old files "); ?></legend>
					<label for="archive_sel"><?php echo xlt("Older than"); ?>:</label>
					<select id="archiveselect" name="archive_sel">
						<option value="" selected="selected">Choose</option>
						<option value="24m">24 months</option>
						<option value="18m">18 months</option>
						<option value="12m">12 months</option>
						<option value="9m">9 months</option>
						<option value="6m">6 months</option>
						<option value="3m">3 months</option>
					</select>
					<label for="archivereport"><?php echo xlt("File Information"); ?>:</label>					
					<input type="button" id="archiverpt" name="archivereport" form="formarchive" value="<?php echo xla("Report"); ?>" />
					<input type="hidden" name="ArchiveRequest" form="formarchive" value="requested" />
					<label for="archivesbmt"><?php echo xlt("Archive"); ?>:</label>
					<input type="submit" id="archivesbmt" name="archive_sbmt" form="formarchive" value="<?php echo xla("Archive"); ?>" />
					</fieldset>
					</form>
				</td>
				<td><form id="formarchrestore" name="form_archrestore" action="edih_main.php" enctype="multipart/form-data" method="POST">
					<fieldset><legend><?php echo xlt("Archive old files"); ?></legend>
					<label for="archrestore_sel"><?php echo xlt("Restore"); ?>:</label>
					<select id="archrestoresel" name="archrestore_sel"> </select>
					<input type="hidden" name="ArchiveRestore" form="formarchrestore" value="restore" />
					<label for="arch_restore"><?php echo xlt("Restore Archive"); ?>:</label>					
					<input type="submit" id="archrestore" name="arch_restore" form="formarchrestore" value=<?php echo xla("Restore"); ?> />
					</fieldset>
					</form>
				</td>
			</tr>
		</table>
		
		<div id="archiversp"></div>
		
	</div>  
</div> 
<!-- End tabs section -->
<!--  -->
<script src="<?php echo $web_root?>/library/js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo $web_root?>/library/js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $web_root?>/library/js/DataTables-1.10.11/datatables.min.js"></script>
<!-- -->
<script src="<?php echo $web_root?>library/js/DataTables-1.10.11/Scroller-1.4.1/js/dataTables.scroller.min.js"></script>
  
<!-- end DataTables js Begin local js -->
<script type="text/javascript">
    jQuery(document).ready(function() {
        // activate tab interface
        jQuery("#tabs").tabs();
        jQuery("#tabs").tabs().css('visibility','visible');
        //
        // set some button disabled
        jQuery('#processfiles').prop('disabled', true);
        jQuery('#archivesubmit').prop('disabled', true);
        // update list of available csv tables
		jQuery(function() { csvlist() });
		// update list of available log files
		jQuery(function() { loglist() });
		// update list of archive files
		jQuery(function() { archlist() });
        
	});
/* ************ 
 *   end of document ready() jquery 
 * ************
 */ 	
/* ****  from http://scratch99.com/web-development/javascript/convert-bytes-to-mb-kb/ *** */
	function bytesToSize(bytes) {
	    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	    if (bytes == 0) return 'n/a';
	    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	    if (i == 0) return bytes + ' ' + sizes[i];
	    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
	};
/* *** variables for upload maximums *** */
/* *** phpserver: 'maxfsize''maxfuploads''postmaxsize''tmpdir'	phpserver['postmaxsize'] *** */
	var phpserver = [];
	jQuery(function() {
		jQuery.ajax({
			url: 'edih_main.php', 
			data: { srvinfo: 'yes' }, 
			dataType: 'json',
			success: function(rsp){ phpserver = rsp }
		});
	}); 
/* *** update the list of available csv tables  *** */
	function csvlist() {
		jQuery.ajax({
			type: 'GET',
			url: 'edih_main.php',
			data: { csvtbllist: 'yes' },
			dataType: 'json',
			success: function(data) {
			  var options = jQuery('#csvselect').attr('options');
			  var optct = jQuery.isPlainObject(data);  // data.length
			  //console.log('csvlist optct ' + optct);
			  if (optct) {
				var options = [];
				options.push("<option value='' selected='selected'><?php echo xla("Choose from list"); ?></option>");
				jQuery.each(data.claims, function(idx, value) {
					//console.log(idx + " - " + value.fname + " " + value.desc);
					options.push("<option value=" + value.fname + ">" + value.desc + "</option>");
				});
				jQuery.each(data.files, function(idx, value) {
					//console.log(idx + " - " + value.fname + " " + value.desc);
					options.push("<option value=" + value.fname + ">" + value.desc + "</option>");
				});
				jQuery("#csvselect").html(options.join(''));
			  }
			}
		});
	};	
/* *** update the list of log files *** */
	function loglist() {
		jQuery.ajax({
			type: 'GET',
			url: 'edih_main.php',
			data: { loglist: 'yes' },
			dataType: 'json',
			success: function(data) {	
			  var options = jQuery('#logselect').attr('options');
			  var optct = data.length;
			  if (optct) {
				var options = [];
				options.push('<option selected="selected"><?php echo xla("Choose from list"); ?></option>');
				for (var i=0; i<optct; i++) {
				  options.push('<option value=' + data[i] + '>' + data[i] + '</option>');
				}
				jQuery("#logselect").html(options.join(''));
			  }
			}
		});
	};
/* *** update the list of archive files *** id="archrestoresel name="archrestore_sel" */
	function archlist() {
		jQuery.ajax({
			type: 'GET',
			url: 'edih_main.php',
			data: { archlist: 'yes' },
			dataType: 'json',
			success: function(data) {
			  var options = jQuery('#archrestoresel').attr('options');
			  var optct = data.length;
			  if (optct) {
				var options = [];
				options.push("<option selected='selected'><?php echo xla("Choose from list"); ?></option>");
				for (var i=0; i<optct; i++) {
				  options.push("<option value=" + data[i] + ">" + data[i] + "</option>");
				}
				//console.log('#archrestoresel', options);
				jQuery('#archrestoresel').html(options.join(""));
			  }
			}
		});
	};
/* ************ 
 * called to bind links in ajax retrieved content for dialog display
 * from links in csv data tables
 * .on( events [, selector] [, data], handler(eventObject) )
 * bindlinks('#tblshow', 'click', '.seg', 'click', '#tbseg', '<?php echo xla("Code Text"); ?>')	
 */
/* ****** dialog cruft
buttons: [{ text: "Close", click: function(){
								jQuery(this).html("");
								jQuery(this).dialog("close");
								}
							}],
 
 var newwin = jQuery(this).attr('href') + '&newwin=yes';         
 { text: "New Window", click: function() {
		window.open(newwin, '_blank');
		jQuery(this).html("");
		jQuery(this).dialog("close");
		}
	},

// add this div for minimized dialog
<div id="dialog_window_minimized_container"></div>
// **** script *****
var _init = jQuery.ui.dialog.prototype._init;
$.ui.dialog.prototype._init = function() {
    //Run the original initialization code
    _init.apply(this, arguments);
     
    //set some variables for use later
    var dialog_element = this;
    var dialog_id = this.uiDialogTitlebar.next().attr('id');
     
    //append our minimize icon
    this.uiDialogTitlebar.append('<a href="#" id="' + dialog_id + 
    '-minbutton" class="ui-dialog-titlebar-minimize ui-corner-all">'+
    '<span class="ui-icon ui-icon-minusthick"></span></a>');
     
    //append our minimized state
    $('#dialog_window_minimized_container').append(
        '<div class="dialog_window_minimized ui-widget ui-state-default ui-corner-all" id="' + 
        dialog_id + '_minimized">' + this.uiDialogTitlebar.find('.ui-dialog-title').text() + 
        '<span class="ui-icon ui-icon-newwin"></div>');
     
    //create a hover event for the minimize button so that it looks good
    $('#' + dialog_id + '-minbutton').hover(function() {
        $(this).addClass('ui-state-hover');
    }, function() {
        $(this).removeClass('ui-state-hover');
    }).click(function() {
        //add a click event as well to do our "minimalization" of the window
        dialog_element.close();
        $('#' + dialog_id + '_minimized').show();
    });
     
    //create another click event that maximizes our minimized window
    $('#' + dialog_id + '_minimized').click(function() {
        $(this).hide();
        dialog_element.open();
    });
'a.rsp .sub .seg'
    $(function(){
    //$('a').on('click', function(e){
    jQuery('a.rsp .sub .seg').on('click', function(e){
        e.preventDefault();
        $('<div/>', {'class':'myDlgClass', 'id':'link-'+($(this).index()+1)})
        .load($(this).attr('href')).appendTo('body').dialog();
    });
});
};
jQuery('div#tblshow > td').hover(
function(e){ jQuery(this).parentsUntil('tr').parent().addClass('outlinetr'); },
function(e){ jQuery(this).parentsUntil('tr').parent().removeClass('outlinetr'); }
);
jQuery('div#tblshow > tr').hover(
function(e){ jQuery(this).addClass('outlinetr'); },
function(e){ jQuery(this).removeClass('outlinetr'); }
);
jQuery('div#tblshow > a.rsp .sub .seg').on('click', function(e) {
e.preventDefault();
$('<div/>', {'class':'myDlgClass', 'id':'link-'+($(this).index()+1)})
        .load($(this).attr('href')).appendTo('body').dialog();
}
);

// **** script ****
// bindlinks('#processed', 'click', '.rsp', 'click', '#rsp', '<?php echo xla("Response"); ?>'),
// bindlinks('#tblshow', 'click', '.rsp', 'click', '#tbrsp', '<?php echo xla("Response"); ?>'),
*/
    function bindlinks(dElem, dEvt, cClass, cEvt, cElem, mytitle){ 
         jQuery(dElem).on(dEvt, cClass, cEvt, function(e) {
            e.preventDefault();
            //
            var statDialog = jQuery(cElem).dialog({
                autoOpen: false,
				resizable: true,
                draggable: true,
                modal: false,
                title: mytitle, //jQuery(this).attr('title'),
                height: 360,
                width: 640,
                maxHeight: 420,
                maxWidth: 800,
                // position: { my: 'left top', at: 'left top', of: dElem, collision: 'none'},  // tblshow""center",
                // position: { my: 'right', at: 'left', of: dEvt, collision: 'none' }               
            });
            //
            if (statDialog.dialog('isOpen')) { statDialog.dialog('close'); };
            jQuery.get(jQuery(this).attr('href'), function(data){ jQuery(cElem).html(data); })
            statDialog.dialog('open'); 
        });
    }

/* ******************* end document ready ***********/
/* ****
 * jQuery-UI accordian -- for 27x file html
 */
    function apply_accordion() {
	    jQuery( "#accordion" )
	      .accordion({
	        header: "> div > h3",
	        collapsible: true,
	        heightStyle: "fill"
	      })
	      .sortable({
	        axis: "y",
	        handle: "h3",
	        stop: function( event, ui ) {
	          // IE doesn't register the blur when sorting
	          // so trigger focusout handlers to remove .ui-state-focus
	          ui.item.children( "h3" ).triggerHandler( "focusout" );
	 
	          // Refresh accordion to handle new order
	          $( this ).accordion( "refresh" );
	        }
	      });
	  };
/* ****************************
 *
 * === upload multiple files
 *     buttons are enabled/disabled
 *     selected and uploaded files are listed    
 *     the process files script html output displayed,
 */
/* **** if files have been uploaded **** */
	var upld_ct = 0;
/* ***** list files selected in the multifile upload input **** */
	jQuery('#uplmulti').change( function(){
		// clear uploaded files list, since new selected files list is coming
		jQuery('#fileupl2').html('');
		jQuery('#fileupl2').removeClass('flist');
		jQuery('#processed').html('');
		var uplfiles = this.files; //event.target.files;
		var fct = uplfiles.length;
		var fsize = 0;
		var fl1 = jQuery('#fileupl1');
		fl1.html('');
		fl1.toggle(true);
		fl1.addClass('flist1');
		var fmaxupl = phpserver['maxfuploads'];   // jQuery("#srvvals").data('mf');
		var pmaxsize = phpserver['postmaxsize']
		var str = "<p><em>Selected Files:</em></p>";
		str = str + "<ul id='uplsel' class='fupl'>";
		for(var i = 0; i < fct; i++) {
			if (i == fmaxupl) str = str + '</ul><p>max file count reached<br> - reload names below </p><ul class=fupl>';
			str = str + "<li>" + uplfiles[i].name + "</li>";  //' ' +
			fsize += uplfiles[i].size;
		};
		str = str + '</ul><p>Total size: ' + bytesToSize(fsize) + ' (max ' + pmaxsize + ')</p>';
		jQuery('#uplsubmit').prop('disabled', false);
		if (upld_ct === 0 ) {
			jQuery('#processupl').prop('disabled', true);
		}
		fl1.html(str);
	});
	// uplreset button click the file input is reset and associated values cleared
	jQuery('#uplreset').on('click', function( event ) {
		//console.log(event.type);
		//console.log(jQuery('#ufile').value);
		event.preventDefault();
		event.stopPropagation();
		jQuery('#fileupl1').html('');
		jQuery('#fileupl2').html('');
		jQuery('#fileupl1').hide();
		jQuery('#fileupl2').hide();
		jQuery('#processed').html('');
		jQuery('#uplsubmit').prop('disabled', true);
		if (upld_ct == 0 ) {
			jQuery('#fuplprocess').prop('disabled', true);
		} else {
			jQuery('#fuplprocess').prop('disabled', false);
		}
		// jQuery('#fupl').reset();
		document.getElementById('formupl').reset();
		return false;
	});

/* ***** uplsubmit button click --upload files are scanned and copied into folders  *** */
/* ***** files are listed next to file selected list by css  *** */
	jQuery('#formupl').on('submit', function( event )  {
		event.stopPropagation();
		event.preventDefault();
		var uplForm = document.getElementById("formupl"); 
		var upldata = new FormData( document.getElementById('formupl') );  
		var rspElem = jQuery('#fileupl2');
		rspElem.html('');
		jQuery.ajax({
			    url: jQuery('#formupl').attr('action'),  
			    type: 'POST',
			    cache: false, 
			    data: upldata,
			    dataType: 'html',
			    processData: false,
			    contentType: false,
			    success: function(data) {
					rspElem.html(data);
					rspElem.show();
					jQuery('#fuplprocess').prop('disabled', false );
					jQuery('#fuplupload').prop('disabled', true);
					uplForm.reset();
					upld_ct++;
				},
			    error: function( xhr, status ) { alert( "Sorry, there was a problem!" ); },
			});
		return false;
	});
/* **** process button, files parsed and csv rows displayed  *** */
	jQuery('#processnew').on('submit', function(e) {
		e.stopPropagation();
		e.preventDefault();
		//var prcForm = document.getElementById("process_new"); 
		jQuery.ajax({
			    url: jQuery('#processnew').attr('action'), 
			    type: 'GET',
			    data: jQuery('#processnew').serialize(),  //prcForm.serialize(),
			    success: [
				    function(data) {
						jQuery('#fileupl1').html('');
						jQuery('#fileupl1').hide();
						jQuery('#fileupl2').html('');
						jQuery('#fileupl1').hide();
						//
						jQuery('#processed').html(data);
						jQuery('#processed').show();
					},
					bindlinks('#processed', 'click', '.rsp', 'click', '#rsp', '<?php echo xla("Response"); ?>'),
					bindlinks('#processed', 'click', '.sub', 'click', '#sub', '<?php echo xla("Submited"); ?>'),
					bindlinks('#processed', 'click', '.seg', 'click', '#seg', '<?php echo xla("EDI Segments"); ?>')
				],
			    error: function( xhr, status ) {
					alert( "Sorry, there was a problem!" ),
					jQuery('#procdessed').html(status)
				}				
			});
		upld_ct = 0;
		/* ***  update list of csv tables *** */
		csvlist();
		jQuery('#fuplprocess').prop('disabled', true );
		return false;
	});

/* *********************************************
 *
 *  ==== file upload lists  match uploaded to selected
 *       when mouse is over element in one list, matching element
 *       in other list is highlighted also
 */
	function outlineMatch(matchElem, matchText) {
		if (matchText == 'none') {
			matchElem.css('font-weight', 'normal');
			return false;
		} else {
			matchElem.each(function( index ) {
				if ( matchText == jQuery(this).text() ) {
					jQuery(this).siblings().css('font-weight', 'normal');
					jQuery(this).css('font-weight', 'bolder');
					return false;
				};
			});
		}
	   return false;
	}
/* *** use .hover event
jQuery('#fileupl2 > li').hover(
	var fl1 = jQuery('#fileupl1').find('li');
	var fname = jQuery(this).text();
	function(e){ jQuery(this).css('font-weight', 'bolder'); outlineMatch(fl1, fname); },
	function(e){ jQuery(this).css('font-weight', 'normal'); outlineMatch(fl1, 'none'); }
);
jQuery('#fileupl1 > li').hover(
	var fl2 = jQuery('#fileupl2').find('li');
	var fname = jQuery(this).text();
	function(e){ jQuery(this).css('font-weight', 'bolder'); if (fl2.length) { outlineMatch(fl2, fname); }; },
	function(e){ jQuery(this).css('font-weight', 'normal'); if (fl2.length) { outlineMatch(fl2, 'none'); }; }
);
*/
	jQuery('#fileupl2').on('mouseenter', 'li', function(event){
		var fl1 = jQuery('#fileupl1').find('li');
		var fname = jQuery(this).text();
		jQuery(this).css('font-weight', 'bolder');
		jQuery(this).siblings().css('font-weight', 'normal');
		outlineMatch(fl1, fname);
	});
	jQuery('#fileupl2').on('mouseleave', 'li', function(){
		var fl1 = jQuery('#fileupl1').find('li');
		jQuery(this).css('font-weight', 'normal');
		outlineMatch(fl1, 'none');
	});
	jQuery('#fileupl1').on('mouseenter', 'li', function(event){	
		jQuery(this).css('font-weight', 'bolder');
		if ( jQuery('#fileupl2').length ) {
			var fl2 = jQuery('#fileupl2').find('li');
			var fname = jQuery(this).text();
			outlineMatch(fl2, fname);
		}
	});
	jQuery('#fileupl1').on('mouseleave', 'li', function(){
		jQuery(this).css('font-weight', 'normal');
		if ( jQuery('#fileupl2').length ) {
			var fl2 = jQuery('#fileupl2').find('li');
			var fname = jQuery(this).text();
			outlineMatch(fl2, 'none');
		}			
	});
/* *****  ==== end file upload lists  match uploaded to selected
/* ****************************
 * ===  end upload multiple files section
 */

/* ****************
 * begin csv tables section
 * the csv tables are displayed using jquery dataTables plugin
 * here, the 'success' action is to execute an array of functions
 * the helper function bindlinks() applies jquery .on method
 * so most links will open a jquery-ui dialog
 */
	jQuery('#formcsvtables').on('submit', function(e) {
		e.preventDefault();
		// verify a csv file is selected
		if (jQuery('#csvselect').val() == '') {
			jQuery("#tblshow").html('<?php echo xla("No table selected! Select a table."); ?>');
			return false;
		}
		jQuery.ajax({
			type:'get',
			url: "edih_main.php", 
			data: jQuery('#formcsvtables').serialize(), 
			dataType: "html",
			success: [ 
				function(data){ 
                    //var tbltl = "<div class='csvcptn'>" + jQuery(data).filter('#dttl').html() + "</div>";
					//var mytbl = "<table id='csvTable' class='csvDisplay'>" + jQuery(data).not('#dttl').html() + "</table>";
					//var mytbl = jQuery(data).not('#dttl').html();
					//jQuery('#tblshow').html(jQuery.trim(mytbl));
					jQuery('#tblshow').html(data); 
					jQuery('#tblshow table#csvTable').DataTable({
						//DisplayLength: 10,    
						//bJQueryUI: true, 
						//bScrollInfinite: true,
						//bScrollCollapse: true,
                        //iScrollLoadGap: 20,
                        //sScrollY:"200px",
                        //sScrollX: true
                        //bPaginate: true,
                        //scroll: true,
                        'jQuery UI': true,
                        'processing': true,
						'scrollY': '300px',
						'scrollCollapse': true,
						'scrollX': true,
						//sScrollXInner: '100%'
						'paging': true
					});
                    //jQuery("#csvTable_filter").before(tbltl);
				},
				bindlinks('#tblshow', 'click', '.rsp', 'click', '#tbrsp', '<?php echo xla("Response"); ?>'),
				bindlinks('#tblshow', 'click', '.sub', 'click', '#tbsub', '<?php echo xla("Submitted"); ?>'),
				bindlinks('#tblshow', 'click', '.seg', 'click', '#tbseg', '<?php echo xla("EDI Segments"); ?>')				
			]              
		});
	}); 
	
	// csv encounter history
	jQuery('#formcsvhist').on('submit', function(e) {
		e.preventDefault();
		jQuery('#tbcsvhist').html('');
		var chenctr = jQuery('#histenctr').value;
		var encrecord = jQuery('#tbcsvhist').dialog({
					buttons: [{ text: "Close", click: function() { jQuery(this).dialog("close"); } }], 
					modal: false,
					title: "<?php echo xla("Encounter EDI Record"); ?>",
					height: 416,
					width: 'auto'
				});
		jQuery.ajax({
			type: "GET",
			url: jQuery('#formcsvhist').attr('action'), 
			data: jQuery('#formcsvhist').serialize(), //{ csvenctr: chenctr },
			dataType: "html",
			success: [
				function(data){ jQuery('#tbcsvhist').html(jQuery.trim(data)); },
				bindlinks('#tbcsvhist', 'click', '.rsp', 'click', '#tbrsp', '<?php echo xla("Response"); ?>'),
				bindlinks('#tbcsvhist', 'click', '.sub', 'click', '#tbsub', '<?php echo xla("Submitted"); ?>'),
				bindlinks('#tbcsvhist', 'click', '.seg', 'click', '#tbseg', '<?php echo xla("EDI Segments"); ?>'),
				encrecord.dialog('open')
			]				
		});
    });
    //		
    jQuery('#csvClear').on('click', function(e) {
		e.preventDefault();
        jQuery("#tblshow").html('');
    });
/* **************
 * === end of csv tables and claim history
 */
/* ****************8
 * === view x12 file form  form"view_x12" file"x12file" submit"fx12" check"ifhtml" newWin"x12nwin"
 */
	jQuery('#x12view').on('submit', function(e) {
		e.preventDefault();
		e.stopPropagation();
		//
		var rspElem = jQuery('#x12rsp');
		var frmData = new FormData( document.getElementById('x12view') );
		jQuery.ajax({
		    url: jQuery('#x12view').attr('action'),
		    type: 'POST',
		    data: frmData,
		    processData: false,
		    contentType: false,
		    //
		    success: function(data) {
				rspElem.html('');
				rspElem.html(data);
				jQuery('#x12filesbmt').prop('disabled', true);
			},
		    error: function( xhr, status ) { alert( "Sorry, there was a problem!" ); }
		});
		return false;
	});
	//
	jQuery('#x12file').change( function(){
		// clear uploaded files list, since new selected files list is coming
		jQuery('#x12rsp').html('');
		jQuery('#x12filesbmt').prop('disabled', false);
	});
	//
	jQuery('#x12filerst').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		// clear uploaded files list, since new selected files list is coming
		jQuery('#x12rsp').html('');
		jQuery('#x12filesbmt').prop('disabled', true);
		jQuery('#x12view').reset();
	});


	//jQuery('#x12nwin').on('click', function(e) {
		//e.stopPropagation();
		//e.preventDefault();
		////
		//var head = jQuery('head').html();
		//var x12disp = jQuery('#fx12rsp').html();
		//var str = "<!DOCTYPE html><html>" + head + "<body>" + x12disp + "</body></html>";
		//window.open(newwin, '_blank');

/*
 * === functions for logs, notes, and archive "frm_archive" "archiveselect""archivesubmit"
 */
	jQuery('#logarch').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		//
		jQuery.ajax({
            type: 'get',
            url: jQuery('#formlog').attr('action'), 
            data: { archivelog: 'yes' },
            dataType: "json",

            success: [ function(data) {
				var str = str + "<ul id='logarchlist'>";
				var fct = data.length;
				if (fct == 0) {
					str = str + '<li>No logs older than 7 days</li>';
				} else {
					for(var i = 0; i < fct; i++) {
						str = str + "<li>" + data[i] + "</li>";
					}
				};
				str = str + '</ul>';
			},
			loglist()
			]
		});
		jQuery('#notesrsp').hide();		
        jQuery('#logrsp').html('');
        jQuery('#logrsp').html(str);
        jQuery('#logrsp').show();
    });
    
    jQuery('#logclose').on('click', function(e) {
		e.preventDefault();
        jQuery('#logrsp').html('');
        jQuery('#logrsp').hide();
        jQuery('#notesrsp').show();
    });
    	
	jQuery('#logselect').on('change', function(e) {
		jQuery('#logshow').prop('disabled', false );
	});
	     
    jQuery('#logshow').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var fn = jQuery('#logselect').val();
        jQuery.ajax({
            type: 'get',
            url: jQuery('#formlog').attr('action'), 
            //data: { archivelog: 'yes', logfile: fn },
            data: jQuery('#formlog').serialize(),
            dataType: "html",
            success: function(data){
				jQuery('#notesrsp').hide();
                jQuery('#logrsp').html(''), 
                jQuery('#logrsp').html(jQuery.trim(data));
                jQuery('#logrsp').show(); 
            }
        });
    }); 

    jQuery('#notesget').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        jQuery.ajax({
            type:'GET',
            url: jQuery('#formnotes').attr('action'),
            data: { getnotes: "yes"},
            dataType: "text",
            success: function(data){
				jQuery('#notesrsp').html('');
                jQuery('#notesrsp').html("<H4>Notes:</H4>");
                jQuery('#notesrsp').append("<textarea id='txtnotes', name='txtnotes',form='formnotes',rows='10',cols='600',wrap='hard' autofocus='autofocus'></textarea>"); 
                // necessary to trim the data since php from script has leading newlines (UTF-8 issue) '|:|'
		        jQuery('#logrsp').hide();
                jQuery('#notesrsp :textarea').val(jQuery.trim(data));
                jQuery('#notesrsp').show();
            }
        });
    });	

    jQuery('#notessave').on('click', function(e) {
		e.preventDefault();
        var notetxt = jQuery('#notesrsp :textarea').val();
        var noteURL = jQuery('#formnotes').attr('action');
        jQuery.post(noteURL, { putnotes: 'yes', tnotes: notetxt },
            function(data){ jQuery('#notesrsp').append(data); });
    });

    jQuery('#notesclose').on('click', function(e) {
		e.preventDefault();
        jQuery('#notesrsp').html('');
        jQuery('#notesrsp').toggle(false);
    });

/*
 * ==== Archive form id="formarchive"
 *   note use of 'one' instead of 'on' so archive command is run only once
 */
	// The .one() method is especially useful ...
	jQuery('#formarchive').one('submit', function(e) {
		//e.stopPropagation();
		e.preventDefault();
		var archForm = document.getElementById('formarchive'); 
		var archdata = new FormData(archForm);  
		var rspElem = jQuery('#archiversp');
		rspElem.html('');
		jQuery.ajax({
			url: jQuery('#formarchive').attr('action'),
			type: 'POST',
			cache: false, 
			data: archdata,
			dataType: 'html',
			processData: false,
			contentType: false,
			success: function(data) {
				rspElem.html(data);
				jQuery('#archivesubmit').prop('disabled', true );
				archForm.reset();
				
			},
			error: function( xhr, status ) { alert( "Sorry, there was a problem!" ); },
			// code to run regardless of success or failure
			// complete: function( xhr, status ) { alert( "The request is complete!" ); }
		});
		$( this ).click(function() {
			console.log( "You have clicked this before!" );
			alert("Archive already performed!");
	    });
	    archlist();
	    csvlist();
		return false;
	});
	//
	jQuery('#archiverpt').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		// id="#archiversp"
		var rspElem = jQuery('#archiversp');
		rspElem.html('');
		var sprd = jQuery('#archiveselect').val();
		var surl = jQuery('#formarchive').attr('action');
		//
		//console.log(surl);
		jQuery.ajax({
			url: 'edih_main.php',
			type: 'GET',
			//cache: false,
			dataType: 'html',
			data: { archivereport: 'yes', period: sprd },
			
			success: function(data) {
				//rspElem.html(data);
				//rspElem.show();
				jQuery('#archiversp').html(data);
			},
			error: function( xhr, status ) {
				alert( "Sorry, there was a problem!" );
				rspElem.html(status);
				rspElem.show();
			}
		});
		//jQuery.get('ehih_main.php', { archivereport: 'yes', period: sprd })
			//.done(function( data ) {
				//alert( "Data Loaded );
				//rspElem.html(data);
			//});
		//});
		return false;
	});
	//		
	jQuery('#archiveselect').on('change', function(e) {
		jQuery('#archivesubmit').prop('disabled', false );
	});

	// 
	jQuery('#formarchrestore').on('submit', function(e) {
		//e.stopPropagation();
		e.preventDefault();
		var archrstForm = document.getElementById('formarchrestore'); 
		var archrstdata = new FormData(archrstForm);  
		var rspElem = jQuery('#archiversp');
		//var archf = jQuery('#archrestoresel').val();
		//archrstdata = { archrestore: 'yes', archfile: archf };
		jQuery.ajax({
			url: jQuery('#formarchrestore').attr('action'),
			type: 'POST', 
			data: archrstdata,
			dataType: 'html',
			processData: false,
			contentType: false,
			success: function(data) {
				rspElem.html('');
				rspElem.html(data);
			},
			error: function( xhr, status ) { alert( "Sorry, there was a problem!" ); },
			// code to run regardless of success or failure
			// complete: function( xhr, status ) { alert( "The request is complete!" ); }
		});
		$( this ).click(function() {
			console.log( "You have clicked this before!" );
			alert("Restore already performed!");
	    });
	    archlist();
	    csvlist();
	    archrstForm.reset();
		return false;
	});

/* ************ 
 * end of javascript block
 */             
</script>     

</body>

</html>
