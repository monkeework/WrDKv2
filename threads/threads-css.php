<style>
.jumbotron {
	position: relative;
	background: #000 url("../_img/_hdr/threads-<?php echo rand(0, 5); ?>.jpg") center center;
	width: 100%;
	height: 100%;
	background-size: cover;
	overflow: hidden;

	color: white;
	}


.jumbotron h1, .jumbotron p {

	color: white;
	text-shadow: 2px 2px 16px #000000;
	text-shadow: 0 0 16px #000000;
	}


/* Set height of the grid so .sidenav can be 100% (adjust if needed) */
.row.content {height: 1500px}

/* On small screens, set height to \'auto\' for sidenav and grid */
@media screen and (max-width: 767px) {
	.sidenav {
		height: auto;
		padding: 15px;
	}
	.row.content {height: auto;}
}

.timeline {
	list-style: none;
	padding: 20px 0 20px;
	position: relative;
	}

.timeline:before {
	top: 0;
	bottom: 0;
	position: absolute;
	content:" ";
	width: 3px;
	background-color: #eeeeee;
	left: 50%;
	margin-left: -1.5px;
	}

.timeline > li {
	margin-bottom: 20px;
	position: relative;
	}

.timeline > li:before, .timeline > li:after {
	content:" ";
	display: table;
	}

.timeline > li:after {
	clear: both;
	}

.timeline > li:before, .timeline > li:after {
	content:" ";
	display: table;
	}

.timeline > li:after {
	clear: both;
	}

.timeline > li > .timeline-panel {
	width: 46%;
	float: left;
	border: 1px solid #d4d4d4;
	border-radius: 2px;
	padding: 20px;
	position: relative;
	-webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
	box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}

.timeline > li > .timeline-panel:before {
	position: absolute;
	top: 26px;
	right: -15px;
	display: inline-block;
	border-top: 15px solid transparent;
	border-left: 15px solid #ccc;
	border-right: 0 solid #ccc;
	border-bottom: 15px solid transparent;
	content:" ";
}

.timeline > li > .timeline-panel:after {
	position: absolute;
	top: 27px;
	right: -14px;
	display: inline-block;
	border-top: 14px solid transparent;
	border-left: 14px solid #fff;
	border-right: 0 solid #fff;
	border-bottom: 14px solid transparent;
	content:" ";
}

.timeline > li > .timeline-badge {
	color: #fff;
	width: 50px;
	height: 50px;
	line-height: 50px;
	font-size: 1.4em;
	text-align: center;
	position: absolute;
	top: 16px;
	left: 50%;
	margin-left: -25px;
	background-color: #999999;
	z-index: 100;
	border-top-right-radius: 50%;
	border-top-left-radius: 50%;
	border-bottom-right-radius: 50%;
	border-bottom-left-radius: 50%;
}

.timeline > li.timeline-inverted > .timeline-panel {
	float: right;
}

.timeline > li.timeline-inverted > .timeline-panel:before {
	border-left-width: 0;
	border-right-width: 15px;
	left: -15px;
	right: auto;
}

.timeline > li.timeline-inverted > .timeline-panel:after {
	border-left-width: 0;
	border-right-width: 14px;
	left: -14px;
	right: auto;
}

.timeline-badge.primary {
	background-color: #2e6da4 !important;
}

.timeline-badge.success {
	background-color: #3f903f !important;
}

.timeline-badge.warning {
	background-color: #f0ad4e !important;
}

.timeline-badge.danger {
	background-color: #d9534f !important;
}

.timeline-badge.info {
	background-color: #5bc0de !important;
}

.timeline-title {
	margin-top: 0;
	color: inherit;
}

.timeline-body > p, .timeline-body > ul {
		margin-bottom: 0;
}

.timeline-body > p + p {
	margin-top: 5px;
}

@media (max-width: 767px) {
ul.timeline:before {
		left: 40px;
	}

	ul.timeline > li > .timeline-panel {
		width: calc(100% - 90px);
		width: -moz-calc(100% - 90px);
		width: -webkit-calc(100% - 90px);
	}

	ul.timeline > li > .timeline-badge {
		left: 15px;
		margin-left: 0;
		top: 16px;
	}

	ul.timeline > li > .timeline-panel {
		float: right;
	}

	ul.timeline > li > .timeline-panel:before {
		border-left-width: 0;
		border-right-width: 15px;
		left: -15px;
		right: auto;
	}

	ul.timeline > li > .timeline-panel:after {
		border-left-width: 0;
		border-right-width: 14px;
		left: -14px;
		right: auto;
	}

}

/* Universal styles */
.myShadow {
	-webkit-box-shadow: 10px 10px 21px 0px rgba(123,122,143,1);
	-moz-box-shadow: 10px 10px 21px 0px rgba(123,122,143,1);
	box-shadow: 10px 10px 21px 0px rgba(123,122,143,1);
	}

.bottom-align-text {
	position: absolute;
	bottom: 0;
	}

.charHex {
	position: absolute;
	left: -20px;
	bottom: -30px;
	}


.btn {
	padding: 14px 24px;
	border: 0 none;
	font-weight: 700;
	letter-spacing: 1px;
	text-transform: uppercase;
	}

.btn:focus, .btn:active:focus, .btn.active:focus {
	outline: 0 none;
	}

.btn-primary {
	background: #0099cc;
	color: #ffffff;
	}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
	background: #33a6cc;
	}

.btn-primary:active, .btn-primary.active {
	background: #007299;
	box-shadow: none;
	}

.btn.outline {
	background: none;
	padding: 12px 22px;
	}

.btn-primary.outline {
	border: 2px solid #0099cc;
	color: #0099cc;
	}

.btn-primary.outline {
	border: 2px solid #0099cc;
	color: #0099cc;
	}


/* for expanding text areas */
textarea{
		display:block;
		box-sizing: padding-box;
		overflow:hidden;

		padding:10px;
		font-size:14px;
		margin:50px auto;
	}

form div.row {margin-bottom: 5px;}

</style>
