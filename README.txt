Psychosemantics Web-Based Experiment Template
    (Formerly "MTurk Experiment Template")
Version 1.1, August 27, 2015

Dan Lassiter
Department of Linguistics and CSLI, Stanford University
http://web.stanford.edu/~danlass/
Email: 'dan' followed by 'lassiter', then the ‘at’ sign, and finally 'stanford.edu'.

INTRODUCTION

This is our template for writing experiments in HTML/JavaScript/CSS. These can either be posted as external HITs on Amazon’s Mechanical Turk (MTurk), or (in a new, experimental feature added in August 2015) posted to another server that you specify. The latter change was made in response to recent changes at Amazon that have made MTurk more expensive and difficult to use if you are not in the US.

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

In a new feature, this update includes a modified version of Long Ouyang's mmturkey to POST data to a server, and a tiny PHP script to process the data into a .csv file. If you have access to a server that can handle PHP, it should be fairly easy to create a very basic system for receiving and storing experimental data. 

This is particularly useful if you don't have access to MTurk (e.g., if you are not in the USA), or if you're studying a language whose users are not found on that platform in sufficient numbers. In such cases, you may wish to recruit participants via personal contacts or social media. This workflow allows you to design your survey/experiment in exactly the same way that you would if you were using MTurk, but deposit the data at a place of your choosing without using Amazon as an intermediary.

(Note: This feature has not been extensively field-tested, so it may still be buggy. Please do let me know if you find issues.)

In order to make your life easier, the PHP script included here will take appropriately formatted data and convert it directly into a "Tidy Data"-style .csv file that can be read into R. HOWEVER, in order to do this, the script makes some very strong assumptions about the way that your experimental data  is being recorded within your JavaScript. Specifically, the data should be recorded as an object (i.e., dictionary/associative array) with

    - all subject-level data recorded in ordinary key-value format, with informative key names
    - each trial's data recorded as a separate object, with each data point given an informative key name

So, for example, the following is a legal way to package your data to be passed to the server using the line 'turk.submit(data);'. Anything else will (probably) break the PHP.

data = {
    'nativeLanguage': 'Spanish',
    'age': 35,
    'comments': 'None. Great survey!'
    'trial1': {
        'rt': 8492,
        'filler': 'no',
        'condition': 'every',
        'response': 'disagree',
        ...
    },
    'trial2': {
        'rt': 8492,
        'filler': 'yes',
        'condition': 'happy',
        'response': 'NA',
        ...
    },
    ...
}

Caveats: 
    - the script will ignore the keys that you assign to individual trials. (So, don't rely on this to record trial order; add trial number in as a separate trial-level variable instead.) 
    - make sure that ALL OF YOUR TRIALS record EXACTLY THE SAME VARIABLES. If it doesn't make sense to record some variable on a given trial, then record it as "NA".
    - if you have free-responses as part of your experiment, you will have to ensure that they do not contain either of the following characters: colon (':') and comma (','). If they do, the PHP will be unable to parse your data correctly. Deal with this by removing/replacing these characters in your JavaScript. For example, suppose I have recorded the value of some text field in a variable 'comments'. It is very likely that some of my participants will use one or both of these characters. So, instead of recording it using something like 
        > data['comments'] = comments;
    I would record the result of replacing these characters with something safe, like
        > comments = comments.replace(',', ' COMMA ')
        > comments = comments.replace(':', ' COLON ')
        > data['comments'] = comments;

Step-by-step instructions for use (assuming you have a PHP server):

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
