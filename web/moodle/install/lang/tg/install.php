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

$string['admindirname'] = 'Феҳристи администратор';
$string['availablelangs'] = 'Пакетҳои забонии дастрас';
$string['chooselanguagehead'] = 'Забонро интихоб намоед';
$string['chooselanguagesub'] = 'Ҳозир забонро ФАҚАТ барои мактубчаҳо ҳангоми ҷойгиркунӣ интихоб кардан лозим аст. Забони сомона ва интерфейсҳои истифодабарандагонро минбаъд дар раванди ҷойгиркунӣ зикр кардан мумкин аст.';
$string['clialreadyinstalled'] = 'Файли config.php аллакай вуҷуд дорад. Агар сомонаро навсозӣ карданӣ бошед, скрипти admin/cli/upgrade.php -ро истифода баред.';
$string['cliinstallheader'] = 'Барномаи ҷойгиркунии Moodle {$a} дар реҷаи сатри фармонҳо';
$string['databasehost'] = 'Сервери базаҳои маълумотҳо';
$string['databasename'] = 'Номи базаи маълумотҳо';
$string['databasetypehead'] = 'Драйвери базаи маълумотҳоро интихоб намоед';
$string['dataroot'] = 'Феҳристи маълумотҳо';
$string['datarootpermission'] = 'Иҷозатҳо ба феҳристи маълумотҳо';
$string['dbprefix'] = 'Префикси номҳои ҷадвалҳо';
$string['dirroot'] = 'феҳристи Moodle';
$string['environmenthead'] = 'Тафтиши муҳит...';
$string['environmentsub2'] = 'Ҳар як версияи Moodle талаботҳои минималӣ ба версияи PHP ва маҷмӯи васеъшавиҳои ҳатмии PHP-ро дорад.
Тафтиши пурраи муҳит пеш аз ҳар як ҷойгиркунӣ ва навсозӣ ба ҷо оварда мешавад.
Илтимос, агар тарзи ҷойгиркунии версияи нав ё ба кор андохтани васеъшавии PHP-ро надонед, бо администратори сервер робита намоед.';
$string['errorsinenvironment'] = 'Тафтиши муҳит иҷро нашудааст!';
$string['installation'] = 'Ҷойгир кардан';
$string['langdownloaderror'] = 'Мутаассифона, забони "{$a}"-ро муқаррар кардан муяссар нашуд. Раванди ҷойгиркунӣ ба забони англисӣ давом хоҳад кард.';
$string['memorylimithelp'] = '<p>Ҳозир маҳдудкунии хотира дар PHP дар сервери Шумо ба андозаи {$a} муқаррар шудааст.</p>

<p>Аз ин сабаб баъди муддате дар Moodle мушкилоти хотира пайдо шуда метавонанд, хусусан агар Шумо бисёр модулҳо ва/ё истифодабарандаҳо дошта бошед.</p>

<p>Мо тавсия медиҳем, агар имкон бошад, дар PHP маҳдудкунии баландтари хотира муқаррар карда шавад, масалан 40M.
Инро бо тарзҳои зерин карда дида метавонед:</p>
<ol>
<li>Агар имкон бошад, PHP-ро бо калиди <i>--enable-memory-limit</i> аз нав нусхабардорӣ кунед.
Дар ин маврид Moodle метавонад мустақилона маҳдудкунии хотираро муқаррар намояд.</li>
<li>Агар Шумо ба файли php.ini дастрасӣ дошта бошед, метавонед параметри <b>memory_limit</b> -ро ба чизе монанди 40M тағйир диҳед. Агар дастрасӣ надошта бошед, шояд Шумо имкон доред аз администратор хоҳиш намоед, ки ин корро кунад.</li>
<li>Дар баъзе серверҳои PHP дар феҳристи Moodle файли .htaccess бунёд кардан мумкин аст, ки сатри зеринро дорад:
<blockquote><div>php_value memory_limit 40M</div></blockquote>
<p>Бо вуҷуди ин, дар баъзе серверҳо аз ин сабаб эҳтимол <b>ҳамаи</b> саҳифаҳои PHP кор накарда мемонанд (Шумо хатоҳоро дар саҳифаҳо хоҳед дид). Дар ин маврид лозим меояд, ки файли .htaccess нест карда шавад.</p></li>
</ol>';
$string['paths'] = 'Роҳҳо';
$string['pathserrcreatedataroot'] = 'Барномаи ҷойгиркунӣ феҳристи маълумотҳои ({$a->dataroot})-ро бунёд карда наметавонад.';
$string['pathshead'] = 'Роҳҳоро тасдиқ намоед';
$string['pathsrodataroot'] = 'Феҳристи маълумотҳо барои сабт дастрас нест.';
$string['pathsroparentdataroot'] = 'Феҳристи волидӣ ({$a->parent}) барои сабт дастрас нест. Барномаи ҷойгиркунӣ феҳристи маълумотҳои ({$a->dataroot})-ро бунёд карда наметавонад.';
$string['pathssubadmindir'] = 'Дар миқдори ками веб-ҳостингҳо роҳи /admin барои дастрасӣ ба ба панели идоракунӣ ё ягон чизи дигар истифода мешавад. Мутаассифона, ин ба ҷойгиршавии стандартии саҳифаҳои идоракунии Moodle мухолифат дорад. Инро бо аз нав номгузорӣ кардани папкаи "admin" дар феҳристи Moodle ва дар ин ҷо зикр намудани номи нави он ислоҳ кардан мумкин аст. Масалан: <em>moodleadmin</em>. Дар айни ҳол ҳамаи истинодҳо ба панели идоракунии Moodle автоматӣ ислоҳ мешаванд';
$string['pathssubdataroot'] = 'Ҷоеро зикр намудан даркор аст, ки Moodle файлҳои боршавандаро нигаҳдорӣ хоҳад кард. Ин феҳрист бояд барои хондан ва  САБТ НАМУДАНИ истифодабаранда, ки веб-сервер аз номи ӯ ба кор андохта шудааст, дастрас бошад (одатан \'nobody\' ё \'apache\'), аммо дар айни ҳол он набояд бевосита аз Интернет дастрас бошад. Барномаи ҷойгиркунӣ кӯшиш мекунад, ки ин феҳристро бунёд кунад, агар он вуҷуд надошта бошад.';
$string['pathssubdirroot'] = 'Роҳи пурра ба феҳристи ҷойгиркунии Moodle.';
$string['pathssubwwwroot'] = 'Веб-адреси пурра, ки аз он Moodle дастрас хоҳад буд.
Барои дастрасӣ ба Moodle якчанд адресҳои умумиро истифода бурдан ғайриимкон аст.
Агар сомонаи Шумо боз якчанд адресҳои умумӣ дошта бошад, Шумо бояд доимо аз ин адресҳо ба адреси зикршуда равона карданро танзим намоед. Агар сомонаи Шумо ҳам аз Интернета, ҳам аз шабакаи маҳаллӣ дастрас бошад, дар ин ҷо адреси умумкиро зикр намоед ва DNS-ро чунон танзим намоед, ки ин адрес ба истифодабарандаҳои маҳаллӣ низ дастрас бошад.
Агар адреси дар ин ҷо зикршуда нодуруст бошад, URL-ро дар сатри адреси браузер тағйир диҳед, то ки дастгоҳро бо нишондиҳандаи дигар аз нав ба кор андозед.';
$string['pathsunsecuredataroot'] = 'Ҷойгиршавии феҳристи маълумотҳо ба талаботи бехатарӣ ҷавобгӯ нест';
$string['pathswrongadmindir'] = 'Феҳристи admin вуҷуд надорад';
$string['phpextension'] = 'Васеъшавии PHP "{$a}"';
$string['phpversion'] = 'Версияи PHP';
$string['phpversionhelp'] = '<p>Барои Moodle  PHP-и версияи 4.3.0 ва болотар ё 5.1.0 ва болотар даркор аст (баъзе мушкилот бо версияи 5.0.x маълуманд).</p>
<p>Ҳозир Шумо версияи {$a}-ро истифода мебаред</p>
<p>Шумо бояд PHP-ро навсозӣ кунед ё ба ҳостинг бо версияи навтари PHP гузаред!<br />
(Дар мавриди версияи 5.0.x ҳамчунин ба версияи 4.4.x фаромадан мумкин аст)</p>';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion})';
$string['welcomep20'] = 'Шумо ин саҳифаро мебинед, чунки дар компютери худ маҷмӯи барномаҳои <strong>{$a->packname} {$a->packversion}</strong> -ро бо муваффақият ҷойгир намудед. Табрик мекунем!';
$string['welcomep30'] = 'Ин версияи маҷмӯи барномаҳо <strong>{$a->installername}</strong> барномаҳои зеринро дар бар мегирад, ки барои бунёд кардани муҳите ки дар он <strong>Moodle</strong> кор хоҳад кард, даркоранд:';
$string['welcomep40'] = 'Ҳамчунин ба ин маҷмӯъ <strong>Moodle {$a->moodlerelease} ({$a->moodleversion})</strong> дохил мешавад.';
$string['welcomep50'] = 'Тартиби истифодаи замимаҳое ки ба ин маҷмӯъ дохил мешаванд, бо иҷозатномаҳои мувофиқ ба низом дароварда мешавад. Маҷмӯи барномаҳои <strong>{$a->installername}</strong> пурра <a href="http://ru.wikipedia.org/wiki/Таъмини_барномавии_кушода">кушода аст </a> ва бо шартҳои иҷозатнома паҳн карда мешавад <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a>.';
$string['welcomep60'] = 'Дар саҳифаҳои минбаъда Шумо якчанд қадамҳои оддии ба компютери худ танзим ва ҷойгир кардани <strong>Moodle</strong> -ро дида метавонед. Шумо метавонед танзимҳоро аз рӯи хомӯшӣ қабул намоед ё онҳоро вобаста ба эҳтиёҷоти худ тағйир диҳед.';
$string['welcomep70'] = 'Тугмаи "Давомаш"-ро зер кунед, то ки раванди ҷойгиркунии <strong>Moodle</strong>-ро давом диҳед';
$string['wwwroot'] = 'Веб-адрес';
