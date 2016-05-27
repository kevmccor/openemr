<?php
/*
 * test_csv_array.php
 * 
 * Copyright 2016 Kevin McCormick <kevin@kt61p>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
 
/*
 * Here's my CSV converter
 * supports Header and trims all fields
 * Note: Headers must be not empty!
 * marco dot remy at aol dot com 17-Jun-2014 04:54
 */
 
require_once './test_edih_csv_inc.php';
require_once './test_edih_obj_2.php';
 

$fp = "/home/kevin/html/openemr/sites/testing/edi/history/csv/claims_f277.csv"; //'/home/kevin/projects/edi/ssb_csv_copy.csv';
//
	
