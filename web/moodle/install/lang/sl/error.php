<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Automatically generated strings for Moodle installer
 *
 * Do not edit this file manually! It contains just a subset of strings
 * needed during the very first steps of installation. This file was
 * generated automatically by export-installer.php (which is part of AMOS
 * {@link http://docs.moodle.org/dev/Languages/AMOS}) using the
 * list of strings defined in /install/stringnames.txt.
 *
 * @package   installer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cannotcreatedboninstall'] = '<p>Podatkovne zbirke ni bilo mogoče ustvariti.</p>
<p>Navedena podatkovna zbirka ne obstaja in navedeni uporabnik nima dovoljenja, da ustvari podatkovno zbirko.</p>
<p>Skrbnik spletnega mesta mora potrditi konfiguracijo podatkovne zbirke.</p>';
$string['cannotcreatelangdir'] = 'Imenika jezika ni možno ustvariti.';
$string['cannotcreatetempdir'] = 'Začasnega imenika ni možno ustvariti.';
$string['cannotdownloadcomponents'] = 'Komponent ni možno prenesti.';
$string['cannotdownloadzipfile'] = 'Datoteke ZIP ni možno prenesti.';
$string['cannotfindcomponent'] = 'Komponente ni možno najti.';
$string['cannotsavemd5file'] = 'Datoteke MD5 ni možno shraniti.';
$string['cannotsavezipfile'] = 'Datoteke ZIP ni možno shraniti.';
$string['cannotunzipfile'] = 'Datoteke ni možno razširiti (unzip).';
$string['componentisuptodate'] = 'Komponenta je posodobljena.';
$string['dmlexceptiononinstall'] = '<p>Prišlo je do napake podatkovne zbirke [{$a->errorcode}].<br />{$a->debuginfo}</p>';
$string['downloadedfilecheckfailed'] = 'Preverjanje prenesene datoteke je spodletelo.';
$string['invalidmd5'] = 'Spremenljivka preverjanja je bila napačna - poskusite ponovno';
$string['missingrequiredfield'] = 'Eno izmed zahtevanih polj manjka';
$string['remotedownloaderror'] = 'Prenos komponent na vaš strežnik ni uspel. Prosimo, da preverite nastavitve prehodnega strežnika. Priporočamo uporabo razširitve cURL za PHP.<br /><br />Datoteko <a href="{$a->url}">{$a->url}</a> morate prenesti ročno - skopirajte jo v imenik "{$a->dest}" in razširite.';
$string['wrongdestpath'] = 'Napačna ciljna pot.';
$string['wrongsourcebase'] = 'Napačna osnova URL vira.';
$string['wrongzipfilename'] = 'Napačno ime datoteke ZIP.';
