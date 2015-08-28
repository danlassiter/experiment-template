Psychosemantics Web-Based Experimental Template
    (Formerly "MTurk Experimental Template")
Version 1.1, August 27, 2015

Dan Lassiter
Department of Linguistics and CSLI, Stanford University
http://web.stanford.edu/~danlass/
Email: 'dan' followed by 'lassiter', then the ‘at’ sign, and finally 'stanford.edu'.

INTRODUCTION

This is our template for writing experiments in HTML/JavaScript/CSS. These can either be posted as external HITs on Amazon’s Mechanical Turk (MTurk), or (in a new feature added in August 2015) posted to another server that you specify. The latter change was made in response to recent changes at Amazon that have made MTurk more expensive and difficult to use if you are not in the US.

It is not functional as-is: you have to know enough HTML and JavaScript to add content to it, using the hints provided in the comments. If you know the basics of these and a little bit about JQuery, you should be ready to go. The examples below may also be helpful.  

If you know some JavaScript but no JQuery, you can try to hack it out using the examples as a guide, or go through CodeSchool's very good, free interactive course (http://try.jquery.com/). For graphics, there are lots of options. I'm fond of Raphael.js, and have included in the HTML comments a few lines that can be used if you want to try it out. 

EXAMPLES

For inspiration, or if you want to modify code instead of starting from scratch, here are a few examples of experiments that have been written and run using the Template-Submiterator-mmturkey workflow:

A simple text-based reasoning experiment (see Lassiter & Goodman 2014 in Cognition): 
    http://web.stanford.edu/~danlass/experiment/animals/animals.html
    paper: http://web.stanford.edu/~danlass/Lassiter-Goodman-reasoning.pdf

A survey with a graphical component (Nadathur & Lassiter in Proceedings of Sinn und Bedeutung 2014):
    http://web.stanford.edu/~danlass/experiment/marbles/marbles.html
    paper: http://web.stanford.edu/~danlass/Nadathur-Lassiter-unless-SuB.pdf

USING TOGETHER WITH SUBMITERATOR TO CREATE EXTERNAL HITs ON AMAZON MECHANICAL TURK 

If you have a functioning experiment written in this style, it's easy to plug it in as an External HIT on MTurk. (At least, easy as of 8.27.15; things seem to be evolving rapidly at Amazon lately, so please do let me know if something breaks.) Just use Submiterator along with mmturkey (https://github.com/longouyang/mmturkey, or the modified version included here). Full details of how to submit external HITs can be found here, along with Submiterator itself and several useful supporting tools.

	https://github.com/danlassiter/Submiterator/

USING TO POST DATA TO YOUR OWN SERVER

In a new feature, this update includes a modified version of Long Ouyang's mmturkey to POST data to a server, and a tiny PHP script to process the data into a .csv file. If you have access to a server that can handle PHP, it's easy to create a (very) basic system for receiving and storing experimental data. 

This is particularly useful if you don't have access to MTurk (e.g., if you are not in the USA), or if you're studying a language whose users are not found on that platform in sufficient numbers. In such cases, you may wish to recruit participants via personal contacts or social media. This workflow allows you to design your survey/experiment in exactly the same way that you would if you were using MTurk, but deposit the data at a place of your choosing without using Amazon as an intermediary.

Step 1: Copy the file "process.php" to an appropriate location on your server.
Step 2: Find and record the URL that "process.php" now lives at. 
Step 3: Open the "template.js" file and uncomment the first two lines.
Step 4: Give your experiment a unique name by setting the "experimentName" variable on line 1. This name will be used by the .php script to decide whether two sets of results belong to the same or different experiments. (This name MUST BE NEW for each experiment, or you risk losing data or munging up the results of two experiments. )
Step 5: Enter the URL you recorded above as the value of the "submitAddress" variable on line 2.
Step 6: Find appropriate participants for your experiment and convince them to take it.
Step 7: Look in the folder where you stored "process.php" to find your a folder called "experimentalData". Your results will be inside, in .csv format.

QUESTIONS OR COMMENTS?

You can contact me at the address at top of this file.

Happy experimenting!

About us:

The Psychosemantics Lab (PI: Dan Lassiter) is dedicated to exploring meaning as a cognitive science problem, using behavioral experiments and modeling tools from formal linguistics, logic, and computational cognitive science. It is located at Stanford’s Center for the Study of Language and Information and is affiliated with the Department of Linguistics. It is in no way affiliated with the Jerry Fodor book, alt-rock group, or hypnosis technique of the same name.
