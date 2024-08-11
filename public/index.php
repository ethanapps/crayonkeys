<html>
<head>
<title>Crayon Keys Typing Exercise - Give your fingers a workout!</title>
<meta name="description" content="Typing exercise that concentrates on problem words and slow keys.  Helps improve speed and accuracy.  Beginner to advanced.">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
@font-face {
  font-family: 'Ubuntu Mono';
  font-style: normal;
  font-weight: 400;
	src: url('fonts/Ubuntu.eot');
  src: local('Ubuntu Mono'), local('UbuntuMono-Regular'),
		url("fonts/Ubuntu.woff") format("woff"),
		url("fonts/Ubuntu.otf") format("opentype"),
		url('fonts/UbuntuMono-R.ttf') format('truetype');
}
</style>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="100" cellspacing="0"><tr><td>

<div id="temp" style="position:absolute; left:20px; top:30px; font:16px arial"></div>

<div id="data" style="position:absolute; left:20px; top:30px; font:13px arial; display:none"></div>
<div id="pulse" style="position:absolute; left:0px; top:0px; z-index:-1; display:none; width:51px; height:74px; overflow:hidden"><img id="pulse_img" src="images/pulse2.png" width="102" height="296" style="position:relative"></div>

<div id="type_div">
<pre id="text" style="font:25px consolas,'Ubuntu Mono','lucida console',monospace; line-height:250%; white-space:nowrap; text-align:center; color:#D0D0D0"></pre>

<div id="results" style="font:16px arial; text-align:center; margin-top:30px">&nbsp;</div>
</div>
</td></tr></table>

<div id="tooltip" style="position:absolute; bottom:60px; left:0px; text-align:center; width:100%; white-space:nowrap; font:16px arial; color:#303030"><span style="border:1px solid #A0A0A0; background:#F4F4F4; padding:6px 18px"><b>HINT:</b> Type like a robot, slowly and methodically</span></div>


<script language="JavaScript">
<!--
// Fix up prefixing
window.AudioContext = window.AudioContext || window.webkitAudioContext;

var doop_context = new AudioContext();
var doop_sound_buffer = 0;
var doop_delayed_play = -1;

function doop_load_audio(url)
{
	var request = new XMLHttpRequest();

	request.open('GET', url, true);
	request.responseType = 'arraybuffer';

	// Decode asynchronously
	request.onload = function() {
		doop_context.decodeAudioData(request.response, function(buffer) {

		doop_sound_buffer = buffer;

		if (doop_delayed_play >= 0)
		{
			doop_play(doop_delayed_play, 1);
			doop_delayed_play = -1;
		}

		}, onError);
	}
	request.send();
}

function doop_play(delayed)
{
	if (doop_sound_buffer)
	{
	  var source = doop_context.createBufferSource();
	  source.buffer = doop_sound_buffer;
	  source.connect(doop_context.destination);
		source.start();
	}
	else if (!delayed)
	{
		doop_delayed_play = 0;
	}
}

function onError()
{
debugger;
}

doop_load_audio('doop3.mp3');



var SEQUENCE_MIN = 30; // Min/max number of characters in sequence
var SEQUENCE_MAX = 36;

var WORD_MAX = 5; // Max number of words

var DELAY_MSEC = 900;//1850; // Wait milliseconds after completing sequence before starting new one

var SESSION_MSEC = 30*60*1000; // Start over after milliseconds of inactivity

var words = new Array('<?php print str_replace("\n", "','", preg_replace('/\n\n+/', "\n", preg_replace('/[^a-z\n]/', '', strtolower(trim(file_get_contents('typing_words.txt')))))); ?>');

for (var x = 0; x < words.length - 1; x++) // Randomize words
{
	var r = Math.floor(Math.random() * (words.length - x)) + x;

	var word = words[r];
	words[r] = words[x];
	words[x] = word;
}

var colors = [
	[[255,255,255]],
	[[255,255,255]],
	[[255,240,35], [119,255,255]],
	[[162,255,0], [250,179,255], [255,222,10], [111,238,255]],
	[[36,255,58], [251,145,255], [255,200,19], [5,230,255]],
	[[108,232,0], [255,101,252], [255,175,56], [60,206,255]],
	[[0,224,49], [255,10,251], [255,152,55], [55,185,255], [255,97,194], [0,212,166]],
	[[88,203,0], [220,20,255], [255,128,0], [21,165,255], [255,72,164]],
	[[0,193,35], [219,0,215], [255,95,9], [43,139,255], [255,51,105]],
	[[0,179,0], [194,0,208], [233,89,0], [0,117,252], [255,20,44]],
	[[0,160,59], [198,0,148], [209,87,0], [0,135,184], [230,0,46], [20,79,255], [125,0,250], [0,111,223]],
	[[15,148,0], [168,0,140], [193,71,0], [0,120,168], [214,0,21], [0,70,233]],
	[[0,131,24], [151,0,133], [163,71,0], [0,112,143], [188,0,28], [0,54,214]],
	[[0,117,2], [132,0,117], [151,55,0], [0,95,133], [168,0,11], [0,60,179]],
	[[0,99,15], [122,0,83], /*  */ [0,81,113], [144,0,10], [29,0,173]],
	[[110,37,0]],
	[[0,58,71]],
	[[56,34,0]],
	[[0,31,27]],
	[[23,0,25]],
	[[0,0,0]]];

// The key timings are adjusted according to placement on keyboard if the same finger is used twice in a row on different keys
var layouts = [
	['qaz','wsx','edc','rfv','tgb','yhn','ujm','ik,','ol.','p;/'], // Qwerty
	['\'a;',',oq','.ej','puk','yix','fdb','ghm','ctw','rnv','lsz']]; // Dvorak

// Below are rough multipliers for middle keys and others
var layouts_mid = [
{'rt':1.2, 'rg':1.4, 'rb':2.2, 'ft':1.4, 'fg':1.2, 'fb':1.8, 'vt':1.9, 'vg':1.1, 'vb':1.2, 'tr':1.2, 'tf':1.4, 'tv':1.9, 'gr':1.4, 'gf':1.2, 'gv':1.1, 'br':2.2, 'bf':1.8, 'bv':1.2, 'jy':1.5, 'jh':1.2, 'jn':1.1, 'uy':1.2, 'uh':1.4, 'un':1.9, 'my':2.2, 'mh':1.8, 'mn':1.2, 'yu':1.2, 'yj':1.4, 'ym':2.2, 'hu':1.4, 'hj':1.2, 'hm':1.8, 'nu':1.9, 'nj':1.1, 'nm':1.2, /* misc */ 'rc':1}];

var LAYOUT_BASE = 0.8; // The base number of exponent (lower will interpret keystrokes faster than reality)

function o(o) {return document.getElementById(o)}

var text = "";
var pos = 0;

var prev_time = 0;
var times = new Array(); // Timings for current sequence
var prev_times = new Array(); // Timings for previous sequence
var session_time = 0; // Combined timings for entire session (including retyped keys)
var session_count = 0; // Number of keys pressed in session

var char_time = new Array(); // Total character timings
var char_order = new Array(); // Highest timings first

var MIN_CHAR = 2; // Length of character sample (min/max)
var MAX_CHAR = 4;

var curr_char = MIN_CHAR; // Sample length for next sequence

for (var c = MIN_CHAR; c <= MAX_CHAR; c++)
{
	char_time[c] = new Object(); // Associative array
	char_order[c] = new Array();
}

var start_timer = 0;

var start_text = ''; // Sequence text at start
//var view_text = ''; // Text with problem keys obscured

var color_rand = new Array(); // Random value for character in sequence (this is to maintain the same color when typing)

var MATCH_LEN = 4; // Character sample length when checking for duplicate words in sequence

var AVG_MAX = 500; // Highest average (capped) when determining cursor color
var AVG_NUB = 425; // Lowest noob average


function key_down(e)
{
	if (start_timer) return false;

	if (e.keyCode == 8)
	{
		var first = 1;
		var is_space = (pos > 0 && text.charAt(pos - 1) == ' ');

		while (pos > 0 && (first || (is_space && text.charAt(pos - 1) == ' ')))
		{
			first = 0;
			pos--;

			times.pop();

			text = text.substr(0, pos)+start_text.charAt(pos)+text.substr(pos + 1);
		}

		prev_time = new Date().getTime();

		refresh_keys();

		return false;
	}
}

function key_press(e)
{
	if (start_timer) return;

	var code = e.keyCode;

if (code == 13) o('temp').innerHTML += '<br>';
	if (code < 32/* && code != 13*/) return;

	if (code >= 65 && code <= 90) // Caps Lock
	{
		code += 32;
	}

	var set_time = 1;

	if (text.charCodeAt(pos) != code) // Incorrectly typed
	{
		if (String.fromCharCode(code) == ' ') // Move cursor forward or backward
		{
			var word_start = pos;
			var word_end = pos;

			for (var x = pos; x >= 0; x--)
			{
				if (start_text[x] != ' ')
				{
					word_start = x;
				}
				else break;
			}

			for (var x = pos; x < text.length; x++)
			{
				if (start_text[x] != ' ')
				{
					word_end = x;
				}
				else break;
			}

			if ((pos - word_start) < (word_end - pos)) // Move to beginning of word
			{
				set_time = 0;

				times.splice(word_start - 1, times.length);

				pos = word_start;
				text = (pos > 0 ? text.substr(0, pos - 1)+' ' : text.substr(0, pos))+start_text.substr(pos);

				if (pos <= 0)
				{
					return;
				}
			}
			else // Move to next word
			{
				if (++word_end >= text.length)
				{
					word_end = text.length;
					set_time = 0;
				}

				text = text.substr(0, pos);

				for (var x = pos; x < word_end && x < start_text.length; x++)
				{
					text += ' ';
					times.push(-1);
				}

				text += (word_end < start_text.length ? ' ' : '')+start_text.substr(word_end + 1);
				pos = word_end;
			}
		}
		else text = text.substr(0, pos)+String.fromCharCode(code)+text.substr(pos + 1);
	}


	if (prev_time > 0)
	{
		var curr_time = new Date().getTime();

		session_time += (curr_time - prev_time);
		session_count++;
//o('temp').innerHTML += ' '+(curr_time - prev_time);

		if (set_time) times.push(curr_time - prev_time);
		prev_time = curr_time;
	}
	else prev_time = new Date().getTime();

	if (set_time) pos++;

	refresh_keys();


	if (pos >= text.length) // User completed sequence
	{
		tooltip_timer = setInterval('fade_tooltip()', 100);

		// Remove skipped keys
		var this_times = times;

		for (var x = this_times.length - 1; x >= 0; x--)
		{
			if (this_times[x] < 0)
			{
				this_times.splice(x, 1);
				text = text.substr(0, x + 1)+text.substr(x + 2);
			}
		}

		// Get average time for sequence
		var total_time = 0;

		for (var x = 0; x < this_times.length; x++)
		{
			total_time += this_times[x];
		}

		var avg_time = total_time / this_times.length;


		// Get individual key timings (samples are MIN_CHAR to MAX_CHAR characters long)
		for (var x = 0; x < this_times.length; x++)
		{
			for (var c = MIN_CHAR; c <= MAX_CHAR; c++)
			{
				if (x <= this_times.length - c)
				{
					var key = '';
					var time = 0;
					var has_space = 0;

					var prev_group = -1; // Key group in layout (Qwerty/Dvorak)
					var prev_index = -1;

					for (var i = 0; i < c; i++)
					{
						if (text[x + i + 1] == ' ')
						{
							has_space = 1;
							break;
						}

						var layout_mul = -1; // Multiplier to compensate for layout

						var two_keys = text[x + i]+text[x + i + 1];

						if (layouts_mid[0][two_keys])
						{
							layout_mul = Math.pow(LAYOUT_BASE, ((layouts_mid[0][two_keys] - 1) / 2) + 1);
						}

						var layout = layouts[0];

						for (var l = 0; l < layout.length; l++)
						{
							var index = layout[l].indexOf(text[x + i + 1]);

							if (index >= 0)
							{
								if (layout_mul < 0 && prev_group >= 0 && prev_group == l && prev_index != index)
								{
									layout_mul = Math.pow(LAYOUT_BASE, ((Math.abs(prev_index - index) - 1) / 2) + 1);
								}

								prev_group = l;
								prev_index = index;

								break;
							}
						}

						key += text[x + i + 1];
						time += this_times[x + i] / Math.pow(c - i, 2.5) * (layout_mul >= 0 ? layout_mul : 1);
					}

					if (has_space) break;

					time /= avg_time;

					var key_exists = char_time[c][key];

					if (key_exists)
					{
						time += (char_time[c][key] - time) * 0.8; // Higher exponent=closer to old strokes

						// Remove from sorted list
						for (var d = 0; d < char_order[c].length; d++)
						{
							if (char_order[c][d] == key)
							{
								char_order[c].splice(d, 1);
								break;
							}
						}
					}

					char_time[c][key] = time;

					// Add to sorted list
					for (var d = 0; d < char_order[c].length; d++)
					{
						if (char_time[c][char_order[c][d]] < time)
						{
							break;
						}
					}

					char_order[c].splice(d, 0, key);
				}
			}
		}


		// Get next sequence
		get_sequence();

		return false;
	}

	if (code == 32) return false;
}

var tooltip_pos = 100;
var tooltip_timer = 0;

function fade_tooltip()
{
	tooltip_pos -= 25;

	o('tooltip').style.opacity = tooltip_pos / 100;

	if (tooltip_pos <= 0)
	{
		o('tooltip').style.display = 'none';

		clearTimeout(tooltip_timer);
		tooltip_timer = 0;
	}
}

var miss_pos = -1; // Character index of missed key
var pulse_frame = 0; // Current frame of pulse animation
var pulse_timer = 0;

function ani_pulse()
{
	if (miss_pos < 0 || ++pulse_frame > 4)
	{
		clearInterval(pulse_timer);
		pulse_timer = 0;

		o('pulse').style.display = 'none';
		return;
	}

	o('pulse').style.left = (o('l'+miss_pos).offsetLeft - 25)+'px';
	o('pulse').style.top = (o('l'+miss_pos).offsetTop - 22)+'px';
	o('pulse_img').style.top = (-((pulse_frame - 1) * 74))+'px';
	o('pulse').style.display = '';
}

var div_str = ''; // HTML of current sequence

function refresh_keys()
{
	var min = -1;
	var max = Math.max.apply(Math, times);

	for (var x = 0; x < times.length; x++)
	{
		if (times[x] >= 0 && (min < 0 || times[x] < min)) min = times[x];
	}


	// Set cursor color depending on average speed
	var avg = (prev_times.length > 0 ? Math.min(session_time / session_count * 1.8, AVG_MAX) : 425);

	var cursor_r = parseInt((avg < AVG_NUB ? 0 : 255) * avg / AVG_MAX); // Red #D9002B blue #0087B8
	var cursor_g = parseInt((avg < AVG_NUB ? 162 : 0) * avg / AVG_MAX);
	var cursor_b = parseInt((avg < AVG_NUB ? 255 : 51) * avg / AVG_MAX);


	// Update letter colors
	div_str = '';
	var has_miss = 0;

	for (var x = 0; x < pos; x++)
	{
		if (pos < text.length)
		{
			min = 0;
			max = 0;

			var sampled = 0;
			var i = 0;

			while (sampled < 12 && i < 100)
			{
				if (x - i >= 0)
				{
					if (times[x - i] >= 0)
					{
						if (min <= 0 || times[x - i] < min) min = times[x - i];
						if (max <= 0 || times[x - i] > max) max = times[x - i];
						sampled++;
					}
				}
				else if (prev_times.length > 0)
				{
					var p = prev_times.length - (i - x);

					if (prev_times[p] >= 0)
					{
						if (min <= 0 || prev_times[p] < min) min = prev_times[p];
						if (max <= 0 || prev_times[p] > max) max = prev_times[p];
						sampled++;
					}
				}
				else break;

				i++;
			}

			if (x <= 5 && prev_times.length <= 0 && max < 10000)
			{
				max = 10000;
			}
		}

		var time = (x > 0 ? times[x - 1] : min + ((max - min) / 2));

		if (time < 0)
		{
			div_str += ' ';
			continue;
		}

		var base = 196;//216;

		var col = base - Math.round((pos >= text.length ? base : 50) * Math.pow(time / max, (pos >= text.length ? 3.4 : 20))); // Higher exponent=lighter and more contrast
		if (pos <= 1) col = base;

		var rgb = 'rgb('+col+','+col+','+col+')';

		if (pos >= text.length)
		{
			var col2 = 150 - Math.round(150 * Math.pow(time / max, 1));

			var col_index = 12 - Math.round(col2 / 255 * 12);
			if (col_index < 0) col_index = 0;
			if (col_index > 20) col_index = 20;

			var col_group = colors[col_index];

			var rgb_array = col_group[Math.floor(color_rand[x] * col_group.length)];

			var r = Math.round(col + ((rgb_array[0] - col) * Math.pow(min / max, 2.1))); // Higher exponent=grayer
			var g = Math.round(col + ((rgb_array[1] - col) * Math.pow(min / max, 2.1)));
			var b = Math.round(col + ((rgb_array[2] - col) * Math.pow(min / max, 2.1)));

			rgb = 'rgb('+r+','+g+','+b+')';
		}

		if (text.charAt(x) != start_text.charAt(x)) // Missed letter
		{
			if (!has_miss)
			{
				has_miss = 1;

				if (miss_pos < 0 || miss_pos < x)
				{
					miss_pos = x;
					pulse_frame = 0;

					o('pulse_img').style.left = (1/*avg < AVG_NUB*/ ? '-51px' : '');

					pulse_timer = setInterval('ani_pulse()', 60);
					doop_play();
				}
			}
		}
		else if (text.charAt(x) == ' ') // Only reset if new word (to prevent multiple pulse animations in a word)
		{
			has_miss = 0;
		}

		div_str += "<font id=\"l"+x+"\" style=\"color:"+rgb+"; padding-bottom:4px; position:relative\">"+(text.charAt(x) == ' ' && pos >= text.length ? '_' : text.charAt(x))+"</font>";
	}

	var cursor_rgb = '#0087B8';//"rgb("+cursor_r+','+cursor_g+','+cursor_b+")";

	div_str += "<font style=\"border-bottom:2px solid "+cursor_rgb+"; color:#000000; padding-bottom:4px\">"+text.substr(pos, 1)+"</font><font style=\"color:#000000; padding-bottom:4px\">"+text.substr(pos + 1)+"</font>";

	o('text').innerHTML = div_str;
}

var reset_timer = 0;

function reset_session()
{
	var curr_time = new Date().getTime();

	if (curr_time - prev_time < 60*1000) // Check if any input past minute
	{
		reset_timer = setTimeout('reset_session()', SESSION_MSEC);
		return;
	}

	window.location.reload(false);
}

function start()
{
	start_timer = 0;

	o('text').innerHTML = start_text = text;
	pos = 0;
	prev_time = 0;
	prev_times = times;
	times = new Array();

	miss_pos = -1;

	refresh_keys();

	if (reset_timer) clearTimeout(reset_timer);
//	reset_timer = setTimeout('reset_session()', SESSION_MSEC);

	color_rand = new Array();

	for (var x = 0; x < text.length; x++)
	{
		color_rand.push(Math.random());
	}
}

function show_data()
{
	var str = '';
	var prev_char = curr_char;

	// Worst keys
	for (var c = MIN_CHAR; c <= MAX_CHAR; c++)
	{
		str +=
			"<div style=\"float:left; padding-right:30px\">\n"+
			"<b"+(c == prev_char && char_order[c].length > 0 ? " style=\"color:#0F76D6\"" : '')+">Key "+c+"</b><br>\n";

		for (var x = 0; x < char_order[c].length && x < 8; x++)
		{
			str += char_order[c][x]+"<br>\n";
		}

		str += "</div>\n";
	}

	o('data').innerHTML = str;
}

var next_seq = '';

function get_sequence()
{
	show_data();

	if (next_seq)
	{
		text = next_seq;
		next_seq = '';

		start();
		return;
	}

	var seq = new Array(0);
	var len = -1;
	var keys = new Array(0);


	// Get problem words
	var key_pos = 0;
	var word_start = 0;

	while (seq.length < WORD_MAX && len < SEQUENCE_MAX)
	{
		var word_id = word_start;
		var key = char_order[curr_char][key_pos];

		if (key)
		{
			var has_word = 0;

			for (var x = word_start; x < (words.length - seq.length); x++)
			{
				if (words[x].indexOf(key) >= 0)
				{
					word_id = x;
					has_word = 1;

					keys.push(key);

					break;
				}
			}

			if (!has_word || word_id > (words.length * 0.7) || curr_char != MIN_CHAR || seq.length >= 2)
			{
				word_start = 0;
				key_pos++;

				if (!has_word) continue;
			}
		}

		// Check length
if (!words[word_id])
{
debugger;
}
		if (len + 1 + words[word_id].length <= SEQUENCE_MAX)
		{
			// Skip if word resembles another
			var word_match = 0;

			for (var i = 0; i < words[word_id].length - MATCH_LEN || i <= 0; i++)
			{
				var str = words[word_id].substr(i, MATCH_LEN);

				for (var x = 0; x < seq.length; x++)
				{
					if (seq[x].indexOf(str) >= 0)
					{
						word_start = word_id + 1;
						word_match = 1;

						break;
					}
				}

				if (word_match) break;
			}

			if (word_match) continue;

			seq.push(words[word_id]); // Add to sequence
			len += 1 + words[word_id].length;

			words.push(words[word_id]); // Shift word to end
			words.splice(word_id, 1);

			word_start = 0;
		}
		else if (len < SEQUENCE_MIN)
		{
			word_start = word_id + 1;

			if (word_start >= (words.length - seq.length)) break;
		}
		else break;
	}

	for (var x = 0; x < seq.length - 1; x++) // Randomize words
	{
		var r = Math.floor(Math.random() * (seq.length - x)) + x;

		var val = seq[r];
		seq[r] = seq[x];
		seq[x] = val;
	}

	text = seq.join(' ');


	// Delay next sequence
	var curr_time = new Date().getTime();
	var lapsed = curr_time - prev_time;

	if (lapsed < DELAY_MSEC)
	{
		start_timer = setTimeout('start()', DELAY_MSEC - lapsed);
	}
	else start();

	if ((key_pos > 0 || curr_char == MIN_CHAR) && ++curr_char > MAX_CHAR)
	{
		curr_char = MIN_CHAR;
	}
}

get_sequence();

document.onkeydown=key_down;
document.onkeypress=key_press;
//-->
</script>

</body>
</html>

