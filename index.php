<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="format-detection" content="telephone=no">
  <title>Memory Game</title>
  <link href="assets/style.css" rel="stylesheet">
  <link href="assets/images/favicon.ico" rel="shortcut icon">
</head>
<body>
  <div class="scoreboard">
    <a href="#" class="solve">Solve the Puzzle</a>
    <div class="scores">
      <div class="team-a team">
        Team A: <span class="plus">+</span><span class="minus">-</span><span class="score">0</span>
      </div>
      <div class="team-b team">
        Team B: <span class="plus">+</span><span class="minus">-</span><span class="score">0</span>
      </div>
      <div class="team-c team">
        Team C: <span class="plus">+</span><span class="minus">-</span><span class="score">0</span>
      </div>
    </div>
  </div>
  <div class="message"></div>
  <div class="container">
    <?php 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // PATRICK GLEASON - LOOK HERE - YOU TOLD ME TO DO THIS BECAUSE YOU CAN'T READ BASIC HTML CODE
    // Modify the number within the function below named "generate_pieces" to a number divisible by 6
    // I can't guarantee this will work if you do something that's not divisible by 6 (6, 12, 18, or 24)
    // If you go past 24, it will probably go past the browser screen and be unusable


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    echo generate_pieces(12); ?>
  </div>
  <script src="assets/jquery-3.1.0.min.js"></script>
  <script src="assets/init.js"></script>
</body>
</html>

<?php 
function generate_pieces($number) {
  $total_count = 0;
  $count = 0;
  $row = 0;
  $game_pieces = '';
  $image_piece = 'assets/images/*-piece.jpg';
  $image_background = 'assets/images/*-background.jpg';
  $pieces_array = array();
  $backgrounds_array = array();
  // create array of available images to use as pieces
  foreach (glob($image_piece) as $image) {
    $pieces_array[] = $image;
  }
  // create array of available images to use as pieces
  foreach (glob($image_background) as $image) {
    $backgrounds_array[] = $image;
  }
  // double up the pieces so there are matches ;)
  $pieces_array = array_merge($pieces_array, $pieces_array);
  // randomize pieces
  shuffle($pieces_array);
  // randomize backgrounds
  shuffle($backgrounds_array);
  // make sure there are enough pieces in the array to create a board with the requested
  // number of pieces for the game board
  if($number > count($pieces_array)) {
    echo '<div class="message error">You do not have enough pieces to play. You are currently requesting a ' . $number . ' long board. Please upload ' . $number / 2 . ' pieces to the images folder.</div>';
    exit();
  }
  // for every piece, create the appropriate container for it
  foreach($pieces_array as $piece) {
    // increment the count of the number piece we are on
    $total_count++;
    // if its time for a new row, do it
    if($count == 0) {
      $game_pieces .= '<div class="row">';
      $row++;
    }
    // add the game piece
    $game_pieces .= '<div class="game-piece" data-image="' . $piece . '" data-number="' . $total_count . '"></div>';
    // increment terminal count
    $count++;
    // if the current piece count is cleanly divisible by 6, its time to close this row out
    if($total_count % 6 == 0) {
      $game_pieces .= '</div>';
      $count = 0;
    }
    // only put as many as indicated by the number given for the function
    if($total_count == $number) {
      break;
    }
  }
  // final game board
  $game_board = '<div class="hidden-image" style="background-image: url(\'' . $backgrounds_array[0] . '\');height:' . 175 * $row . 'px"></div>
    <div class="game-board" style="height:' . 175 * $row . 'px">' . $game_pieces . '</div>';
  // return the HTML container for the game board
  return $game_board;
}
?>