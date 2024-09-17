<?
$ingame = "*";
require "includes/header.php";
/*        ORIGINAL NEWS LAYOUT
	<span id="section"><a href="index.html">News Title</a></span><br />
					<span id="date">Nov 12th, 2003 12:00 pm</span><br />
					When one door closes another door opens; but we so often look 
					so long and so regretfully upon the closed door, that we do 
					not see the ones which open for us.<br />
					<div class="comments">
						<a href="index.html">(10) Comments</a></div>
					<br />
				<img alt="newsicon" src="images/news_icon3.gif" align="right" />
*/

?>

<b><tl><img alt="" src="images/sticky.png" /> Latest News</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />

					
					<?
					
$newlim = $SETTINGS['Number_of_News_Items'];
$newsformat = html_entity_decode( $SETTINGS['News_Template'] );
$result = $db->query( "SELECT * FROM news ORDER BY nID DESC LIMIT $newlim" );

while ( $news = $db->fetch( $result ) ) {
    $newdisplay = str_replace( "[ndate]", $news['nDate'], $newsformat );
    $newdisplay = str_replace( "[ntitle]", $news['nTitle'], $newdisplay );
    $newdisplay = str_replace( "[nbody]", html_entity_decode( $news['nBody'] ), $newdisplay );
    echo $newdisplay;
} 

?>
					</td>
					<td class="recent">
									<b><tl>Poll</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
						<?php
$result = $db->fetch( $db->query( "SELECT * FROM polls ORDER BY pID DESC LIMIT 1" ) );
if ( $result ) {

    ?>
			<?php
    require 'includes/poll.php';

    ?>
		<?php
} 

require 'includes/footer.php';
?>