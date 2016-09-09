<?php

#echo '<h1>wackka wakkawackka wakkawackka wakkawackka wakkawackka wakkawackka wakka</h1>'; #prove we are including file

#Move into DB once we have the ability to create editable text areas
$aarContent = [
	#CHARACTERS - INDEX
		"AccessVisitor" => '<div class="">
		<h3 class="">Unauthorized user recognized, file access limited.</h3>
		<p><strong>Access Level 0 </strong></p>
		<p>(If Unregistered/unlogged in user)Welcome to Cerebra, a digital assistant used in the creation of, storing and archiving of locations, profiles and vital information which those allied with the X-Men might need at any given moment regarding many of the world\'s known mutants, super-powered inhabitant\'s and even alien species. Records are editable only by those with administrator access, but are accessible by those with a security clearance of 3 or higher for the purpose of research and training. Records may only be entered by someone with administrative level access. You have base administrative privileges to all Cerebra Database entries.</p>
		<p>To search Cerebra for a character or a location, choose from the appropriate categories and/or enter a keyword using the form at the top of the page. </p>
	</div>
	<div align= "center">
		<button type="button">Join Marvel Adventures</button>
	</div>',

	"AccessMember" => '<div class="">
			<h3 align="center">Authorized user recognized, file access granted.</h3>
			<p><strong>Access Level 2 </strong></p>
			<p>I am Friday, you\'re personal digital assistant for as long as you are active on this site. I exist to help facilitiate the purposes of character research, development, and curation of vitial character statistics here at Marvel Adventures. the creation, storing and archiving of vital information which is currated by the Xaiver Institute for the Gifted. The information is often detailed and contains a wealth of data and is easily searchable. Here, you have access to various levels of detailed character profiles of many of the most noteable beings and super-powered inhabitant\'s across the globe. In addition, the database also contains detailed information on various locals and maps of noteable locations across the universe. Records are editable only by those with administrator access, but are accessible by those with a security clearance of 3 or higher for the purpose of research and training. Records may only be entered by someone with administrative level access </p>
		</div>
		<div align= "center">
			<a href="./../contact.php" target="_blank" class="btn btn-primary btn-sm">Request Character / Location / Playby</a>
		</div>',



	#MODAL - Resigter/Join
	"EvalPost" => '<h4>RP Sample Post to Write Your Evaluation Response To</h4><p><em>The limp, possibly lifeless body of May Parker, Aunt of young Peter Parker lay at the feet of Dr Otto Octavius. Spider-Man\'s keen senses and Spider-Sense told him that his aunt was still alive, but only just barely and needed urgent medical care. Octavious stood before Spider-Man, better know as Dr. Ock, the deranged genius was possibly Spider-Man\'s single greatest foe with his keen albiet slightly deranged intellect, his ruthless cunning, and four robotic arms to assist him. "Well Spider-Man? Where are you clever quips and witty barbs now I ask you? We stand at the foothold of my greatest accomplishment and you stand helpless before me - there is nothing you can do. Once I throw the final switch, New York will be under my complete, autonomous control."<br /><br />Dr. Oct was about to laugh, but the lights above them suddenly flickered, then went out. The blackout was likely due to the amount of power which his cold fusion reactor was drawing from the city. The old subterrain wiring likely couldn\'t handle the stress of the load it had been tasked with carring and now the lights were out if only for the moment. In the darkness, Dr. Oct was likely startled - if that was the case, then perhaps his tentacle had eased it\'s grip on Aunt May\'s neck...</p>',


	"EvalPlaceholder" => "Please write an RP sample using the text area below. The sample is to be 300 words in length or longer. We ask that you use the character of Spider-Man (we know that it is not likley that you are applying for Spider-Man, this sample is strictly for purposes of evaluation.) In the post, please write your sample in our site style which is third-person, past tense narrative voice. Above, we have given you a sample post to write your evaluation post - Thank you for your cooperation.",

	"Terms" => "<h4 class=''><strong>TERMS &amp; CONDITIONS:</strong></h4>
		<div class='pull-left'><img src='./../_img/RP-17.png' alt='RP-17' /></div>
		<div class='pull-left'>
			<small>" . SITE_NAME . " is rated NC-17, most parents would consider patently too adult for their children 17 and under. No persons, aged 16 or less will be accepted as members of " . SITE_ABBR . " NC-17 does not mean 'obscene' or 'pornographic' in the common or legal understanding of those words, and should not be construed as a negative judgment in any sense. Our rating simply signals that the content is meant for an mature audiences/members. An NC-17 rating can be based on violence, sex, aberrational behavior, drug abuse or any other element that most parents would consider too strong and therefore off-limits for viewing by those under the age of 17. " . SITE_ABBR . " has taken every reasonable process to screen out those below the age of 17 from participating in it's activites and as such is not responsible for those who might mislead admins to gain access to   " . SITE_ABBR . " content.
			<br /><br />
			Neither " . SITE_ABBR . ", nor Monkeework is responsible for any messages posted by it's membership, either 'ICly' or 'OOCly'. We do not vouch for nor warrant the accuracy, completeness or usefulness of any message, and accept no responsiblities for the contents of any such messages. All messages are consdiered to express the views of their perspective authors and not necessarily the views of " . SITE_ABBR . ". Any member who feels that a posted message is objectionable is encouraged to contact a site moderator immediately by email. Please note that while we do have the ability to remove objectionable messages/materials, any such posts which are flagged as objectionable will be reviewed before any efforts are taken to moderator or remove the offending post(s) found to be objectionable within a reasonable time frame, if we determine that removal is necessary and violates our sites rating/posting policies. By joining, you agree, through your use and participation of this service, that you will not use " . SITE_ABBR . " to post any OOC material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person's privacy, or otherwise in violative of any law. You agree not to post any copyrighted material unless the copyright is considered shared/of fair use by you and " . SITE_ABBR . ", and thus will remain on " . SITE_ABBR . " under the governace of such 'fair useage' acts.
		</small></div>",



	#UPLOADS
	"UploadDefault" => "<h2>Recent FAQ's</h2>
	<h5><span class='glyphicon glyphicon-time'></span> Post by Monkee, July 5, 2016.</h5>
	<h5><span class='label label-danger'>Powers</span> <span class='label label-primary'>Character Creation</span></h5><br>

	<p>
		So you've just joined Marvel Champion's online Roleplaying site, and you want people to pay attention to you and the character you'll be handling. What do you do? The best way to keep other roleplayers from ignoring you is to choose a play-by for your character..
	</p>

	<h2>What is a Playby?</h2>
	<p>
		Play-bys are models, celebrities, hipsters, and scene kids that roleplayers use to Visually represent the characters in play. selects a play-by for her character, she will mine the internets for photographs of that particular person and molest them with grunge brushes, song lyrics, and whatever pretentious character name the roleplayer dug out of babynames.com. Said roleplayer will post the play-by on her character's profile, and all of the other site's members will ooh and aah over how sexy and cool the character looks. Many internet scholars theorize that the attractiveness of a roleplayer is inversely proportional to the attractiveness of her average character, which means that sites that require or encourage play-bys are overloaded with some of the ugliest women on the planet.
	</p>

	<h2>How to claim a Playby</h2>
	<p>
		Once a handler(Player) has settled on a playby for their character, they enter it into the character creation form. If the playby is available, the form will accept the handler's request and automatically update our claims page for you. If you request a playby which is already in use, you will get a polite notice stating that that playby has already been claimed.</p>
	<p>
		<em>NOTE: While most characters on Marvel Champions have assigned faceclaims, many of them are muteable. If a character does not have an active handler, they may not have an active claim on a specific faceclaim and as always, the handler who get's their character approved first has first claim on a playby.</em></p>

	<h2>So What's Considered Fairgame?</h2>
	<p>
		If a person is considered to be active in the public space, meaning they have some kind of public persona such as that of a famous athelete or actor or even a podcaster, their considered fairgame.
	</p>

	<p>
		Any questions or suggestions?.</p>

	<br>"




];










