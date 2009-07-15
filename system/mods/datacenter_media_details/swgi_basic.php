<?php
//j// BOF

/*n// NOTE
----------------------------------------------------------------------------
secured WebGine
net-based application engine
----------------------------------------------------------------------------
(C) direct Netware Group - All rights reserved
http://www.direct-netware.de/redirect.php?swg

The following license agreement remains valid unless any additions or
changes are being made by direct Netware Group in a written form.

This program is free software; you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA 02111-1307, USA.
----------------------------------------------------------------------------
http://www.direct-netware.de/redirect.php?licenses;gpl
----------------------------------------------------------------------------
#echo(sWGmodsDatacenterMediaDetailsVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* datacenter_media_details/swgi_basic.php
*
* @internal   We are using phpDocumentor to automate the documentation process
*             for creating the Developer's Manual. All sections including
*             these special comments will be removed from the release source
*             code.
*             Use the following line to ensure 76 character sizes:
* ----------------------------------------------------------------------------
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage datacenter
* @uses       direct_product_iversion
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/

/* -------------------------------------------------------------------------
All comments will be removed in the "production" packages (they will be in
all development packets)
------------------------------------------------------------------------- */

//j// Basic configuration

/* -------------------------------------------------------------------------
Direct calls will be honored with an "exit ()"
------------------------------------------------------------------------- */

if (!defined ("direct_product_iversion")) { exit (); }

//j// Functions and classes

//f// direct_mods_datacenter_media_details_basic_ddb_link_view ($f_data)
/**
* Modification function called by:
* m = datacenter
* s = media
* a = view
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   direct_datacenter::get()
* @uses   direct_datacenter::get_evars()
* @uses   direct_html_encode_special()
* @uses   direct_linker()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_datacenter_media_details_basic_ddb_link_view ($f_data)
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -direct_mods_datacenter_media_details_basic_ddb_link_view (+f_data)- (#echo(__LINE__)#)"); }

	if ($f_data[0]) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	if (empty ($f_return))
	{
		$f_link_array = $f_data[1]->get ();

		if ($f_link_array['ddbdatacenter_type'] == "text/x-ddb-link") { $f_link_evars_array = $f_data[1]->get_evars (); }
		else { $f_link_evars_array = NULL; }

		if ((is_array ($f_link_evars_array))&&(isset ($f_link_evars_array['ddbdatacenter_link_url'])))
		{
			$f_link_url_preview = direct_linker ("optical",$f_link_evars_array['ddbdatacenter_link_url']);
			$f_link_url = direct_html_encode_special ($f_link_evars_array['ddbdatacenter_link_url']);
			$f_link_id = md5 ($f_link_url);

			$direct_cachedata['output_mods_datacenter_media_details_htmlbox'] = ("<span class='pagecontent'><span style='font-weight:bold'>".(direct_local_get ("datacenter_link_url")).":</span> <a href=\"$f_link_url\" target='_top'>$f_link_url_preview</a></span>");

			if ($direct_settings['datacenter_link_redirect_jsjump'])
			{
$direct_cachedata['output_mods_datacenter_media_details_htmlbox'] .= ("<br />\n<span id='swgjsjump_point' class='pagecontent' style='font-weight:bold;text-align:center'><span style='font-size:10px'><br />\n".(direct_local_get ("core_automated_redirection_unsupported"))."</span></span><script language='JavaScript' type='text/javascript'><![CDATA[
djs_swgDOM_replace (\"<span id='swgjsjump_point' class='pagecontent' style='font-size:10px;text-align:center'>(".(direct_local_get ("core_automated_redirection","text")).")<br /><a href='javascript:djs_datacenter_{$f_link_id}_redirect_cancel()'>".(direct_local_get ("datacenter_link_redirect_cancel","text"))."</a></span>\",'swgjsjump_point');
djs_var['datacenter_{$f_link_id}_redirect'] = true;

function djs_datacenter_{$f_link_id}_redirect ()
{
	if (djs_var['datacenter_{$f_link_id}_redirect']) { self.document.location.replace (\"$f_link_url\"); }
}

function djs_datacenter_{$f_link_id}_redirect_cancel ()
{
	if (djs_var['datacenter_{$f_link_id}_redirect'])
	{
		djs_swgDOM_replace (\"<span class='pagecontent' style='font-size:10px;text-align:center'><br />".(direct_local_get ("datacenter_link_redirect_cancelled","text"))."</span>\",'swgjsjump_point');
		djs_var['datacenter_{$f_link_id}_redirect'] = false;
	}
}

self.setTimeout (\"djs_datacenter_{$f_link_id}_redirect ()\",$direct_settings[datacenter_link_redirect_jsjump]);
]]></script>");
			}

			if (!$f_link_array['ddbdatacenter_trusted']) { $direct_cachedata['output_mods_datacenter_media_details_htmlbox'] .= "<br /><br />\n<span class='pagehighlightborder2' style='display:block;text-align:justify'><span class='pagecontent'>".(direct_local_get ("datacenter_link_warning"))."</span></span>"; }

			$f_return[] = "htmlbox";
		}
	}

	return $f_return;
}

//f// direct_mods_datacenter_media_details_basic_download_view ($f_data)
/**
* Modification function called by:
* m = datacenter
* s = media
* a = view
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   direct_datacenter::get()
* @uses   direct_datacenter::get_plocation()
* @uses   direct_linker_dynamic()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_datacenter_media_details_basic_download_view ($f_data)
{
	global $direct_cachedata;
	if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -direct_mods_datacenter_media_details_basic_download_view (+f_data)- (#echo(__LINE__)#)"); }

	if ($f_data[0]) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	if (empty ($f_return))
	{
		$f_object_array = $f_data[1]->get ();
		$f_object_plocation = $f_data[1]->get_plocation ();

		if ($f_object_plocation)
		{
			$f_path_array = pathinfo ($f_object_plocation);
			$f_download_url = direct_linker_dynamic ("url0","m=datacenter&a=transfer_dl&dsd=doid+".(urlencode ($f_object_array['ddbdatalinker_id'])));

			$direct_cachedata['output_mods_datacenter_media_details_htmlbox'] = "<span style='font-weight:bold'>".(direct_local_get ("datacenter_download")).":</span> <a href=\"$f_download_url\" target='_blank'>{$f_path_array['basename']}</a>";
			if (!$f_object_array['ddbdatacenter_trusted']) { $direct_cachedata['output_mods_datacenter_media_details_htmlbox'] .= "<br />\n<br />\n<span class='pagehighlightborder2' style='display:block;text-align:justify'><span class='pagecontent'>".(direct_local_get ("datacenter_download_warning"))."</span></span>"; }

			$f_return[] = "htmlbox";
		}
	}

	return $f_return;
}

//f// direct_mods_datacenter_media_details_basic_image_view ($f_data)
/**
* Modification function called by:
* m = datacenter
* s = media
* a = view
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   direct_basic_functions::varfilter()
* @uses   direct_datacenter::get()
* @uses   direct_datacenter::get_plocation()
* @uses   direct_datacenter::is_physical()
* @uses   direct_datacenter::parse()
* @uses   direct_linker_dynamic()
* @uses   USE_debug_reporting
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_datacenter_media_details_basic_image_view ($f_data)
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -direct_mods_datacenter_media_details_basic_image_view (+f_data)- (#echo(__LINE__)#)"); }

	if ($f_data[0]) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	if (empty ($f_return))
	{
		$f_object_array = $f_data[1]->get ();

		if ($f_data[1]->is_physical ()) { $f_file_path = ""; }
		else { $f_file_path = $direct_classes['basic_functions']->varfilter ($direct_settings['datacenter_path_upload'],"settings"); }

		if (($f_object_array['ddbdatacenter_type'] == "image/gif")||($f_object_array['ddbdatacenter_type'] == "image/jpeg")||($f_object_array['ddbdatacenter_type'] == "image/png")) { $f_file_path = $f_data[1]->get_plocation ($f_file_path); }
		else { $f_file_path = ""; }

		if (($f_file_path)&&(file_exists ($f_file_path)))
		{
			$f_object_pageurl = direct_linker_dynamic ("url0","m=datacenter&a=transfer&dsd=doid+".(urlencode ($f_object_array['ddbdatalinker_id'])),true,false);
			$f_object_array = $f_data[1]->parse ("m=datacenter&s=media&a=[a]&dsd=[oid]");

			if (strlen ($f_object_array['title_alt'])) { $f_object_title = $f_object_array['title_alt']; }
			else { $f_object_title = $f_object_array['title']; }

			$direct_cachedata['output_mods_datacenter_media_details_htmlbox'] = "<a href=\"{$f_object_array['pageurl_download']}\" target='_self'><img src=\"$f_object_pageurl\" border='0' alt=\"$f_object_title\" title=\"$f_object_title\" /></a>";
			$f_return[] = "htmlbox";
		}
	}

	return $f_return;
}

//f// direct_mods_datacenter_media_details_basic_text_view ($f_data)
/**
* Modification function called by:
* m = datacenter
* s = media
* a = view
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   direct_basic_functions::varfilter()
* @uses   direct_datacenter::get()
* @uses   direct_datacenter::get_plocation()
* @uses   direct_file_get()
* @uses   direct_html_encode_special()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_datacenter_media_details_basic_text_view ($f_data)
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -direct_mods_datacenter_media_details_basic_text_view (+f_data)- (#echo(__LINE__)#)"); }

	if ($f_data[0]) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	if (empty ($f_return))
	{
		$f_object_array = $f_data[1]->get ();

		if ($f_data[1]->is_physical ()) { $f_file_path = ""; }
		else { $f_file_path = $direct_classes['basic_functions']->varfilter ($direct_settings['datacenter_path_upload'],"settings"); }

		if ($f_object_array['ddbdatacenter_type'] == "text/plain") { $f_file_path = $f_data[1]->get_plocation ($f_file_path); }
		else { $f_file_path = ""; }

		if (($f_file_path)&&(file_exists ($f_file_path)))
		{
			$direct_cachedata['output_mods_datacenter_media_details_contentbox'] = direct_html_encode_special (direct_file_get ("s0",$f_file_path));
			$f_return[] = "contentbox";
		}
	}

	return $f_return;
}

//j// Script specific commands

if (!isset ($direct_settings['datacenter_link_redirect_jsjump'])) { $direct_settings['datacenter_link_redirect_jsjump'] = 15000; }
if (!isset ($direct_settings['datacenter_path_upload'])) { $direct_settings['datacenter_path_upload'] = $direct_settings['path_data']."/uploads/"; }

//j// EOF
?>
