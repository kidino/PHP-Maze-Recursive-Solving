<?php
/*
	Author : Khairil Iszuddin Ismail
	Date   : 2013-07-31, 12:38PM +8 GMT
	Web    : http://IszuddinIsmail.com
	
	ABOUT
	=====
	This was written as a submission to a programming challenge
	at http://challenge.lizard-apps.com/

	HOW TO USE 
	==========
	In a Windows environment, assuming that you have php in
	your PATH settings, you just need to run the following
	command in the command prompt
	
	php maze.php < maze1.txt
	php maze.php < maze2.txt
	php maze.php < maze3.txt
	
	CREDIT
	======
	I had a rough idea on how to solve this. But my recursion
	didn't work at first. Then I searched the web for maze
	solving algorithm. And I found this.
	
	http://www.cs.bu.edu/teaching/alg/maze/
	
	This is my PHP implementation of Recursion: Solving a Maze
	by Robert I. Pitts of Boston University.

*/

// getting STDIN input
$in = fopen('php://stdin', 'r');
$x = 0; $maze = array();
while(!feof($in)){
    $line = trim(fgets($in, 4096));
	for($y = 0; $y < strlen($line); $y++ ) {
		$maze[$x][$y] = $line[$y];
		if ( $line[$y] == 'S') { $s_x = $x; $s_y = $y; }
	}
	$x++;
}

// maze search function
function search_path($x, $y) {	
	global $maze;
	if (!isset($maze[$x][$y])) { return false; }
	if ($maze[$x][$y] == 'E') { return true; }
	if (($maze[$x][$y] != ' ')
	&&($maze[$x][$y] != 'S')) { return false; }
	
	$maze[$x][$y] = '.';
	
	if (search_path($x, $y+1)) { return true; }
	if (search_path($x+1, $y)) { return true; }
	if (search_path($x-1, $y)) { return true; }
	if (search_path($x, $y-1)) { return true; }
	
	$maze[$x][$y] = 'x';	
	return false;
}

// let's search the maze!
search_path($s_x, $s_y);
$maze[$s_x][$s_y] = 'S';
$output = '';
foreach($maze as $line) { $output .= implode('',$line)."\n"; }
echo str_replace('x',' ',$output);
?>