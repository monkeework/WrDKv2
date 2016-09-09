<?php //aboutus.php
/**
 * aboutus.php is a model for largely static PHP pages
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

require './../_inc/config_inc.php'; #provides configuration, pathing, error handling, db credentials
$config->titleTag = "This is the about Us page, silly!"; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php

/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS

//$config->banner = ''; #goes inside header
$config->banner = 'ABOUT US'; #goes inside header

$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

# END CONFIG AREA ----------------------------------------------------------

//get_header('SmallPark_AboutUs_header_inc.php'); #defaults to theme header or header_inc.php
get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center"><?php echo THIS_PAGE ?></h3>

<h1 class="masthead">Feared and hated by humans because they're different, the X-Men are heroic mutants, individuals born <br >with special powers who've sworn to use <br >their gifts to help those who fear<br > them regardless the cost.</h1>

<h3>rules</h3>
<ul>
	<li>No Godmoding or Powerplaying, staples of any site.</li>
	<li>Be respectful, Out of Character and In. If you have issues, please contact an admin.</li>
	<li>You must be over 16 years of age to join. Mature events such as sex and extreme violence are not discouraged, but warning tags are required in the thread title. In that vein, please keep from having every thread focus on sex, that's not really what we're about here.</li>

</ul>



<h2>site specific</h2>

<h3>THOUGHTFULNESS</h3>

<p>If you come across a plot idea that would impact a large portion of the site (ie, influencing the flow of the site's story, or involving a large amount of characters), please run it past the admins first. Small sub-plots between characters are fine. However, plots that involve a kidnapped X-Character require admin permission to proceed, as well as large plots that revolve around a single character. Furthermore, such plots are only admissible by established RPers on the site; new RPers cannot request permission for them until they've at least been heavily involved in several threads after their acceptance to the site, to show that they can support such an undertaking.</p>

<p>Because of this rule, if you are a prospective member and intend on following through with a self-driven plot of that type, we discourage you from including it in your application as a lead-in to your introduction thread. That is to say, please don't end your history with a situation that will require that plot upon your acceptance. You will still be expected to wait to request that plot, and as such will likely be asked to just edit it out of your application.</p>



<h3>ACTIVITY</h3>

<p>Marvel Champions, or 'MC' will hold bi-monthly Activity Checks, taking place at the beginning of every other month. Activity Checks will last two weeks, in which time you are encouraged to post links to current threads. The suggested minimum is one post per character in the time since the previous check (a month and a half). Activity Checks will not be enforced with an iron fist, however; rather than a do-or-die requirement, these checks are to encourage you to remain active with your characters, and to help us get an idea of where some people might be having trouble.</p>


<p>Prolonged or excessive bouts of inactivity in spite of these checks will have consequences. These repercussions may consist of either a forced reduction of characters (if you have several), removal of a barely used character (in the case of a single character being neglected), or in extreme cases, deletion from the site. If we cannot get in contact with you (using the contact info in your character's profile) administrators reserve the right to choose which option fits.
</p>

<p>If no prior notice is given, the admins are unable to get in contact with you, and your account(s) is not logged into in a couple of months, your account(s) may be deleted, pending administrative discretion.</p>

<p>(This is why posting an Away Notice in the provided board is important!)
</p>



<h3>IMAGES</h3>

<p>Avatars have a size limit of 100x100 pixels, and signatures have a width limit of 500 pixels, though images linked within posts are resized automatically. When selecting profile, avatar, and signature images or gifs, please keep them tasteful; no nudes or sexually-implicit scenes. A link to your character's profile MUST be linked in your signatures, while a link to your relationship application is not mandatory but highly recommended!</p>



<h3>TIMESTAMPS</h3>

<p>Timestamps are required at the top of all plot-related posts. Be mindful of the site timeline. You are not allowed to post beyond the range specified there. Past threads, however, are allowed. The only thing we require in the stamp itself is the date, whether it be specific or vague. Threads that have little - if any - bearing at the plot at hand (eg, slice-of-life threads), simply need a vague stamp at the top, not a specific date.</p>



<h3>EXAMPLE OF SPECIFIC TIMESTAMP</h3>
<p>Date: April 17th, 2013 (update if different)<br />
Time: 4am (update if different)<br />
Setting: Central Park (update if different)<br />
Outfit: [ We will allow for a polyvore link or image upload in the the future ]</p>



<h3>EXAMPLE OF VAGUE STAMP</h3>
<p>Late Summer</p>



<h3>APPLICATION INFO</h3>

<p>Have questions or need help navigating? Contact an admin or a Site Buddy
</p>

<p>There is to be one character per account. Please complete all sections of your profile, and check them for spelling/grammar errors.</p>

<p>Minimums for all sections except Weaknesses is 200 words. If your character is Human, or has a rather simple power, please contact an admin to have this waived.</p>

<p>Your RP Sample doesn't have to be novel-length, but we appreciate some effort. Three paragraphs is ideal. Write something that shows your character's personality and powers and post it AFTER your application, as a reply to your profile thread. This is not mandatory for secondary characters, but the admins may request one to better understand your character's abilities.</p>

<p>Regarding WIP/unfinished applications: if that character account has not been logged into - or the WIP application has not been worked on - for a month or more, then the application will be moved to Archives and the account will be deleted. If you return after this and wish to have your application recovered, please contact an admin and we will gladly recover it for you so that you may continue working on it.</p>

<p>In the case of a former member returning to the fold, if your account has been deleted and your profile moved to Archives, we request that you re-apply and wait for the usual admin acceptance notice. (We're sorry for the inconvenience, we just think it's only fair for everyone to be treated equally in this regard. Thanks for your patience, and welcome back!)</p>



<h2>CHARACTERS</h2>

<h3>CHARACTER LIMIT</h3>

<p>There is a recommended cap of 6 characters per Handle'er, with some active and talented Handle'er taking on more, provided that they meet the posting requirements and receive administrative approval beforehand. When applying for a new character, a roleplayer must meet the following requirements:</p>

<ul>
	<li>Remain at least moderately active with the characters they already have.</li>
	<li>Wait one month from the official date of acceptance of their most current character.</li>
	<li>Have at least 10 IC posts with the most recently accepted character.</li>
	<li>The 10+ posts the roleplayer does for their most recently accepted character have to be at least 2 paragraphs long.</li>
</ul>

<ul>
	<li>If a roleplayer feels that they are capable of managing more characters than those that fall within the initial six-character limit, they do have the option of applying for further characters, though some additional regulations are put into effect in such case:</li>
	<li>The same general rules of character application as above still apply – however, the roleplayer must get explicit, written approval and recognition of activity from at least two administrators. They must do this for every additional character, without exception.</li>
	<li>The roleplayer must provide a general idea of how their newest character will play into the site’s current climate, plots, etc., to avoid extraneous drifters. Providing (at least) three existing characters on the site that they can plot with and what those plots might be is encouraged, but not mandatory. Relevance of plots to current site events is also preferable, but not mandatory.</li>
</ul>



<h3>TRAITS (Abilities, Skills, Powers, et al</h3>

<p>The number of abilities your mutant can have holds no limit, but keep them reasonable and related. Four or five completely unrelated abilities might be seen as going overboard without a convincing explanation, and if your character is deemed to be overpowered, either in number or in power level, you will be asked to change them. If you aren't sure about what constitutes an over-powered character, feel free to ask an admin, or read a selection of character profiles to get an idea of what is acceptable.</p>

<p>Please take a look at the Current Powers list, and use your own discretion; there is no limit to the number of powers on the site, but if there are a lot of your choice already there, maybe consider adding a twist to yours or picking something different. Also consider this if you're thinking of applying with a canon character.</p>



<h3>HISTORY</h3>

<p>Please take into account the site's history, especially if your character has been involved with a particular faction for a number of years, as there have been some major upsets in recent history. This is a requirement. Also, please be aware of the moral and political standpoints of your chosen faction as they exist in MC, as they may not be the same as in the various canon universes - for example, The Brotherhood in MC is not a band of belligerent street thugs. The Faction Information page should help with this.</p>

<p>Also, due to an impressive number of histories involving secret government testing or other experimentation on the character, we'd like to officially come out and discourage this line of thinking. It isn't forbidden, but please, if you must include this for your character, make it noteworthy enough to pass muster.</p>

<p>Another trend that has cropped up recently is the idea of bringing in an original character from an alternate universe. This is also highly discouraged. 99% of the time it breaks the rule about self-driven plots upon joining the site, and even if it doesn't, as a core trait of that character (ie, adapting to this new world), it imposes upon many of the other members to have to cater to this character arc in every thread they participate in. The only possible exception to this is the incredibly rare dimension-hopping canon, such as a member of the Exiles.</p>



<h3>CHANGING CHARACTER INFORMATION</h3>

<p>After being accepted, please do not change your profile without running things past the admins. Updating their history, appearance, etc if something happens in-character is fine, but adding new powers or completely re-hauling the character without permission is not acceptable. If you feel you want to just reword the sections (in the words of one admin, "so it's less of a clusterfuck", because we all have those moments after a while) without changing the core content, then just feel free to give a shout-out to an admin so we know what's up.</p>



<h2>CANONS (Characters)</h2>

<h3>APPLYING FOR CANONS</h3>
<p>
MC is OC-CENTRIC, meaning that original characters are preferred to canons, but first-time applicants interested in canon characters may still apply. First-time applicants are encouraged to contact an Admin first if applying with a particularly powerful canon character so that we can ensure that the character fits well with the site dynamic. Applicants may be asked for a sample post before applying, or may be asked to re-apply with an OC so that we may gauge your skill level and build trust. </p>

<h3>List of Taken/Wanted Canons</h3>

<p>Canon history must still include aspects of the site's history. Simply saying that the character has been off doing his/her own thing until recently will not cut it.
</p>
<p>Plagiarized applications will not be accepted - this includes profiles from other sites that are not your own, as well as copying and pasting the biography of the canon from a character database site (yes, admins will check). You are also expected to keep your canon IN CHARACTER. If you only have a vague grasp on a canon, you might reconsider your choice. Admins maintain the right to discuss this with you should you veer off course.
</p>


<h3>CANON ACTIVITY
</h3>
<p>Canons must remain ACTIVE. Obviously this scales with integration of character/importance (Husk, for example wouldn't need to remain as active as Wolverine). The admins reserves the right to put the canon back up for adoption in cases of prolonged inactivity that extend for a longer time period than six weeks without notice.
</p>

<p>There is no hard cap on how many canon characters you may have, however the recommended cap of 6 characters overall is encouraged, and you are encouraged to maintain a ratio of 1 OC per canon. Any members seeking to apply for a canon without maintaining this ratio will be expected to gain approval from the admin team before submitting their application, and will need to meet all other prerequisites (including activity, post counts, and time waits.) In the case of unanimous agreement between the admins to bypass the ratio rule, the profile is subject to standard review and acceptance is not guaranteed.
</p>


<h3>RELATIONSHIPS
</h3>
<p>No relations to canon characters are allowed who are themselves non-canon (ie, the time-traveling child of Kitty Pryde or the brother of Logan). Exceptions might be made if discussed with the admins and the RPer of the canon character if they are currently being played by one.
</p>

<h3>most importantly</h3>
<p> <strong>DON'T BE A JERK</strong>. Seriously. Just don't.</p>

<p> <strong>BE NICE</strong>. We aren't going to say 'have fun', rather we're going to say be nice and try to help everyone else. If you do this along with everyone else, then we think it's highly likely that you will actually have fun during your time here. So, please, be respect of yourself and your fellow RPers and do have fun when and where possible.
</p>



<?php
get_footer(); #defaults to theme header or footer_inc.php
?>
