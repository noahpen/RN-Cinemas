function imageMovieDetails(movieID) {
	window.open(`movie-details.php?movieID=${movieID}`,"_self");
}

function convertTime(minutes) {
    var h = Math.floor(minutes / 60);
    var m = minutes % 60;
    h = h < 10 ? '0' + h : h;
    m = m < 10 ? '0' + m : m;
    return h + ':' + m;
  }

function buyTicketMovieDetails(movieID) {
	window.open(`buy-tickets.php?movieID=${movieID}`,"_self");
}

function buyTicketSearch(cineplexID, movieID) {
	window.open(`buy-tickets.php?movieID=${movieID}&${cineplexID}`,"_self");
}