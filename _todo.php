<?php //aboutus.php
/**
 * todo.php - generic static page to track my work load
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see config_inc.php
 * @todo none
 */

require './_inc/config_inc.php'; #provides configuration, pathing, error handling, db credentials
$config->titleTag = "This is the about Us page, silly!"; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php

#credentials
$config->titleTag = "Max's TO DO List"; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->banner = "Max's To Dos"; #goes inside header



# END CONFIG AREA ----------------------------------------------------------

//get_header('SmallPark_AboutUs_header_inc.php'); #defaults to theme header or header_inc.php
get_header(); #defaults to theme header or header_inc.php

echo '<h3 align="center">' . smartTitle() . '</h3>
	<ol style="margin-bottom: 15px;">
		<li><h4>CHARACTER (h)</h4></li>
			<ul>
				<li style="margin-bottom: 10px; text-decoration: line-through;  color: #bbb;">
					<b>Broken / default images</b>
					<br />
					<i>TIME ESTIMATE: 1 day</i>
					<i>TIME ACTUAL: 1 hr</i>
				</li>

				<li style="margin-bottom: 10px; text-decoration: line-through;  color: #bbb;">
					<b>Fix radio stat selects</b> - <a href="./_themes/Bootswatch/index.htm" target="_blank">see example here for radio check boxes</a>
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>ShowMembers</b>
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 5px; text-decoration: line-through;  color: #bbb;">
					<b>Cleaner SQL Call</b> - handle more of the sorting in the sql for each of the base search states instead of parsing after the fact<br />
					<i>example sql</i>
						<code>
								 <br />
							SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID <br />
							FROM ma_Characters <br />
							WHERE StatusID IS >=0 AND <=3 <br />
							ORDER BY CodeName ASC; <br />
								<br />
						</code>
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Tighten up Edit page</b> - all values pass
					<br />
					<i>TIME ESTIMATE: 3 day</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Delete Character Page</b> - all values pass
					<br />
					<i>TIME ESTIMATE: 3 day</i>
				</li>

				<li style="margin-bottom: 15px; text-decoration: line-through; color: #bbb;">
					<b><strike>Create New Character Page</strike></b>
					<br />
					<i>TIME ESTIMATE: 3 day</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Request Character Page</b>
					<br>
					<ul>
						<li>Account for posting record</li>
						<li>Account for character total (OCs and FCs)</li>
					</ul>
					<br />
					<i>TIME ESTIMATE: 3 day</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>convert to classes</b>
					<br />
					<i>TIME ESTIMATE: 2 week</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Character Image Upload</b>
					<br />
					<i>TIME ESTIMATE: 1 week</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Power Personalizer</b>
					<br />
					<i>TIME ESTIMATE: 1 week for testing and play</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>Playby Recommender</b>
					<br />
					<i>TIME ESTIMATE: 1 week for testing and play</i>
				</li>

				<li style="margin-bottom: 15px;">
					<b>test system</b> - then make posting forum
					<br />
					<i>TIME ESTIMATE: 1 week for testing and play</i>
				</li>

			</ul>


		<li ><h4 style="padding-top: 15px;"><b>MENU (w)</b><h4></li>
			<ul>
				<li style="margin-bottom: 5px;">
					<b>function maxLinks()</b> - new improved menubar with dropdowns incorporated
					<br />
					NOTES - already begun, see common-inc.php, see <a href="./_themes/Bootswatch/index.htm" target="_blank">demo style here</a>.
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 5px;">
					<b>Members Page</b> - so folks can see each others deets if logged in.
					<br />
					NOTES - already begun, see profile.php, which has show member option <a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowMembers" target="_blank">demo style here</a>.
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

			</ul>


		<li ><h4 style="padding-top: 15px;"><b>User Area (w)</b><h4></li>
			<ul>
				<li style="margin-bottom: 5px;">
					<b>showMyCharacters()</b> - display any characters assigned to my profile on my dashboard
					<br />
					NOTES - neccessary SQL ought to be/exist in profileNew.php</a>.
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 5px;">
					<b>Activity Check</b>.
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

				<li style="margin-bottom: 5px;">
					<b>Contact Modal - </b> It pops up so we don\'t have to load a contact page :D. Use/adapt existing contact page.<br /<br />
					Update Contact Modal with \'Are you human?\' google thingie.
					<br />
					<i>TIME ESTIMATE: 1 day</i>
				</li>

			</ul>


		<li ><h4 style="padding-top: 15px;"><b>Polls + Surveys (w)</b><h4></li>
			<ul>
				<li style="margin-bottom: 5px;">
					<b>Survey/Poll Section</b> - take from dashboard, display on homepage
					<br />
					NOTES - neccessary SQL ought to be/exist in profileNew.php.
					<br />
					<i>TIME ESTIMATE: 3 weeks</i>
				</li>
			</ul>


		<li ><h4 style="padding-top: 15px;"><b>Polls + Surveys (w)</b><h4></li>
			<ul>
				<li style="margin-bottom: 5px;">
					<b>Posts</b> - PostEmojies
					<br />
					Concept - Just as you could select any character to post as, now you will be able to select any avatar of the character so if you are in civieis it’s more obvious. Likewise if you are set to ‘incognito’ mode, the site would use your ‘incognito’ avatar as your standard thumbnail. Otherwise it would use your hero thumbnail. Character galleries are now unlimited in size so you can have lots.
					<br /><br />
					- public (based on status ID - Tony Stark, Captain Ameria, FF)<br />
					- private (X-Men, Young Avengers is private) <br />
					- heroic (X-Men/FF - costumed modes)<br />
					<br />
					<i>TIME ESTIMATE: 2 months</i>
				</li>

				<li style="margin-bottom: 5px;">
					<b>ShowEntireThread</b>
					<br />
					Concept - Shows the whole damn thread as a single page so no unnecessary paging.
					<br />
					<i>TIME ESTIMATE: 2 months</i>
				</li>

				<li style="margin-bottom: 5px;">
					<b>PostBetween</b>
					<br />
					Concept - allows the insertion of a post between to existing posts in a thread.
					<br />
					<i>TIME ESTIMATE: 2 months</i>
				</li>
			</ul>











	</ol>';

get_footer(); #defaults to theme header or footer_inc.php

