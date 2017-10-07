<?php

/**
 *
 */
function setBreadCrumb($menu, $submenu = null, $item = null)
{
	session()->put('menu', $menu);
	if(!is_null($submenu)){
		session()->put('submenu', $submenu);
	}
    if(!is_null($item)){
        session()->put('item', $item);
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

/**
 * 
 */

function client_id()
{
	$client_id = 0;
	if (Auth::check()){		
		$client_id = Auth::user()->enterprise->client_id;
	}

	return $client_id;
}

/**
 * 
 */
function setListCorporates()
{
	$client = App\Client::where('id', Auth::user()->enterprise->client_id)->first();

    $corporates = $client->corporates;

    $corporates->transform(function ($item, $key) {
	    return $item['username'] = strtoupper($item['username']);
	});

	session()->put('list_corporates', $corporates);
}