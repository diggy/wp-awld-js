<?php

/**
 * Examples Page
 *
 * @updated: 31 may 2012
 */
if ( ! function_exists( 'wp_awld_js_settings_examples_page' ) )
{
function wp_awld_js_settings_examples_page()
{
	global $wp_awld_js;
	$wp_awld_js->enqueue();
	?>
<br />
<style>.post-title p.description{color:#666;}.post-title p.awld-link a{font-weight:bold;}</style>
<table class="wp-list-table widefat fixed awld-scope" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' id='feat' class='manage-column column-title'  style="max-width:150px;">
			<span>Feature</span><span class=""></span>
		</th>
		<th scope='col' id='sample' class='manage-column column-title'  style="">
			<span>Example</span><span class=""></span>
		</th>
		<th scope='col' id='code' class='manage-column column-title'  style="">
			<span>Code</span><span class=""></span>
		</th>
		<th scope='col' id='notes' class='manage-column column-title'  style="">
			<span>Notes</span><span class=""></span>
		</th>
	</tr>
	</thead>
	<tbody id="wp-awld-js-list">
		<tr valign="top">
			<td class="post-title">
				<p><strong>Widget</strong></p>
			</td>
			<td class="post-title" style="overflow:visible;">
				<div class="awld-index"></div>
			</td>
			<td class="post-title">
				<p><code>[awld_index]</code></p>
			</td>
			<td class="post-title">
				<p class="description">Auto-generated index of awld.js links found on the page.</p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://en.wikipedia.org/" target="_blank">Wikipedia</a></p>
				<p class="description">en.wikipedia.org</p>
			</td>
			<td class="post-title">
				<p id="wikipedia"><a class="awld-type-person" href="http://en.wikipedia.org/wiki/Achilles">Achilles</a> is a major character in Homer's Iliad.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld type="person" href="http://en.wikipedia.org/wiki/Achilles"]Achilles[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Note: the links in the snippets that appear for Wikipedia references aren't working yet because they're relative web addresses. Will be fixed in the future.</p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://pleiades.stoa.org/" target="_blank">Pleiades</a></p>
				<p class="description">pleiades.stoa.org</p>
			</td>
			<td class="post-title">
				<p id="pleiades"><a href="http://pleiades.stoa.org/places/550595">Troy</a> is the setting of Homer's Iliad, a story that may well reflect "geopolitical" circumstances in the Late Bronze Age.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://pleiades.stoa.org/places/550595"]Troy[/awld]' />
			</td>
			<td class="post-title">
				<p class="description"></p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://data.perseus.org/" target="_blank">Perseus</a></p>
				<p class="description">data.perseus.org</p>
			</td>
			<td class="post-title">
				<p id="homer">First, the <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-eng1">beginning</a> of the Iliad in English. Now in <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-grc1">Greek</a> (but it needs line breaks). Here's the Odyssey in <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg002.perseus-eng1">English</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-eng1"]beginning[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Load data from perseus.org.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://pelagios-project.blogspot.com" target="_blank">Pelagios</a></p>
				<p class="description">pelagios-project.blogspot.com</p>
			</td>
			<td class="post-title">
				<p id="pelagios"><a href="http://pleiades.stoa.org/places/433032">Pompeii</a> is a partially buried Roman town-city near modern Naples, Italy.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://pleiades.stoa.org/places/433032"]Pompeii[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Format links to the <a href="http://pelagios-project.blogspot.com">Pelagios project</a>.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://finds.org.uk/" target="_blank">UK Portable Antiquities Scheme</a></p>
				<p class="description">finds.org.uk</p>
			</td>
			<td class="post-title">
				<p id="ukpas">The UK's Portable Antiquities Scheme has registered many thousands of objects, many of them coins: some high-value (<a href="http://finds.org.uk/database/artefacts/record/id/495315">Aureus</a>), some less so (<a href="http://finds.org.uk/database/artefacts/record/id/412455">Radiate</a>).</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://finds.org.uk/database/artefacts/record/id/495315"]Aureus[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Loads data from finds.org.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://lccn.loc.gov/" target="_blank">Library of Congress</a></p>
				<p class="description">lccn.loc.gov</p>
			</td>
			<td class="post-title">
				<p id="loc">Classical historiography is a well-established discipline.<sup><a href="http://lccn.loc.gov/a55003923">loc link</a></sup></p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='<sup>[awld href="http://lccn.loc.gov/a55003923"]loc link[/awld]</sup>' />
			</td>
			<td class="post-title">
				<p class="description">The Library of Congress works well with awld.js. The title displayed in the widget is pulled from the LOC website.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://www.worldcat.org/" target="_blank">Worldcat</a></p>
				<p class="description">worldcat.org</p>
			</td>
			<td class="post-title">
				<p id="worldcat">Petra excavation report citation.<sup><a title="M. Sharp Joukowsky, Petra Great Temple (1998)" href="http://www.worldcat.org/oclc/84948065">worldcat link</a></sup></p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='<sup>[awld href="http://www.worldcat.org/oclc/84948065"]worldcat link[/awld]</sup>' />
			</td>
			<td class="post-title page-title column-title">
				<p class="description">Worldcat goes to great lengths to block mashups so awld.js uses the contents of the html title attribute for display in the widget.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://nomisma.org/" target="_blank">Nomisma</a></p>
				<p class="description">nomisma.org</p>
			</td>
			<td class="post-title">
				<p id="nomisma">The mint at <a href="http://nomisma.org/id/athens">Athens</a> was a prolific producer of silver coins that appear in many Archaic through Hellenistic hoards. Nomisma also hosts a representation of Crawford's typology of Roman Republican coins: e.g. <a href="http://nomisma.org/id/rrc-525.4a">RRC 525/4a</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://nomisma.org/id/athens"]Athens[/awld]' />
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://nomisma.org/id/rrc-525.4a"]RRC 525/4a[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Click through to the Nomisma page to see a map of hoards with coins of Athens in them.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://opencontext.org/" target="_blank">Open Context</a></p>
				<p class="description">opencontext.org</p>
			</td>
			<td class="post-title">
				<p id="roman_pottery"><a class="awld-type-object" href="http://opencontext.org/subjects/73221A18-7A7C-44C4-36CD-0CECF8F7A725">This sherd published by OpenContext.org</a> shows that ARS was carried to Petra in Jordan.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld type="object" href="http://opencontext.org/subjects/73221A18-7A7C-44C4-36CD-0CECF8F7A725"]This sherd published by OpenContext.org[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Loads data from opencontext.org.</p>
			</td>
		</tr>		
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://arachne.uni-koeln.de/" target="_blank">Arachne</a></p>
				<p class="description">arachne.uni-koeln.de</p>
			</td>
			<td class="post-title">
				<p id="transport">In the high imperial period <a href="http://arachne.uni-koeln.de/item/objekt/1460">small ships</a> carried goods along navigable rivers.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://arachne.uni-koeln.de/item/objekt/1460"]small ships[/awld]' />
			</td>
			<td class="post-title">
				<p class="description"></p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://www.trismegistos.org/" target="_blank">Trismegistos</a></p>
				<p class="description">trismegistos.org</p>
			</td>
			<td class="post-title">
				<p id="trismegistos">A <a href="http://www.trismegistos.org/text/13">text</a> in Trismegistos.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://www.trismegistos.org/text/13"]text[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Displays more information about the cited text.</p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://www.papyri.info/" target="_blank">Papyri</a></p>
				<p class="description">papyri.info</p>
			</td>
			<td class="post-title">
				<p id="trismegistos">A text from <a href="http://www.papyri.info/hgv/1357">Papyri.info</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://www.papyri.info/hgv/1357"]Papyri.info[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">Displays more information about the cited text.</p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://eol.org/" target="_blank">EOL</a></p>
				<p class="description">eol.org</p>
			</td>
			<td class="post-title">
				<p>EOL: <a href="http://eol.org/pages/328699">Cow</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://eol.org/pages/328699"]Cow[/awld]' />
			</td>
			<td class="post-title">
				<p class="description"></p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://ecatalogue.art.yale.edu/" target="_blank">Yale Art Gallery</a></p>
				<p class="description">ecatalogue.art.yale.edu</p>
			</td>
			<td class="post-title">
				<p>Yale Art Gallery: <a href="http://ecatalogue.art.yale.edu/detail.htm?objectId=139601">Posthumous Alexander</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld href="http://ecatalogue.art.yale.edu/detail.htm?objectId=139601"]Posthumous Alexander[/awld]' />
			</td>
			<td class="post-title">
				<p class="description"></p>
			</td>
		</tr>
		<tr valign="top">
			<td class="post-title">
				<p class="awld-link"><a href="http://fr.wikipedia.org/" target="_blank">Wikipedia FR</a></p>
				<p class="description">fr.wikipedia.org</p>
			</td>
			<td class="post-title">
				<p>French language wikipedia link: <a class="awld-type-person noise" href="http://fr.wikipedia.org/wiki/Alexandre_le_Grand">Alexander the Great</a>.</p>
			</td>
			<td class="post-title">
				<input type="text" onclick="jQuery(this).select();" value='[awld class="noise" type="person" href="http://fr.wikipedia.org/wiki/Alexandre_le_Grand"]Alexander the Great[/awld]' />
			</td>
			<td class="post-title">
				<p class="description">This is a fun foible as the popover shows the blurb for the French romance!</p>
			</td>
		</tr>
	</tbody>
</table>
<p style="text-align:right;color:#666;">Last updated: 01 Jun 2012</p>
<?php
}
}