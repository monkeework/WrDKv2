<?php

#echo '<h1>_inc/arrays-inc.php is here</h1>';

/**
 *arrays-inc.php - all general arrays kept here for ease of location/use
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 *
 * @todo none
 */

// ===============================================
// COMMON ARRAYS
// ===============================================
$aarStatus = [
	"0"  => "Set Status", #non standards default setting
	"1"  => 'Want', #non standards default setting
	"2"  => 'Open',
	"3"  => 'Hold',
	"4"  => 'Taken',
	"5"  => 'Develop',
	"6"  => 'Submit',
	"7"  => 'Review',
	"8"  => 'Expand',
	"9"  => 'Approve',
	"10" => 'Lock',
	"11" => 'Injured',
	"12" => 'Retire',
	"13" => 'M.I.A.',
	"14" => 'Dead',
	"15" => 'Clone',
	"16" => 'Unlist', #is the default setting when needed
	"17" => 'Restrict', #is the default setting when needed
	"18" => 'Ban'
];

#used in profilesADD.php - note description variation
$aarStatusTest = [
		"0"  => "Character Status Not Set", #non standards default setting
		"1"  => 'Wanted', #non standards default setting
		"2"  => 'Open',
		"3"  => 'Hold',
		"4"  => 'Taken',
		"5"  => 'Develop',
		"6"  => 'Submit',
		"7"  => 'Review',
		"8"  => 'Expand (Revsions required)',
		"9"  => 'Approved',
		"10" => 'Locked',
		"11" => 'Injured',
		"12" => 'Retired',
		"13" => 'M.I.A.',
		"14" => 'Dead',
		"15" => 'Clone',
		"16" => 'Unlisted (Invisible to membership)', #is the default setting when needed
		"17" => 'Restricted (Mod Approval needed)', #is the default setting when needed
		"18" => 'Banned'
	];



$aarPrivilege = [
	"0"  => "visitor", 		#unknown
	"1"  => 'guest',   		#no character, just joined
	"2"  => 'member',  		#aproved, no character
	"3"  => 'handler',    #aproved, has character
	"4"  => 'mod',     		#characters
	"5"  => 'admin',   		#handles
	"6"  => 'owner',      #superadmin
	"7"  => 'developer'   #all privs-db
];



$aarWaiver = [
"0"  => "G - General. Suitable for members of all ages; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"1"  => "PG - Some content may not be suitable for children; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"2"  => "PG-13 - Some material may be inappropriate for persons under the age of 13; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"3"  => "R - Content not suitable for persons under the age of 17. Adult or legal guardian's permission required to participate; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"4"  => "NC-17 - Content not suitable for persons under the age of 17; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"5"  => "X - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved by mods and storyteller. Such actions initiated by other players require prior player consent.",
"6"  => "XX - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved by mods and storyteller. Such actions initiated by other players require prior player consent.",
"7"  => "XXX - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved. No prior player consent required for event inclusion.",
"8"  => "NPC - General use authorized; No maiming, mutitilating, or other possible traumatic situations without prior moderator consent.",
"9"  => "NPC - Mod approval required; No maiming, mutitilating, or other possible traumatic situations without prior moderator consent.",
"10" => "NPC - Storyteller approval required; No maiming, mutitilating, or other possible traumatic situations without prior storyteller consent."
];


//remember to map changes to '/ajax/charinfo.php'!
$digits = [
	"0",1,2,3,4,5,6,7,8,9
	];

#&frasl; = forward slash
$aarBtnRank = [
	'S &frasl; 0',
	'fe', 'pr', 'ty', 'gd', 'ex', 'rem',' inc', 'am', 'mon', 'un',
	'S &frasl; X', 'S &frasl; Y', 's &frasl; z',
	'c1', 'c3', 'c5', 'b'];

$aarClassification = [
"Please select a Character Classification", #don't show if no selection/default
"animal",
"android",
"a.i.",
"alien - extraterestrial",
"alien - extradimensional",
"alien - temporal",
"angel",
"celestial",
"cyborg",
"demi-god/godling",
"demon/devil",
"diety",
"extra-dimensional",
"foriegn",
"human (Homosapien Sapien Sapien)",
"hybrid",
"inhuman",
"mechanical",
"mutation - dormant: Class Unknown",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"alpha-prime - Ap1",
"alpha-kappa - Ak1",
"alpha-epsilon - Ae1",
"alpha-gamma - Ag1",
"alpha-tau - At1",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"gamma-prime - Gp2",
"gamma-kappa - Gk2",
"gamma-epsilon - Ge2",
"gamma-omega - Go2",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"epsilon-prime - Ep3",
"epsilon-kappa - Ek3",
"epsilon-tau - Et3",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"kappa-prime - Ek4",
"kappa-tau - Et4",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"omega-prime - Op5",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"symbiot",
"robot",
"unknown",
" " #don't show if no selection/default
];

$aarEducation = [
"None",
"Special Ed. - Variable",
"Preschool",
"Kindergarden",
"GRD 1",
"GRD 2",
"GRD 3",
"GRD 4",
"GRD 5",
"GRD 6",
"GRD 7",
"GRD 8",
"GRD 9 - Freshmen",
"GRD 10 - Sophmore",
"GRD 11 - Junior",
"GRD 12 - Senior",
"GRD 12 - Grad",
"GRD 12 - G.E.D.",
"College YR 1 - Attending",
"College YR 1",
"College YR 2 - Attending",
"College YR 2 - Degree",
"College YR 3 - Attending",
"College YR 4 - Attending",
"College YR 4 - B.A.",
"College YR 4 - B.F.A.",
"College YR 4 - B.S.",
"College YR 5 - Attending",
"College YR 6 - Attending.",
"College YR 6 - M.A.",
"College YR 6 - M.F.A.",
"College YR 6 - M.S.",
"College YR 7 - Attending.",
"College YR 8 - Attending.",
"College YR 8 - PH.d.",
"College YR 8 - Dr.",
"Homeschooled.",
"Unknown"
];

$aarEye = [
	'red, dark',
	'red, light',
	'orange, dark',
	'orange, light',
	'Amber',
	'yellow, bright',
	'yellow, light',
	'green, light',
	'green, dark',
	'blue, pond',
	'blue, medium',
	'blue, medium',
	'blue, light',
	'periwinkle',
	'lavender',
	'pink',
	'plum',
	'brown, dark',
	'brown, light',
	'hazel',
	'grey',
	'metallic periwinkle',
	'teal, metallic ',
	'albino',

	'<sup>*</sup>see description'];

$aarHair = [
	'black, jet',
	'black, natural',

	'brown, dark',
	'brown, chocolate',
	'brown, medium',
	'brown, golden',
	'brown, light',
	'brown, ashen',
	'brown, honey',
	'brown, caramel',

	'blonde, ash',
	'blonde, medium',
	'blonde, platinum',
	'blonde, honey',
	'blonde, golden',
	'blonde, sandy',
	'blonde, meade',
	'blonde, butterscotch',
	'blonde, strawberry',

	'red, copper',
	'red, garnet',
	'red, dark',

	'blonde, hollywood',
	'blonde, plantinum',

	'purple, plum',
	'blue, steel',
	'red, burgundy',

	'green, grape',
	'green, turquoise',

	'pink, pearl',

	'purple, passion',

	'red, rosa',
	'red, ruby',

	'purple, ultraviolet',

	'white',

	'bald',
	'shaved',

	'<sup>*</sup>see description'
];

$aarLegal = [
	"Minor, No criminal record", "Minor, Criminal record", "Minor, Record sealed", "Adult, No criminal record", "Adult, Criminal record", "Adult, Record sealed"
];

$aarMarital = [
	"committed",
	"Dating", "Divorced",
	"Married", "Open Relation",
	"Partnered",
	"Seperated", "Single"
];

$aarPowSource = [
"None",
"Accident",
"Alien",
"Altered - Induced",
"Altered - Random",
"Artificial - Mechanical: Induced",
"Artificial - Mechanical: Random",
"Enhanced - Induced",
"Enhanced - Random",
"External (Extra-dimensional)",
"External (Faith)",
"External (Mechanical)",
"External (Magical)",
"External (Mythical)",
"Faith",
"Hybrid",
"Mutation - Dormant",
"Mutation - Genetic: Induced",
"Mutation - Genetic: Hereditary",
"Mutation - Genetic: Random",
"High-Tech Wonder",
"Magic",
"Mythic",
"Study",
"Training",
"Unknown"
];

$aarOrientation = [
"0" => "please select a character sexual orientation", #is the default setting when needed
"1" => "asexual",
"2" => "bisexual",
"3" => "hetrosexual",
"4" => "homosexual",
"5" => "pansexual",
"6" => "polysexual",
"7" => "transexual",
"8" => ""	 #default for non-displayed value
];

$aarRank = [
"None",
"PR - 00",
"FE - 02",
"PR - 04",
"TY - 06",
"GD - 10",
"EX - 20",
"REM - 30",
"INC - 40",
"AM - 50",
"MON - 75",
"UN - 100",
"SX - 150",
"SY - 200",
"SZ - 500",
"C1 - 1,000",
"C3 - 3,000",
"C5 - 5,000",
"BYND - ?"
	];

//Marvel stats
$aarRankStaggered = [
	"None",
" ",
"PR",
"PR / FE*",
"PR / TY*",
"PR / GD*",
"PR / EX*",
"PR / REM*",
" ",
"FE / PR*",
"FE",
"FE / TY*",
"FE / GD*",
"FE / EX*",
"FE / REM*",
" ",
"TY / PR*",
"TY / FE*",
"TY",
"TY / GD*",
"TY / EX*",
"TY / REM*",
"TY / INC*",
"TY / AM*",
"TY / MON*",
" ",
"GD / PR*",
"GD / FE*",
"GD / TY*",
"GD",
"GD / EX*",
"GD / REM*",
"GD / INC*",
"GD / AM*",
" ",
"EX / PR*",
"EX / FE*",
"EX / TY*",
"EX / GD*",
"EX",
"EX / REM*",
"EX / INC*",
"EX / AM*",
"EX / MON*",
" ",
"REM / FE*",
"REM / TY*",
"REM / GD*",
"REM / EX*",
"REM",
"REM / INC*",
"REM / AM*",
"REM / MON*",
"REM / UN*",
" ",
"INC / TY*",
"INC / GD*",
"INC / EX*",
"INC / REM*",
"INC",
"INC / AM*",
"INC / MON*",
"INC / UN*",
"INC / SX*",
" ",
"AM / GD*",
"AM / EX*",
"AM / REM*",
"AM / INC*",
"AM",
"AM / AM",
"AM / MON*",
"AM / UN*",
"AM / SX*",
" ",
"MON / EX*",
"MON / REM*",
"MON / INC*",
"MON / AM",
"MON",
"MON / UN*",
"MON / SX*",
"MON / SY*",
"MON / SZ*",
" ",
"UN / REM*",
"UN / INC*",
"UN / AM",
"UN / MON*",
"UN",
"UN / SX*",
"UN / SY*",
"UN / SZ*",
"UN / C1000*",
" ",
"SX / INC*",
"SX / AM",
"SX / MON*",
"SX / UN*",
"SX",
"SX / SY*",
"SX / SZ*",
"SX / C-1000*",
"SX / C-3000*",
" ",
"SY / AM",
"SY / MON*",
"SY / UN*",
"SY / SX*",
"SY",
"SY / SZ*",
"SY / C-1000*",
"SY / C-3000*",
"SY / C-5000*",
" ",
"C-1000 / UN*",
"C-1000 / SX*",
"C-1000 / SY*",
"C-1000 / SZ*",
"C-1000",
"C-1000 / C-3000*",
"C-1000 / C-5000*",
"C-1000 / BYND*",
" ",
"C-3000 / SX*",
"C-3000 / SY*",
"C-3000 / SZ*",
"C-3000 / C-1000*",
"C-3000",
"C-000 / C-5000*",
"C-3000 / BYND*",
" ",
"C-5000 / SX*",
"C-5000 / SY*",
"C-5000 / SZ*",
"C-5000 / C-1000*",
"C-5000*",
"C-3000 / BYND*",
" ",
"BYND / SY*",
"BYND / SZ*",
"BYND / C-1000*",
"BYND / C-5000*",
"BYND",
" ",
"Unknown"
	];

$aarRating = [
1 => array("rating"=>"G", "description"=>"General Audiences"),
2 => array("rating"=>"PG", "description"=>"Strong language used"),
3 => array("rating"=>"PG-13", "description"=>"Strong violence or language used"),
4 => array("rating"=>"R", "description"=>"Restricted - Strong sexual or violent situations described"),
5 => array("rating"=>"NC-17", "description"=>"Explicit Sexual/Graphic situations described"),
6 => array("rating"=>"X", "description"=>"Hee, hee, hee!")
];

$aarAsset = [
	"Unemployed, Social Security or allowance",
	"Freelance, lower middle class, students",
	"Salaried employment, middle class",
	"Professional employment, middle class",
	"Small ineritance or business, upper middle class",
	"Large business or chain, trust fund, upper class",
	"Standard corporation, millionaire",
	"Large corporation, small country",
	"Multinational corp., govt. branch of major country",
	"Major country, mega-corporation",
	"Unknown"
];


$aarExpertise = [
	"Lacks any knowledge or understanding of Language and machines",
	"Knows native language and simple machines",
	"Some tech exposure, understands complex machines",
	"Operate current technology: computers, electronics",
	"Repair, install and troubleshoot current technology",
	"Modify existing current technology",
	"Knows most advanced terran tech concepts",
	"Knows non-terran technologies",
	"Create leading-edge tech: stardrives, temporal devices",
	"Improve and modify advanced alien technologies",
	"In effect, IS an alien technology",
	"Unknown"
];

//Changes applied to compoto => display.php, edit.php
//MA, MU, XC & XPG will use '$stats_marvel' (duh)
//DC Stats
$stats_dc = [
"0",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"10",
"11",
"12",
"13",
"14",
"15",
"16",
"17",
"18",
"19",
"20",
"21",
"22",
"23",
"24",
"25",
"26",
"27",
"28",
"29",
"30",
"31",
"32",
"33",
"34",
"35",
"36",
"37",
"38",
"39",
"40",
"41",
"42",
"43",
"44",
"45",
"46",
"47",
"48",
"49",
"50",
"51",
"52"
	];

$stateAbbr = [
	"AL", "AK", "AZ", "AR", "CA", "CZ", "CO", "CT", "DE", "FL", "GA", "GU", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "VI", "WA", "DC", "WV", "WI", "WY"
	];

$stateName = [
	"Alabama", "Alaska", "Arizona", "Arkansas",
	"California", "Canal Zone", "Colorado", "Connecticut",
	"Delaware",
	"Florida",
	"Georgia", "Guam",
	"Hawaii",
	"Idaho", "Illinois", "Indiana", "Iowa",
	"Kansas", "Kentucky",
	"Louisiana",
	"Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana",
	"Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota",
	"Ohio", "Oklahoma", "Oregon",
	"Pennsylvania", "Puerto Rico",
	"Rhode Island", "South Carolina",
	"South Dakota",
	"Tennessee", "Texas",
	"Utah", "Vermont",
	"Virginia", "Virgin Islands",
	"Washington", "Washington, D.C.", "West Virginia", "Wisconsin", "Wyoming"];

/*
$aarSource = [
"None",
"Artificial - Mechanical: Induced",
"Artificial - Mechanical: Random",
"Extra-dimensional",
"Mutation - Genetic: Induced",
"Mutation - Genetic: Hereditary",
"Mutation - Genetic: Random",
"Alien",
"High-Tech Wonder",
"Magic",
"Unknown"
];
*/


$aarTposition = [
"None",
"Squad Leader",
"Deputy Squad Leader",
"Team Leader",
"Deputy Team Leader",
"Reservist",
"Hiatus"
];

$aarTrait = [
	"Activist",
	"Adventurer", "Analyst", "Architect", "Autocrat", "Autist", "Avant-Garde", "Benefactor", "Bon Vivant", "Bragard", "Bravo", "Caregiver", "Cavalier", "Celebrant", "Child", "Competitor", "Confidant", "Conformist", "Conniver", "Coward", "Crackerjack", "Critic", "Curmudgeon", "Coward", "Dabbler", "Dark Hero", "Decoder", "Defender", "Defiant", "Director", "Deviant", "Explorer", "Fanatic", "Follower", "Gallant", "Grown-up", "Guardian", "Hero", "Honest-Abe", "Jester", "Jobsworth", "Judge", "Idealist",  "Intellectual", "Lackey", "Loner", "Manipulator", "Martyr", "Masochist", "Mediator", "Mentor", "Minion", "Misguided Villian", "Monster", "Narcissist", "Newbie", "Nut", "Old Hand", "Optimist", "Pedagogue", "Penitent", "Perfectionist", "Pervert", "Plotter", "Poltroon", "Power Broker", "Praise-Seeker", "Predator", "Psuedo Intellectual", "Psychotic", "Rebel", "Recovering", "Reluctant Hero", "Rogue", "Sadist", "Sage", "Scientist", "Scoundrel", "Seductresss", "Seductor", "Sensualist", "Shattered", "Show-off", "Soldier", "Startlet", "Supplicant", "Survivor", "Sycophant", "Terrorist", "Theorist",  "Thrill-Seeker", "Traditionalist", "Trickster", "Vigilante", "Villain", "Vindictive" ];

$aarWeather = [
1 => array("weatherDB"=>"GOOD", "description"=>"Clear"),

2 => array("weatherDB"=>"FAIR", "description"=>"Partly Overcast"),
3 => array("weatherDB"=>"FAIR", "description"=>"Overcast"),

4 => array("weatherDB"=>"MILD", "description"=>"Cloudy"),
5 => array("weatherDB"=>"MILD", "description"=>"Cloudy, Occasional Drizzle"),

6 => array("weatherDB"=>"OVERCAST", "description"=>"Overcast"),
7 => array("weatherDB"=>"OVERCAST", "description"=>"Partly Foggy"),
8 => array("weatherDB"=>"OVERCAST", "description"=>"Foggy"),

9 => array("weatherDB"=>"STORMY", "description"=>"Drizzle"),
10 => array("weatherDB"=>"STORMY", "description"=>"Rain"),
11 => array("weatherDB"=>"STORMY", "description"=>"Thunder & Lightning"),
12 => array("weatherDB"=>"STORMY", "description"=>"Snow"),
13 => array("weatherDB"=>"STORMY", "description"=>"Icestorm"),

14 => array("weatherDB"=>"HAZARDOUS", "description"=>"Blizzard"),
15 => array("weatherDB"=>"HAZARDOUS", "description"=>"Hurricane"),
16 => array("weatherDB"=>"HAZARDOUS", "description"=>"Partial Eclipse"),
17 => array("weatherDB"=>"HAZARDOUS", "description"=>"Full Eclipse")
];

$heightFeet = [
	"", "1&#39;", "2&#39;", "3&#39;", "4&#39;", "5&#39;", "6&#39;", "7&#39;", "8&#39;", "9&#39;", "0&#39;"
];

$heightInch = [
	"", " 1&quot;", " 2&quot;", " 3&quot;", " 4&quot;", " 5&quot;", " 6&quot;", " 7&quot;", " 8&quot;", " 9&quot;", "10&quot;", "11&quot;"
	];



$characterWeight1 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];

$characterWeight2 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];

$characterWeight3 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];


$aarCountryName = [
	"United States",
	"Afghanistan",
	"Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argent in.", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia Hercegov in.", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Byelorussian SSR", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "Ch in.", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic Of", "Cook Islands", "Costa Rica", "Cote DIvoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Czechoslovakia", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Great Britain", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemela", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and McDonald Islands", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic Of)", "Iraq", "Ireland", "Isle Of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic Peoples Republic Of", "Korea, Republic Of", "Kuwait", "Kyrgyzstan", "Lao Peoples Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States Of", "Moldova, Republic Of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Neutral Zone", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts And Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and The Grenadines", "Samoa", "San Mar in.", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and The Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province Of Ch in.", "Tajikista", "Tanzania, United Republic Of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukra in.", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "USSR", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen, Republic of", "Yugoslavia", "Zaire", "Zambia", "Zimbabwe", "Other"];

$countryAbbr = [
	"US", "AF", "AL",
	"DZ", "AS", "AD", "AO", "AI", "AQ", "AG", "AR", "AM", "AW", "AU", "AT", "AZ", "BS", "BH", "BD", "BB", "BY", "BE", "BZ", "BJ", "BM", "BT", "BO", "BA", "BW", "BV", "BR", "IO", "BN", "BG", "BF", "BI", "BY", "KH", "CM", "CA", "CV", "KY", "CF", "TD", "CL", "CN", "CX", "CC", "CO", "KM", "CG", "CD", "CK", "CR", "CI", "HR", "CU", "CY", "CZ", "CS", "DK", "DJ", "DM", "DO", "TP", "EC", "EG", "SV", "GB", "GQ", "ER", "EE", "ET", "FK", "FO", "FJ", "FI", "FR", "GF", "PF", "TF", "GA", "GM", "GE", "DE", "GH", "GI", "GB", "GR", "GL", "GD", "GP", "GU", "GT", "GG", "GN", "GW", "GY", "HT", "HM", "HN", "HK", "HU", "IS", "IN", "ID", "IR", "IQ", "IE", "IM", "IL", "IT", "JM", "JP", "JE", "JO", "KZ", "KE", "KI", "KP", "KR", "KW", "KG", "LA", "LV", "LB", "LS", "LR", "LY", "LI", "LT", "LU", "MO", "MK", "MG", "MW", "MY", "MV", "ML", "MT", "MH", "MQ", "MR", "MU", "YT", "MX", "FM", "MD", "MC", "MN", "MS", "MA", "MZ", "MM", "NA", "NR", "NP", "NL", "AN", "NT", "NC", "NZ", "NI", "NE", "NG", "NU", "NF", "MP", "NO", "OM", "PK", "PW", "PA", "PG", "PY", "PE", "PH", "PN", "PL", "PT", "PR", "QA", "RE", "RO", "RU", "RW", "SH", "KN", "LC", "PM", "VC", "WS", "SM", "ST", "SA", "SN", "SC", "SL", "SG", "SK", "SI", "SB", "SO", "ZA", "GS", "ES", "LK", "SD", "SR", "SJ", "SZ", "SE", "CH", "SY", "TW", "TJ", "TZ", "TH", "TG", "TK", "TO", "TT", "TN", "TR", "TM", "TC", "TV", "UG", "UA", "AE", "UK", "US", "UM", "UY", "SU", "UZ", "VU", "VA", "VE", "VN", "VG", "VI", "WF", "EH", "YE", "YU", "ZR", "ZM", "ZW"];

$aarMyTips = [
	'ra' => '<a href="#" rel="tooltip"  title="A measure of a character\'s raw innate combat ability: Used to determine if the character lands a blow in hand-to-hand (called Slugfest) combat
	&bull; Used to determine if a character evades a blunt attack
	&bull; Used to determine if a multiple combat attack or other FEAT involving hand-to-hand combat is successful
	&bull; Used to determine the secondary ability known as Health " >Rank</a>',

	'fi' => '<a href="#" rel="tooltip"  title="A measure of a character\'s raw innate combat ability: Used to determine if the character lands a blow in hand-to-hand (called Slugfest) combat
	&bull; Used to determine if a character evades a blunt attack
	&bull; Used to determine if a multiple combat attack or other FEAT involving hand-to-hand combat is successful
	&bull; Used to determine the secondary ability known as Health " >Fighting</a>',

	'ag' => '<a href="#" rel="tooltip"  title="A measure of dexterity and nimbleness
	&bull; Used to determine if the character hits with a thrown or aimed weapon at a distance
	&bull; Used to determine if the character dodges a missile attack
	&bull; Used to determine if the character catches an object, holds onto a ledge, or successfully performs actions that require quick action or co-ordination
	&bull; Used to determine how well a character handles a vehicle
	&bull; Used to determine the secondary ability known as Health" >Agility</a>',

	'st' => '<a href="#" rel="tooltip"  title="A measure of physical muscle power
	&bull; Used to determine damage inflicted in slugfest combat
	&bull; Used to determine success and damage in wrestling combat and success in Grabbing, Escaping, and Blocking maneuvers
	&bull; Used to determine success in destroying materials
	&bull; Used to determine if a character can lift a heavy object or perform other acts that require physical power
	&bull; Used to determine the secondary ability known as Health" >Strength</a>',

	'end' => '<a href="#" rel="tooltip"  title="•	A measure of personal toughness and physical resistance  <br />
	&bull; Used to determine normal moving speed
	&bull; Used to determine success in charging attacks
	&bull; Used to determine success in avoiding the effects of disease, poison, and gas
	&bull; Used to determine success in matters that require the character to perform actions over a long period of time, such as holding one\'s breath
	&bull; Used to determine the secondary ability known as Health
	&bull; Used to resist the effects of Slams, Stuns, and Kill results directed against the hero
	&bull; Used td determine the amount of Health regained by a wounded individual" >Endurance:</a>',

	're' => '<a href="#" rel="tooltip"  title="•	A measure of intelligence and the capacity for logical thought
	&bull; Used to determine the character\'s success in building things
	&bull; Used to determine the character\'s success in understanding unknown technology and languages
	&bull; Used to determine the secondary ability known as Karma" >Reason</a>',

	'int' => '<a href="#" rel="tooltip"  title="•	A measure of wisdom, wits, common sense, and battle reflexes
	&bull; Used to discover clues
	&bull; Used to determine who may act first in combat (see Initiative)
	&bull; Used to detect hidden or potentially dangerous items, as well as in situations where the the character plays a hunch
	&bull; Used to resist effects of emotion control powers, spells, and abilities
	&bull; Used to determine the secondary ability known as Karma" >Intuition</a>',

	'psy' => '<a href="#" rel="tooltip"  title="•	A measure of mental strength and willpower
	&bull; Used to show resistance to mental and will-dominating attacks
	&bull; Used to determine resistance to magical attacks
	&bull; Used to determine initial Magical abilities for those characters who wield magic  <br />
	&bull; Used to determine the secondary ability known as Karma" >Psyche</a>',

	'pow' => '<a href="#" rel="tooltip"  title=" description to come. sorry" >Power Rank</a>',

	'sk' => '<a href="#" rel="tooltip"  title="•	A measure of mental strength and willpower
	&bull; Used to show resistance to mental and will-dominating attacks
	&bull; Used to determine resistance to magical attacks
	&bull; Used to determine initial Magical abilities for those characters who wield magic
	&bull; Used to determine the secondary ability known as Karma" >Skill Level</a>'


];



/*
Health:
•	Used to determine the amount of physical damage the character can absorb before losing consciousness and potentially dying
•	Does not have a rank or rank number, but rather is the sum of the rank numbers of the character's Fighting, Agility, Strength, and Endurance
•	Lost through combat, accidents, attacks, and other potentially dangerous and life-threatening situations
•	Recovered after damage is taken, 10 turns after damage is inflicted
•	Regained through normal healing by the Endurance rank number of points per day (in crisis situations, Health may be figured as regained by the hour or turn. See the table under Healing)
•	If reduced to 0, the character is unconscious and may begin to lose Endurance ranks (see Life, Death, and Health).



Karma:
•	Used by the hero as a measure of experience, allowing the hero to perform actions that may otherwise be impossible
•	Does not have a rank or rank number. Starting Karma is determined when the character is created by the sum of the Initial rank numbers of the character's Reason, Intuition, and Psyche
•	Gained through performing heroic and basically "honorable" acts •	Lost through performing selfish, harmful, or "dishonorable" acts
•	May be spent by the player-character to perform actions otherwise impossible or unlikely. These include modifying die rolls, staying alive, building things, using magical abilities, and raising the hero's ability rank numbers and ranks through advancement

Resources:
•	A measure of how wealthy a character is, and how the character may use that wealth
•	Generated when the character is created
•	Presented as a rank with a rank number (replacing the Resource Points of the MARVEL SUPER HEROES Original Set)
•	Used to determine if a character can afford a particular item or service
•	See under Resource FEATs in the next chapter for full effects of Resources



Popularity:
•	A measure of the character's reputation in that character's normal environment
•	Generated when the character is created
•	Represented as a rank and rank number. Heroes generally have positive Popularity. Villains generally have negative Popularity
•	Used to determine reactions of large groups of people and neutral NPCs
Used to gain favors, information, and equipment from Contacts
*/
