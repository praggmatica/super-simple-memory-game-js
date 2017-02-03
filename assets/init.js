$(document).ready(function() {
  // append numbers to the back of the cards
  $('.game-piece').append(function() {
    return '<div class="number">' + $(this).data('number') + '</div>';
  });
  // when a game piece is clicked
  $('.game-piece').click(function() {
    // we want to be able to reference the initially clicked piece later
    var clickedPiece = $(this);
    // set the background to the image assigned to this card, when its selected
    clickedPiece.css('background-image', 'url(\'' + clickedPiece.data('image') + '\')').addClass('opened-number').addClass('match');
    // matching logic
    // checks if any other game pieces are visible, so we can try to match
    if($('.game-piece.opened').length) {
      // if the background properties match (the same image url), then we have a match
      if(clickedPiece.data('image') == $('.game-piece.opened').data('image')) {
        $('.game-piece.opened').css('background-image', 'url(\'' + $('.game-piece.opened').data('image') + '\')').addClass('match');

        setTimeout(function() {
          $('.message').show().empty().removeClass('error').addClass('success').append('You got a match! Did they guess the puzzle? <a href="#" class="yes">Yes</a> | <a href="#" class="no">No</a>');
        }, 500);
      // otherwise, we don't have a match, reset the pieces
      } else {
        $('.game-piece.opened').css('background-image', 'url(\'' + $('.game-piece.opened').data('image') + '\')');

        setTimeout(function() {
          $('.message').show().empty().removeClass('success').addClass('error').append('No match! Try again.');
          // clears out only the two game pieces that were attempted to be matched
          $('.match').css('background-image','url(\'assets/images/card-back.jpg\')').removeClass('opened').removeClass('opened-number').removeClass('match');
          // clears out all game pieces back to having the card back
          //$('.game-piece').css('background-image','url(\'assets/images/card-back.jpg\')').removeClass('opened');
        }, 500);
      }
    // otherwise, there are no other game pieces open, so this is the first piece
    } else {
      $(this).addClass('opened');
    }
  });
  // check for a click on the yes option for a match
  $('body').on('click', '.yes', function() {
    $('.match').css('background','transparent').removeClass('opened').removeClass('match');
    $('.message').hide();
  });
  // check for a click on the no option for a match
  $('body').on('click', '.no', function() {
    $('.match').css('background-image','url(\'assets/images/card-back.jpg\')').removeClass('opened').removeClass('opened-number').removeClass('match');
    $('.message').hide();
  });
  // solve the puzzle
  $('.solve').click(function() {
    $('.game-piece').css('background','transparent');
    $('.number').hide();
  });
  // increase points
  $('.plus').click(function() {
    var element = $(this).siblings('.score');
    var score = parseInt(element.text());
    element.text(score+100);
  });
  // decrease points
  $('.minus').click(function() {
    var element = $(this).siblings('.score');
    var score = parseInt(element.text());
    element.text(score-100);
  });
});