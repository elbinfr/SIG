<?php

/**
 *
 */
function setBreadCrumb($menu, $submenu = null)
{
	session()->put('menu', $menu);
	if(!is_null($submenu)){
		session()->put('submenu', $submenu);
	}	
}

/**
 * 
 */
function setUsername()
{
	$username = '';
	if (Auth::check()){		
		$username = Auth::user()->first_name . ' ' . Auth::user()->last_name;
	}

	return $username;
}