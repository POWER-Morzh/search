<?php
// WARNING: No blank line or spaces before the "< ? p h p" above this.

// IMPORTANT: This file should be made in UTF-8 (without BOM) only.
// CB will automatically convert to site's local character set.

/**
* Joomla/Mambo Community Builder
* @version $Id: cbteamplugins_language.php$
* @package Community Builder
* @subpackage German CB-Team Plugins Language file for CB 1.8
* @german translations v.1.2.1 - v.1.7.3 (2009/08/17 until 2012/02/29) by Angelika Reisiger (Lintzy) (Software-lupe.de)
* @author Angelika Reisiger, copyright (c) 2009 - 02/2012, Angelika Reisiger
* @german translations v.1.8 (since 2012/04/05) by Frank Behnke, cb@gut-beddingen.de
* @author Frank Behnke
* @copyright (C) 2012, Frank Behnke
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// ensure this file is being included by a parent file:
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

// 1.2 Stable:
// ProfileBook plugin: (new method: UTF8 encoding here):
CBTxt::addStrings( array(
'Profile Book' => 'Gästebuch',
'Entry' => 'Eintrag',
'Profile Book Description' => 'Gästebuch Beschreibung',
'Created On: %s' => 'Erstellt am: %s',
'Edited By %s On: %s' => 'Bearbeitet von %s am: %s',
'<br /><strong>[Notiz: </strong><em>letzte Bearbeitung vom Moderator</em><strong>]</strong>' => '<br /><strong>[Mitteilung: </strong><em>Letzte Änderung durch Moderator</em><strong>]</strong>',
'Users Feedback:' => 'Benutzer Feedback:',
'Edited by Site Moderator' => 'Bearbeitet durch Moderator',
'Comments' => 'Kommentare',
'Email' => 'E-Mail',
'Location' => 'Ort',
'This user currently doesn\'t have any posts.' => 'Dieser Benutzer hat aktuell keine Nachrichten gepostet.',
'User Rating' => 'Benutzerwertung',
'Web Address' => 'Web Addresse',
'Submit Entry' => 'Eintrag übermitteln',
'Update Entry' => 'Eintrag aktualisieren',
'Enable Profile Entries' => 'Profileinträge erlauben',
'Auto Publish' => 'Automatisch veröffentlichen',
'Notify Me' => 'Benachrichtigt werden',
'Enable visitors to your profile to make comments about you and your profile.' => 'Erlaubt Besuchern des eigenen Profils Kommentare über das Profil oder die Person abzugeben.',
'Enable Auto Publish if you want entries submitted to be automatically approved and displayed on your profile.' => 'Autmatisch veröffentlichen erlauben, bedeutet, dass Einträge automatisch freigeschaltet und in dem eigenen Profil angezeigt werden.',
'Enable Notify Me if you would like to receive an email notification each time someone submits an entry.  This is recommended if you are not using the Auto Publish feature.' => '"Mich benachrichtigen" erlauben  bedeutet, dass jedes Mal eine E-Mail-Benachrichtigung verschickt wird, wenn ein Benutzer einen Eintrag im Gästebuch vornimmt. Diese Einstellung ist empfohlen, wenn die "Automatisch veröffentlichen" Funktion ausgeschaltet ist.',
'Enable Profile Blog' => 'Profil Blog aktivieren',
'Enable Profile Wall' => 'Profil Pinnwand aktivieren',
'Enable your blog on your profile.' => 'Blog im eigenen Profil aktivieren.',
'Enable the wall on your profile so yourself and visitors can write on it.' => 'Pinnwand im eigenen Profil aktivieren, damit Besucher und man selbst dort schreiben können.',
'Enable Notify Me if you\'d like to receive an email notification each time someone submits an entry. This is recommended if you are not using the Auto Publish feature.' => 'Benachrichtigung an mich schicken aktivieren, wenn E-Mail Benachrichtigungen bei jedem Eintrag an die eigene E-Mail-Adresse geschickt werden sollen. Diese Einstellung ist empfohlen, wenn die Automatisch Veröffentlichen Funktion deaktiviert ist.',
'Bold' => 'Fett',
'Italic' => 'Kursiv',
'Underline' => 'Unterstrichen',
'Quote' => 'Zitat',
'Code' => 'Code',
'List' => 'Liste',
'List' => 'Liste',
'Image' => 'Bild',
'Link' => 'Link',
'Close' => 'Schließen',
'Color' => 'Farbe',
'Size' => 'Größe',
'Item' => 'Element',
'Bold text: [b]text[/b]' => 'Text Fett: [b]text[/b]',
'Italic text: [i]text[/i]' => 'Text Kursiv: [i]text[/i]',
'Underline text: [u]text[/u]' => 'Text Unterstrichen: [u]text[/u]',
'Quoted text: [quote]text[/quote]' => 'Text Zitat: [quote]text[/quote]',
'Code display: [code]code[/code]' => 'Code Anzeige: [code]code[/code]',
'Unordered List: [ul] [li]text[/li] [/ul] - Hint: a list must contain List Items' => 'Unsortierte Liste: [ul] [li]text[/li] [/ul] - Hinweis: eine Liste muss Listenelemente enthalten',
'Ordered List: [ol] [li]text[/li] [/ol] - Hint: a list must contain List Items' => 'Geordnete Liste: [ol] [li]text[/li] [/ol] - Hinweis: eine Liste muss Listenelemente enthalten',
'Image: [img size=(01-499)]http://www.google.com/images/web_logo_left.gif[/img]' => 'Bild: [img size=(01-499)]http://www.google.com/images/web_logo_left.gif[/img]',
'Link: [url=http://www.zzz.com/]This is a link[/url]' => 'Link: [url=http://www.zzz.com/]Das ist ein Link[/url]',
'Close all open bbCode tags' => 'Alle offenen bbCode-Tags schließen',
'Color: [color=#FF6600]text[/color]' => 'Farbe: [color=#FF6600]text[/color]',
'Size: [size=1]text size[/size] - Hint: sizes range from 1 to 5' => 'Größe: [size=1]text size[/size] - Hinweis: Größe von 1 bis 5',
'List Item: [li] list item [/li] - Hint: a list item must be within a [ol] or [ul] List' => 'Listenelement: [li] listenelement [/li] - Hinweis: Ein Listenelement muss sich innerhalb einer [ol] oder [ul] Liste befinden',
'Dimensions' => 'Dimensionen',
'File Types' => 'Dateitypen',
'Submit' => 'Senden',
'Preview' => 'Vorschau',
'Cancel' => 'Abbrechen',
'User Comments' => 'Benutzer Kommentare',
'Your Feedback' => 'Feedback',
'Edit' => 'Bearbeiten',
'Update' => 'Aktualisieren',
'Delete' => 'Löschen',
'Publish' => 'Veröffentlichen',
'Sign Profile Book' => 'Ins Gästebuch eintragen',
'Give Feedback' => 'Feedback geben',
'Edit Feedback' => 'Feedback bearbeiten',
'Un-Publish' => 'Unveröffentlichen',
'Not Published' => 'Nicht veröffentlicht',
'Color' => 'Farbe',
'Size' => 'Größe',
'Very Small' => 'Sehr klein',
'Small' => 'Klein',
'Normal' => 'Normal',
'Big' => 'Groß',
'Very Big' => 'Sehr groß',
'Close All Tags' => 'Alle Tags schließen',
'Standard' => 'Standard',
'Red' => 'Rot',
'Purple' => 'Lila',
'Blue' => 'Blau',
'Green' => 'Grün',
'Yellow' => 'Gelb',
'Orange' => 'Orange',
'Darkblue' => 'Dunkelblau',
'Gold' => 'Gold',
'Brown' => 'Braun',
'Silver' => 'Silber',
'You have received a new entry in your %s' => 'Es gibt einen neuen Eintrag im %s',
'%s has just submitted a new entry in your %s.' => '%s hat gerade einen neuen Eintrag verfasst ins %s.',
'An entry in your %s has just been updated' => 'Ein Eintrag im %s wurde gerade aktualisiert',
'%s has just submitted an edited entry for %s in your %s.' => '%s hat gerade einen Eintrag bearbeitet und übermittelt für %s im %s.',
"\n\nYour current setting is that you need to review entries in your %1\$s. Please login, review the new entry and publish if you agree. Direct access to your %1\$s:\n%2\$s\n" => "

Laut gewählter Einstellung müssen die Einträge freigeschaltet werden im %1\$s. Bitte einloggen, den neuen Eintrag prüfen und eventuell veröffentlichen. Direkter Zugriff %1\$s:
%2\$s
",
"\n\nYour current setting is that new entries in your %1\$s are automatically published. To see the new entry, please login. You can then see the new entry and take appropriate action if needed. Direct access to your %1\$s:\n%2\$s\n" => "

 Laut gewählter Einstellung werden neue Einträge automatisch veröffentlicht. Um neue Einträge zu sehen, muss man sich erst einloggen. Dann können neue Einträge geprüft und eventuell geeignete Maßnahmen ergriffen werden. Direkter Zugriff %1\$s:
%2\$s
",
'Name is Required!' => 'Name ist erforderlich!',
'Email Address is Required!' => 'E-Mail-Addresse ist erforderlich!',
'Comment is Required!' => 'Kommentar ist erforderlich!',
'User Rating is Required!' => 'Benutzer Wertung ist erforderlich!',
'You have not selected a User Rating. Do you really want to provide an Entry without User Rating ?' => 'Es wurde keine Benutzer-Bewertung abgegeben. Soll dieser Eintrag wirklich ohne Benutzerbewertung abgeschickt werden?',
'Return Gesture' => 'Return',
'Profile Rating' => 'Profil Bewertung',
'You have not selected your User Rating.' => 'Benutzer-Bewertung wurde nicht gewählt.',
'Would you like to give a User Rating ?' => 'Soll eine Benutzer-Bewertung abgegeben werden?',
'Do you really want to delete permanently this Comment and associated User Rating ?' => 'Soll dieser Kommentar und die dazugehörige Benutzer-Bewertung wirklich gelöscht werden?',
'You are about to edit somebody else\'s text as a site Moderator. This will be clearly noted. Proceed ?' => 'Es wird gerade der Text eines Benutzers durch einen Moderator geändert. Das wird klar gekennzeichnet. Fortsetzen?',
'Hidden' => 'Versteckt',
'Feedback from %s: ' => 'Feedback von %s: ',
'Poor' => 'Schlecht',
'Best' => 'Am Besten',
// 1.2:
'Vote %s star' => 'Abstimmung %s Stern',
'Vote %s stars' => 'Abstimmung %s Sterne',
'Cancel Rating' => 'Bewertung abbrechen',
'Average Profile Rating by other users' => 'Durchschnittliche Profilbewertung von anderen Benutzern',
// 1.2.1:
'Title' => 'Titel',
'Title is Required!' => 'Titel ist erforderlich!',
'NEW' => 'NEU',
'Mark Read' => 'Als gelesen markieren',
'Mark Unread' => 'Als ungelesen markieren',
'You have %s new %s post' => 'Es gibt %s neue %s Post',
'You have %s new %s posts' => 'Es gibt %s neue %s Nachrichten',
'Add new blog entry' => 'Einen neuen Blogeintrag hinzufügen',
'Wall entry' => 'Pinnwand-Eintrag',
'Write on the wall' => 'An die Pinnwand schreiben',
'Entry' => 'Eintrag',
'Blog text' => 'Blog Text',
'Save Blog Entry' => 'Blogeintrag speichern',
'Video' => 'Video',
'Video: [video type=youtube]id[/video] - Hint: id is only the embedding id of the video' => 'Video: [video type=youtube]id[/video] - Hinweis: Id bedeutet nur die eingebettete ID des Videos',
// module:
'%s added a new guestbook entry to %s' => '%s hat einen neuen Gästebucheintrag hinzugefügt für %s',
'%s wrote a new blog "%s"' => '%s hat einen neuen Blog geschrieben"%s"',
'%s wrote a new blog' => '%s hat einen neuen Blog geschrieben',
'%s added a new wall entry to %s' => '%s hat einen neuen Pinnwand-Eintrag verfasst für %s',
'%s added a new wall entry' => '%s hat einen neuen Pinnwand-Eintrag verfasst',
'No entries have been made!' => 'Keine neuen Einträge vorhanden!',
// 1.2.2:
'Untranslated strings on this page' => 'Nicht übersetzte Strings auf dieser Seite',
'Translations on this page' => 'Übersetzungen auf dieser Seite',
'English string' => 'Englische Zeichenkette (String)',
'Translated string' => 'Übersetzte Strings',
// CB 1.4 Validations:
'No changes.'							=>	'Keine Veränderungen.',
'This field is required.'				=>	'Das ist ein Pflichtfeld - Eingabe erforderlich.',
'Please fix this field.'				=>	'Bitte dieses Feld korrigieren.',
'Please enter a valid email address.'	=>	'Bitte eine gültige E-Mail-Adresse einfügen.',
'Please enter a valid URL.'				=>	'Bitte einen gültigen Link einfügen.',
'Please enter a valid date.'			=>	'Bitte ein gültiges Datum einfügen.',
'Please enter a valid date (ISO).'		=>	'Bitte ein gültiges Datum (ISO) einfügen.',
'Please enter a valid number.'			=>	'Bitte eine gültige Zahl eingeben.',
'Please enter only digits.'				=>	'Bitte nur Ziffern eintragen.',
'Please enter a valid credit card number.'		=>	'Bitte eine gültige Kreditkartennummer eintragen.',
'Please enter the same value again.'			=>	'Bitte denselben Wert erneut eingeben.',
'Please enter a value with a valid extension.'	=>	'Bitte den Wert einer gültigen Erweiterung eintragen.',
'Please enter no more than {0} characters.'		=>	'Bitte mehr als {0} Zeichen eintragen.',
'Please enter at least {0} characters.'			=>	'Bitte mindestens {0} Zeichen eintragen.',
'Please enter a value between {0} and {1} characters long.'	=>	'Bitte einen Wert zwischen {0} und {1} Zeichen eintragen.',
'Please enter a value between {0} and {1}.'					=>	'Bitte einen Wert zwischen {0} und {1} eintragen.',
'Please enter a value less than or equal to {0}.'			=>	'Bitte einen Wert mit weniger oder gleich {0} eintragen.',
'Please enter a value greater than or equal to {0}.'		=>	'Bitte einen Wert größer oder gleich {0} eintragen.',
// CB 1.8 Validations:
'Not a valid input' => 'Keine gültige Eingabe',
) );

// Profile Gallery v1.2 final plugin: (new method: UTF8 encoding here):
CBTxt::addStrings( array(
'Please look at the relevant tab for additional parameters' => 'Weitere Einstellungen im "Tab Management".',
'Approval Tab Enabled' => 'Tab für Moderator-Freigaben',
'[This feature is not implemented yet] Specify Yes to enable gallery management tab for moderators (default: No).' =>
'[Dieses Feature wurde derzeit noch nicht implementiert!] "Ja" = Galerie Management Tab für Moderatoren anzeigen. "Nein" = kein Moderatoren Tab zeigen.',
'Moderator Notification' => 'Moderator Benachrichtigung senden',
'Specify Yes to enable notification email messages sent to moderators (default: Yes).' => '"Ja" = Moderatoren erhalten eine Benachrichtigungs E-Mail. "Nein" = keine Benachrichtigung versenden.',
'Gallery Automatically Enabled' => 'Galerie automatisch einschalten',
'Specify No to require each user or moderator (depending on setting of next \'Allow User to Enable\' parameter) to enable his/her gallery by editing his/her profile setting (default: Yes).' =>
'"Nein" = erfordert Freigabe jedes Benutzers/Moderators (abhängig von der Einstellung "Freigabe durch Benutzer"), "Ja" = automatisch Einschalten (Default).',
'Allow User to Enable' => 'Freigabe durch Benutzer',
'Specify Yes to allow user to enable his/her gallery by editing his/her profile setting. If set to No, then CB moderator or backend admin must enable gallery for each user (default: Yes).' =>
'"Ja" = dem Benutzer erlauben, die Galerie in seien Profil-Einstellungen freizugeben, "Nein" = der Moderator/Backend-Administrator muß die Galerie für jeden Benutzer freigeben (Default: Ja).',
'Enable Paging' => 'seitenweise Anzeige',
'Specify Yes to allow entries to automatically page when they exceed the number per page limit (default: Yes).' =>
'"Ja" = Benachrichtigen, wenn die Anzahl der Elemente pro Seite überschritten wird, "Nein" = keine Benachrichtigung (Default: Ja).',
'Gallery Operations Mode' => 'Galerie-Elemente',
'Select which mode you want the gallery to operate in (default: Images)' => 'Spezifiziert, welche Elemente die Galerie enthalten kann (Default: Bilder).',
'Images' => 'Bilder',
'Files' => 'Dateien',
'Images and Files' => 'Bilder und Dateien',
'Image File List' => 'Bilddateitypen',
'Comma separated file extension list for allowable image items (default: jpg,gif,png).' => 'Dateierweiterungen, die für Bilddateien erlaubt sind. Erweiterungen werden durch ein Komma getrennt (Default: jpg,gif,png).',
'Other File List' => 'übrige Dateitypen',
'Comma separated file extension list allowable for non image items (default: zip,doc,pdf,txt,xls).' => 'Dateierweiterungen, die für die übrigen Dateitypen erlaubt sind. Erweiterungen werden durch ein Komma getrennt (Default: zip,doc,pdf,txt,xls).',
'Sort Option' => 'Sortierung',
'Select which sorting option to apply when displaying gallery items (default: Newer items first).' => 'Sortierungsreihenfolge wählen, in der die Galerie-Elemente angezeigt werden (Default: neue zuerst).',
'Older items first' => 'alte zuerst',
'Newer items first' => 'neue zuerst',
'Select which access mode type to allow when viewing the gallery tab (default: Registered Only).' => 'Zugriffsrechte, für die Darstellung des Galerie-Tabs (Default: Registriert).',
'Public' => 'Öffentlich',
'Registered Only' => 'Registriert',
'Allow Access Mode Override' => 'alternative Zugriffsrechte',
'Select Yes to allow users to override default access mode setting for gallery tab viewing (default: yes).' => '"Ja" = Erlaube Benutzern, die Zugriffsrechte zur Galerie-Tab-Anzeige zu überschreiben. "Nein" = Keine Überschreibung der Rechte erlaubt (Default: Ja).',
'Allow Moderator FE Uploads' => 'Moderatoruploads im Frontend',
'Select Yes to allow moderators to upload items on behalf of users when viewing their profiles in the front-end (default: Yes)' =>
'"Ja" = Moderatoren erlauben, Elemente im Namen des Benutzer im Frontend hochladen zu können. "Nein" = Kein Hochladen im Frontend (Default: Ja).',
'Display Format' => 'Galerieformat',
'Select which format to use when displaying gallery items (default: Default (thumbnail))' => 'Auswahl des Anzeigeformats der Galerieelemente (Default: Bildvorschau)',
'Default (thumbnail)' => 'Bildvorschau',
'Table list' => 'Elementliste, tabellarisch',
'Thumbnail lightbox' => 'Bildvorschau in einer Lightbox',
'Display Format Parameters' => 'Galerieanzeige-Parameter',
'Comma separated parameters to use during html rendering of profile gallery items. First value is the number of chars to truncate title at when viewing thumbnail (default: 10). Second value is the string you want to follow after the truncated title (default: ...). Third value is the number of pixels to add to verticle dimension of the thumbnail to allow icon buttons to fit (default: 100). Fourth value is the number of pixels to add to the horizontal dimension of the thumbnail (default: 0). (default:10,...,100,0,70,10).' =>
'Kommaseperierte Parameterliste zur Darstellung von Galerieelementen. Erster Parameter = max. Zeichenlänge vom Titelnamen in der Bildvorschau (Default: 10). Zweiter Parameter = String, der nach dem Titelnamen angezeict wird (Default: ...). Dritter Parameter = Pixelanzahl, die der Bildvorschaubreite hinzugefügt wird, um die Icon-Buttons korrekt darstellen zu können (Default: 100). Vierter Parameter: Pixelanzahl, die der Bildvorschauhöhe hinzugefügt wird, um die Icon-Buttons korrekt darstellen zu können (Default: 0).',
'Allow Display Format Override' => 'Galerie-Anzeigeformat überschreiben',
'Select Yes to allow users to override default format setting for gallery viewing (default: Yes).' => '"Ja" = Benutzern erlauben, das Galerie-Anzeigeformat zu ändern. "Nein" = keine Änderung erlaubt (Default: Ja)',
'Autopublish' => 'Neue Elemente automatisch Publizieren',
'Default setting for newly submitted items. Can be over-ridden by any user from the cb field profile updates (default: Yes).' => 'Vorgabeeinstellung für neue Galerie-Elemente. Kann im Benutzerprofil geändert werden',
'Allow Auto-publish Override' => 'automatisches Publizieren ändern',
'Select Yes to allow users to override default autopublish status for new gallery items (default: No).' => '"Ja" = Benutzer können können die Einstellungen zur Publizierung ändern. "Nein" = Keine Änderung möglich',
'Auto-approve' => 'Elementfreigabe',
'Select Yes to automatically approve submitted items or No to force item approval by authorized moderators (default: Yes).' => '"Ja" = automatische Freigabe von Galerie-Elementen. "Nein" = Galerie-Elemente müssen freigegeben werden (Default: Ja).',
'Elementfreigabe im Backend' => '',
'Select Yes to allow admins to override default autoapprove setting for individual users via the backend user management (default: Yes).' => '"Ja" = Administratoren können die individuellen Rechte bezüglich der Elementfreigabe im Backend ändern. "Nein" = keine Backend-Änderung möglich (Default: Ja)',
'Gallery Button Icons' => 'Galeriebuttons',
'Select Yes to over-ride default icon images (default: No).' => '"Anpassen" = Galeriebuttons können geändert werden. "Nein" = keine Änderung möglich (Default: Nein).',
'Over-ride' => 'Anpassen',
'Gallery Icon List' => 'angepasste Button-Icons',
'Comma separated file list for gallery icon images (must be 5 items otherwise system will revert to default icons). Icons must be located in components --> com_comprofiler --> plugin --> user --> plug_cbprofilegallery --> images folder (default: delete.gif,unpublish.gif,publish.gif,approve.gif,revoke.gif,edit.gif).' =>
'Bilddateienliste, die zum Darstellen der Button-Icons verwendet wird (5 Elemente sind zwingend erforderlich, sonst werden die Voreinstellungen benutzt). Die Icondateien müssen dazu im Verzeichnis: /components/com_comprofiler/plugin/user/plug_cbprofilegallery/images folder liegen! (Default: delete.gif,unpublish.gif,publish.gif,approve.gif,revoke.gif,edit.gif).',
'Entries per Page' => 'Elemente pro Seite',
'Number of entries shown per page (default: 5).' => 'Anzahl der Galerie-Elemente, die auf einer Seite angezeigt werden (Default: 5).',
'Items Quota' => 'Elemente pro Benutzer',
'Default gallery items quota per user (default: 10).' => 'Anzahl der Elemente, die ein Benutzer publizieren kann (Default: 10).',
'Maximum width' => 'max. Bildbreite',
'Maximum image width for single image upload in pixels. Images exceeding this value will be resized (default: 500).' => 'maximale Bildbreite für hochgeladene Bilder. Bilder, die diese Einstellung überschreiten werden herunterskaliert (Default: 500).',
'Maximum height' => 'max. Bildhöhe',
'Maximum image height for single image upload in pixels. Images exceeding this value will be resized (default: 500).' => 'maximale Bildhöhe für hochgeladene Bilder. Bilder, die diese Einstellung überschreiten werden herunterskaliert (Default: 500).',
'Maximum size' => 'max. Dateigröße',
'Maximum gallery item size in Kbytes allowed for single uploaded item. Files exceeding this size will be rejected (default: 250).' => 'maximale Dateigröße für hochgeladene Dateien der Galerie (in Kilobytes). Elemente, die diese Größe überschreiten werden abgelehnt! (Default: 250).',
'Maximum thumbnail width' => 'max. Bildvorschaubreite',
'Maximum thumbnail width in pixels for image item resizing (default: 150).' => 'maximale Breite der Bildvorschauskalierung.',
'Maximum thumbnail height' => 'max. Bildvorschauhöhe',
'Maximum thumbnail height in pixels for image item resizing (default: 150).' => 'maximale Höhe der Bildvorschauskalierung.',
'Storage quota' => 'Speicherkontingent',
'Default storage quota in Kbytes for individual user. Can be over-ridden by admin for VIP users (default: 1024).' => 'voreingestelltes Speicherkontingent (in Kilobytes), der Benutzern zur Verfügung steht. Administratoren können diesen Wert für VIP-Benutzer ändern (Default: 1024).',
'Allow Public Access' => 'Öffentlich',
'Allow Registered Access' => 'Registriert',
'Allow Connections Access' => 'Verbundene',
'Registered Stealth Access' => 'Registriert (Geheim)',
'Connections Stealth Access' => 'Verbundene (Geheim)',

// Profile Gallery older versions plugin: (new method: UTF8 encoding here.):
'CB Profile Gallery' => 'CB Profil-Galerie',
'This tab contains a basic no-frills image Gallery for CB profiles' => 'Dieses Tab beinhaltet die Bilder-Galerie für die CB Profile',
'Current Items' => 'Aktuelle Elemente',
'Keeps track of number of stored items' => 'Verfolgt die Anzahl der gespeicherten Elemente',
'Date of last update to Gallery items in this profile' => 'Datum der letzten Aktualisierung zum Galerieartikel dieses Profiles',
'Last Update' => 'Letzte Aktualisierung',
'Enable Gallery' => 'Galerie einschalten',
'Select Yes or No to turn-on or off the Gallery Tab' => 'Wählen, um das Galerie-Tab ein- oder auszuschalten',
'Short Greeting' => 'Kurze Grußformel',
'Enter a short greeting for your gallery viewers' => 'Eine kurze Grußformel zum Besuch der Galeriebenutzer eingeben',
'Item Quota' => 'Artikelkontingent',
'The admin may use this to over-ride the default value of allowable items for each profile owner' => 'Der Administrator kann dies nutzen um die Standardwerte der erlaubten Elemente zu überschreiben',
'No Items published in this profile gallery' => 'Es ist noch kein Element in dieser Profil-Galerie veröffentlicht worden',
'Title:' => 'Titel:',
'Description:' => 'Beschreibung:',
'Image File:' => 'Bilddatei:',
'Submit New Gallery Entry' => 'Neuen Galerie-Eintrag machen',
'Submit Gallery Entry' => 'Galerie-Eintrag absenden',
'A file must be selected via the Browse button' => 'Eine Detei muß über den Button gewählt werden',
'A gallery item title must be entered' => 'Ein Titelnamen muß für das Galerie-Element eingeben werden',
'Autopublish items' => 'Elemente automatisch veröffentlichen',
'Select Yes or No to autopublish or not newly uploaded gallery items' => 'Neue Galerie-Elemente automatisch veröffentlichen oder nicht',
'Current Storage' => 'Aktueller Speicherplatz',
'This field keeps track of the total size of all uploaded gallery items - like a quota usage field. Value is in bytes' => 'Verfolgt die Gesamtgröße der hochgeladenen Galerie-Elemente wie das Kontingentfeld- Die Größe ist in Bytes angegeben.',
'Greetings - connections only viewing enabled' => 'Willkommen - Verbindungen werden nur angezeigt',
'Sorry - connections only viewing enabled for this gallery that currently has %1$d items in it.' => 'Verbindungen werden für die Galerie, die %1$d Elemente hat, angezeigt.',
'Automatically approve' => 'Automatisch Freigeben',
'This value can be set by the admin to over-ride the gallery plugin backend default approval parameter' => 'Diesen Parameter kann der Administrator setzen um die Standardeinstellungen für die Galerie-Freigabe im Backend anzupassen',
'Storage Quota (KB)' => 'Speicherkontingent (KB)',
'This value can be set by the admin to over-ride the gallery plugin backend default user quota' => 'Diesen Parameter kann der Administrator setzen um die Standardeinstellungen für die Galerie-Plugin-Benutzerkontingent im Backend anzupassen',
'Maximum allowable single upload size exceeded - gallery item rejected' => 'Die maximale Uploadgröße wurde überschritten - Das Galerie-Element wurde abgelehnt! ',
'File extension not authorized' => 'Dateiendung wird nicht unterstützt',
/**
 * Parameters available for use in _pg_QuotaMessage language string
 * %1$d ~ Total count of items uploaded
 * %2$d ~ Maximum uploaded items allowed
 * %3$d ~ Total KB of uploaded items
 * %4$d ~ Maximum KB of uploaded items allowed
 * %5$d ~ Consumed storage percentage of uploaded items
 * %6$d ~ Free storage percentage of uploaded items
 * %7$d ~ Maximum single upload size
 */
' [Your current quota marks: %1$d/%2$d items %3$d/%4$d Kbytes (%5$d%% consumed - %6$d%% free)]' => ' [aktuelle Kontingente: %1$d/%2$d Elemente %3$d/%4$d Kbytes (%5$d%% gespeichert - %6$d%% frei) - max. Uploadgröße beträgt %7$d Kbytes]',
'This file would cause you to exceed you quota - gallery item rejected' => 'Diese Datei würde das Speicherkontingent überschreiten - Galerie-Element abgelehnt',
'Access Mode' => 'Zugriffsmodus',
'Select desirable access mode: Public access, Registered users only, Connected users only, REG-S for Registered-stealth, CON-S for Connections-stealth' => 'Zugriffsmudus wählen: Öffentlich, Registrierte Benutzer, Benutzer mit Verbindung, Registrierte Benutzer (Geheim), Benutzer mit Verbindung (Geheim)',
'Public Access' => 'Öffentlich',
'Registered Access' => 'Registriert',
'Registered Only - Stealth' => 'Registriert (Geheim)',
'Connections Only' => 'Verbundene Benutzer',
'Connections Only - Stealth' => 'Verbundene Benutzer (Geheim)',
'Display Format' => 'Anzeigeformat',
'Select Display Format to apply for gallery viewing.' => 'Ein Anzeigeformat für die Galerie auswählen.',
'Pictures gallery list format' => 'Bildergalerie Listenformat',
'File list format' => 'Dateilisten-Format',
'Picture gallery list lightbox format' => 'Bildergalerie (Lightbox) Listenformat',
'Gallery repository successfully created!' => 'Galerieangebot erfolgreich erstellt!',
'Gallery repository could not be created! Please notify system admin!' => 'Galerieangebot konnte nicht erstellt werden! Bitte den Administrator dazu kontaktieren!',
'Image ToolBox failure! - Please notify system admin - ' => 'Fehler: Bilder-Toolbox! - Bitte den Administrator dazu kontaktieren -',
'The file upload has failed! - Please notify your system admin!' => 'Der Dateiupload ist fehlgeschlagen! - Bitte den Administrator dazu kontaktieren -',
/**
 * Parameters available for use in _pg_FileUploadSucceeded and _pg_FileUploadAndTnSucceeded language strings
 * %1$s ~ Name of uploaded file in user repository
 */
'The file %1$s has been successfully uploaded!' => 'Die Datei %1$s wurde erfolgreich hochgeladen!',
'The file %1$s has been successfully uploaded and tn%1$s thumbnail created!' => 'Die Datei %1$s wurde erfolgreich hochgeladen und die tn%1$s Bildvorschau wurde erzeugt!',
'Only Registered Members Allowed to view the %1$d items in this Gallery!' => 'Nur registrierten Benutzern ist es erlaubt, die %1$d Elemente in der Galerie zu sehen!',
'Delete' => 'Löschen',
'Publish' => 'Veröffentlichen',
'Unpublish' => 'Unveröffentlichen',
'Approve' => 'Freigeben',
'Revoke' => 'Widerrufen',
'Default setting' => 'Standardeinstellungen',
'Are you sure you want to delete selected item ? The selected item will be deleted and cannot be undone!' => 'Sicher, das gewählte Element zu löschen? Dieses Element wird endgültigt gelöscht!',
'Max single upload (KB)' => 'max. Dateigröße einer Datei (KB)',
'This value can be set by the admin to over-ride the gallery plugin backend default maximum single upload size' => 'Diesen Parameter kann der Administrator setzen um die Standardeinstellungen für die maximale Uploadgröße einer Datei im Backend anzupassen',
'Updated' => 'Aktualisiert',
'Title' => 'Titel',
'Description' => 'Beschreibung',
'Download' => 'Download',
'Actions' => 'Aktionen',
'Never' => 'Niemals',
'Gallery Moderation' => 'Galerie-Moderation',
'This tab contains all pending autorization gallery items' => 'Dieses Tab enthält alle noch freizugebenden Galerie-Elemente.',
'New Gallery Item just uploaded' => 'Neues Galerie-Element hochgeladen',
/**
 * Parameters available for use in _pg_MSGBODY_NEW language string
 * %1\$s ~ item type
 * %2\$s ~ item title
 * %3\$s ~ item description
 * %4\$s ~ username
 * %5\$s ~ profile link
 */
"A new Gallery item has just been uploaded and may require approval.\n"
."This email contains the item details\n\n"
."Gallery Item Type - %1\$s\n"
."Gallery Item Title - %2\$s\n"
."Gallery Item Description - %3\$s\n\n"
."Username - %4\$s\n"
."Profile Link - %5\$s \n\n\n"
."Please do not respond to this message as it is automatically generated and is for information purposes only\n"
=>
"Ein neues Galerie-Element wurde hochgeladen, das eine noch eine Freigabe erfordert.\n"
."Diese E-Mail enthält Details zu dem Element\n\n"
."Galerie-Element-Typ - %1\$s\n"
."Galerie-Element-Titel - %2\$s\n"
."Galerie-Element-Beschreibung - %3\$s\n\n"
."Username - %4\$s\n"
."Link zum Profil - %5\$s \n\n\n"
."Bitte nicht auf diese automatisch generierte System-Nachricht antworten\n",
'Your Gallery Item has been approved!' => 'Galerie-Element wurde freigegeben!',

"A Gallery item in your Gallery Tab has just been approved by a moderator.\n\n\n"
."Please do not respond to this message as it is automatically generated and is for information purposes only\n"
=>
"Ein Galerie-Element vom Galerie-Tab wurde soeben von einem Moderator freigegeben.\n\n\n"
."Bitte nicht auf diese automatisch generierte System-Nachricht antworten\n",

'Your Gallery Item has been revoked!' => 'Das Galerie-Element wurde abgelehnt!',

"A Gallery item in your Gallery Tab has just been revoked by a moderator.\n\n\n"
."If you feel that this action is unjustified please contact one of our moderators.\n"
."Please do not respond to this message as it is automatically generated and is for information purposes only\n"
=>
"Ein Galerie-Element wurde zur Veröffentlichung von einem Moderator abgelehnt.\n\n\n"
."Bei einer ungerechtfertigten Ablehnung ist ein Moderator zu kontaktieren.\n"
."Bitte nicht auf diese automatisch generierte System-Nachricht antworten\n",

'Your Gallery Item has been deleted!' => 'Eines der Galerie-Elemente wurde gelöscht!',

"A Gallery item in your Gallery Tab has just been deleted by a moderator.\n\n\n"
."If you feel that this action is unjustified please contact one of our moderators.\n"
."Please do not respond to this message as it is automatically generated and is for information purposes only\n"
=>
"Einer der Galerie-Elemente aus dem Tab wurde von einem Moderator gelöscht.\n\n\n"
."Bei einer ungerechtfertigten Löschung ist ein Moderator zu kontaktieren.\n"
."Bitte nicht auf diese automatisch generierte System-Nachricht antworten\n",

'Your Gallery item is pending approval by a site moderator.' => 'Ein Galerie-Element muß noch von einem Moderator freigegeben werden.',
'Your Gallery item quota has been reached. You must delete an item in order to upload a new one or you may contact the admin to increase your quota.' => 'Das Galerie-Kontingent ist erschöpft. Es muß eines der aktiven Galerie-Elemente gelöscht werden um ein neues hochladen zu können. Bitten den Administrator um eine Kontingentserweiterung befragen.',
'Failed to be add index.html to the plugin gallery - please contact administrator!' => 'Fehler beim Hinzufügen der index.html zu der Plugin-Galerie - bitte den Administrator kontaktieren!',
'No item uploaded!' => 'Kein Element hochgeladen!',
/**
 * Parameters available for use in _pgModeratorViewMessage
 * %1$d ~ Total count of items uploaded
 * %2$d ~ Maximum uploaded items allowed
 * %3$d ~ Total KB of uploaded items
 * %4$d ~ Maximum KB of uploaded items allowed
 * %5$s ~ access mode setting
 * %6$s ~ display format setting
 * %7$s ~ single upload size
 */
'<font color="red">Moderations :<br />'
.'Items - %1$d<br />'
.'Item Quota - %2$d<br />'
.'Storage - %3$d<br />'
.'Storage Quota - %4$d<br />'
.'Access Mode - %5$s<br />'
.'Display Mode - %6$s<br /></font>'
=>
'<font color="red">Moderationsdaten:<br />'
.'Elemente - %1$d<br />'
.'Elementkontingent - %2$d<br />'
.'Speicherplatz - %3$d<br />'
.'Speicherkontingent - %4$d<br />'
.'Zugriffsart - %5$s<br />'
.'Anzeigeart - %6$s<br />'
.'Uploadgröße für eine einzelne Datei - %7$s<br /></font>',

'Image ' => 'Bild ',
' of ' => ' von ',
'Image {x} of {y}' => 'Bild {x} von {y}',
/**
 * Following section defines language strings used in CB Gallery Module
 */
'No Viewable Items' => 'Keine verfügbaren Elemente',
'No items rendered' => 'Keine Elemente erzeugt',

'Edit Gallery Item' => 'Galerie-Element bearbeiten',
'Edit' => 'Bearbeiten',
'Update' => 'Aktualisieren',

'Bad File - Item rejected' => 'Falsche Datei - Element abgelehnt',
'Not logged on' => 'Nicht Eingeloggt',
'No connected items' => 'Keine verbundenen Dateien'
));

// Privacy plugin: (new method: UTF8 encoding here):
CBTxt::addStrings( array(
'Only to logged-in users' => 'Nur eingeloggte Benutzer',
'Only for direct connections' => 'Nur für direkte Verbindungen',
'Only for %s' => 'Nur für %s',
'Access only to logged-in users. Please login.' => 'Zugriff nur für eingeloggte Benutzer. Bitte Einloggen.',
'Access only to logged-in users. Please login or %s.' => 'Zugriff nur für eingeloggte Benutzer. Bitte erst Einloggen oder %s.',
'register' => 'Registrieren',
'Access only with login' =>	'Zugriff nur nach Login',
'Access only to directly connected users' => 'Zugriff nur für Benutzer mit direkter Verbindung',
'Access only to directly connected users and friends of friends' =>	'Zugriff nur für Benutzer mit direkter Verbindung und Freunde von Freunden',

// CB Privacy v1.3
'Privacy configuration level' => 'Datenschutz Konfiguration',
'Privacy configuration level for that field' => 'Datenschutz-Konfiguration für dieses Feld. "CB Konfiguration" = Einstellungen aus der CB Konfiguration verwenden. "Benutzerkontrolle" = Benutzer können individuelle Einstellungen zum Datenschutz des Feldes vornehmen',
'Normal CB settings' => 'CB Konfiguration',
'User can control privacy' => 'Benutzerkontrolle',
'User search on this field' => 'Benutzersuche ermöglichen',
'Should users which have set a non-default Privacy configuration level for that field be excluded from search results when a user specifically searches for that field ' =>
'Sollen Benutzer, die geänderte Datenschutzeinstellungen verwenden, von der Feldsuche ausgeschlossen werden?',
'Allow search on private fields' => 'Suche in privaten Feldern erlauben',
'Exclude private users' => 'private Benutzer ausschließen',
'Front-end edit' => 'Frontend Zugangskontrolle',
'No front-end edit at all for that field' => 'keine Feld-Bearbeitung möglich',
'Front-end edit only by allowed moderators' => 'Bearbeitung nur durch Moderatoren',
'Front-end edit permission for that field' => 'Frontend-Bearbeitung für dieses Feld',
'Privacy configuration level for that tab' => 'Datenschutz-Konfiguration für dieses Feld. "CB Konfiguration" = Einstellungen aus der CB Konfiguration verwenden. "Benutzerkontrolle" = Benutzer können individuelle Einstellungen zum Datenschutz des Tabs vornehmen',
'Front-end edit permission for that tab' => 'Frontend-Bearbeitung für dieses Tab',
'No front-end edit at all for that tab' => 'keine Tab-Bearbeitung möglich',
'Tabs Privacy' => 'Datenschutz für Tabs',
'Tabs marked by users \'for registered users only\'' => 'Tabs "nur für registrierte Benutzer"',
'Show protected tabs' => 'bei geschützten Tabs',
'Should tabs being viewable only by registered users be hidden or shown with an error message \'Access only to registered users\'.' =>
'HINWEIS: Tabs werden generell registrierten Benutzern gezeigt. "Tab nur für registrierte Benutzer" = geschützte Tabs werden Gästen nicht angezeigt. "Hinweismeldung anzeigen" = der Hinweis \'Anzeigen nur für registrierte Benutzer\' wird angezeigt.',
'Hide tab' => 'Tab nur für registrierte Benutzer',
'Show error message' => 'Hinweismeldung anzeigen',
'Tabs marked by users \'for connections only\'' => 'Tabs "nur für verbundene Benutzer"',
'Should tabs being viewable only by connected users be hidden or shown with an error message \'Access only to directly connected users\'.' =>
'HINWEIS: Tabs werden generell Benutzern mit Verbindung gezeigt. "Tab nur für registrierte Benutzer" = geschützte Tabs werden Gästen nicht angezeigt. "Hinweismeldung anzeigen" = der Hinweis \'Anzeige nur für verbundene Benutzer\' wird angezeigt.',
'Fields Privacy' => 'Datenschutz für Felder',
'Fields marked by users \'for registered users only\'' => 'Felder "nur für registrierte Benutzer"',
'Show protected field' => 'bei geschützten Feldern',
'Should fields being viewable only by registered users be hidden or shown with an error message \'Access only to registered users\'.' =>
'HINWEIS: Felder werden generell registrierten Benutzern gezeigt. "Feld nur für registrierte Benutzer" = geschützte Felder werden Gästen nicht angezeigt. "Hinweismeldung anzeigen" = der Hinweis \'Anzeige nur für registrierte Benutzer\' wird angezeigt.',
'Hide field' => 'Feld nur für registrierte Benutzer',
'Fields marked by users \'for connections only\'' => 'Felder "nur für verbundene Benutzer"',
'Should fields being viewable only by connected users be hidden or shown with an error message \'Access only to directly connected users\'.' =>
'HINWEIS: Felder werden generell Benutzern mit Verbindung gezeigt. "Feld nur für registrierte Benutzer" = geschützte Felder werden Gästen nicht angezeigt. "Hinweismeldung anzeigen" = der Hinweis \'Anzeige nur für verbundene Benutzer\' wird angezeigt.',
'Privacy granularity' => 'Datenschutz Benutzeroptionen',
'Select here which possibilities are offered to the user' => 'Auswählen, welche Benutzeroptionen zur Verfügung gestellt werden sollen',
'Visible on profile' => 'immer im Profil anzeigen',
'Always proposed value, default value.' => 'Wird immer im Profil angezeigt. Keine Optionen vorhanden! ',
'Only to registered users' => 'nur für registrierte Benutzer',
'Note: public profiles view must be enabled in global CB config connections tab for that choice to even appear.' =>
'HINWEIS: unter CB Konfiguration -> Verbindungen muss dazu die \'Art der Anzeige\' auf "Öffentlich" eingestellt werden.',
'Do not propose' => 'nicht Vorschlagen',
'Propose' => 'Vorschlagen',
'Only to direct connections' => 'nur für direkte Verbindungen',
'Should all connections be offered as choice to users\'s privacy settings. Note: connections must be enabled in global CB config connections tab.' =>
'Sollen alle Verbindungen als Auswahlmöglichkeit in den Benutzereinstellungen für den Datenschutz angezeigt werden? HINWEIS: unter CB Konfiguration -> Verbindungen muss dazu \'Verbindung ermöglichen\' auf "Ja" eingestellt werden.',
'Only to one connection type' => 'nur zu einem Verbindungstyp',
'Should connection types be offered as choice to users\'s privacy settings. Note: connections must be enabled in global CB config connections tab.' =>
'Sollen Verbindungstypen als Auswahlmöglichkeit in den Benutzereinstellungen für den Datenschutz angezeigt werden? HINWEIS: unter CB Konfiguration -> Verbindungen muss dazu \'Verbindung ermöglichen\' auf "Ja" eingestellt werden.',
'Also to connections\' connections' => 'auch zu Verbindungen von verbundenen Benutzern',
'Should connections and connections\' connections be offered as choice to users\'s privacy settings. Note: connections must be enabled in global CB config connections tab.' =>
'Sollen \'Verbindungen\' und \'Verbindungen von verbundenen Benutzern\' als Auswahlmöglichkeit in den Benutzereinstellungen für den Datenschutz angezeigt werden? HINWEIS: unter CB Konfiguration -> Verbindungen muss dazu \'Verbindung ermöglichen\' auf "Ja" eingestellt werden.',
'Invisible on profile' => 'Unsichtbar im Profil',
'Should a completely invisible option be proposed. In backend, all fields are always visible.' => 'Soll \'Unsichtbar im Profil\' als Auswahlmöglichkeit angezeigt werden? HINWEIS: Im Backend sind alle Felder immer sichtbar.',
'First set' => 'Datenschutz Voreinstellungen',
'Allowed' => 'Erlaubt'
));

// Activity plugin: (new method: UTF8 encoding here):
CBTxt::addStrings( array(
'%s joined, welcome !'					=>	'%s beigetreten, Willkommen !',
'%s updated his profile'				=>	'%s hat sein Profil aktualisiert',
'%s updated their profile'				=>	'%s haben ihre Profile aktualisiert',

'%s and %s'								=>	'%s und %s',
'%s, %s and %s'							=>	'%s, %s und %s'	,
'%s, %s, %s and %s more'				=>	'%s, %s, %s und %s mehr',

'%s and %s are now connected'			=>	'%s und %s stehen in Verbindung',
'%s is now connected to %s'				=>	'%s hat nun eine Verbindung mit %s',
'%s are now connected to %s'			=>	'%s haben nun eine Verbindung zu %s',

'%s added a new picture'				=>	'%s hat ein neues Bild hinzugefügt',
'%s added new pictures'					=>	'%s hat neue Bilder hinzugefügt',
'%s added %s new pictures'				=>	'%s hat %s neue Bilder hinzugefügt',
'%s commented to %s\'s %s'				=>	'%s hat einen Kommentar abgegeben zu %s\'s %s',
'%s rated %s\'s %s'						=>	'%s hat %s\'s %s bewertet' ,
'picture'								=>	'Bild',
'pictures'								=>	'Bilder',
'profile'								=>	'Profil',

'%s added a new gallery'				=>	'%s hat eine neue Galerie hinzugefügt',

'%s signed the guestbook of %s'			=>	'%s hat sich in das Gästebuch von %s eingetragen',
'%s wrote on the wall of %s'			=>	'%s hat an die Pinnwand von %s geschieben',
'%s posted a new note to %s'			=>	'%s hat eine neue Notiz zu %s hinzugefügt',
'%s updated a %s in %s'					=>	'%s aktualisierte ein %s in %s',
'%s updated a %s in %s\'s %s'			=>	'%s aktualisierte ein %s in %s\'s %s',
'%s updated a %s in the %s'				=>	'%s aktualisierte ein %s in dem %s',

'%s wrote a new %s'						=>	'%s hat eine neue %s geschrieben',
'%s wrote a new %s "%s"'				=>	'%s hat eine neue %s "%s" geschrieben',
'%s replied to %s'						=>	'%s antwortete auf %s',
'%s replied to %s "%s"'					=>	'%s antwortete auf %s "%s"',
'%s edited his %s'						=>	'%s änderte sein %s',
'forum post'							=>	'Forum-Nachricht',
'comment'								=>	'Kommentar',
'note'									=>	'Notiz',
'tag'									=>	'Tag',
'rating'								=>	'Bewertung',

'%s created the group "%s"'				=>	'%s hat die Gruppe "%s" erstellt',
'%s joined the group "%s"'				=>	'%s ist der Gruppe "%s" beigetreten',

'%s subscribed to %s'					=>	'%s hat sich angemeldet für %s',
'%s upgraded to %s'						=>	'%s aktualisiert zu %s',
'%s donated %s'							=>	'%s spendete an %s',
'%s donated %s, thank you very much'	=>	'%s spendete an %s, vielen Dank!',
'%s donated'							=>	'%s spendete',
'%s donated, thank you very much'		=>	'%s spendete, vielen Dank',
'%s purchased something'				=>	'%s hat etwas gekauft',
'%s purchased something, thank you'		=>	'%s hat etwas gekauft, vielen Dank',
'%s purchased a %s'						=>	'%s hat ein %s gekauft',
'%s purchased a %s, thank you'			=>	'%s hat ein %s gekauft, vielen Dank',

));

// CB Ratings fields v1.0 RC
CBTxt::addStrings( array(
'Thank you for rating!'					=>	'Danke, für die Bewertung!',
'Click on a star to rate!'				=>	'Zum Bewerten, auf einen Stern klicken!',
// Rate 1 Star:
'Rate %s %s'							=>	'Bewerte %s %s',
'Cancel Rating'							=>	'Bewertung abbrechen',
// following rating strings can be used/changed in field's param
'Self'									=>	'Selber',
'Visitor'								=>	'Besucher',
'Rating'								=>	'Bewertung',
'Star'									=>	'Stern',
'Stars'									=>	'Sterne',
'Poorest'								=>	'Schlechteste',
'Poor'									=>	'Schlecht',
'Average'								=>	'Durchschnittlich',
'Good'									=>	'Befriedigend',
'Better'								=>	'Gut',
'Best'									=>	'Top',
'Configuration Settings' => 'Konfiguration',
'Number of Units' => 'Bewertungseinheiten',
'Maximum number of units that should be used for this field.' => 'Wählt die maximale Anzahl der Bewertungeinheiten (Sterne).',
'Rating Fraction' => 'Bewertungsschritte',
'Select the fraction of a unit you want the user to be able to select' => 'Wählt die Größe der Bewertungsschritte aus.',
'Whole (1)' => 'Einzeln (1)',
'Half (1/2)' => 'Halb (1/2)',
'Thirds (1/3)' => 'Drittel (1/3)',
'Quarters (1/4)' => 'Viertel (1/4)',
'Language Strings' => 'Übersetzungen',
'Self Display Title' => 'Eigener Anzeigetitel',
'The title to display when refering to the rating provided by the profile owner (language-translated from English in the CB language plugin file).' =>
'Der Titel, der bei der Bewertung des eigenen Profils angezeigt wird.',
'Visitor Display Title' => 'Besucher Anzeigetitel',
'The title to display when refering to the rating provided by profile visitors (language-translated from English in the CB language plugin file).' =>
'Der Titel, der bei der Bewertung durch einen Besucher angezeigt wird.',
'Action Title' => 'Titel für Bewertung',
'The verb to use when refering to the action being taken, i.e Rating or Voting (language-translated from English in the CB language plugin file).' =>
'Das Verb, das für die Bewertung angegeben wird.',
'Thank you text' => 'Dankestext nach Bewertung',
'The &quot;Thank you for rating!&quot; text displayed in ajax after voting (language-translated from English in the CB language plugin file).' =>
'Der Text der nach einer abgegebenen Bewertung angezeigt wird.',
'Singular Unit Title' => 'eine Bewertungseinheit',
'The title to display when refering to a single rating unit, i.e Star or Vote (language-translated from English in the CB language plugin file).' =>
'Legt den Namen einer einzelnen Bewertungseinheit fest.',
'Plural Unit Title' => 'mehrere Bewertungseinheiten',
'The title to display when refering to multiple rating unit, i.e Stars or Votes (language-translated from English in the CB language plugin file).' =>
'Legt den Namen bei der Auswahl von mehreren Bewertungseinheiten fest.',
'Rating Text 0' => 'Bewertung für \'0\'',
'Please provide a description for each of the total number of rating units configured above (language-translated from English in the CB language plugin file).' =>
'Einen Bewertungstext, passend zur entsprechenden Bewertung eingeben (z.Bsp.: 0 = Schlecht, 5 = Top).',
'Rating Text 1' => 'Bewertung für \'1\'',
'Rating Text 2' => 'Bewertung für \'2\'',
'Rating Text 3' => 'Bewertung für \'3\'',
'Rating Text 4' => 'Bewertung für \'4\'',
'Rating Text 5' => 'Bewertung für \'5\'',
'Rating Text 6' => 'Bewertung für \'6\'',
'Rating Text 7' => 'Bewertung für \'7\'',
'Rating Text 8' => 'Bewertung für \'8\'',
'Rating Text 9' => 'Bewertung für \'9\'',
'Rating Text 10' => 'Bewertung für \'10\'',
'Rating Text 11' => 'Bewertung für \'11\'',
'Allow Annonymous Ratings' => 'Gästebewertungen erlauben',
'If set to &quot;Yes&quot;, ratings will be permitted by visitors who are not logged in.' => '"Ja" = Gäste können Bewertungen abgeben. "Nein" = keine Bewertungen für Gäste.',#
'Log Rating Details' => 'detailiertes Bewertungslog',
'If set to &quot;Yes&quot;, details about each rating will be logged such as IP Address, User ID, DateTime, etc.' =>
'"Ja" = jede Bewertung wird detailiert hinterlegt (IP-Adresse, UserID, Datum, Zeit...). "Nein" = kein detailiertes BewertungsLog führen.',
'Allow Multiple Ratings' => 'Mehrfachbewertungen erlauben',
'If set to &quot;Yes&quot;, user will be able to cast multiple votes' => '"Ja" = Benutzer können Mehrfachbewertungen abgeben. "Nein" = keine Mehrfachbewertungen.',
'Seconds between Ratings' => 'Bewertungsabstand (Sekunden)',
'The number of seconds a user will be required to wait prior to performing an additional rating.' =>
'Gibt den Mindestzeitabstand an, die ein Benutzer warten muss, bevor er erneut Bewerten kann.'
));

// Forum integration plugin:
CBTxt::addStrings( array(
'Found %s Forum Posts'					=>	'%s Forum-Nachrichten gefunden',
'Forum Posts'							=>	'Foren-Nachrichten',
'Last %s Forum Posts'					=>	'letzte %s Foren-Nachrichten',
'Moderator'								=>	'Moderator',
'Administrator'							=>	'Administrator',
'ONLINE'								=>	'ONLINE',
'OFFLINE'								=>	'OFFLINE',
'Online Status: '						=>	'Online-Status: ',
'View Profile: '						=>	'Profil anzeigen: ',
'Send Private Message: '				=>	'Persönliche Nachricht senden: ',
'Date'									=>	'Datum',
'Subject'								=>	'Betreff',
'Category'								=>	'Kategorie',
'Hits'									=>	'Aufrufe',
'Karma: '								=>	'Karma: ',
'Posts: '								=>	'Gepostet: ',
'Forum Statistics'						=>	'Forum-Statistik',
'Forum Ranking'							=>	'Forum-Ranking',
'Total Posts'							=>	'Nachrichten insgesamt',
'Karma'									=>	'Karma',
'No matching forum posts found.'		=>	'Keine zutreffenden Nachrichten gefunden.',
'This user has no forum posts.'			=>	'Dieser Benutzer hat keine Foren-Nachrichten.',
'Your Subscriptions'					=>	'Eigene Abos',
'Action'								=>	'Aktion',
'No subscriptions found for you.'		=>	'Keine Abonnements gefunden.',
'Your Favorites'						=>	'Deine Favoriten',
'No favorites found for you.'			=>	'Keine Favoriten gefunden.',
'Remove'								=>	'Entfernen',
'Remove All'							=>	'Alle Entfernen',
'Unsubscribe'							=>	'Abonnement entfernen',
'Unsubscribe All'						=>	'Alle Abonnements entfernen',
'Are you sure you want to unsubscribe from this forum subscription?'				=>	'Sicher, dieses Foren-Abonnement abzubestellen?',
'Are you sure you want to unsubscribe from all your forum subscriptions?'			=>	'Sicher, ALLE Foren-Abonnements abzubestellen?',
'Are you sure you want to remove this favorite thread?'								=>	'Sicher, diesen Forums-Thread von den Favoriten zu entfernen?',
'Are you sure you want to remove all your favorite threads?'						=>	'Sicher, ALLE Foren-Theads von den Favoriten zu entfernen?',
'The forum component is not installed.  Please contact your site administrator.'	=>	'Forums-Komponente nicht installiert.  Bitte den Administrator kontaktieren.',
'Male'									=>	'männlich',
'Female'								=>	'weiblich'
));

// CB Facebook integration plugin v1.9
CBTxt::addStrings( array(
// PHP-Deklarationen; Verwendung gemeinsam mit dem CB Twitter Plugin
'ID not found' => 'ID nicht gefunden',
'ID already in use or account mismatch!' => 'ID wird bereits benutzt oder die Kontodaten sind falsch!',
'Account linked successfully' => 'Konto erfolgreich verlinkt',
'Account linking not permitted!' => 'Kontoverlinkung nicht zugelassen!',
'Your registration is not yet complete' => 'Die Registrierung ist noch nicht vollständig',
'Account registration not permitted!' => 'Kontoregistrierung nicht zugelassen!',
'User failed to initiate!' => 'Benutzer konnte nicht initiieren',
'This username is already in use!' => 'Benutzername ist schon vergeben!',
'This field is required.' => 'Dieses Feld ist erforderlich!',
'Please fix this field.' => 'Bitte Feld korrigieren!',
'Please enter a valid email address.' => 'Bitte eine gültige E-Mail-Adresse eingeben.',
'Please enter a valid URL.' => 'Bitte eine gültige URL eingeben.',
'Please enter a valid date.' => 'Bitte ein gültiges Datum eingeben',
'Please enter a valid date (ISO).' => 'Bitte ein gültiges Datum (ISO-Format) eingeben.',
'Please enter a valid number.' => 'Bitte eine gültige Nummer eingeben.',
'Please enter only digits.' => 'Bitte nur Ziffern eingeben.',
'Please enter a valid credit card number.' => 'Bitte eine gültige Kreditkartennummer eingeben.',
'Please enter the same value again.' => 'Bitte den gleichen Wert erneut eingeben.',
'Please enter a value with a valid extension.' => 'Bitte einen Wert mit einer geltenden Erweiterung eingeben.',
'Please enter no more than {0} characters.' => 'Bitte nicht mehr als (0) Zeichen eingeben.',
'Please enter at least {0} characters.' => 'Bitte mindestens (0) Zeichen eingeben.',
'Please enter a value between {0} and {1} characters long.' => 'Bitte einen Wert mit einer Zeichenlänge von (0) bis (1) eingeben.',
'Please enter a value between {0} and {1}.' => 'Bitte einen Wert zwischen (0) und (1) eingeben.',
'Please enter a value less than or equal to {0}.' => 'Bitte einen Wert =< (kleiner oder gleich) (0) eingeben.',
'Please enter a value greater than or equal to {0}.' => 'Bitte einen Wert >= (größer oder gleich) (0) eingeben.',
'E-mail Address' => 'E-Mail-Adresse',
'Confirm E-mail Address' => 'E-Mail-Adresse bestätigen',
'Update' => 'Aktualisieren',
'Link your [sitename] account.' => '[sitename]-Konto verlinken.',
'Login with your [sitename] account.' => 'In das [sitename]-Konto einloggen.',
'Link' => 'Link',
'Sign in' => 'Anmelden.',
'Default CMS' => 'Joomla CMS',
'Not Installed' => 'nicht Installiert',
'Installed' => 'Installiert',
'Not Configured' => 'nicht Konfiguriert',
'Initiated' => 'Initiiert',
'Not Initiated' => 'nicht Initiiert',
'View Facebook Profile'	=>	'Facebook-Profil anzeigen',
'Logout of your Facebook account.'	=>	'Logout von Facebook.',
'Sign out'	=>	'Abmelden',
'Login with your Facebook account.'	=>	'Login bei Facebook.',
'Unjoin this site'	=>	'Beitritt dieser Website wiederrufen',
'Unauthorize this site from your Facebook account.'	=>	'Authorisierung für diese Website bei Facebook wiederrufen.',
'Are you sure you want to unjoin %s?'	=>	'Sicher, den Beitritt bei %s zu wiederrufen?',
// XML-Definitionen...
'Application' => 'Applikation',
'App ID/App Key' => 'Facebook AppID/AppKey',
'Input Facebook application id or application key.' => 'Die Facebook AppID oder den AppKey eingeben',
'App Secret' => 'Facebook SecretKey',
'Input Facebook application secret.' => 'Den SecretKey der Facebook-Application eingeben.',
'Select how Facebook determines the language for its Javascript library. If Automatic then will use the users or sites selected language by tag. Please note not all languages are supported.' =>
'Sprachauswahl für das Facebook Plugin. Wenn die Sprache auf \'Automatisch\' eingestellt wurde, wird die Auswahl der Joomla-Konfiguration verwendet. HINWEIS: Nicht alle Sprachen werden unterstützt.',
'Automatic (CB Language)' => 'Automatisch',
'German' => 'Deutsch',
'Enable or disable Facebook integration. This allows quick enable or disable without having to clear parameters.' =>
'"Aktiviert" = Facebookintegration einschalten und das Einloggen mit den Facebook-Kontodaten ermöglichen. "Deaktiviert" = kein Einloggen mit den Facebookdaten.',
'Registration' => 'Registrierung',
'Register' => 'Registrieren',
'Enable or disable Facebook account registration. Register allows for non-existing Community Builder users to register with their Facebook account credentials.' =>
'"Aktiviert" = Registrierung durch Facebook auch bei keinem existierenden CB Konto ermöglichen. "Deaktiviert" = keine Registrierung ohne CB Konto.',
'Usergroup' => 'Benutzergruppe',
'Select Facebook registration usergroup of users.' => 'Die Benutzergruppe auswählen, in die der neue Benutzer bei einer Registrierung über Facebook eingeordnet wird.',
'Approval' => 'Kontogenehmigung',
'Select Facebook registration to require admin approval.' => 'Wählen, ob ein Administrator das neue Benutzerkonto freigeben muß.',
'No (override CB)' => 'Nein (CB Überschreiben)',
'Yes (override CB)' => 'Ja, (CB Überschreiben)',
'Default (CB setting)' => 'CB Einstellungen',
'Confirmation' => 'Bestätigen',
'Select Facebook registration to require email confirmation.' => 'Auswählen, ob eine Registrierung über Facebook eine Bestätigung per E-Mail erfordert.',
'Linking' => 'Verlinkung',
'Enable or disable Facebook account linking. Linking allows existing Community Builder users while logged in to link their Facebook account to their existing Community Builder account.' =>
'"Aktiviert" = erlaubt eine Verlinkung des CB Benutzerkontos mit dem Facebook-Konto. "Deaktiviert" = keine Verlinkung.',
'Login' => 'Login',
'Button Style' => 'Buttonstil',
'Select how Facebook button is displayed.' => 'Auswählen, wie die Schaltfläche von Facebook dargestellt wird.',
'Compact' => 'Kompakt',
'Module Orientation' => 'Modul-Orientierung',
'Module Type' => 'Modultypisch',
'First Redirect' => 'erste URL-Umleitung',
'Input optional Facebook first time login redirect URL (e.g. index.php?option=com_comprofiler).' => 'URL-Umleitung bei der ersten Anmeldung bei Facebook angeben (diese Angabe ist Optional).',
'Redirect' => 'URL-Umleitung',
'Input optional Facebook login redirect URL (e.g. index.php?option=com_comprofiler).' =>
'URL-Umleitung nach einer Anmeldung über Facebook angeben (Optional, z.Bsp.: index.php?option=com_comprofiler ).',
'Menu' => 'Menü',
'Unlink' => 'Verlinkung aufheben',
'Enable or disable Facebook unlink link on CB Menu. Please note in accordance with Facebook application policies a user must be provided with a means to unlink their account. If disabled an alternative means to unlink must be provided.' =>
'"Aktiviert" = zeigt einen Link im CB, um die Verlinkung der Benutzerkonten bei Facebook und CB aufheben zu können (wird von Facebook gefordert!). "Deaktiviert" = ein Alternativ-Link zur Aufhebung muß an einer anderen Stelle platziert werden.',
'Debug' => 'Debug Informationen',
'Test if cURL PHP module is installed.' => 'Testet, ob das cURL RPHP-Modul installiert ist.',
'Test if JSON PHP module is installed.' => 'Testet, ob das JSON PHP-Modul installiert ist.',
'Test if plugin is configured.' => 'Testet, ob das Plugin korrekt für Facebook eingerichtet ist.',
'Facebook ID' => 'Facebook ID',
'Your Facebook ID allowing API calls; if unauthorized only public calls will validate.' =>
'Die Facebook ID erlaubt API-Aufrufe. Ohne Befugnis werden nur öffentliche Aufrufe bewilligt.'
));

// CB Twitter integration plugin v1.4
CBTxt::addStrings( array(
'View Twitter Profile'	=>	'Twitter-Profil anzeigen',
'Logout of your Twitter account.'	=>	'Ausloggen bei Twitter.',
'Login with your Twitter account.'	=>	'Einloggen bei Twitter.',
// XML-Deklarationen...
'Consumer Key' => 'Twitter ComsumerKey',
'Consumer Secret' => 'Twitter SecretKey',
'Enable or disable Twitter integration. This allows quick enable or disable without having to clear parameters.' =>
'"Aktiviert" = das Einloggen mit den Twitter-Kontodaten ermöglichen. "Deaktiviert" = kein Einloggen mit Twitterdaten möglich.',
'Enable or disable Twitter account registration. Register allows for non-existing Community Builder users to register with their Twitter account credentials.' =>
'"Aktiviert" = Registrierung durch Twitter auch bei keinem existierenden CB Konto ermöglichen. "Deaktiviert" = keine Registrierung ohne CB Konto.',
'Select Twitter registration usergroup of users.' => 'Die Benutzergruppe auswählen, in die der neue Benutzer bei einer Registrierung über Twitter eingeordnet wird.',
'Select Twitter registration to require admin approval.' => 'Wählen, ob ein Administrator das neue Benutzerkonto freigeben muß.',
'Select Twitter registration to require email confirmation.' => 'Auswählen, ob eine Registrierung über Twitter eine Bestätigung per E-Mail erfordert.',
'Enable or disable Twitter account linking. Linking allows existing Community Builder users while logged in to link their Twitter account to their existing Community Builder account.' =>
'"Aktiviert" = erlaubt eine Verlinkung des CB Benutzerkontos mit dem Twitter-Konto. "Deaktiviert" = keine Verlinkung.',
'Select how Twitter button is displayed.' => 'uswählen, wie die Schaltfläche von Twitter dargestellt wird.',
'Input optional Twitter first time login redirect URL (e.g. index.php?option=com_comprofiler).' => 'URL-Umleitung bei der ersten Anmeldung bei Twitter angeben (diese Angabe ist Optional).',
'Input optional Twitter login redirect URL (e.g. index.php?option=com_comprofiler).' =>
'URL-Umleitung nach einer Anmeldung über Twitter angeben (Optional, z.Bsp.: index.php?option=com_comprofiler ).',
'Test if cURL PHP module is installed.' => 'Testet, ob das cURL RPHP-Modul installiert ist.',
'Test if JSON PHP module is installed.' => 'Testet, ob das JSON PHP-Modul installiert ist.',
'Test if plugin is configured.' => 'Testet, ob das Plugin korrekt für Facebook eingerichtet ist.',
'Twitter ID' => 'Twitter ID',
'Your Twitter ID allowing API calls; if unauthorized only public calls will validate.' =>
'Die Twitter ID erlaubt API-Aufrufe. Ohne Befugnis werden nur öffentliche Aufrufe bewilligt.'
));

// imagetoolbox messages needed for CB Team plugins
CBTxt::addStrings( array(
// 1 language string from imagetoolbox
'The file exceeds the maximum size of %s kilobytes'	=>	'Die Datei überschreitet die maximale Größe von %s Kilobytes'
));

// AcyMailing newsletter plugin: for starter version 1.0
CBTxt::addStrings( array(
'Click on the help button to get some help' => 'Bitte "HELP" klicken, um Hilfe zu erhalten!',
'Lists displayed on the registration form' => 'Abonnementlisten zeigen',
'The following selected lists will be displayed on the CB registration page if they are not selected in the field auto-subscribe to.' =>
'Die im folgenden gewählten Listen werden im Registrierungsformular angezeigt wenn dieses nicht schon im Feld "Auto-Abonnieren" ausgewält wurden.',
'Auto-subscribe to' => 'Auto-Abonnieren',
'The user will be automatically subscribed to the selected lists. They won\'t be displayed on your registration form but the user will be subscribed to those lists during the registration process' =>
'Benutzer abonnieren automatisch die ausgewählten Listen',
'Lists checked by default' => 'Listen für Vorabauswahl',
'The selected lists will be checked by default on your CB Registration Form. This option does only apply to visible lists as hidden lists will be always checked.' =>
'Listen automatisch im Registrierungsformular auswählen',
'Lists displayed on the user profile' => 'Listen im Benutzerprofil',
'The following selected lists will be displayed on the CB User profile' => 'Listen, die im Benutzerprofil angezeigt werden',
'Display Receive HTML/Text on registration' => 'HTML/Text-Auswahl bei Registrierung',
'Select yes if you want to give to the user the choice to receive the HTML or the Text version of all your e-mails.' =>
'"Ja" = Der Benutzer die Wahl im Registrierungsformular zwischen E-Mails im HTML- oder Textformat. "Nein" = Keine Auswahlmöglichkeit',
'Display Receive HTML/Text on user profile' => 'HTML/Text-Auswahl im Benutzerprofil',
'Select yes if you want to give to the user the choice to receive the HTML or the Text version of all your e-mails.' =>
'"Ja" = Der Benutzer die Wahl im Benutzerprofilzwischen E-Mails im HTML- oder Textformat. "Nein" = Keine Auswahlmöglichkeit',
'Description as an overlay' => 'Listenbeschreibung als Overlay',
'Add the description of each visible list as an overlay of the list name. Be careful, you might have conflicts using this option if you have some flash elements on your website.' =>
'"Ja" = Zeigt die Beschreibung jeder Liste als Overlay beim Listennamen. "Nein" = Kein Overlay. VORSICHT: Bei Verwendung von Flash-Inhalten auf der WebSite kann es zu Konflikten kommen!',
'Subscribe Caption' => 'Abonnementfeld-Text',
'Text displayed for the subscription field. If you don\'t specify anything, the default value will be used from the current language file' =>
'Dieser Text wird im Abonnementfeld angezeigt. Ist das Feld freigelassen, wird der Vorgabetext in der aktuellen Sprache angezeigt',
'Intro Text' => 'Einleitungstext',
'This text will be displayed on the profile page before the form inside a div class=acymailing_introtext' =>
'Dieser Text wird im Benutzerprofil vor dem Formular in einem DIV-Element <div class=acymailing_introtext...> angezeigt',
'Mailing lists' => 'Mailing-Listen',
'Enables the user to manage his subscription to the AcyMailing Mailing Lists' => 'Erlaubt dem Benutzer die Kontrolle über ihre Mailing-Listenabonnements'
));

// Auto Welcome Message v1.2
CBTxt::addStrings( array(
'Credits:' => 'Anerkennung:',
'License:' => 'Lizenz:',
'Automatic Welcome Message' => 'Automatische Willkommen-Nachricht',
'Specify Yes to automatically send a welcome message each new member' => '"Ja" um jedem neuen Benutzer eine Willkommensnachricht zu senden',
'Notification Method' => 'Benachrichtigungstyp',
'Select the appropriate notification method to use.' => 'Wählt die Methode für die Willkommensnachricht aus.',
'PMS only' => 'Nur System-Nachricht<br>',
'Email only' => 'Nur E-Mail-Nachricht<br>',
'PMS and Email' => 'System- und E-Mail-Nachricht<br>',
'PMS Welcome Subject' => 'Betreff  (System-Nachricht)',
'Welcome message subject to use in the PMS delivery. You can use [cbfieldnames] and substitutions just like in CB.' =>
'Betreff der Willkommen-Nachricht, die an den Benutzer über das CM-System gesendet wird. Es können [CBFeldnamen] und CB-Substitutionen eingefügt werden',
'PMS Welcome Body' => 'Nachrichtentext  (System-Nachricht)',
'Body of Welcome PMS message to send. You can use [cbfieldnames] and substitutions just like in CB.' => 'zu sendender System-Nachrichtentext. Es können [CBFeldnamen] und CB-Substitutionen eingefügt werden.',
'PMS Sender Id' => 'Absender ID  (System-Nachricht)',
'The userid of the sender to be used in case of PM systems (default 62 for admin user).' => 'Die Benutzer ID, die beim Versenden von System-Nachrichten verwendet wird (Default: 62 = Administrator).',
'EMAIL Welcome Subject' => 'Betreff  (E-Mail)',
'Welcome message subject to use in auto-welcome email. You can use [cbfieldnames] and substitutions just like in CB.' =>
'Betreff der Willkommen-Nachricht, die an den Benutzer über per E-Mail gesendet wird. Es können [CBFeldnamen] und CB-Substitutionen eingefügt werden',
'EMAIL Welcome Body' => 'Nachrichtentext  (E-Mail)',
'Body of auto-welcome email message. You can use [cbfieldnames] and substitutions just like in CB.' => 'zu sendender E-Mail-Nachrichtentext. Es können [CBFeldnamen] und CB-Substitutionen eingefügt werden.',
'EMAIL Sender Id' => 'Absender ID  (E-Mail)',
'The userid of the sender - to be used as the sender (default 62 for admin - use 0 for system message)' => 'Die Benutzer ID (keine E-Mail-Adresse!), die beim Versenden von System-Nachrichten verwendet wird (Default: 62 = Administrator, 0 = System-Nachricht).',
'Automatic Connection to key user' => 'Verbindung zum Ansprechpartner',
'Specify Yes to connect new users to key user.' => '"Ja" = Eine automatische Community Builder Verbindung zum Ansprechpartner erstellen.',
'Direction of Connection request' => 'Initiator der Verbindungsanfrage',
'New user requests' => 'Anfrage vom Benutzer',
'Key user requests' => 'Anfrage vom Ansprechpartner',
'Connection Request Message' => 'Nachricht zur Verbindungsanfrage',
'Message to send new user (or key user-s) when requesting automatic connection.' => 'Nachricht, die an den Benutzer (oder Ansprechpartner) bei der Verbindungsanfrage gesendet wird.',
'Key User Ids' => 'Ansprechpartner ID(s)',
'The userids to connect with the new user (default 62 for admin, multiple userids comma separated).' => 'Ansprechpartner ID(s), die für eine Verbindung verwendet wird (Default: 62 = Administrator, mehrere IDs mit dem Komma trennen).'
));

// UddeIM PMS v2.7 (die Original-Übersetzung wurde Vervollständigt
CBTxt::addStrings( array(
// PMS Plugin: Private Messaging System (uddeIM PMS)
'PMS version' => 'PMS Version',
'Choose uddeIM version installed. &lt;strong&gt;IMPORTANT: Component configuration must also be done!&lt;/strong&gt;' =>
'Die installierte UddeIM Version auswählen. <strong>WICHTIG: Die UddeIM Komponente muß hierzu konfiguriert sein!</stronng>',
'uddeIM 0.9 and above' => 'UddeIM v0.9 und neuer',
'Unescape \'\\\\n\'' => 'Escapesequenz "\\n" ignorieren',
'When you have problems with \'\\\\n\' in notification messages set this to \'yes\'. Default is \'no\'.' => 'Auf "Ja" setzen, bei  Problemen mit der Escapesequenz \'\\n\' im Nachrichtentext (Default: Nein).',
'No (default)' => 'Nein (Default)',
'Double escape' => 'Doppel-Escape \'\\\\\' verwenden',
'When you have problems with \'\n\' in notification messages set this to \'no\'. Default is \'yes\'.' => 'Auf "Nein" setzen, bei Problemen mit der Escapesequenz \'\\n\' (Default: "Ja").',
'Yes (default)' => 'Ja (Default)',
'see tab manager: pms.uddeim parameters' => 'weitere Einstellungsmöglichkeiten im "Tab Management".',
// PMS Plugin: uddeIM Blocking Plugin
'uddeIM Blocking Plugin Enabled' => 'UddeIM Blocking Plugin eingeschaltet',
'Select Yes to enable Blocking Plugin.' => '"Ja" Auswählen, um das Plugin einzuschalten',
// PMS Show Inbox
'Inbox Parameters:' => 'Posteingang Parameter:',
'Number of articles to display' => 'Anzahl der anzuzeigenden Nachrichten',
'If showing all posts, this is the number of posts per page. If showing only last ones, this is the number of articles to show. Default is 10' =>
'Zeigt die eingestellte Anzahl von Nachrichten an. Die Anzeige erfolgt Seitenweise wenn mehr Nachrichten vorhanden sind (Default: 10).',
'If set to -show all- all articles will become visible in the user profile. Otherwise, only the last submitted will be visible.' =>
'"Alle anzeigen" = sämtliche Nachrichten werden gezeigt. "Nur die letzten" = nur die neuesten Nachrichten werden angezeigt.',
// PMS Plugin: ProfileLink
'uddeIM Profilelink Settings' => 'UddeIM ProfileLink Einstellungen',
'Show Tab title' => 'Tab Titel',
'Hide' => 'Verbergen',
'Show' => 'Anzeigen',
'Suppress User List' => 'Benutzerliste verbergen',
'Suppress the complete user list selection.' => '"Ja" = Benutzerlistenauswahl unterdrücken. "Nein" = zeige Benutzerliste.',
'Disable To: Field' => 'Empfängerfeld verbergen',
'Disable the To: field.' => '"Ja" = Empfängerfeld nicht anzeigen. "Nein" = Anzeigen.',
'Link text' => 'Text für Nachrichten Link',
'Default is &quot;Send Private Message&quot;' => 'Dieser Text erscheint als Link zum Versenden von Nachrichten'
));

// PublicMail v1.3
CBTxt::addStrings( array(
'Parameters:' => 'Parameter:',
'Look under TAB MANGEMENT for parameters!' => 'Die Parameter-Einstellungen sind im "Tab Management" zu finden!',
'Main Settings' => 'Basiseinstellungen',
'Show form to whom?' => 'Nachrichtenformular zeigen',
'Should the mail-form be shown to all users/visitors or only people logged in?' => 'Benutzergruppe, die das Nachrichtenformular nutzen kann',
'All users/visitors' => 'Gäste und Registriert',
'Only registred users' => 'nur Registriert',
'Only unregistred users' => 'nur Gäste',
'Visiting own profile' => 'Im Benutzerprofil anzeigen',
'Should a text defined in the language file, the email form, or nothing at all be shown to the user if visiting own profile (and is logged in)?' =>
'Welche Elemente sollen im eigenen Benutzerprofil, wenn Eingeloggt, angezeigt werden (Default: Nichts)? HINWEIS: Die Sprachdatei befindet sich im Verzeichnis /components/com_comprofiler/plugin/user/plug_cbpublicmail/languages/',
' Don\'t show anything to owner! ' => 'Nichts',
' Show text from language file! ' => 'Text der Sprachdatei',
' Show the Public Mail form! ' => 'E-Mail-Formular',
'Show email adress in frontend?' => 'E-Mail-Adresse im Profil zeigen',
'Who should be able to view the email address of the profile owner (the person being mailed) in frontend? Deactivated saves one database query.' =>
'Wer kann die E-Mail-Adresse des Empfänger-Profils sehen?',
' Totally hidden! ' => 'Verstecken',
' Shown to all! ' => 'Allen',
' Shown only to registered members! ' => 'nur Registriert',
'Frontend intro text' => 'Einleitungstext',
'Type the intro text that is visible in frontend before the email-form is shown. Default text is: \\\'If you want to contact this person, you may use this email-form:\\\'' =>
'Dieser Text wird vor dem E-Mail-Formular angezeigt.',
'Use Captcha security?' => 'Sicherheitsabfrage',
'Captcha is a anti-spam system. The users are required to fill in a Captcha field before being able to send the mail! NB.: The CB Captcha plugin (ver. 2.2 for CB 1.2) from www.joomlapolis.com needs to be installed seperately!' =>
'Catcha ist ein Anti-Spam System. Benutzer müssen das Captcha-Eingabefeld ausfüllen, um eine Nachricht abschicken zu können. HINWEIS: Das CB Captcha Plugin v2.2 oder neuer von www.joomlapolis.com muß hierzu installiert sein!',
'Don\'t use Captcha' => 'kein Captcha verwenden',
'Only for guests (CB Captcha - v2.2 or above)' => 'Captcha nur bei Gästen',
'Show to everybody (CB Captcha - v2.2 or above)' => 'Captcha immer zeigen',
'Mail Settings' => 'E-Mail Einstellungen',
'Send thank you email?' => 'Danke E-Mail senden',
'Should the sender recieve an confirmation email after having e-mailed a registered user?' => '"Ja" = der Absender erhält eine Bestätigungsnachricht. "Nein" = keine Bestätigung versenden',
'Log messages sent in DB?' => 'gesendete E-Mails speichern',
'Should the messages sent to a registered user be saved in the database? Please note that you have to view them through eg. PhpMyAdmin!' =>
'"JA" = versandte E-Mails in der MySQL-Datenbank speichern. "Nein" = keine E-Mails speichern (gespeicherte E-Mails können z.Bsp. mit MyPHPadmin betrachtet werden!)',
'Send BCC emails to admin?' => 'BCC Kopie versenden',
'Should the admin recieve a BCC copy of the emails send though the system? Please remember to fill in the BCC reciever email below!' =>
'"Ja" = der Administrator erhält eine BCC E-Mail der versandten Nachrichten (Bitte dazu unbedingt im nächsten Feld einen Empfänger angeben!). "Nein" = keine Kopie senden',
'BCC - reciever email' => 'BCC Empfänger',
'What email adress should recieve emails send though Public Mail when users use the system? Remember to activate it above!' => 'Gibt an, wer eine Kopie von versandten Nachrichten empfangen soll (Hierzu muss die Option "BCC Kopie versenden" aktiviert werden!).',
'BCC subject prefix' => 'BCC Betreff Prefix',
'Should there be a prefix in the email subject for the BCC email (not thank you email)?' => 'Prefix, der vor dem BCC Betreff eingefügt wird (wird nicht bei der Danke E-Mail verwendet).',
'Reciever subject prefix' => 'E-Mail Betreff Prefix',
'Should there be a prefix in the email subject for the reciever email (not thank you email)?' => 'Prefix, der vor dem E-Mail Betreff des Empfängers eingefügt wird (wird nicht bei der Danke E-Mail verwendet).',
'Form Settings' => 'Formular Einstellungen',
'Form table width' => 'Formular Breite',
'How wide should the table and thereby email-form be? You can either type a number of pixels (100) or a percentage (eg. 100%)!' =>
'Die Breite des Formulares in Pixel (z.Bsp. "100") oder in Prozent (z.Bsp. "100%").',
'Use send copy feature?' => 'Eigenkopie ermöglichen',
'Should the sender be able to choose that a copy of the mail sent to a registered user is sent to themselves!' => '"Ja" = eine Checkbox für eine Eigenkopie zeigen. "Nein" = keine Möglichkeit der Eigenkopie',
'Use mail subject field?' => 'E-Mail Betreff verwenden',
'Should a field for email subject be shown in the mail form?' => '"Ja" = ein E-Mail Betrifft-Eingabefeld anzeigen. "Nein" = kein Betreff zeigen.',
'Field size (length)' => 'Eingabefelder Breite',
'What is the length (size) of the input fields? Default is 23!' => 'Gibt die Breite der Eingebefelder an (Default: 23).',
'Max. field length' => 'max. Eingabelänge',
'What is the maximum amount of characters a user is allowed to type in the email subjectfield and extra fields?' => 'Gibt die maximale Stringlänge in den Eingabefeldern inkl. Zusatzfeldern an (Default: 60).',
'Max. message length' => 'max. Nachrichtenlänge',
'What is the maximum amount of characters a user is allowed to type in the email body?' => 'Gibt die maximale Stringlänge der Nachricht an.',
'Rows in text area' => 'Zeilenanzahl für Nachricht',
'How many rows should the text area have? This defines how high the textarea is!' => 'Gibt die Anzahl der Zeilen für das Nachrichtentext-Feld an (Default: 5)',
' 1 row ' => '1 Reihe',
' 2 row ' => '2 Reihen',
' 3 row ' => '3 Reihen',
' 4 row ' => '4 Reihen',
' 5 row ' => '5 Reihen',
' 6 row ' => '6 Reihen',
' 7 row ' => '7 Reihen',
' 8 row ' => '8 Reihen',
' 9 row ' => '9 Reihen',
' 10 row ' => '10 Reihen',
' 11 row ' => '11 Reihen',
' 12 row ' => '12 Reihen',
' 13 row ' => '13 Reihen',
' 14 row ' => '14 Reihen',
' 15 row ' => '15 Reihen',
' 16 row ' => '16 Reihen',
' 17 row ' => '17 Reihen',
' 18 row ' => '18 Reihen',
' 19 row ' => '19 Reihen',
' 20 row ' => '20 Reihen',
' 21 row ' => '21 Reihen',
' 22 row ' => '22 Reihen',
' 23 row ' => '23 Reihen',
' 24 row ' => '24 Reihen',
' 25 row ' => '25 Reihen',
'Cols in text area' => 'Nachrichtenfeld Breite',
'How many columns should the text area have? This defines how wide the text area is!' => 'Gibt die Breite des Nachrichtenfeldes an (Default: 40).',
' 15 cols ' => '15 Zeichen',
' 16 cols ' => '16 Zeichen',
' 17 cols ' => '17 Zeichen',
' 18 cols ' => '18 Zeichen',
' 19 cols ' => '19 Zeichen',
' 20 cols ' => '20 Zeichen',
' 21 cols ' => '21 Zeichen',
' 22 cols ' => '22 Zeichen',
' 23 cols ' => '23 Zeichen',
' 24 cols ' => '24 Zeichen',
' 25 cols ' => '25 Zeichen',
' 26 cols ' => '26 Zeichen',
' 27 cols ' => '27 Zeichen',
' 28 cols ' => '28 Zeichen',
' 29 cols ' => '29 Zeichen',
' 30 cols ' => '30 Zeichen',
' 31 cols ' => '31 Zeichen',
' 32 cols ' => '32 Zeichen',
' 33 cols ' => '33 Zeichen',
' 34 cols ' => '34 Zeichen',
' 35 cols ' => '35 Zeichen',
' 36 cols ' => '36 Zeichen',
' 37 cols ' => '37 Zeichen',
' 38 cols ' => '38 Zeichen',
' 39 cols ' => '39 Zeichen',
' 40 cols ' => '40 Zeichen',
' 41 cols ' => '41 Zeichen',
' 42 cols ' => '42 Zeichen',
' 43 cols ' => '43 Zeichen',
' 44 cols ' => '44 Zeichen',
' 45 cols ' => '45 Zeichen',
' 46 cols ' => '46 Zeichen',
' 47 cols ' => '47 Zeichen',
' 48 cols ' => '48 Zeichen',
' 49 cols ' => '49 Zeichen',
' 50 cols ' => '50 Zeichen',
' 51 cols ' => '51 Zeichen',
' 52 cols ' => '52 Zeichen',
' 53 cols ' => '53 Zeichen',
' 54 cols ' => '54 Zeichen',
' 55 cols ' => '55 Zeichen',
' 56 cols ' => '56 Zeichen',
' 57 cols ' => '57 Zeichen',
' 58 cols ' => '58 Zeichen',
' 59 cols ' => '59 Zeichen',
' 60 cols ' => '60 Zeichen',
' 61 cols ' => '61 Zeichen',
' 62 cols ' => '62 Zeichen',
' 63 cols ' => '63 Zeichen',
' 64 cols ' => '64 Zeichen',
' 65 cols ' => '65 Zeichen',
' 66 cols ' => '66 Zeichen',
' 67 cols ' => '67 Zeichen',
' 68 cols ' => '68 Zeichen',
' 69 cols ' => '69 Zeichen',
' 70 cols ' => '70 Zeichen',
' 71 cols ' => '71 Zeichen',
' 72 cols ' => '72 Zeichen',
' 73 cols ' => '73 Zeichen',
' 74 cols ' => '74 Zeichen',
' 75 cols ' => '75 Zeichen',
' 76 cols ' => '76 Zeichen',
' 77 cols ' => '77 Zeichen',
' 78 cols ' => '78 Zeichen',
' 79 cols ' => '79 Zeichen',
' 80 cols ' => '80 Zeichen',
'Extra Form Fields' => 'Formular Zusatzfelder',
'Use extra text field 1?' => 'Zusatzfeld 1 anzeigen',
'Should an extra field be shown in the form?' => '"Ja" = Zusatzfeld 1 im Formular anzeigen. "Nein" = nicht verwenden.',
'Extra field 1 label text' => 'Zusatzfeld 1 Bezeichnung',
'Type the intro text that is visible in frontend before the extra 1 field is shown. Default text is: \\\'Contact number\\\'' =>
'Gibt die Bezeichnung an, die vor dem Zusatzfeld 1 angezeigt wird (Default: Contact number)',
'Use extra text field 2?' => 'Zusatzfeld 2 anzeigen',
'Should an extra field be shown in the form?' => '"Ja" = Zusatzfeld 2 im Formular anzeigen. "Nein" = nicht verwenden.',
'Extra field 2 label text' => 'Zusatzfeld 2 Bezeichnung',
'Type the intro text that is visible in frontend before the extra 2 field is shown. Default text is: \\\'MSN adress\\\'' =>
'Gibt die Bezeichnung an, die vor dem Zusatzfeld 2 angezeigt wird (Default: MSN adress)',
'Use extra text field 3?' => 'Zusatzfeld 3 anzeigen',
'Should an extra field be shown in the form?' => '"Ja" = Zusatzfeld 3 im Formular anzeigen. "Nein" = nicht verwenden.',
'Extra field 3 label text' => 'Zusatzfeld 3 Bezeichnung',
'Type the intro text that is visible in frontend before the extra 3 field is shown. Default text is: \\\'Company\\\'' =>
'Gibt die Bezeichnung an, die vor dem Zusatzfeld 3 angezeigt wird (Default: Company)',
'Restriction Settings' => 'Nachrichten Einschränkungen',
'Restrict Public Mail' => 'Formular im Profil anzeigen',
'You can choose to activate restriction of what profiles/users have access to the Public Mail. You need to type the Joomla/CB ID\'s of the users in the textarea below. The user ID\'s should either be the users that are can or can\'t use Public Mail. In this dropdown box you choose if the users are the only ones allowed or the only once not allowed! Default setting is off = \'All users have Public Mail on there profile\'!' =>
'Die Benutzer auswählen, in deren Profil das Formular angezeigt wird (Default: bei allen Benutzern).',
'All users have Public Mail on there profile' => 'bei allen Benutzern',
'Everyone but the user ID\'s below have Public Mail' => 'Alle, bis auf die angegebenen Benutzer',
'Only user with ID\'s below have Public Mail' => 'Nur die angegebenen Benutzer',
'Resticted users Joomla ID' => 'Benutzer ID\'s',
'Type the Joomla/CB user ID\'s into this text area that should either be the only once that can use OR not use Public Mail! You choose if the ID\'s are allowed or not in the dropdown above. The syntax should be commaseperated like so \'62,432,543\'. You can view the Joomla/CB user ID\'s in the user manager in both Joomla and CB!' =>
'Hier können die Benutzer ID\'s angegeben werden, in deren Profilen das Forumlar eingeschränkt- oder freigegeben ist (abhängig von den Einstellungen Oben). Die Benutzer ID\'s sind entweder im Joomla-Menü: Benutzer oder im CB Benutzer Management ersichtlich. Die einzelnen Benutzer ID\'s werden hierbei mit einem Komma (,) getrennt.'
));

// CB Captcha v2.3
CBTxt::addStrings( array(
'Release Date:' => 'Release Datum:',
'Plugin Prerequisites' => 'Plugin Voraussetzungen',
'Captcha Requirements' => 'Erforderlich für das Plugin',
'If all prerequisites are satisfied you should see a sample representation of the captcha security image and sound.' =>
'Wenn alle Voraussetzungen zur korrekten Darstellung des Captchas gegeben sind, wir ein Beispiel-Captcha (mit Bild und Klangausgabe) unten angezeigt.',
'Captcha Security Mode Parameters' => 'Captcha Sicherheits Parameter',
'Captcha Security Mode' => 'Captcha Modus',
'Specify desired security mode (default: Image and Sound).' => 'Hier kann der Arbeitsmodus vom Captcha eingestellt werden (Default: Bild- und Klangausgabe).',
'Image and Sound' => 'Bild- und Klangausgabe',
'Image only' => 'nur Bildausgabe',
'Captcha Image Generation Parameters' => '<br>Captcha Erstellungs Parameter',
'Captcha Width' => 'Captcha Breite',
'Enter width in pixels for the captcha image (Default is 95)' => 'Gibt die Breite des Captche-Bildes in Pixeln an (Default: 95).',
'Captcha Height' => 'Captcha Höhe',
'Enter height in pixels for captcha image (Default is 30)' => 'Gibt die Höhe des Captcha-Bildes in Pixeln an (Default: 30).',
'Captcha Characters' => 'Captcha Zeichenanzahl',
'Enter number of captcha characters to generate (Default is 5)' => 'Gibt die Anzahl der Zeichen an, die das Captcha-Bild enthalten soll (Default: 5).',
'Captcha Char Set' => 'Captcha Zeichensatz',
'Character set to use to generate random captcha image. Default set is a-z (lowercase) because these sound segments are supported by Nato phonetic library. If you add other chars (uppercase) then audio playback will break. However non-Nato phonetic digit sounds exist in the sound repository so digits may be added without breaking captcha sound playback.' =>
'Gibt alle möglichen Zeichen an, aus denen das Captcha-Bild zusammen gesetzt werden kann (Default: a-z Kleinbuchstaben). ACHTUNG: Andere Zeichen (als Kleinbuchstaben) können Probleme bei der Klangausgabe verursachen und sollten vor dem Gebrauch getestet werden!',
'Captcha Font' => 'Captcha Schriftart',
'Font to use for Captcha (default: monofont)' => 'Gibt die Schriftart an, die verwendet wird (Default: monofont).',
'Captcha Background Color' => 'Captcha Hintergrundfarbe',
'Enter color composition (in Red, Green, Blue dimensions - 0 to 255) for captcha image background (Default is 255,255,255)' =>
'Gibt die Hintergrundfarbe des Captcha-Bildes an. Die Farbanteile Rot,Grün und Blau können die Werte 0-255 annehmen und sind jeweils mit einem Komma \',\' getrennt (Default: 255,255,255).',
'Captcha Text Color' => 'Captcha Textfarbe',
'Enter color composition (in Red, Green, Blue dimensions - 0 to 255) for captcha image text (Default is 20,40,100)' =>
'Gibt die Schriftfarbe im Captcha-Bild an. Die Farbanteile Rot,Grün und Blau können die Werte 0-255 annehmen und sind jeweils mit einem Komma \',\' getrennt (Default: 20,40,100).',
'Captcha Noise Color' => 'Captcha Störmusterfarbe',
'Enter color composition (in Red, Green, Blue dimensions - 0 to 255) for captcha image noise (Default is 100,120,180)' =>
'Gibt die Farbe des Störmusters im Captcha-Bild an. Die Farbanteile Rot,Grün und Blau können die Werte 0-255 annehmen und sind jeweils mit einem Komma \',\' getrennt (Default: 100,120,180).',
'Captcha Placement Parameters' => 'Captcha Integration',
'Include Captcha in Registration Process' => 'bei der Registrierung anzeigen',
'Specify Yes to include Captcha image (and sound if specified) during registration or No not to (default: Yes).' =>
'"Ja" = im Registrierungsformular anzeigen. "Nein" = keine Anzeige.',
'Include Captcha in New Password Request Process' => 'bei Passwortanforderung anzeigen',
'Specify Yes to include Captcha image (and sound if specified) during password reset process or No not to (default: Yes).' =>
'"JA" = bei der Anforderung eines neuen Passwortes anzeigen. "Nein" = keine Anzeige.',
'Include Captcha in User Emailing Process' => 'beim Nachrichten versenden anzeigen',
'Specify Yes to include Captcha image (and sound if specified) during user emailing process or No not to (default: Yes).' =>
'"Ja" = im Nachrichtenformular anzeigen. "Nein" = keine Anzeige',
'Include Captcha in CB Contact component' => 'in der CB Contact Komponente anzeigen',
'Specify Yes to include Captcha image (and sound if specified) during website CB Contact component form process for everybody (Yes) or only for not logged in guests (Yes only for guests) or No not to (default: Yes).' =>
'"Ja" = Anzeige im CB Contact Formular für Alle. "nur für Gäste" = nur für (nicht Eigeloggte) Gäste anzeigen. "Nein" = keine Anzeige',
'Yes only for guests' => 'nur für Gäste',
'Include Captcha check in CB Login' => 'in der CB Login Komponente anzeigen',
'Specify Yes to include Captcha image (and sound if specified) during user login process or No not to (default: No). You must also enable CB Plugins integration in CB login module settings. Captcha on login function is not recommended, but in some cases needed.' =>
'"Ja" = Captcha im CB Login Modul anzeigen (hierzu muß die CB Plugin Integration in den Moduleinstellungen ebenfalls aktiviert werden). "Nein" = keine Anzeige. HINWEIS: Die Captcha-Abfrage im Login Modul wird nicht empfohlen; bei Bedarf kann sie eingeschaltet werden.',
'Include title for security input box on CB Login form' => 'CB Login Captcha-Eingabefeld benennen',
'Specify Yes to include title for security input box in CB Login form (default: Yes).' => '"Ja" = einen Titel vor dem Sicherheitseingabefeld ausgeben. "Nein" = kein Titel vergeben',
'Login Form Security Input Field Title' => 'Captcha-Eingabefeld Benennung',
'Should contain the field title that should be used for the security input field in the CB Login module (default: _UE_CAPTCHA_Enter_Label).' =>
'Hier kann eine Benennung für das Capzcha-Eingabefeld eingegeben werden (Default: _UE_CAPTCHA_Enter_Label).',
'Include Captcha in other uses' => 'Captcha anderweitig verwenden',
'Specify Yes to include Captcha image (and sound if specified) in other usages or No not to (default: Yes).' => '"Ja" = Captcha kann für andere Anwendungen verwendet werden. "Nein" = keine Verwendung.',
'Captcha images and sound mode' => 'Captcha Bild- und Klangausgabe Modi',
'Specify desired images and sound generation mode: joomla index.php file works fine as long as there is no other content/errors outputed, separate CB Captcha\'s captchaindex.php  (default) is fastest and works fine if joomla\'s configuration.php file is standard.' =>
'Spezifiziert den Generierungsmodus für die Bild- und Klangausgabe. "Joomla\'s index.php" sollte funktionieren wenn keine anderen Inhalte oder Fehler ausgegeben werden. "CB Captcha\'s captchaindex.php" ist die schnellste Methode, die bei Joomla\'s configuration.php in der Standardfassung fehlerfrei funktioniert',
'Joomla\'s index.php' => 'Joomla\'s index.php',
'CB Captcha\'s captchaindex.php' => 'CB Captcha\'s captchaindex.php'
));

// CB LastViews v1.2
CBTxt::addStrings( array(
'The number of last views displayed' => 'Anzahl der letzten Betrachtungen',
'How many views should be displayed?' => 'Wieviele der letzen Betrachtungen des Benutzerprofils sollen angezeigt werden?',
'You may enter a comma seperated list of user IDs that will be excluded from display.' => 'ausgenommene Benutzer ID\'s',
'Use this to hide admins, mods or certain individuals if you like.' => 'Hier können Administratoren, Moderatoren oder individuelle Benutzer von der Betrachtungsliste ausgenommen werden. Die einzelnen Benutzer ID\'s werden hierbei durch ein Komma \',\' getrennt.',
'Language' => 'Sprache',
'Language for -(admin)-' => 'Sprachdefinition für (Administrator).',
'Language for -The last-' => 'Sprachdefinition für \'Die Letzten\'.',
'Language for -views-' => 'Sprachdefinition für \'Betrachtungen\'.',
'Language for -avatar-' => 'Sprachdefinition für \'Avatar\'',
'Language for -name-' => 'Sprachdefinition für \'Namen\'',
'Language for -time-' => 'Sprachdefinition für \'Zeit\'',
'Language for -total-' => 'Sprachdefinition für \'Zeit\'',
'Guest have visited this profile.' => 'Gäste haben das Profil betrachtet',
'Language for -guests have visited this profile-"' => 'Sprachdefinition für \'Gäste haben das Profil betrachtet\'',
'Admin Group' => 'Administratoren-Gruppe',
'The admin or moderator group to whom the total visits count is shown. 18 for authors and up (same as special setting and default), 19 for editors and up, 20 for publishers and up, etc..' =>
'Definiert die Benutzergruppe, deren Mitgliedern die Gesamtanzahl der Betrachtungen gezeigt wird. Dies einzelnen ID\'s der Benutzergruppen können in Joomla\'s Administratormenü -> Benutzer -> Benutzergruppen eingesichtet werden.',
'Enable Total Visits Display To Specified Admin Group?' => 'Gesamtbertrachtungen für Admins',
'Enable showing total to the previously set usergroup and higher?' => '"Anzeigen" = zeigt den Mitgliedern der oben definierten Benutzergruppe die Gesamtanzahl der Betrachtungen. "Verbergen" = nicht anzeigen.',
'Enable Total Visits Display To Profile Owners?' => 'Gesamtbetrachtungen für Profileigentümer',
'Total can be shown to specified admin/moderator group, even when disabled for profile owners.' => '"Anzeigen" = zeigt den Profileigentümern die Gesamtanzahl der Profilberachtungen. "Verbergen" = nicht anzeigen',
'Also show totals to other logged in users?' => 'Gesamtbetrachtungen von Fremdprofilen für Benutzer',
'For this setting to work, the total display setting above has to be enabled.' => 'HINWEIS: Die Anzeige erfolgt nur mit der Einstellung "Anzeigen" bei \'Gesamtbetrachtungen für Profileigentümer\'!',
'Show Guestcount?' => 'Betrachtungen von Gästen',
'Show the number of guests that have visited this profile? (Hide when you don\\\'t allow guests to view profiles)' => '"Anzeigen" = zeigt einen Betrachtungszähler im Profil an. "Verbergen" = nicht anzeigen.',
'Do you want to display the username or the name of the user.' => 'Betrachter anzeigen als',
'Choose what to display. Username or Name.' => 'Wie sollen die Betrachter angezeigt werden?',
'Username' => 'Benutzername',
'Username (Name)' => 'Benutzername (RealName)',
'Name (Username)' => 'RealName (Benutzername)',
'How would you like the date displayed?' => 'angezeigtes Datumsformat',
'Choose in what order to display the date.' => 'Auswählen, wie die Datumsanzeige formatiert werden soll.',
'Did you pay me due karma for this karmaware plugin on www.joomlapolis.com ?' => 'Haben Sie mir für dieses Karmaware-Plugin einen Karmapunkt gespendet?'
));

// CB Ajax FileField v1.5
CBTxt::addStrings( array(
'Field' => 'Feld',
'This field type allows users to upload any file to your webserver which matches the criterias checked (file-extension, file-size) regardless of real file contents. This plugin can not check files for appropriate content, including any content inappropriate for your site audience or any damageable content for users (viruses and other dangerous content). It should be used only on closed users servers, or be very carefuly monitored by site moderators.' =>
'Dieser Feldtyp erlaubt es Benutzern jede Datei auf dem Webserver hochzuladen, die den ausgewählten Kriterien (Dateierweiterung, Dateigröße) entsprechen. Der tatsächliche Inhalt der Datei, der auch eventuell Schadsoftware (Viren, Trjaner) enthalten könnte, wird dabei nicht überprüft! Diese Option sollte nur für vertrauenswürdigen Benutzern erlaubt werden. Moderatoren sollten diese Dateien sehr genau auf ihren Inhalt überprüfen.',
'File Extension Icons' => 'Icons für Dateierweiterungen',
'Enable display of icons based on extension.' => 'Zeigt Datei-Icons, passend ihrer Dateierweiterung',
'Notify' => 'Benachrichtigen',
'Send notification e-mail for this field.' => 'Sendet eine E-Mail-Benachrichtigung für dieses Feld',
'Send File' => 'Datei anhängen',
'Send file as attachment with notification e-mail.' => 'Die Datei wird als Anhang mit der E-Mail-Benachrichtigung gesendet',
'Field entry validation' => 'Feldeingabe-Überprüfung',
'Allowed File Types' => 'Erlaubte Dateierweiterungen',
'File extensions allowed for upload. The following extensions are not allowed regardless of Allowed File Types for security reasons: php, php3, php4, php5, asp, exe, and py!' =>
'Gibt die erlaubten Dateierweiterungen für das Hochladen an. Die folgenden Dateiendungen sind generell (aus Sicherheitgründen) vom Hochladen ausgeschlossen: php, php3, php4, php5, asp, exe und py!',
'Maximum File Size' => 'max. Dateigröße (KB)',
'Maximum size of file in KBs permitted for upload.' => 'Die maximal erlaubte Dateigröße (in KB) zum Hochladen.',
'Minimum File Size' => 'min. Dateigröße (KB)',
'Minimum size of file in KBs permitted for upload.' => 'Die minimal erlaubte Dateigröße (in KB) zum Hochladen.',
'Enable or disable ajax for this field.' => 'Ajax für dieses Feld ein- oder ausschalten?',
'Placeholder Text' => 'Text bei leerem Feld',
'Text to display if field is empty.' => 'Dieser Text wird angezeigt wenn das Feld leer ist.',
'Tooltip text' => 'Text bei MouseOver',
'Text displayed upon mouseover.' => 'Text, der erscheint wenn man den Mousezeiger darüber platziert.',
'Submit text' => 'Text für Senden-Button',
'Submit button text. Leave blank to disable.' => 'Text, der in der Senden-Schaltfläche dargestellt wird. Freilassen, zeigt keinen Text.',
'Reset text' => 'Text für Rücksetz-Button',
'Reset button text. Leave blank to disable.' => 'Text, der in der Reset-Schaltfläche dargestellt wird. Freilassen, zeigt keinen Text.',
'Class' => 'CSS Class',
'CSS class to style the field.' => 'CSS-Class, für individuelles Styling des Feldes.',
'Notifcation E-mail' => 'E-Mail-Benachrichtigung',
'From Name' => 'Absender-Name',
'Name e-mail is being sent from. Leave blank to use system from name.' => 'Absendername, von der die E-Mail-Benachrichtigung gesendet wird. Freilassen, um den System-Namen zu verwenden.',
'From Address' => 'Absender-E-Mail',
'Address e-mail is being sent from. Leave blank to use system from address.' => 'E-Mail-Adresse, von der die E-Mail-Benachrichtigung gesendet wird. Freilassen, um die System-Adresse zu verwenden.',
'To' => 'Empfänger',
'Comma separated list of addresses (e.g. user@mysite.com,admin@mysite.com). Supports substitutions. Leave blank to send to moderators.' =>
'Empfängeradresse(n), an die eine Benachrichtigung gesendet wird (Mehrere Adressen werden mit einem Komma \',\' getrennt). Freilassen, um alle Moderatoren zu benachrichtigen.',
'Subject' => 'Betreff',
'Subject of e-mail. Supports substitutions.' => 'Betreff, der bei Benachrichtigungen verwendet wird (die Verwendung von System-Variablen ist möglich).',
'Body' => 'Nachrichtentext',
'Body of e-mail. Use [file] to send file name and [field] to send field name with body. Supports substitutions.' => 'Nachrichtentext, der bei der Benachrichtigung verwendet wird (die Verwendung von System-Variablen ist mäglich).',
'Has a file' => 'Hat eine Datei',
'Has no file' => 'Hat keine Datei',
'Please select a file before uploading' => 'Eine Datei zum Hochladen auswählen.',
'Please upload only %s' => 'Bitte nur %s hochladen',
'The file size exceeds the maximum of %s KB' => 'Die Dateigröße überschreitet das Maximum von %s KB',
'The file is too small, the minimum is %s KB' => 'Die Datei ist zu klein. Die Mindestgröße beträgt %s KB',
'No file' => 'keine Datei',
'No change of file' => 'keine Dateiänderung',
'Upload new file' => 'Neue Datei hochladen',
'Upload file' => 'Datei hochladen',
'Remove file' => 'Datei entfernen',
'Select file' => 'Datei auswählen',
'Terms and Conditions' => 'Allgemeine Geschäftsbedingungen',
'By uploading, you certify that you have the right to distribute this file and that it does not violate the [toc].' =>
'Bestätigung, daß beim Hochladen keine Urheberrechte oder AGB\'s verletzt werden',
'By uploading, you certify that you have the right to distribute this file.' =>
'Bestätigung, daß beim Hochladen keine Urheberrechte verletzt werden',
'Your file must be of [ext] type and should exceed [min] KB, but not [max] KB' =>
'Die Datei muß dem [ext] Typ entsprechen und sollte größer als [min] KB sein. Die Maximalgröße darf [max] KB  nicht überschreiten',
'File failed to download! Error: File not found' => 'Datei-herunterladen fehlgeschlagen! FEHLER: Datei nicht gefunden',
'File failed to download! Error: Unknown extension' => 'Datei-herunterladen fehlgeschlagen! FEHLER: Unbekannte Dateierweiterung',
'File failed to download! Error: File not found' => 'Datei-herunterladen fehlgeschlagen! FEHLER: Datei nicht gefunden',
'File failed to download! Error: Unknown MIME' => 'Datei-herunterladen fehlgeschlagen! FEHLER: Unbekannter MIME-Typ'
));

// CB ProfileBook v1.2
CBTxt::addStrings( array(
'Add Rating to Stats List' => 'Bewertung dem Profil hinzufügen',
'Adds the average user profile rating to the users stats section' => 'Fügt eine Bewertungsmöglichkeit dem Benutzerprofil hinzu',
'Status Field Rating Label' => 'Beschriftung vom Bewertungsfeld',
'Label to be used to show stats for rating' => 'Beschriftungstext, der vor dem Bewertungsfeld angezeigt wird.',
'Unistall Mode' => 'Deinstallationsart',
'Default option is to remove code and leave database and existing items (this is the case when preparing for upgrade) otherwise remove completely' =>
'Legt die Vorgehensweise bei der Deinstallation fest. "Datenbanktabelle und Einträge behalten" = es werden keine Änderungen der Datenbank vorgenommen (z.Bsp. bei Plugin-Aktualisierung). "Datenbanktabelle und Einträge entfernen" = Datenbank mit Einträgen restlos entfernen.',
'Leave database table and existing items' => 'Datenbanktabelle und Einträge behalten',
'Remove database table and existing items' => 'Datenbanktabelle und Einträge entfernen',
'Main settings' => 'Haupteinstellungen',
'Entries per Page' => 'Einträge pro Seite',
'Number of entries shown per page.' => 'Anzahl der Einträge, die auf einer Seite angezeigt werden sollen.',
'Sort Order' => 'Sortierung',
'Set the sort order of entries on a profile based on submission date/time.' => 'Legt die Sortierungsreihenfolge der Profileinträge (nach Erstellungszeit/Erstellungsdatum) fest.',
'Ascending' => 'Aufsteigend',
'Descending' => 'Absteigend',
'Enabled features' => 'Funktionen',
'Anonymous Entries' => 'anonyme Einträge',
'Allow unregistered users to write entries.' => '"Ja" = auch Gästen können Einträge schreiben. "Nein" = keine Freigabe für Gäste.',
'Enable Captcha integration' => 'CB Captcha verwenden',
'If CB captcha plugin is installed, allows to use it.' => 'Erlaubt es, bei installiertem CB Captcha Plugin, dieses zu verwenden.',
'Yes, only for not logged-in guests' => 'Ja, nur für Gäste',
'Yes, also for logged-in users' => 'Ja, auch für Benutzer',
'Enable User Rating' => 'Benutzerbewertung erlauben',
'Allow users to rate profile' => 'Erlaubt es, einen Benutzer in seinem Profil zu bewerten.',
'Yes, Optional' => 'Ja (Optional)',
'Yes, Optional but Remind' => 'Ja (Optional mit Erinnerungsmeldung)',
'Yes, Mandatory' => 'Ja (Erforderlich)',
'Content interpreters' => 'Inhaltsoptionen',
'Show title' => 'Titel zeigen',
'Show name of logged-in users' => 'Zeigt den Namen eingeloggter Benutzer an.',
'Allow Smilies' => 'Smilies erlauben',
'Allow users add smilies to their post' => 'Erlaubt es, Smilies in Beiträgen zu verwenden.',
'Allow BBCode' => 'BBCode erlauben',
'Allow users to add bbcode to their post' => 'Erlaubt es, BBCode in Beiträgen zu verwenden.',
'Special BB-codes' => 'spezielle BBCodes',
'Allow [img] BBCode' => '[img] BBCode erlauben',
'Allow users to add images urls with [img] bbcode to their post. WARNING: cross-linking images might bring copyright issues, and unsafe content to your site, if not moderated.' =>
'"Ja" =  Bilder´können in Beiträge mit dem BBCode \'[img]\' eingefügt werden. WARNUNG: cross-gepostete Bilder können evtl. Urheberrechte verletzen. Auf diese Weise eingebettete Bilder sollten von Moderatoren überprüft werden! "Nein" = kein Einfügen von Bildern gestattet.',
'Allow [video] BBCode' => '[video] BBCode erlauben',
'Allow users to add videos from youtube, googleVideo, vimeo and more with [video] bbcode to their post. WARNING: cross-linking videos might bring copyright issues, and unsafe content to your site, if not moderated.' =>
'"Ja" =  Videos´(Youtube, googleVideo, vimeo und mehr...) können in Beiträge mit dem BBCode \'[video]\' eingefügt werden. WARNUNG: cross-gepostete Videos können evtl. Urheberrechte verletzen. Auf diese Weise eingebettete Videos sollten von Moderatoren überprüft werden! "Nein" = kein Einfügen von Videos gestattet.',
'More features' => 'weitere Funktionen',
'Allow entries to automatically page when they exceed the number per page limit.' => '"JA" zeigt die Beiträge seitenweise an wenn die \'Anzahl der Einträge\' überschritten wurde. "Nein" = ledigliches Anzeigen der vordefinierten Anzahl (weiter oben).',
'Enable Gesture' => 'AntwortLink zeigen',
'When a user is viewing an entry from another registered user a link will appear that will allow them to return the gesture.' =>
'"Ja" = wenn ein Benutzer einen Beitrag schreibt wird ein AntwortLink in dessen Profil gezeigt. "Nein" = kein Profil-Link anzeigen.',
'Show editor by default' => 'Texteditor anzeigen',
'Allow posters to directly enter their text.' => '"Zeigen" = Benutzer können ihren Text selbst im Texteditor eingeben. "Versteckt" = kein Texteditor.',
'Extra fields' => 'zusätzliche Felder',
'Show name' => 'Namen anzeigen',
'Show name of logged-in users' => '"Ja" = Namen des eingeloggten Benutzers anzeigen. "Nein" = keine Namensanzeige',
'Show email' => 'E-Mail anzeigen',
'Show email of logged-in users' => '"Ja" = E-Mail-Adresse des eingeloggten Benutzers anzeigen. "Nein" = keine E-Mail-Anzeige',
'Use Location Field' => 'Standortfeld verwenden',
'Allow posters to enter a location as part of their entry' => '"Ja" = einen Standort im Beitrag mit veröffentlichen',
'Location Field' => 'Standortfeld',
'Select the name of the field which contains the equivalent field in the Community Build Field manager.  If blank, registered users will be asked for a location.' =>
'Den Names des Feldes (Community Builder -> Felder Manager) angeben, das für die Standortangabe verwendet werden soll. Freigelassen; der Benutzer wird nach dem Standort gefragt...',
'Use Web Address Field' => 'Web-Adressenfeld verwenden',
'Allow posters to enter a web address as part of their entry' => '"Ja" = Feld zur Eingabe der Web-Adresse wird gezeigt. "Nein" = keine Web-Adresse anzeigen.',
'Web Address Field' => 'Web-Adressenfeld',
'Select the name of the field which contains the equivalent field in the Community Build Field manager.  If blank, registered users will be asked for a web address.' =>
'Den Names des Feldes (Community Builder -> Felder Manager) angeben, das für die Web-Adressenangabe verwendet werden soll. Freigelassen; der Benutzer wird nach der Web-Adresse gefragt...',
'Enable Profile Entries' => 'Profil-Beiträge verfassen',
'Enable visitors to your profile to make comments about you and your profile.' => '"Ja" = erlaubt es Besuchern, Beiträge in das Benutzerprofil zu schreiben. "Nein" = keine Beiträge möglich.',
'Auto Publish' => 'automatsch Publizieren',
'Enable Auto Publish if you want entries submitted to be automatically approved and displayed on your profile.' =>
'"Ja" = verfasste Beiträge werden automatisch freigegeben- und publiziert',
'Notify Me' => 'Mich benachrichtigen',
'Enable Notify Me if you\'d like to receive an email notification each time someone submits an entry.  This is recommended if you are not using the Auto Publish feature.' =>
'"Ja" = Benachrichtigung senden wenn ein Beitrag in das Benutzerprofil geschrieben wird (empfohlen beim automatischen Publizieren). "Nein" = keine Benachrichtigung.',
// ProfileBlog
'Enable Profile Blog' => 'Profil-Blog anzeigen',
'Enable your blog on your profile.' => '"Ja" = Den Profil-Blog aktivieren. "Nein" = keinen Profil-Blog verwenden.',
// ProfileWall
'Enable Profile Wall' => 'Profil-Pinnwand',
'Enable the wall on your profile so yourself and visitors can write on it.' => '"Ja" = Die Profil-Pinnwand aktivieren. "Nein" = keine Profil-Pinnwand verwenden.'
));

// CB Ajax TextField v1.7
CBTxt::addStrings( array(
'Display Mode' => 'Anzeigetyp',
'How the ajax text field is displayed on profiles.' => 'Legt die Anzeigeart von Ajax TextField im Benutzerprofil fest.',
'Discrete' => 'Diskret',
'Edit icon on hover' => 'Bearbeiten-Icon beim Überfahren',
'Highlight' => 'Hervorheben',
'Thick' => 'Dick',
'Minimum length of content (0 = no minimum).' => 'Mindestlänge des Inhaltes (0 = keine).',
'Maximum length' => 'Maximallänge',
'Maximum length of content (0 = no maximum).' => 'Maximallänge des Inhaltes (0 = keine).',
'Show or hide display of bubble around field on profiles.' => '"Anzeigen" = zeigt eine Anzeigeblase um das Profilfeld. "Verstecken" = keine Anzeigelase zeigen.',
'Bubble' => 'Anzeigeblase',
'Define what color is used for the bubble.' => 'Legt die Farbe der Anzeigeblase fest.',
'Black' => 'Schwarz',
'Dark Green' => 'Dunkelgrün',
'Teal' => 'Blaugrün',
'Cyan' => 'Türkis',
'Gray' => 'Grau',
'Tail' => 'Anhang',
'Define what is display after the tail of the bubble or display no tail.' => 'Wählt einen Anhang für die Anzeigeblase aus.',
'Avatar Thumbnail' => 'Avatar Miniaturbild',
'Nothing below tail' => 'Nichts unter dem Anhang',
'No Tail' => 'Kein Anhang',
'Tail Text' => 'Anhangtext',
'Text displayed after the tail of the bubble.' => 'Text, der im Anhang der Anzeigeblase gezeigt werden soll.',
'Any string ( /.*/ ) ' => 'jegliche Texteingabe ( /.*/ )',
'Submit button text. Put 0 to disable.' => 'Legt den Text für den Sende-Button fest (0 = kein Text).',
'Reset button text. Put 0 to disable.' => 'Legt den Text für den Rücksetz-Button fest (0 = kein Text).'
));


// IMPORTANT WARNING: The closing tag, "?" and ">" has been intentionally omitted - CB works fine without it.
// This was done to avoid errors caused by custom strings being added after the closing tag. ]
// With such tags, always watchout to NOT add any line or space or anything after the "?" and the ">".
