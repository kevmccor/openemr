<?php
/*
 * test_271_codes.php
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

class edih_271_codes {
	//
	public $code271 = array();
	//private $code271 = array();
	private $ds = '';
	private $dr = '';
	// the key_match array is a concept of matching code lists to 
	// segment elements when diferent segments are looking for the same 
	// code or reference lists  
	//  -- a very tedious project and immediately put on hold
	//public $key_match = array('HCR04'=>array('CRC02');
	//
	function __construct($component_separator, $repetition_separator) {
		//
		// echo "class edih_271_codes ds=$component_separator dr=$repetition_separator".PHP_EOL;
		//
		$this->ds = $component_separator;
		$this->dr = $repetition_separator;
		//
		// transaction type code 
		$this->code271['BHT06'] = array(
				'18'=>'Response - no further updates',
				'19'=>'Response - further updates to follow',
				'31'=>'Subrogation Demand',
				'AT'=>'Administrative Action',
				'CH'=>'Chargeable',
				'DG'=>'Response',
				'RP'=>'Reporting',
				'RT'=>'Spend Down',	
				'RU'=>'Medical Services Reservation'
				);
		
		// AAA rejection reasons 
		$this->code271['AAA03'] = array(			
				'04'=>'Authorized quantity exceeded',
				'15'=>'Required application data missing',
				'33'=>'Input Errors',
				'35'=>'Out of Network',
				'41'=>'Authorization/Access restrictions',
				'42'=>'Unable to respond at current time.',
				'43'=>'Invalid/Missing provider information',
				'44'=>'Invalid/Missing provider name',
				'45'=>'Invalid/Missing provider speciality',
				'46'=>'Invalid/Missing provider phone number',
				'47'=>'Invalid/Missing provider state',
				'48'=>'Invalid/Missing referring provider identification number',
				'49'=>'Provider is not primary care physician',
				'50'=>'Provider ineligible for inquiries',
				'51'=>'Provider not on file',
				'52'=>'Service dates not within provider plan enrollment',
				'53'=>'Inquired benefit inconsistent with provider type',
				'56'=>'Inappropriate date',
				'57'=>'Invalid/Missing dates of service',
				'58'=>'Invalid/Missing date of birth',
				'60'=>'Date of birth follows date of service',
				'61'=>'Date of death preceeds dates of service',
				'62'=>'Date of service not within allowable inquiry period',
				'63'=>'Date of service in future',
				'64'=>'Invalid/Missing patient ID',
				'65'=>'Invalid/Missing patient name',
				'66'=>'Invalid/Missing patient gender code',
				'67'=>'Patient not found',
				'69'=>'Inconsistent with patient age.',
				'70'=>'Inconsistent with patient gender.',
				'71'=>'Patient birth date does not match that for the patient in the database',
				'72'=>'Invalid/Missing subscriber/insured ID',
				'73'=>'Invalid/Missing subscriber/insured name',
				'74'=>'Invalid/Missing subscriber/insured gender code',
				'75'=>'Subscriber/Insured not found',
				'76'=>'Duplicate Subscriber/Insured ID number',
				'77'=>'Subscriber found, patient not found',
				'78'=>'Subscriber/Insured not in Group/Plan identified',
				'79'=>'Invalid participant identification',
				'97'=>'invalid or missing provider address',
				'T4'=>'Payer name or identifier missing',
				'T5'=>'Certification Information Missing',
				'80'=>'No response received by clearinghouse',
				'98'=>'Expiremental service or procedure.',
				'AA'=>'Authorization number not found.',
				'AE'=>'Requires primary care physician authorization.',
				'AF'=>'Invalid/Missing diagnosis codes.',
				'AG'=>'Invalid/Missing procedure codes.',
				'AO'=>'Additional patient condition information required.',
				'CI'=>'Certification information does not match patient.',
				'E8'=>'Requires medical review.',
				'IA'=>'Invalid authorization number format.',
				'MA'=>'Missing authorization number.'			
				);

 
				
		// follow-up action code
		$this->code271['AAA04'] = array(	
				'C'=>'Please correct and resubmit',
				'N'=>'Resubmission not allowed',
				'P'=>'Please resubmit original transaction',
				'R'=>'Resubmission allowed',
				'S'=>'Do not resubmit; Inquiry initiated to a third party',
				'W'=>'Please wait 30 days and resubmit',
				'X'=>'Please wait 10 days and resubmit',  // 'Y'=>'Do not resubmit; We will hold your request and respond again shortly'
				'Y'=>'Do not resubmit; We will respond again shortly'
				);
				
		// provider PRV codes		
		$this->code271['PRV'] = array(			
				'AD'=>'Admitting',
				'AT'=>'Attending',
				'BI'=>'Billing',
				'CO'=>'Consulting',
				'CV'=>'Covering',
				'H'=>'Hospital',
				'HH'=>'Home Health Care',
				'LA'=>'Laboratory',
				'OT'=>'Other Physician',
				'P1'=>'Pharmacy',
				'PC'=>'Primary Care Physician',
				'PE'=>'Performing',
				'R'=>'Rural Health Clinic',
				'RF'=>'Referring',
				'SB'=>'Sunmitting',
				'SK'=>'Skilled Nursing Facility',
				'SU'=>'Supervising'
				);
				
	
		//REF codes
		$this->code271['REF'] = array(
				'18'=>'Plan Number',
				'1L'=>'Group or Policy number',
				'1W'=>'Member ID number',
				'3H'=>'Case number',
				'49'=>'Family unit number',
				'6P'=>'Group number',
				'CE'=>'Class of contract code',
				'CT'=>'Provider contract number',
				'EA'=>'Medical record ID number',
				'EJ'=>'Patient account number',
				'F6'=>'Health Ins claim (HIC) number',
				'GH'=>'ID card serial number',
				'HJ'=>'Identity card number',
				'IF'=>'Issue number',
				'IG'=>'Ins policy number',
				'N6'=>'Plan network ID number',
				'NQ'=>'Medicaid recipient ID number',
				'Q4'=>'Prior identifier number',
				'SY'=>'Social security number',
				'Y4'=>'Agency claim number',
				'NT'=>'Administrator\'s Reference Number',
				'BB'=>'Authorization Number',
				'0B'=>'State License Number',
				'1G'=>'Provider UPIN Number',
				'1J'=>'Facility ID Number',
				'EI'=>'Employer\'s ID Number',
				'G5'=>' Provider Site Number',
				'N5'=>'Provider Plan Network ID Number',
				'N7'=>'Facility Network IID Number',
				'ZH'=>' Carrier Assigned Reference Number'
				);

			
		// DTP date qualifiers
		$this->code271['DTP'] = array(
				'ABC'=>'Estimated Date of Birth',
				'AAH'=>'Event',
				'007'=>'Effective',
				'036'=>'Expiration',
				'096'=>'Discharge',
				'102'=>'Issue',
				'152'=>'Effective date of change',
				'291'=>'Plan',
				'303'=>'Maintenance effective',
				'307'=>'Eligibility',
				'318'=>'Added',
				'340'=>'COBRA begin',
				'341'=>'COBRA end',
				'342'=>'Premium paid to date begin',
				'343'=>'Premium paid to date end',
				'346'=>'Plan begin',
				'347'=>'Plan end',
				'348'=>'Benefit date',
				'349'=>'Benefit end',
				'356'=>'Eligibility begin',
				'357'=>'Eligibility end',
				'382'=>'Enrollment',
				'435'=>'Admission',
				'431'=>'Onset of Current Symptoms or Illness',
				'439'=>'Accident',
				'442'=>'Date of death',
				'458'=>'Certification',
				'472'=>'Service',
				'484'=>'Last Menstrual Period',
				'539'=>'Policy effective',
				'540'=>'Policy expiration',
				'636'=>'Date of last update',
				'771'=>'Status'
				);
	
	
		//entity identifier code  --code source 237
		$this->code271['NM101'] = array(	
				'03'=>'Dependent',
				'13'=>'Contracted Service Provider',
				'1I'=>'Preferred Provider Organization (PPO)',
				'1P'=>'Provider',
				'2B'=>'Third-Party Administrator',
				'5T'=>'X-Ray Radiation Therapy Unit',
				'5U'=>'CT Scanner Unit',
				'5V'=>'Diagnostic Radioisotope Facility',
				'5W'=>'Magnetic Resonance Imaging (MRI) Facility',
				'5X'=>'Ultrasound Unit',
				'5Y'=>'Rehabilitation Inpatient Unit',
				'5Z'=>'Rehabilitation Outpatient Services',
				'36'=>'Employer',
				'45'=>'Drop-off Location', 
				'70'=>'Prior Incorrect Insured',
				'71'=>'Attending Physician',
				'72'=>'Operating Physician',
				'73'=>'Other Physician',
				'74'=>'Corrected Insured',
				'75'=>'Participant',
				'77'=>'Service Location',
				'AAG'=>'Ground Ambulance Services',
				'AAJ'=>'Admitting Services',
				'AAK'=>'Primary Surgeon',
				'AAL'=>'Medical Nurse',
				'AAM'=>'Cardiac Rehabilitation Services',
				'AAN'=>'Skilled Nursing Services',
				'AAO'=>'Observation Room Services',
				'AAQ'=>'Anesthesiology Services',
				'CA'=>'Carrier',
				'DD'=>'Assistant Surgeon',
				'DK'=>'Ordering Physician',
				'DN'=>'Referring Provider',
				'EXS'=>'Ex-spouse',
				'FA'=>'Facility',
				'FS'=>'Final Scheduled Destination',
				'G3'=>'Clinic',
				'GG'=>'Intermediary',
				'GM'=>'Spouse Insured',
				'GP'=>'Gateway Provider',
				'GW'=>'Group',
				'HF'=>'HPSA Facility',
				'HH'=>'Home Health Agency',
				'I3'=>'Independent Physicians Association (IPA)',
				'IL'=>'Insured or Subscriber',
				'IR'=>'Self Insured',
				'LR'=>'Legal Representative',
				'NCT'=>'Name Changed To',
				'ND'=>'Next Destination',
				'NZ'=>'Primary Physician',
				'OC'=>'Origin Carrier',
				'OO'=>'Alternate Insurer',
				'ORI'=>'Original Name',
				'P2'=>'Primary Insured or Subscriber',
				'P3'=>'Primary Care Provider',
				'P4'=>'Prior Insurance Carrier',
				'P5'=>'Plan Sponsor',
				'PR'=>'Payer',
				'PRP'=>'Primary Payer',
				'PW'=>'Pickup Address',
				'QB'=>'Purchase Service Provider',
				'QV'=>'Group Practice',
				'R3'=>'Next Scheduled Destination',
				'SEP'=>'Secondary Payer',
				'SJ'=>'Service Provider',
				'TTP'=>'Tertiary Payer',
				'VER'=>'Party Performing Verification',
				'VN'=>'Vendor',
				'VY'=>'Organization Completing Configuration Change',
				'X3'=>'Utilization Management Organization',
				'X4'=>'Spouse',
				'Y2'=>'Managed Care Organization'				
				);


		// entity ID type code
		$this->code271['NM108'] = array(
				'24'=>'Employer ID Number (EIN)',
				'46'=>'Electronic Transmiter ID (ETIN)',
				'FI'=>'Federal Taxpayer ID',
				'II'=>'Standard Unique Health ID',
				'MI'=>'Member ID', 
				'NI'=>'NAIC Identification',
				'PI'=>'Payor ID',
				'SV'=>'Service Provider Number',
				'XV'=>'CMS Plan ID',
				'XX'=>'CMS National ID'
				);
	
		// Name -- entity relationship code
		$this->code271['NM110'] = array(
				'01'=>'Parent',
				'02'=>'Child',
				'27'=>'Domestic Partner',
				'41'=>'Spouse',
				'48'=>'Employee',
				'65'=>'Other',
				'72'=>'Unknown'
				);
	
		//	contact number identifier
		$this->code271['PER03'] = array(
				'ED'=>'EDI Access Number',
				'EM'=>'Electronic Mail',
				'FX'=>'Facsimile',
				'TE'=>'Telephone',
				'UR'=>'URL'
				);
			
		// MPI  qualifiers
		// the MPI03 Service affiliation qualifiers have 'SB' prepended
		$this->code271['MPI'] = array(
				'A'=>'Partial',
				'C'=>'Current',
				'L'=>'Latest',
				'O'=>'Oldest',
				'P'=>'Prior',
				'S'=>'Second most current',
				'T'=>'Third most current',
				'AE'=>'Active reserve',
				'AO'=>'Active military-overseas',
				'AS'=>'Academy student',
				'AT'=>'Presidential appointee',
				'CC'=>'Contractor',
				'DD'=>'Dishonorably discharges',
				'HD'=>'Honorably discharges',
				'IR'=>'Inactive reserve',
				'LX'=>'Leave of absence: military',
				'PE'=>'Plan to enlist',
				'RE'=>'REcommissioned',
				'RM'=>'Retired military-overseas',
				'RR'=>'Retired without recall',
				'RU'=>'REtired military-USA',
				'SBA'=>'Air Force',
				'SBB'=>'Air Force Reserves',
				'SBC'=>'Army',
				'SBD'=>'Army Reserves',
				'SBE'=>'Coast Guard',
				'SBF'=>'Marine Corps',
				'SBG'=>'Marine Corps Reserves',
				'SBH'=>'National Guard',
				'SBI'=>'Navy',
				'SBJ'=>'Navy Reserves',
				'SBK'=>'Other',
				'SBL'=>'Peace Corp',
				'SBM'=>'Regular Armed Forces',
				'SBN'=>'Reserves',
				'SBO'=>'U.S. Public Health Service',
				'SBQ'=>'Foreign Military',
				'SBR'=>'American Red Cross',
				'SBS'=>'Department of Defvense',
				'SBU'=>'Unites Services Organization',
				'SBW'=>'Military Sealift Command',
				'A1'=>'Admiral',
				'A2'=>'Airman',
				'A3'=>'Airman First Class',
				'B1'=>'Basic Airman',
				'B2'=>'Brigadier General',
				'C1'=>'Captain',
				'C2'=>'Chief Master Sergeant',
				'C3'=>'Chief Petty Officer',
				'C4'=>'Chief Warrant',
				'C5'=>'Colonel',
				'C6'=>'Commander',
				'C7'=>'Commodore',
				'C8'=>'Corporal',
				'C9'=>'Corporal Specialist 4',
				'E1'=>'Ensign',
				'F1'=>'First Lieutenant',
				'F2'=>'First Sergeant',
				'F3'=>'First Sergeant-Master Sergeant',
				'F4'=>'Fleet Admiral',
				'G1'=>'General',
				'G4'=>'Gunnery Sergeant',
				'L1'=>'Lance Corporal',
				'L2'=>'Lieutenant',
				'L3'=>'Lieutenant Colonel',
				'L4'=>'Lieutenant Commander',
				'L5'=>'Lieutenant General',
				'L6'=>'Lieutenant Junior Grade',
				'M1'=>'Major',
				'M2'=>'Major General',
				'M3'=>'Master Chief Petty Officer',
				'M4'=>'Master Gunnery Sergeant Major',
				'M5'=>'Master Sergeant',
				'M6'=>'Master Sergeant Specialist 8',
				'P1'=>'Petty Officer First Class',
				'P2'=>'Petty Officer Second Class',
				'P3'=>'Petty Officer Third Class',
				'P4'=>'Private',
				'P5'=>'Private First Class',
				'R1'=>'Rear Admiral',
				'R2'=>'Recruit',
				'S1'=>'Seaman',
				'S2'=>'Seaman Apprentice',
				'S3'=>'Seaman Recruit',
				'S4'=>'Second Lieutenant',
				'S5'=>'Senior Chief Petty Officer',
				'S6'=>'Senior Master Sergeant',
				'S7'=>'Sergeant',
				'S8'=>'Sergeant First Class Specialist 7',
				'S9'=>'Sergeant Major Specialist 9',
				'SA'=>'Sergeant Specialist 5',
				'SB'=>'Staff Sergeant',
				'SC'=>'Staff Sergeant Specialist 6',
				'T1'=>'Technical Sergeant',
				'V1'=>'Vice Admiral',
				'W1'=>'Warrant Officer'			
				);
	
		// eligibility or benifit information code
		$this->code271['EB01'] = array(			
				'1'=>'Active Coverage',
				'2'=>'Active-Full Risk Capitation',
				'3'=>'Active-Services Capitated',  			//	'4'=>'Active - Services Capitated to Primary Care Physician',
				'4'=>'Active-Capitated to PCP',
				'5'=>'Active-Pending Investigation',
				'6'=>'Inactive', 							//	'7'=>'Inactive - Pending Eligibility Update',
				'7'=>'Inactive-Pending Elig Update',
				'8'=>'Inactive-Pending Investigation',
				'A'=>'Co-Insurance',
				'B'=>'Co-Payment',
				'C'=>'Deductible',
				'D'=>'Benefit Description',
				'E'=>'Exclusions',
				'F'=>'Limitations',
				'G'=>'Out of Pocket (Stop Loss)',
				'H'=>'Unlimited',
				'I'=>'Non-Covered',
				'J'=>'Cost Containment',
				'K'=>'Reserve',
				'L'=>'Primary Care Provider',
				'M'=>'Pre-existing Condition',
				'N'=>'Services Restricted to Following Provider',
				'O'=>'Not Deemed a Medical Necessity',
				'P'=>'Benefit Disclaimer',
				'Q'=>'Second Surgical Opinion Required',
				'R'=>'Other or Additional Payor',
				'S'=>'Prior Year(s) History',
				'T'=>'Card(s) Reported Lost/Stolen',  		//	'U'=>'Contact Following Entity for Eligibility or Benefit Information',
				'U'=>'Contact Entity for Information',
				'V'=>'Cannot Process',
				'W'=>'Other Source of Data',
				'X'=>'Health Care Facility',
				'Y'=>'Spend Down',
				'CB'=>'Coverage Basis',
				'MC'=>'Managed Care Coordinator'
				);
		
		// coverage level code		
		$this->code271['EB02'] = array(		
				'CHD'=>'Children Only',
				'DEP'=>'Dependents Only',
				'E1D'=>'Employee and One Dependent',
				'E2D'=>'Employee and Two Dependents',
				'E3D'=>'Employee and Three Dependents',
				'E5D'=>'Employee and One or More Dependents',
				'E6D'=>'Employee and Two or More Dependents',
				'E7D'=>'Employee and Three or More Dependents',
				'E8D'=>'Employee and Four or More Dependents',
				'E9D'=>'Employee and Five or More Dependents',
				'ECH'=>'Employee and Children',
				'EMP'=>'Employee Only',
				'ESP'=>'Employee and Spouse',
				'FAM'=>'Family',
				'IND'=>'Individual',
				'SPC'=>'Spouse and Children',
				'SPO'=>'Spouse Only',
				'TWO'=>'Two Party'
				);
		
		// service type code 
		$this->code271['EB03'] = array(
				'1'=>'Medical Care',
				'2'=>'Surgical',
				'3'=>'Consultation',
				'4'=>'Diagnostic X-Ray',
				'5'=>'Diagnostic Lab',
				'6'=>'Radiation Therapy',
				'7'=>'Anesthesia',
				'8'=>'Surgical Assistance',
				'10'=>'Blood',
				'11'=>'Used Durable Medical Equipment',
				'12'=>'Durable Medical Equipment Purchase',
				'13'=>'Ambulatory Service Center Facility',
				'14'=>'Renal Supplies',
				'15'=>'Alternate Method Dialysis',
				'16'=>'Chronic Renal Disease (CRD) Equipment',
				'17'=>'Pre-Admission Testing',
				'18'=>'Durable Medical Equipment Rental',
				'19'=>'Pneumonia Vaccine',
				'20'=>'Second Surgical Opinion',
				'21'=>'Third Surgical Opinion',
				'22'=>'Social Work',
				'23'=>'Diagnostic Dental',
				'24'=>'Periodontics',
				'25'=>'Restorative',
				'26'=>'Endodontics',
				'27'=>'Maxillofacial Prosthetics',
				'28'=>'Adjunctive Dental Services',
				'30'=>'Health Benefit Plan Coverage',
				'32'=>'Plan Waiting Period',
				'33'=>'Chiropractic',
				'34'=>'Chiropractic Office Visits',
				'35'=>'Dental Care',
				'36'=>'Dental Crowns',
				'37'=>'Dental Accident',
				'38'=>'Orthodontics',
				'39'=>'Prosthodontics',
				'40'=>'Oral Surgery',
				'41'=>'Preventive Dental',
				'42'=>'Home Health Care',
				'43'=>'Home Health Prescriptions',
				'45'=>'Hospice',
				'46'=>'Respite Care',
				'47'=>'Hospitalization',
				'48'=>'Hospital-Inpatient',
				'49'=>'Hospital-Room and Board',
				'50'=>'Hospital-Outpatient',
				'51'=>'Hospital-Emergency Accident',
				'52'=>'Hospital-Emergency Medical',
				'53'=>'Hospital-Ambulatory Surgical',
				'54'=>'Long Term Care',
				'55'=>'Major Medical',
				'56'=>'Medically Related Transportation',
				'60'=>'General Benefits',
				'61'=>'In-vitro Fertilization',
				'62'=>'MRI Scan',
				'63'=>'Donor Procedures',
				'64'=>'Acupuncture',
				'65'=>'Newborn Care',
				'66'=>'Pathology',
				'67'=>'Smoking Cessation',
				'68'=>'Well Baby Care',
				'69'=>'Maternity',
				'70'=>'Transplants',
				'71'=>'Audiology',
				'72'=>'Inhalation Therapy',
				'73'=>'Diagnostic Medical',
				'74'=>'Private Duty Nursing',
				'75'=>'Prosthetic Device',
				'76'=>'Dialysis',
				'77'=>'Otology',
				'78'=>'Chemotherapy',
				'79'=>'Allergy Testing',
				'80'=>'Immunizations',
				'81'=>'Routine Physical',
				'82'=>'Family Planning',
				'83'=>'Infertility',
				'84'=>'Abortion',
				'85'=>'HIV-AIDS Treatment',
				'86'=>'Emergency Services',
				'87'=>'Cancer Treatment',
				'88'=>'Pharmacy',
				'89'=>'Free Standing Prescription Drug',
				'90'=>'Mail Order Prescription Drug',
				'91'=>'Brand Name Prescription Drug',
				'92'=>'Generic Prescription Drug',
				'93'=>'Podiatry',
				'94'=>'Podiatry-Office Visits',
				'95'=>'Podiatry-Nursing Home Visits',
				'96'=>'Professional (Physician)',
				'97'=>'Anesthesiologist', 				// '98'=>'Professional (Physician) Visit - Office',
				'98'=>'Physician Visit-Office',  		// '99'=>'Professional (Physician) Visit - Inpatient',
				'99'=>'Physician Visit-Inpatient',	// 'A0'=>'Professional (Physician) Visit - Outpatient',
				'A0'=>'Physician Visit-Outpatient',	// 'A1'=>'Professional (Physician) Visit - Nursing Home',
				'A1'=>'Physician Visit-Nursing Home',	// 'A2'=>'Professional (Physician) Visit - Skilled Nursing Facility',
				'A2'=>'Physician Visit-SNF',			// 'A3'=>'Professional (Physician) Visit - Home',
				'A3'=>'Physician Visit-Home',			// 
				'A4'=>'Psychiatric',
				'A5'=>'Psychiatric-Room and Board',
				'A6'=>'Psychotherapy',
				'A7'=>'Psychiatric-Inpatient',
				'A8'=>'Psychiatric-Outpatient',
				'A9'=>'Rehabilitation',
				'AB'=>'Rehabilitation-Inpatient',
				'AC'=>'Rehabilitation-Outpatient',
				'AD'=>'Occupational Therapy',
				'AE'=>'Physical Medicine',
				'AF'=>'Speech Therapy',
				'AG'=>'Skilled Nursing Care',
				'AI'=>'Substance Abuse',
				'AJ'=>'Alcoholism Treatment',
				'AK'=>'Drug Addiction',
				'AL'=>'Vision (Optometry)',
				'AM'=>'Frames',
				'AO'=>'Lenses',
				'AP'=>'Routine Eye Exam',
				'AQ'=>'Nonmedically Necessary Physical',
				'AR'=>'Experimental Drug Therapy',
				'B1'=>'Burn Care',
				'B2'=>'Brand Name Prescription Drug-Formulary',
				'B3'=>'Brand Name Prescription Drug-Non-Formulary',
				'BA'=>'Independent Medical Evaluation',
				'BB'=>'Psychiatric Treatment Partial Hospitalization',
				'BC'=>'Day Care (Psychiatric)',
				'BD'=>'Cognitive Therapy',
				'BE'=>'Massage Therapy',
				'BF'=>'Pulmonary Rehabilitation',
				'BG'=>'Cardiac Rehabilitation',
				'BH'=>'Pediatric',
				'BI'=>'Nursery Room and Board',
				'BK'=>'Orthopedic',
				'BL'=>'Cardiac',
				'BM'=>'Lymphatic',
				'BN'=>'Gastrointestinal',
				'BP'=>'Endocrine',
				'BQ'=>'Neurology',
				'BR'=>'Eye',
				'BS'=>'Invasive Procedures',
				'BT'=>'Gynecological',
				'BU'=>'Obstetrical',
				'BV'=>'Obstetrical/Gynecological',
				'BW'=>'Mail Order Prescription Drug: Brand Name',
				'BX'=>'Mail Order Prescription Drug: Generic',
				'BY'=>'Physician Visit-Sick',
				'BZ'=>'Physician Visit-Well',
				'C1'=>'Coronary Care',
				'CA'=>'Private Duty Nursing-Inpatient',
				'CB'=>'Private Duty Nursing-Home',
				'CC'=>'Surgical Benefits-Professional (Physician)',
				'CD'=>'Surgical Benefits-Facility',
				'CE'=>'Mental Health Provider-Inpatient',
				'CF'=>'Mental Health Provider-Home',
				'CG'=>'Mental Health Facility-Inpatient',
				'CH'=>'Mental Health Facility-Outpatient',
				'CI'=>'Substance Abuse Facility-Inpatient',
				'CJ'=>'Substance Abuse Facility-Outpatient',
				'CK'=>'Screening X-ray',
				'CL'=>'Screening laboratory',
				'CM'=>'Mammogram, High Risk Patient',
				'CN'=>'Mammogram, Low Risk Patient',
				'CO'=>'Flu Vaccination',
				'CP'=>'Eyewear and Eyewear Accessories',
				'CQ'=>'Case Management',
				'DG'=>'Dermatology',
				'DM'=>'Durable Medical Equipment',
				'DS'=>'Diabetic Supplies',
				'E0'=>'Allied Behavioral Analysis Therapy',
				'E1'=>'Non-Medical Equipment (non DME)',
				'E2'=>'Psychiatric Emergency',
				'E3'=>'Step Down Unit',
				'E4'=>'Skilled Nursing Facility Head Level of Care',
				'E5'=>'Skilled Nursing Facility Ventilator Level of Care',
				'E6'=>'Level of Care 1',
				'E7'=>'Level of Care 2',
				'E8'=>'Level of Care 3',
				'E9'=>'Level of Care 4',
				'E10'=>'Radiographs',
				'E11'=>'Diagnostic Imaging',
				'E12'=>'Basic Restorative-Dental',
				'E13'=>'Major Restorative-Dental',
				'E14'=>'Fixed Prosthodontics',
				'E15'=>'Removable Prosthodontics',
				'E16'=>'Intraoral Images-Complete Series',
				'E17'=>'Oral Evaluation',
				'E18'=>'Dental Prophylaxis',
				'E19'=>'Panoramic Images',
				'E20'=>'Sealants',
				'E21'=>'Flouride Treatments',
				'E22'=>'Dental Implants',
				'E23'=>'Temporomandibular Joint Dysfunction',
				'E24'=>'Retail Pharmacy Prescription Drug',
				'E25'=>'Long Term Care Pharmacy',				// 'E26'=>'Comprehensive Medication Therapy Management Review',
				'E26'=>'Comp Med Therapy Mgmt Review',			// 'E27'=>'Targeted Medication Therapy Management Review',
				'E27'=>'Targeted Med Therapy Mgmt Review',
				'E28'=>'Dietary/Nutritional Services',
				'EA'=>'Preventive Services',
				'EB'=>'Specialty Pharmacy',
				'EC'=>'Durable Medical Equipment New',
				'ED'=>'CAT Scan',
				'EE'=>'Ophthalmology',
				'EF'=>'Contact Lenses',							// 'GF'=>'Generic Prescription Drug - Formulary',
				'GF'=>'Generic Rx-Formulary',					// 'GN'=>'Generic Prescription Drug - Non-Formulary',
				'GN'=>'Generic Rx-Non-Formulary',
				'GY'=>'Allergy',
				'IC'=>'Intensive Care',
				'MH'=>'Mental Health',
				'NI'=>'Neonatal Intensive Care',
				'ON'=>'Oncology',								// 'PE'=>'Positron Emission Tomography (PET) Scan',
				'PE'=>'(PET) Scan',
				'PT'=>'Physical Therapy',
				'PU'=>'Pulmonary',
				'RN'=>'Renal',
				'RT'=>'Residential Psychiatric Treatment',
				'SMH'=>'Serious Mental Health',
				'TC'=>'Transitional Care',
				'TN'=>'Transitional Nursery Care',
				'UC'=>'Urgent Care'
				);
				
		// insurance type codes
		$this->code271['EB04'] = array(			
				'D'=>'Disability',
				//'12'=>'Medicare Secondary Working Aged Beneficiary or Spouse with Employer Group Health Plan',
				//'13'=>'Medicare Secondary End-Stage Renal Disease Beneficiary in the 12 month coordination period with an employer\'s group health plan',
				//'14'=>'Medicare Secondary, No-fault Insurance including Auto is Primary',
				//'15'=>'Medicare Secondary Worker\'s Compensation',
				//'16'=>'Medicare Secondary Public Health Service (PHS)or Other Federal Agency',
				//'41'=>'Medicare Secondary Black Lung',
				//'42'=>'Medicare Secondary Veteran\'s Administration',
				//'43'=>'Medicare Secondary Disabled Beneficiary Under Age 65 with Large Group Health Plan (LGHP)',
				//'47'=>'Medicare Secondary, Other Liability Insurance is Primary',
				'12'=>'Medicare Secondary',
				'13'=>'Medicare Secondary (ESRD)',
				'14'=>'Medicare Secondary (No-fault Primary)',
				'15'=>'Medicare Secondary (WC)',
				'16'=>'Medicare Secondary (PHS)',
				'41'=>'Medicare Secondary (Black Lung)',
				'42'=>'Medicare Secondary (VA)',
				'43'=>'Medicare Secondary (LGHP)',
				'47'=>'Medicare Secondary, Liability Ins Primary',			
				'AP'=>'Auto Insurance Policy',
				'C1'=>'Commercial',				// 'CO'=>'Consolidated Omnibus Budget Reconciliation Act (COBRA)',
				'CO'=>'(COBRA)',
				'CP'=>'Medicare Conditionally Primary',
				'DB'=>'Disability Benefits',
				'EP'=>'Exclusive Provider Organization',
				'FF'=>'Family or Friends',
				'GP'=>'Group Policy',			//'HM'=>'Health Maintenance Organization (HMO)',
				'HM'=>'(HMO)',					//'HN'=>'Health Maintenance Organization (HMO) - Medicare Risk',
				'HN'=>'(HMO)-Medicare Risk',	//'HS'=>'Special Low Income Medicare Beneficiary',
				'HS'=>'Special Low Income Medicare',			
				'IN'=>'Indemnity',
				'IP'=>'Individual Policy',
				'LC'=>'Long Term Care',
				'LD'=>'Long Term Policy',
				'LI'=>'Life Insurance',
				'LT'=>'Litigation',
				'MA'=>'Medicare Part A',
				'MB'=>'Medicare Part B',
				'MC'=>'Medicaid',
				'MH'=>'Medigap Part A',
				'MI'=>'Medigap Part B',
				'MP'=>'Medicare Primary',
				'OT'=>'Other',					//'PE'=>'Property Insurance - Personal',
				'PE'=>'Property Ins-Personal',
				'PL'=>'Personal',				//'PP'=>'Personal Payment (Cash - No Insurance)',
				'PP'=>'Cash (No Ins)',			//'PR'=>'Preferred Provider Organization (PPO)',
				'PR'=>'(PPO)',			
				'PS'=>'Point of Service (POS)',
				'QM'=>'Qualified Medicare Beneficiary',
				'RP'=>'Property Insurance-Real',
				'SP'=>'Supplemental Policy',	//'TF'=>'Tax Equity Fiscal Responsibility Act (TEFRA)',
				'TF'=>'(TEFRA)',
				'WC'=>'Workers Compensation',
				'WU'=>'Wrap Up Policy'
				);
				
		// time period qualifier
		$this->code271['EB06'] = array(			
				'1'=>'Month',
				'2'=>'Year',
				'6'=>'Hour',
				'7'=>'Day',
				'21'=>'Years',
				'22'=>'Service Year',
				'23'=>'Calendar Year',
				'24'=>'Year to Date',
				'25'=>'Contract',
				'26'=>'Episode',
				'27'=>'Visit',
				'28'=>'Outlier',
				'29'=>'Remaining',
				'30'=>'Exceeded',
				'31'=>'Not Exceeded',
				'33'=>'Lifetime Remaining',
				'34'=>'Month',
				'35'=>'Week',
				'36'=>'Admission',			//'A'=>'Hourly Appurtenance Units (Hours of Enhancement/Addition to Equipment)',
				'A'=>'Hourly Appurtenance Units',
				'D'=>'Daily Time Units',
				'H'=>'Hourly Time Units',
				'O'=>'Other Time Units'
				);
		
		// quantity type qualifier
		$this->code271['EB09'] = array(
				'8H'=>'Minimum',
				'99'=>'Quantity Used',
				'CA'=>'Covered-Actual',
				'CE'=>'Covered-Estimated',
				'D3'=>'Number of Co-insurance Days',
				'DB'=>'Deductible Blood Units',
				'DY'=>'Days',
				'HS'=>'Hours',
				'LA'=>'Life-time Reserve-Actual',
				'LE'=>'Life-time Reserve-Estimated',
				'M2'=>'Maximum',
				'MN'=>'Month',
				'P6'=>'Number of Services or Procedures',
				'QA'=>'Quantity Approved',
				'S7'=>'Age, High Value',
				'S8'=>'Age, Low Value',
				'VS'=>'Visits',
				'YY'=>'Years'
				);
				
		// authorization required code
		$this->code271['EB11'] = array(
				'N'=>'Pre-Auth: No',
				'U'=>'Pre-Auth: Unknown',
				'Y'=>'Pre-Auth: Yes'
				);
				
		// in-network status
		$this->code271['EB12'] = array(
				'N'=>'In Network: No',
				'U'=>'In Network: Unknown',
				'W'=>'In Network: N/A',
				'Y'=>'In Network: Yes'
				);				
											
		// product/service id qualifier
		$this->code271['EB13'] = array(
				'AD'=>'Am Dental Assoc Codes',
				'CJ'=>'CPT Codes',
				'HC'=>'HCPCS Codes',
				'ID'=>'ICD-9-CM-Procedure',					// 'IV'=>'Home Infusion EDI Coalition (HIEC) Product/Service Code',
				'IV'=>'(HIEC) Product/Service Code',			// 'N4'=>'National Drug Code in 5-4-2 Format',
				'N4'=>'Nat\'l Drug Code 5-4-2 Fmt',
				'ZZ'=>'Mutually Defined'
				);	
				
		// quantity qualifier - unit or basis copde
		$this->code271['HSD01'] = array(	
				'DY'=>'Days',
				'FL'=>'Units',
				'HS'=>'Hours',
				'MN'=>'Month',
				'VS'=>'Visit',
				'DA'=>'Days',
				'MO'=>'Months',
				'WK'=>'Week',
				'YR'=>'Years'			
				);
	
		// delivery frequency code
		$this->code271['HSD07'] = array(
				'1'=>'1st Week of Month',
				'2'=>'2nd Week of Month',
				'3'=>'3rd Week of Month',
				'4'=>'4th Week of Month',
				'5'=>'5th Week of Month',
				'6'=>'1st & 3rd Weeks of Month',
				'7'=>'2nd & 4th Weeks of Month',
				'8'=>'1st Working Day of Period',
				'9'=>'Last Working Day of Period',
				'A'=>'Mon through Fri',
				'B'=>'Mon through Sat',
				'C'=>'Mon through Sun',
				'D'=>'Monday',
				'E'=>'Tuesday',
				'F'=>'Wednesday',
				'G'=>'Thursday',
				'H'=>'Friday',
				'J'=>'Saturday',
				'K'=>'Sunday',
				'L'=>'Mon through Thur',
				'M'=>'Immediately',
				'N'=>'As Directed',
				'O'=>'Daily Mon. through Fri.',
				'P'=>'1/2 Mon & 1/2 Thurs',
				'Q'=>'1/2 Tue & 1/2 Thur',
				'R'=>'1/2 Wed & 1/2 Fri',
				'S'=>'Once Anytime Mon through Fri',
				'T'=>'1/2 Tue & 1/2 Fri',
				'U'=>'1/2 Mon. & 1/2 Wed',
				'V'=>'1/3 Mon, 1/3 Wed, 1/3 Fri',
				'W'=>'When Necessary',
				'X'=>'1/2 By Wed, Bal. By Fri',
				'Y'=>'None/Cancel/Override',
				'Z'=>'Mutually Defined',
				'SA'=>'Sun, Mon, Thur, Fri, Sat',
				'SB'=>'Tue through Sat',
				'SC'=>'Sun, Wed, Thur, Fri, Sat',
				'SD'=>'Mon, Wed, Thur, Fri, Sat',
				'SG'=>'Tue through Fri',
				'SL'=>'Mon, Tue and Thur',
				'SP'=>'Mon, Tue and Fri',
				'SX'=>'Wed and Thur',
				'SY'=>'Mon, Wed and Thur',
				'SZ'=>'Tue, Thur and Fri',
				);
	
		// Ship/Delivery Pattern Time Code
		$this->code271['HSD08'] = array(			
				'A'=>'1st Shift (9-5)',
				'B'=>'2nd Shift',
				'C'=>'3rd Shift',
				'D'=>'A.M.',
				'E'=>'P.M.',
				'F'=>'As Directed',
				'G'=>'Any Shift',
				'Y'=>'None/Cancel/Override',
				'Z'=>'Mutually Defined'
				);
				
		$this->code271['IIIGR'] = array(
				'1'=>' No Physical Injury',
				'01'=>' No Physical Injury',
				'2'=>' Amputation',
				'02'=>' Amputation',
				'3'=>' Angina Pectoris',
				'03'=>' Angina Pectoris',
				'4'=>' Burn',
				'04'=>' Burn',
				'7'=>' Concussion',
				'07'=>' Concussion',
				'10'=>' Contusion',
				'13'=>' Crushing',
				'16'=>' Dislocation',
				'19'=>' Electric Shock',
				'22'=>' Enucleation',
				'25'=>' Foreign Body',
				'28'=>' Fracture',
				'30'=>' Freezing',
				'31'=>' Hearing Loss or Impairment',
				'32'=>' Heat Prostration',
				'34'=>' Hernia',
				'36'=>' Infection',
				'37'=>' Inflammation',
				'40'=>' Laceration',
				'41'=>' Myocardial Infarction',
				'42'=>' Poisoning-General',
				'43'=>' Puncture',
				'46'=>' Rupture',
				'47'=>' Severance',
				'49'=>' Sprain or Tear',
				'52'=>' Strain or Tear',
				'53'=>' Syncope',
				'54'=>' Asphyxiation',
				'55'=>' Vascular',
				'58'=>' Vision Loss',
				'59'=>' All Other Specific Injuries, NOC',
				'60'=>' Dust Disease, NOC',
				'61'=>' Asbestosis',
				'62'=>' Black Lung',
				'63'=>' Byssinosis',
				'64'=>' Silicosis',
				'65'=>' Respiratory Disorders',
				'66'=>' Poisoning-Chemical, (Other Than Metals)',
				'67'=>' Poisoning-Metal',
				'68'=>' Dermatitis',
				'69'=>' Mental Disorder',
				'70'=>' Radiation',
				'71'=>' All Other Occupational Disease Injury, NOC',
				'72'=>' Loss of Hearing',
				'73'=>' Contagious Disease',
				'74'=>' Cancer',
				'75'=>' AIDS',
				'76'=>' VDT-Related Diseases',
				'77'=>' Mental Stress',
				'78'=>' Carpal Tunnel Syndrome',
				'79'=>' Hepatitis C',
				'80'=>' All Other Cumulative Injury, NOC',
				'90'=>' Multiple Physical Injuries Only',
				'91'=>' Multiple Injuries Including Both Physical & Psychological'
				);

				
		//place of service  --code source 237
		$this->code271['POS'] = array(				
				'01'=>'Pharmacy',
				'02'=>'Unassigned',
				'03'=>'School',
				'04'=>'Homeless Shelter',
				'05'=>'Indian Health Service Free-standing Facility',
				'06'=>'Indian Health Service Provider-based Facility',
				'07'=>'Tribal 638 Free-standing Facility',
				'08'=>'Tribal 638 Provider-based Facility',
				'09'=>'Prison/Correctional Facility',
				'11'=>'Office',
				'12'=>'Home ',
				'13'=>'Assisted Living Facility',
				'14'=>'Group Home',
				'15'=>'Mobile Unit',
				'16'=>'Temporary Lodging',
				'17'=>'Walk-in Retail Health Clinic',
				'20'=>'Urgent Care Facility',
				'21'=>'Inpatient Hospital',
				'22'=>'Outpatient Hospital',
				'23'=>'Emergency Room-Hospital',
				'24'=>'Ambulatory Surgical Center',
				'25'=>'Birthing Center',
				'26'=>'Military Treatment Facility',
				'31'=>'Skilled Nursing Facility',
				'32'=>'Nursing Facility',
				'33'=>'Custodial Care Facility',
				'34'=>'Hospice',
				'41'=>'Ambulance-Land',
				'42'=>'Ambulance-Air or Water',
				'49'=>'Independent Clinic',
				'50'=>'Federally Qualified Health Center',
				'51'=>'Inpatient Psychiatric Facility',
				'52'=>'Psychiatric Facility-Partial Hospitalization',
				'53'=>'Community Mental Health Center',
				'54'=>'Intermediate Care Facility/Mentally Retarded',
				'55'=>'Residential Substance Abuse Treatment Facility',
				'56'=>'Psychiatric Residential Treatment Center',
				'57'=>'Non-residential Substance Abuse Treatment Facility',
				'60'=>'Mass Immunization Center',
				'61'=>'Comprehensive Inpatient Rehabilitation Facility',
				'62'=>'Comprehensive Outpatient Rehabilitation Facility',
				'71'=>'Public Health Clinic',
				'72'=>'Rural Health Clinic',
				'81'=>'Independent Laboratory',
				'99'=>'Other Place of Service'
				);
			
		// insurance relationship code  
		$this->code271['INS02'] = array(	
				'18'=>'self',
				'01'=>'spouse',
				'19'=>'child', 
				'20'=>'employee',
				'21'=>'unknown'
				);
				
		// 278 authorization Health Care Services Review
		$this->code271['UM01'] = array(
				'AR'=>'Admission review',
				'HS'=>'Health Services Review',
				'IN'=>'Individual',
				'SC'=>'Specialty Care review'
				);
				
		$this->code271['UM02'] = array( 
				'1'=>'Appeal--Immediate', 
				'2'=>'Appeal--Standard', 
				'3'=>'Cancel',  
				'4'=>'Extension',
				'I'=>'Initial',
				'N'=>'Reconsideration', 
				'R'=>'Renewal',
				'S'=>'Revised'
				);
		
		// related causes code		
		$this->code271['UM05'] = array( 
				'AA'=>'Auto Accident',  
				'AP'=>'Another Party responsible',  
				'EM'=>'Employment'
				);
		
		// level of service code	
		$this->code271['UM06'] = array(
				'03'=>'Emergency', 
				'E'=>'Elective', 
				'U'=>'Urgent'
				);
		
		// current patient condition code
		$this->code271['UM07'] = array(
				'1'=>'Acute',
				'2'=>'Stable',
				'3'=>'Chronic',
				'4'=>'Systemic',
				'5'=>'Localized',
				'6'=>'Mild Disease',
				'7'=>'Normal, Healthy',
				'8'=>'Severe Systemic Disease',
				'9'=>'Severe Systemic Disease Constant Threat to Life',
				'E'=>'Excellent',
				'F'=>'Fair',
				'G'=>'Good',
				'P'=>'Poor'
				);
		
		// prognosis code
		$this->code271['UM08'] = array(
				'1'=>'Poor',
				'2'=>'Guarded',
				'3'=>'Fair',
				'4'=>'Good',
				'5'=>'Very Good',
				'6'=>'Excellent',
				'7'=>'Less than 6 Months to Live',
				'8'=>'Terminal'
				);
		
		// delay reason code
		$this->code271['UM10'] = array(
				'1'=>'Proof of Eligibility Unknown',
				'2'=>'Litigation',
				'3'=>'Authorization Delays',
				'4'=>'Delay in Certifying Provider',
				'7'=>'Third Party Processing Delay',
				'8'=>'Delay in Eligibility Determination',
				'10'=>'Administration Delay in Prior Approval Process',
				'11'=>'Other',
				'15'=>'Natural Disaster',
				'16'=>'Lack of Information',
				'17'=>'No Response to Initial Request'
				);
				
		// certification action code
		$this->code271['HCR01'] = array(
				'A1'=>'Certified in total', 
				'A2'=>'Certified - partial', 
				'A3'=>'Not Certified',
				'A4'=>'Pended', 
				'A6'=>'Modified', 
				'C'=>'Cancelled', 
				'CT'=>'Contact Payer', 
				'NA'=>'No Action Required'
				);
				
		// health care decision reason code			
		$this->code271['HCR03'] = array(				
				'1'=>'Price Authorization Expired',
				'2'=>'Price authorization no longer required',
				'3'=>'Product not on the price authorization',
				'4'=>'Authorized Quantity Exceeded',
				'5'=>'Special Cost Incorrect',
				'6'=>'No Credit Allowed',
				'7'=>'Administrative Cancellation',
				'8'=>'Unit resale higher than authorized',
				'9'=>'Out of Network',
				'0A'=>'Testing not Included',
				'0B'=>'Request Forwarded To and Decision Response Forthcoming From an External Review Organization',
				'0C'=>'Authorization/Access Restrictions',
				'0D'=>'Requires PCP authorization',
				'0E'=>'Provider is Not Primary Care Physician',
				'0F'=>'Not Medically Necessary',
				'0G'=>'Level of Care Not Appropriate',
				'0H'=>'Certification Not Required for this Service',
				'0J'=>'Certification Responsibility of External Review Organization',
				'0K'=>'Primary Care Service',
				'0L'=>'Exceeds Plan Maximums',
				'0M'=>'Non-covered Service',
				'0N'=>'No Prior Approval',
				'0P'=>'Requested Information Not Received',
				'0Q'=>'Duplicate Request',
				'0R'=>'Service Inconsistent with Diagnosis',
				'0S'=>'Pre-existing Condition',
				'0T'=>'Experimental Service or Procedure',
				'0U'=>'Additional Patient Information required',
				'0V'=>'Requires Medical Review',
				'0W'=>'Disposition pending review',
				'0X'=>'Service Inconsistent with Provider Type',
				'0Y'=>'Service inconsistent with Patient\'s Age',
				'0Z'=>'Service inconsistent with Patient\'s Gender',
				'10'=>'Product/service/procedure delivery pattern (e.g., units, days, visits, weeks, hours, months)',
				'11'=>'Pricing',
				'12'=>'Patient is restricted to specific provider',
				'13'=>'Service authorized for another provider',
				'14'=>'Plan/contractual guidelines not followed',
				'15'=>'Plan/contractual geographic restriction',
				'16'=>'Inappropriate facility type',
				'17'=>'Time limits not met',
				'18'=>'Notification received',
				'19'=>'Cosmetic',
				'20'=>'Once in a lifetime restriction applies',
				'21'=>'Transport Request Denied',
				'22'=>'Ambulance Certification Segment information doesn\'t correspond to Transport Address Segment',
				'23'=>'Mileage cannot be computed based on data submitted',
				'24'=>'Computed mileage is inconsistent with transport information or service units submitted',
				'25'=>'Services were not considered due to other errors in the request.',
				'26'=>'Missing Provider Role',
				'27'=>'Patient in Health Insurance Exchange premium payment grace period -- first month.',
				'28'=>'Patient in Health Insurance Exchange premium payment grace period -- second month.',
				'29'=>'Patient in Health Insurance Exchange premium payment grace period -- third month.',
				);

		// yes/no condition code			
		$this->code271['HCR04'] = array(									
				'N'=>'No',
				'U'=>'Unknown',
				'W'=>'Not Applicable',
				'Y'=>'Yes'
				);

				
		// code source identifier code			
		$this->code271['HI01'] = array(
				'ABF'=>'ICD-10-CM Diagnosis',
				'ABJ'=>'ICD-10-CM Admitting Diagnosis',
				'ABK'=>'ICD-10-CM Principal Diagnosis',
				'APR'=>'ICD-10-CM Patient Reason for Visit',
				'BF'=>'ICD-9-CM Diagnosis',
				'BJ'=>'ICD-9-CM Admitting Diagnosis',
				'BK'=>'ICD-9-CM Principal Diagnosis',
				'DR'=>'Diagnosis Related Group (DRG)',
				'PR'=>'ICD-9-CM Patient Reason for Visit',
				'LOI'=>'LOINC codes'
				);
				
		// code source identifier		
		$this->code271['SV101'] = array(				
				'HP'=>'Health Insurance Prospective Payment System',
				'N6'=>'National Health Related Item Code in 4-6 Format',
				'UI'=>'U.P.C. Consumer Package Code (1-5-5)',
				'WK'=>'Advanced Billing Concepts (ABC) Codes.',
				'AD'=>'American Dental Association Codes.',
				'CJ'=>'Current Procedural Terminology (CPT) Codes',
				'DX'=>'(ICD-9-CM) - Diagnosis',
				'EN'=>'EAN/UCC--13',
				'EO'=>'EAN/UCC--8',
				'ER'=>'Jurisdiction Specific Procedure and Supply Codes',
				'HC'=>'(HCPCS) Codes',
				'HI'=>'HIBC (Health Care Industry Bar Code) Supplier Labeling Standard Primary Data Message',
				'HP'=>'Health Insurance Prospective Payment System (HIPPS) Skilled Nursing Facility Rate Code',
				'ID'=>'(ICD-9-CM) - Procedure',
				'IV'=>'Home Infusion EDI Coalition (HIEC) Product/Service Code',
				'N4'=>'National Drug Code in 5-4-2 Format',
				'N6'=>'National Health Related Item Code in 4-6 Format',
				'NU'=>'National Uniform Billing Committee (NUBC) UB92 Codes',
				'ON'=>'Customer Order Number',
				'UI'=>'U.P.C. Consumer Package Code (1-5-5)',
				'UK'=>'GTIN 14-digit Data Structure',
				'UP'=>'UCC--12',
				'WK'=>'Advanced Billing Concepts (ABC) Codes',
				'ZZ'=>'Mutually Defined' 
				);
				
				
		// code source identifier		
		$this->code271['SV103'] = array(
				'DA'=>'Days',	
				'F2'=>'International Unit',
				'MJ'=>'Minutes', 
				'UN'=>'Unit'
				);
 
		// nursing home level of care		
		$this->code271['SV120'] = array(		
				'1'=>'Skilled Nursing Facility (SNF)', 
				'2'=>'Intermediate Care Facility (ICF)',
				'3'=>'Intermediate Care Facility - Mentally Retarded (ICF-MR)', 
				'4'=>'Chronic Disease Hospital (CD)', 
				'5'=>'ntermediate Care Facility (ICF) Level II I',
				'6'=>'Special Skilled Nursing Facility (SNF)', 
				'7'=>'Nursing Facility (NF)',
				'8'=>'Hospice'
				);
		
						
		// admission type code			
		$this->code271['CL101'] = array(
				'1'=>'Emergency',
				'2'=>'Urgent',
				'3'=>'Elective',
				'4'=>'Newborn',
				'5'=>'Trauma',
				'9'=>'Information not available'
				);
				
		// admission source type code			
		$this->code271['CL102'] = array(			
				'1'=>'Physician Referral',
				'2'=>'Clinic Referral',
				'3'=>'HMO Referral',
				'4'=>'Transfer from a Hospital',
				'5'=>'Transfer from a Skilled Nursing Facility (SNF)',
				'6'=>'Transfer from Another Health Facility',
				'7'=>'Emergency Room',
				'8'=>'Court/Law Enforcement',
				'9'=>'Information Not Available',
				'10'=>'Transfer from Psych Substance Abuse or Rehab Hospital',
				'11'=>'Transfer from a Critical Access Hospital',
				'E'=>'Transfer from Ambulatory Surgical Center',
				'F'=>'Transfer from Hospice and is Under a Hospice Plan of Care or Enrolled in Hospice Program'
				);

		// release of information indicator code
		// -- which segment?			
		//$this->code271['CL102'] = array(	
				//'Y'=>'Yes',
				//'R'=>'Restricted or Modified Release',
				//'N'=>'No Release'
			//};

				
				
		// patient status code			
		$this->code271['CL103'] = array(	
				'1'=>'Discharged to Home or Self-Care (Routine Discharge)',
				'2'=>'Discharged/Transferred to Another Short-Term General Hospital',
				'3'=>'Discharged/Transferred to an SNF',
				'4'=>'Discharged/Transferred to an Intermediate Care Facility (ICF)',
				'5'=>'Discharged/Transferred to Another Type of Institution (Including Distinct Parts) or Referred for',
				'6'=>'Outpatient Services to Another Institution',
				'7'=>'Discharged/Transferred to Home Under Care of Organized Home Health Service Organization',
				'8'=>'Left Against Medical Advise or Discontinued Care',
				'9'=>'Discharged/Transferred to Home Under Care of Home IV Therapy Provider',
				'20'=>'Admitted as an Inpatient to this Hospital',
				'30'=>'Expired (or Did Not Recover-Christian Science Patient)',
				'40'=>'Expired at Home (for Hospice Care Only)',
				'41'=>'Expired in a Medical Facility such as a Hospital, SNF, ICF or Freestanding Hospice (for Hospice Care Only)',
				'42'=>'Expired, Place Unknown (for Hospice Care Only)',
				'50'=>'Discharged to Hospice-Home',
				'51'=>'Discharged to Hospice-Medical Facility',
				'61'=>'Discharged/transferred within this institution to a hospital based Medicare approved swing bed.',
				'62'=>'Discharged/transferred to an inpatient rehabilitation facility including distinct part units of a hospital',
				'63'=>'Discharged/transferred to a long term care hospital',
				'64'=>'Discharged/transferred to a nursing facility certified under Medicaid but not certified under Medicare.',
				'65'=>'Discharged/transferred to a psychiatric hospital or psychiatric distinct part unit of a hospital',
				'66'=>'Discharged/transferred to a Critical Access Hospital (CAH)',
				'69'=>'Discharged/transferred to a designated disaster alternative care site',
				'81'=>'Discharged to home or self-care with a planned acute care hospital inpatient readmission',
				'82'=>'Discharged/transferred to a short term general hospital for inpatient care with a planned acute care hospital inpatient readmission',
				'83'=>'Discharged/transferred to a skilled nursing facility (SNF) with Medicare certification with a planned acute care hospital inpatient readmission',
				'84'=>'Discharged/transferred to a facility that provides custodial or supportive care with a planned acute care hospital inpatient readmission',
				'85'=>'Discharged/transferred to a designated cancer center or children\'s hospital with a planned acute care hospital inpatient readmission',
				'86'=>'Discharged/transferred to home under care of organized home health service organization with a planned acute care hospital inpatient readmission',
				'87'=>'Discharged/transferred to court/law enforcement with a planned acute care hospital inpatient readmission',
				'88'=>'Discharged/transferred to a federal health care facility with a planned acute care hospital inpatient readmission',
				'89'=>'Discharged/transferred to a hospital-based Medicare approved swing bed with a planned acute care hospital inpatient readmission',
				'90'=>'Discharged/transferred to an inpatient rehabilitation facility (IRF) including rehabilitation distinct part units of a hospital with a planned acute care hospital inpatient readmission',
				'91'=>'Discharged/transferred to a Medicare certified long term care hospital (LTCH) with a planned acute care hospital inpatient readmission',
				'92'=>'Discharged/transferred to a nursing facility certified under Medicaid but not certified under Medicare with a planned acute care hospital inpatient readmission',
				'93'=>'Discharged/transferred to a psychiatric distinct part unit of a hospital with a planned acute care hospital inpatient readmission',
				'94'=>'Discharged/transferred to a critical access hospital (CAH) with a planned acute care hospital inpatient readmission',
				'95'=>'Discharged/transferred to another type of health care institution not defined elsewhere in this code list with a planned acute care hospital inpatient readmission'
				);

		// ambulance transport code
		$this->code271['CR103'] = array(	
				'I'=>'Initial Trip',
				'R'=>'Return Trip',
				'T'=>'Transfer Trip',
				'X'=>'Round Trip'
				);
			
			
		// spinal subluxation level code
		$this->code271['CR203'] = array(	
				'C1'=>'Cervical 1',
				'C2'=>'Cervical 2',
				'C3'=>'Cervical 3',
				'C4'=>'Cervical 4',
				'C5'=>'Cervical 5',
				'C6'=>'Cervical 6',
				'C7'=>'Cervical 7',
				'CO'=>'Coccyx',
				'IL'=>'Ilium',
				'L1'=>'Lumbar 1',
				'L2'=>'Lumbar 2',
				'L3'=>'Lumbar 3',
				'L4'=>'Lumbar 4',
				'L5'=>'Lumbar 5',
				'OC'=>'Occiput',
				'SA'=>'Sacrum',
				'T1'=>'Thoracic 1',
				'T2'=>'Thoracic 2',
				'T3'=>'Thoracic 3',
				'T4'=>'Thoracic 4',
				'T5'=>'Thoracic 5',
				'T6'=>'Thoracic 6',
				'T7'=>'Thoracic 7',
				'T8'=>'Thoracic 8',
				'T9'=>'Thoracic 9',
				'T10'=>'Thoracic 10',
				'T11'=>'Thoracic 11',
				'T12'=>'Thoracic 12'
				);

		// oxygen type code			
		$this->code271['CR503'] = array(	
				'A'=>'Concentrator', 
				'B'=>'Liquid Stationary', 
				'C'=>'Gaseous Stationary', 
				'D'=>'Liquid Portable', 
				'E'=>'Gaseous Portable',
				'O'=>'Other'
				);
				
				
 		// oxygen delivery type code			
		$this->code271['CR517'] = array(
				'A'=>'Nasal Cannula',
				'B'=>'Oxygen Conserving Device',
				'C'=>'Oxygen Conserving Device with Oxygen Pulse System',
				'D'=>'Oxygen Conserving Device with Reservoir System',
				'E'=>'Transtracheal Catheter'
				);


 		// certification type code			
		$this->code271['CR608'] = array(				 
				'1'=>'Appeal-Immediate',
				'2'=>'Appeal-Standard',
				'3'=>'Cancel', 
				'4'=>'Extension', 
				'5'=>'Notification', 
				'6'=>'Verification',
				'I'=>'Initial', 
				'R'=>'Renewal', 
				'S'=>'Revised'
				);
 

				
		// paperwork type code			
		$this->code271['PWK01'] = array(				
				'3'=>' Report Justifying Treatment Beyond Utilization Guidelines',
				'4'=>' Drugs Administered',
				'5'=>' Treatment Diagnosis',
				'6'=>' Initial Assessment',
				'7'=>' Functional Goals',
				'8'=>' Plan of Treatment',
				'9'=>' Progress Report',
				'10'=>' Continued Treatment',
				'11'=>' Chemical Analysis',
				'13'=>' Certified Test Report',
				'15'=>' Justification for Admission',
				'21'=>' Recovery Plan',
				'48'=>' Social Security Benefit Letter',
				'55'=>' Rental Agreement',
				'59'=>' Benefit Letter',
				'77'=>' Support Data for Verification',
				'A3'=>' Allergies/Sensitivities Document',
				'A4'=>' Autopsy Report',
				'AM'=>' Ambulance Certification',
				'AS'=>' Admission Summary',
				'AT'=>' Purchase Order Attachment',
				'B2'=>' Prescription',
				'B3'=>' Physician Order',
				'BR'=>' Benchmark Testing Results',
				'BS'=>' Baseline',
				'BT'=>' Blanket Test Results',
				'CB'=>'Chiropractic Justification',
				'CK'=>'Consent Form(s)',
				'D2'=>'Drug Profile Document',
				'DA'=>'Dental Models',
				'DB'=>'Durable Medical Equipment Prescription',
				'DG'=>'Diagnostic Report',
				'DJ'=>'Discharge Monitoring Report',
				'DS'=>'Discharge Summary',
				'FM'=>'Family Medical History Document',
				'HC'=>'Health Certificate',
				'HR'=>'Health Clinic Records',
				'I5'=>'Immunization Record',
				'IR'=>'State School Immunization Records',
				'LA'=>'Laboratory Results',
				'M1'=>'Medical Record Attachment',
				'NN'=>'Nursing Notes',
				'OB'=>'Operative Note',
				'OC'=>'Oxygen Content Averaging Report',
				'OD'=>'Orders and Treatments Document',
				'OE'=>'Objective Physical Examination (including vital signs) Document',
				'OX'=>'Oxygen Therapy Certification',
				'P4'=>'Pathology Report',
				'P5'=>'Patient Medical History Document',
				'P6'=>'Periodontal Charts',
				'P7'=>'Periodontal Reports',
				'PE'=>'Parenteral or Enteral Certification',
				'PN'=>'Physical Therapy Notes',
				'PO'=>'Prosthetics or Orthotic Certification',
				'PQ'=>'Paramedical Results',
				'PY'=>'Physician Report',
				'PZ'=>'Physical Therapy Certification',
				'QC'=>'Cause and Corrective Action Report',
				'QR'=>'Quality Report',
				'RB'=>'Radiology Films',
				'RR'=>'Radiology Reports',
				'RT'=>'Report of Tests and Analysis Report',
				'RX'=>'Renewable Oxygen Content Averaging Report',
				'SG'=>'Symptoms Document',
				'V5'=>'Death Notification',
				'XP'=>'Photographs'
				);

		// paperwork delivery code			
		$this->code271['PWK02'] = array(
				'BM'=>'By Mail',
				'EL'=>'Electronically Only',
				'EM'=>'E-Mail',
				'FX'=>'By Fax',
				'VO'=>'Voice'
				);


		// certification type code			
		$this->code271['CRC01'] = array(
				'07'=>'Ambulance Certification',
				'08'=>'Chiropractic Certification',
				'09'=>'Durable Medical Equipment Certification'
				);
		
		// paperwork delivery code			
		$this->code271['CRC03'] = array(
				'1'=>'Patient was admitted to a hospital',
				'2'=>'Patient was bed confined before the ambulance service',
				'3'=>'Patient was bed confined after the ambulance service',
				'4'=>'Patient was moved by stretcher',
				'5'=>'Patient was unconscious or in shock',
				'6'=>'Patient was transported in an emergency situation',
				'7'=>'Patient had to be physically restrained',
				'8'=>'Patient had visible hemorrhaging',
				'9'=>'Ambulance service was medically necessary',
				'10'=>'Patient is ambulatory',
				'11'=>'Ambulation is Impaired and Walking Aid is Used for Therapy or Mobility',
				'12'=>'Patient is confined to a bed or chair',
				'13'=>'Patient is Confined to a Room or an Area Without Bathroom Facilities',
				'14'=>'Ambulation is Impaired and Walking Aid is Used for Mobility',
				'15'=>'Patient Condition Requires Positioning of the Body or Attachments Which Would Not be Feasible With the Use of an Ordinary Bed',
				'16'=>'Patient needs a trapeze bar to sit up due to respiratory condition or change body positions for other medical reasons',
				'17'=>'Patient\'s Ability to Breathe is Severely Impaired',
				'18'=>'Patient condition requires frequent and/or immediate changes in body positions',
				'19'=>'Patient can operate controls',
				'20'=>'Siderails Are to be Attached to a Hospital Bed Owned by the Beneficiary',
				'21'=>'Patient owns equipment',
				'22'=>'Mattress or Siderails are Being Used with Prescribed Medically Necessary Hospital Bed Owned by the Beneficiary',
				'23'=>'Patient Needs Lift to Get In or Out of Bed or to Assist in Transfer from Bed to Wheelchair',
				'24'=>'Patient has an orthopedic impairment requiring traction equipment which prevents ambulation during period of use',
				'25'=>'Item has been prescribed as part of a planned regimen of treatment in patient home',
				'26'=>'Patient is highly susceptible to decubitus ulcers',
				'27'=>'Patient or a care-giver has been instructed in use of equipment',
				'29'=>'A 6-7 hour nocturnal study documents 30 episodes of apnea each lasting more than 10 seconds',
				'30'=>'Without the equipment, the patient would require surgery',
				'31'=>'Patient has had a total knee replacement',
				'32'=>'Patient has intractable lymphedema of the extremities',
				'33'=>'Patient is in a nursing home',
				'35'=>'This Feeding is the Only Form of Nutritional Intake for This Patient',
				'37'=>'Oxygen delivery equipment is stationary',
				'38'=>'Certification signed by the physician is on file at the supplier\'s office',
				'40'=>'Patient or Caregiver is Capable of Using the Equipment Without Technical or Professional Supervision',
				'41'=>'Patient or Caregiver is Unable to Propel or Lift a Standard Weight Wheelchair',
				'42'=>'Patient Requires Leg Elevation for Edema or Body Alignment',
				'43'=>'Patient Weight or Usage Needs Necessitate a Heavy Duty Wheelchair',
				'44'=>'Patient Requires Reclining Function of a Wheelchair',
				'45'=>'Patient is Unable to Operate a Wheelchair Manually',
				'46'=>'Patient or Caregiver Requires Side Transfer into Wheelchair, Commode or Other',
				'58'=>'Durable Medical Equipment (DME) Purchased New',
				'59'=>'Durable Medical Equipment (DME) Is Under Warranty',
				'60'=>'Transportation Was To the Nearest Facility',
				'9D'=>'Lack of Appropriate Facility within Reasonable Distance to Treat Patient in the Event of Complications',
				'9H'=>'Patient Requires Intensive IV Therapy',
				'9J'=>'Patient Requires Protective Isolation',
				'9K'=>'Patient Requires Frequent Monitoring',
				'IH'=>'Independent at Home',
				'LB'=>'Legally Blind',
				'SL'=>'Speech Limitations'
				);
			




	
	//
	//			
	}
	//
	public function get_271_code($elem, $code) {
		//
		$e = (string)$elem;
		$val = '';
		if ( strpos($code, $this->ds) != false || strpos($code, $this->dr) != false) {
			if (strpos($code, $this->ds) != false ) {
				$cdar = explode($this->ds, $code);
				foreach($cdar as $cd) {
					if (strpos($code, $this->dr) != false) {
						$cdar2 = explode($this->dr, $code);
						foreach($cdar2 as $cd2) {
							if (isset($this->code271[$e][$cd2]) ) {
								$val .= $this->code271[$e][$cd2] . '; ';
							} else {
								$val .= "code $cd2 N/A ";
							}
						}
					} else {
						$val .= (isset($this->code271[$e][$cd]) ) ? $this->code271[$e][$cd].' ' : "code $cd N/A ";
					}
				}
			} elseif (strpos($code, $this->dr) != false) {
				$cdar = explode($this->dr, $code);
				foreach($cdar as $cd) {
					$val .= (isset($this->code271[$e][$cd]) ) ? $this->code271[$e][$cd].'; ' : "code $cd N/A ";
				}
			}
		} elseif ( array_key_exists($e, $this->code271) ) {
			$val = (isset($this->code271[$e][$code]) ) ? $this->code271[$e][$code] : "$elem code $code unknown";
		} else {
			$val = "$e codes not available ($code)";
		}
		//
		return $val;
	}
	//
	public function get_keys() {
		return array_keys($this->code271);
	}
}
