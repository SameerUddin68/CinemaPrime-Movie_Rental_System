function validateReview() {
    var textarea = document.getElementById('review'); // Update 'movie_review' to 'review'
    var wordCount = textarea.value.trim().split(/\s+/).length;

    // Adjust the minimum word limit as needed (e.g., 10 in this case)
    var minimumWordLimit = 10;

    if (wordCount < minimumWordLimit) {
        alert('Your review must have at least ' + minimumWordLimit + ' words.');
        return false;
    }

    return true;
}

