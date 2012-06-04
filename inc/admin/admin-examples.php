<?php
/**
 * Examples Page
 *
 * @updated: 03 jun 2012
 */
if ( ! function_exists( 'wp_awld_js_settings_examples_page' ) )
{
function wp_awld_js_settings_examples_page()
{
	global $wp_awld_js;
	
	// enqueue awld.js
	$wp_awld_js->enqueue();

	// examples array	
	$examples = array(
		array(
			'id' => 'arachne',
			'title' => array( 'Arachne', 'arachne.uni-koeln.de', 'http://arachne.uni-koeln.de/' ),
			'example' => 'In the high imperial period <a href="http://arachne.uni-koeln.de/item/objekt/1460">small ships</a> carried goods along navigable rivers.',
			'code' => array( '[awld href=&#34;http://arachne.uni-koeln.de/item/objekt/1460&#34;]small ships[/awld]' ),
			'notes' => 'Arachne is the central Object database of the German Archaeological Institute (DAI) and the Archaeological Institute of the University of Cologne.',
		),
		array(
			'id' => 'eol',
			'title' => array( 'EOL', 'eol.org', 'http://eol.org/' ),
			'example' => 'EOL: <a href="http://eol.org/pages/328699">Cow</a>.',
			'code' => array( '[awld href=&#34;http://eol.org/pages/328699&#34;]Cow[/awld]' ),
			'notes' => 'Encyclopedia of Life. Global access to knowledge about life on Earth.',
		),
		array(
			'id' => 'loc',
			'title' => array( 'Library of Congress', 'lccn.loc.gov', 'http://lccn.loc.gov/' ),
			'example' => 'Classical historiography is a well-established discipline.<sup><a href="http://lccn.loc.gov/a55003923">loc link</a></sup>',
			'code' => array( '&lt;sup&gt;[awld href=&#34;http://lccn.loc.gov/a55003923&#34;]loc link[/awld]&lt;/sup&gt;' ),
			'notes' => 'The Library of Congress works well with awld.js. The title displayed in the widget is pulled from the LOC website.',
		),
		array(
			'id' => 'ikmk',
			'title' => array( 'Münzkabinett Berlin', 'smb.museum', 'http://www.smb.museum/ikmk/' ),
			'example' => '<a class="awld-type-object" href="http://www.smb.museum/ikmk/object.php?id=18200915">Incertum</a> ca. 650-600 v. Chr.',
			'code' => array( '[awld type=&#34;object&#34; href=&#34;http://www.smb.museum/ikmk/object.php?id=18200915&#34;]Incertum[/awld]' ),
			'notes' => 'The Münzkabinett of the Staatliche Museen zu Berlin is one of the largest Numismatic Collections in the world.',
		),
		array(
			'id' => 'nomisma',
			'title' => array( 'Nomisma', 'nomisma.org', 'http://nomisma.org/' ),
			'example' => 'The mint at <a href="http://nomisma.org/id/athens">Athens</a> was a prolific producer of silver coins that appear in many Archaic through Hellenistic hoards. Nomisma also hosts a representation of Crawford\'s typology of Roman Republican coins: e.g. <a href="http://nomisma.org/id/rrc-525.4a">RRC 525/4a</a>.',
			'code' => array( 
				'[awld href=&#34;http://nomisma.org/id/athens&#34;]Athens[/awld]',
				'[awld href=&#34;http://nomisma.org/id/rrc-525.4a&#34;]RRC 525/4a[/awld]'
			),
			'notes' => 'Click through to the Nomisma page to see a map of hoards with coins of Athens in them.',
		),
		array(
			'id' => 'opencontext',
			'title' => array( 'Open Context', 'opencontext.org', 'http://opencontext.org/' ),
			'example' => '<a class="awld-type-object" href="http://opencontext.org/subjects/73221A18-7A7C-44C4-36CD-0CECF8F7A725">This sherd published by OpenContext.org</a> shows that ARS was carried to Petra in Jordan.',
			'code' => array( '[awld type=&#34;object&#34; href=&#34;http://opencontext.org/subjects/73221A18-7A7C-44C4-36CD-0CECF8F7A725&#34;]This sherd published by OpenContext.org[/awld]' ),
			'notes' => 'Loads data from opencontext.org.',
		),
		array(
			'id' => 'papyri',
			'title' => array( 'Papyri', 'papyri.info', 'http://www.papyri.info/' ),
			'example' => 'A text from <a href="http://www.papyri.info/hgv/1357">Papyri.info</a>.',
			'code' => array( '[awld href=&#34;http://www.papyri.info/hgv/1357&#34;]Papyri.info[/awld]' ),
			'notes' => 'Displays more information about the cited text.',
		),
		array(
			'id' => 'pelagios',
			'title' => array( 'Pelagios', 'pelagios-project.blogspot.com', 'http://pelagios-project.blogspot.com' ),
			'example' => '<a href="http://pleiades.stoa.org/places/433032">Pompeii</a> is a partially buried Roman town-city near modern Naples, Italy.',
			'code' => array( '[awld href=&#34;http://pleiades.stoa.org/places/433032&#34;]Pompeii[/awld]' ),
			'notes' => 'Format links to the Pelagios project',
		),
		array(
			'id' => 'perseus',
			'title' => array( 'Perseus', 'data.perseus.org', 'http://data.perseus.org/' ),
			'example' => 'First, the <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-eng1">beginning</a> of the Iliad in English. Now in <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-grc1">Greek</a> (but it needs line breaks). Here\'s the Odyssey in <a href="http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg002.perseus-eng1">English</a>.',
			'code' => array( '[awld href=&#34;http://data.perseus.org/citations/urn:cts:greekLang:tlg0012.tlg001.perseus-eng1&#34;]beginning[/awld]' ),
			'notes' => 'Load data from perseus.org.',
		),
		array(
			'id' => 'pleiades',
			'title' => array( 'Pleiades', 'pleiades.stoa.org', 'http://pleiades.stoa.org/' ),
			'example' => '<a href="http://pleiades.stoa.org/places/550595">Troy</a> is the setting of Homer\'s Iliad, a story that may well reflect "geopolitical" circumstances in the Late Bronze Age.',
			'code' => array( '[awld href=&#34;http://pleiades.stoa.org/places/550595&#34;]Troy[/awld]' ),
			'notes' => 'Pleiades is a community-built gazetteer and graph of ancient places.',		
		),
		array(
			'id' => 'ukpas',
			'title' => array( 'Portable Antiquities Scheme', 'finds.org.uk', 'http://finds.org.uk/' ),
			'example' => 'The UK\'s Portable Antiquities Scheme has registered many thousands of objects, many of them coins: some high-value (<a href="http://finds.org.uk/database/artefacts/record/id/495315">Aureus</a>), some less so (<a href="http://finds.org.uk/database/artefacts/record/id/412455">Radiate</a>).',
			'code' => array( '[awld href=&#34;http://finds.org.uk/database/artefacts/record/id/495315&#34;]Aureus[/awld]' ),
			'notes' => 'Loads data from finds.org.',
		),
		array(
			'id' => 'sudoc',
			'title' => array( 'Sudoc', 'sudoc.abes.fr', 'http://www.sudoc.abes.fr/' ),
			'example' => '<a class="awld-type-citation" href="http://www.sudoc.fr/058578307">Death on the Nile</a> by <strike>Agatha Christie</strike> Walter Scheidel',
			'code' => array( '[awld type=&#34;citation&#34; href=&#34;http://www.sudoc.fr/058578307&#34;]Death on the Nile[/awld]' ),
			'notes' => 'The <em>Système Universitaire de Documentation</em> (Sudoc) catalogue is a French collective catalogue created by Higher Educational and Research libraries and resource centres.',
		),
		array(
			'id' => 'trismegistos',
			'title' => array( 'Trismegistos', 'trismegistos.org', 'http://www.trismegistos.org/' ),
			'example' => 'A <a href="http://www.trismegistos.org/text/13">text</a> in Trismegistos.',
			'code' => array( '[awld href=&#34;http://www.trismegistos.org/text/13&#34;]text[/awld]' ),
			'notes' => 'Displays more information about the cited text.',
		),
		array(
			'id' => 'wikipedia',
			'title' => array( 'Wikipedia', 'en.wikipedia.org', 'http://en.wikipedia.org/' ),
			'example' => '<a class="awld-type-person" href="http://en.wikipedia.org/wiki/Achilles">Achilles</a> is a major character in Homer\'s Iliad.',
			'code' => array( '[awld type=&#34;person&#34; href=&#34;http://en.wikipedia.org/wiki/Achilles&#34;]Achilles[/awld]' ),
			'notes' => 'Note: the links in the snippets that appear for Wikipedia references aren\'t working yet because they\'re relative web addresses. Will be fixed in the future.',
		),
		array(
			'id' => 'wikipedia-fr',
			'title' => array( 'Wikipedia FR', 'fr.wikipedia.org', 'http://fr.wikipedia.org/' ),
			'example' => 'French language wikipedia link: <a class="awld-type-person noise" href="http://fr.wikipedia.org/wiki/Alexandre_le_Grand">Alexander the Great</a>.',
			'code' => array( '[awld class=&#34;noise&#34; type=&#34;person&#34; href=&#34;http://fr.wikipedia.org/wiki/Alexandre_le_Grand&#34;]Alexander the Great[/awld]' ),
			'notes' => 'This is a fun foible as the popover shows the blurb for the French romance!',
		),
		array(
			'id' => 'worldcat',
			'title' => array( 'Worldcat', 'worldcat.org', 'http://www.worldcat.org/' ),
			'example' => 'Petra excavation report citation.<sup><a title="M. Sharp Joukowsky, Petra Great Temple (1998)" href="http://www.worldcat.org/oclc/84948065">worldcat link</a></sup>',
			'code' => array( '&lt;sup&gt;[awld href=&#34;http://www.worldcat.org/oclc/84948065&#34;]worldcat link[/awld]&lt;/sup&gt;' ),
			'notes' => 'Worldcat goes to great lengths to block mashups so awld.js uses the contents of the html title attribute for display in the widget.',
		),
		array(
			'id' => 'yale',
			'title' => array( 'Yale Art Gallery', 'ecatalogue.art.yale.edu', 'http://ecatalogue.art.yale.edu/' ),
			'example' => 'Yale Art Gallery: <a href="http://ecatalogue.art.yale.edu/detail.htm?objectId=139601">Posthumous Alexander</a>.',
			'code' => array( '[awld href=&#34;http://ecatalogue.art.yale.edu/detail.htm?objectId=139601&#34;]Posthumous Alexander[/awld]' ),
			'notes' => 'Loads data from the Yale University Art Gallery.',
		),
		/*array(
			'id' => '',
			'title' => array( '', '', '' ),
			'example' => '',
			'code' => array( '' ),
			'notes' => '',
		),*/
	); // end examples array
	?><br />
<style>p.description{color:#666;}p.awld-link a{font-weight:bold;}</style>
<table class="wp-list-table widefat fixed awld-scope" cellspacing="0">
	<thead>
		<tr>
			<th scope="col" id="feat" class="manage-column column-title" style="max-width:150px;"><span><?php _e( 'Feature', 'wp_awld_js' ); ?></span><span class=""></span></th>
			<th scope="col" id="sample" class="manage-column column-title"><span><?php _e( 'Example', 'wp_awld_js' ); ?></span><span class=""></span></th>
			<th scope="col" id="code" class="manage-column column-title"><span><?php _e( 'Code', 'wp_awld_js' ); ?></span><span class=""></span></th>
			<th scope="col" id="notes" class="manage-column column-title"><span><?php _e( 'Notes', 'wp_awld_js' ); ?></span><span class=""></span></th>
		</tr>
	</thead>
	<tbody id="wp-awld-js-list">
		<tr valign="top">
			<td><p><strong><?php _e( 'Widget', 'wp_awld_js' ); ?></strong></p></td>
			<td style="overflow:visible;"><div class="awld-index"></div></td>
			<td><p><code>[awld_index]</code></p></td>
			<td><p class="description"><?php _e( 'Auto-generated index of awld.js enhanced links found on the page.', 'wp_awld_js' ); ?></p></td>
		</tr>
		<?php
			foreach( $examples as $example ) : 
				$return = '<tr id="' . $example['id'] . '" valign="top">
					<td><p class="awld-link"><a href="' . $example['title'][2] . '" target="_blank">' . $example['title'][0] . '</a></p><p class="description">' . $example['title'][1] . '</p></td>
					<td><p id="' . $example['id'] . '">' . $example['example'] . '</p></td>
					<td>';
				$fields = $example['code'];
				foreach( $fields as $field ) : 
					$return .= '<input type="text" onclick="jQuery(this).select();" value="' . $field . '" />';
				endforeach;
				$return .= '</td>
					<td><p class="description">' . $example['notes'] . '</p></td>
				</tr>';
				echo $return;
			endforeach;
		?>
	</tbody>
</table>
<p class="description" style="text-align:right;"><?php _e( 'Last updated:', 'wp_awld_js' ); ?> 03 Jun 2012</p>
<?php
}
}