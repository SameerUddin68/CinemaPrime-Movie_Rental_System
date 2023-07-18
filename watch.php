<!DOCTYPE html>
<html>
<head>
    <title>Playing..</title>

</head>
<body>
    <div style="width: 600px;
    margin: 0 auto;" id="player">
        <video style="width: 100%;" id="video-player" src="res/videos/movie2.webm"></video>
        <div style="display: flex;
    align-items: center;" id="controls">
            <button style="font-size: 24px;
    padding: 10px;" id="play-pause-btn">&#9658;</button>
            <div style="flex: 1;
    height: 5px;
    background-color: #ddd;
    margin: 0 10px;" id="progress-bar">
                <div style=" height: 100%;
    background-color: #ff0000;
    width: 0;" id="progress"></div>
            </div>
            <div style="font-size: 12px;" id="time-display">
                <span id="current-time">00:00</span> / <span id="duration">00:00</span>
            </div>
        </div>
    </div>

</body>
</html>


<script>
    var videoPlayer = document.getElementById('video-player');
var playPauseButton = document.getElementById('play-pause-btn');
var progressBar = document.getElementById('progress');
var currentTimeDisplay = document.getElementById('current-time');
var durationDisplay = document.getElementById('duration');

playPauseButton.addEventListener('click', function() {
    if (videoPlayer.paused || videoPlayer.ended) {
        videoPlayer.play();
        playPauseButton.innerHTML = '&#10074;&#10074;'; // pause button
    } else {
        videoPlayer.pause();
        playPauseButton.innerHTML = '&#9658;'; // play button
    }
});

videoPlayer.addEventListener('timeupdate', function() {
    var progress = (videoPlayer.currentTime / videoPlayer.duration) * 100;
    progressBar.style.width = progress + '%';

    var currentTime = formatTime(videoPlayer.currentTime);
    currentTimeDisplay.textContent = currentTime;
});

videoPlayer.addEventListener('durationchange', function() {
    var duration = formatTime(videoPlayer.duration);
    durationDisplay.textContent = duration;
});

function formatTime(timeInSeconds) {
    var minutes = Math.floor(timeInSeconds / 60);
    var seconds = Math.floor(timeInSeconds % 60);
    return padZero(minutes) + ':' + padZero(seconds);
}

function padZero(num) {
    return (num < 10) ? '0' + num : num;
}
 
</script>
