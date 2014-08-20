<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifier
 */
 
/**
 * Smarty date modifer
 * 
 * Type:     modifier<br>
 * Name:     datediff<br>
 * Purpose:  get the datediff
 * 
 * @author	Joshua Rüsweg
 * @param	string  $string      input string
 * @return	string	date string
 */
function smarty_modifier_datediff($string) {
	$timestamp = intval($string); // convert to timestamp
	
	$diff = time() - $timestamp;
	
	if ($diff < 0) {
		return date('d.m.Y H:i', $timestamp); 
	}
	
	// <= zwei Minuten 
	if ($diff < 60) {
		return "vor einen Moment"; 
	}
	
	if ($diff <= 120) {
		return "vor einer Minute"; 
	}
	
	// unter einer Stunde
	if ($diff < 3600) {
		// remove "führende null"
		$min = date('i', $diff); 
		$min = intval($min);
		
		return "vor ". $min ." Minuten"; 
	}
	
	// unter einem Tag
	if ($diff < 3600 * 23) {
		$f = intval(date('H', $diff)); 
		return "vor ". $f ." Stunde".(($f > 1) ? "n" : "");
	}
	
	if ($diff < 3600 * 24 * 2) {
		return "Gestern, ". date('H:i', $timestamp);
	}
	
	if ($diff < 3600 * 24 * 7) {
		$date = function ($date) {
			switch ($date) {
				case 'Mon':
					return 'Montag';
				
				case 'Tue': 
					return 'Dienstag'; 
					
				case 'Wed':
					return 'Mittwoch'; 
					
				case 'Thu': 
					return 'Donnerstag'; 
					
				case 'Fri': 
					return 'Freitag'; 
					
				case 'Sat': 
					return 'Samstag'; 
					
				case 'Sun': 
					return 'Sonntag'; 
					
				default: 
					return 'Invalid'; 
			}
		};
		
		return $date(date('D', $timestamp)) .", ". date('H:i', $timestamp);; 
	}
	
	if ($diff < 3600 * 24 * 364) {
		return date('d.m', $timestamp);
	}
	
	return date('d.m.Y', $timestamp);
} 
