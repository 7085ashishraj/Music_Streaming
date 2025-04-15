


// Player state management
const playerState = {
  currentSongIndex: 0,
  playlist: [],
  player: null,
  isPlaying: false,
  isPlayerReady: false,
  durationInterval: null,
  lastUpdateTime: 0,
  isDraggingProgress: false
};

// Initialize YouTube Player
function initializeYouTubePlayer() {
  return new Promise((resolve) => {
    window.onYouTubeIframeAPIReady = function() {
      playerState.player = new YT.Player('player', {
        height: '0',
        width: '0',
        playerVars: {
          'autoplay': 1,
          'controls': 0,
          'disablekb': 1,
          'fs': 0,
          'rel': 0,
          'enablejsapi': 1
        },
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange,
          'onError': (error) => {
            console.error('Player error:', error);
          //   showMessage('Skipping to next song...', 'error');
            playNextSong();
          }
        }
      });
      resolve();
    };

    // Load YouTube IFrame API
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  });
}

// Timer functions
function startTimerUpdates() {
  stopTimerUpdates(); // Clear any existing interval
  updateTimerDisplay(); // Immediate first update
  playerState.durationInterval = setInterval(updateTimerDisplay, 200); // More frequent updates
}

function stopTimerUpdates() {
  if (playerState.durationInterval) {
    clearInterval(playerState.durationInterval);
    playerState.durationInterval = null;
  }
}

function updateTimerDisplay() {
  // Don't update if user is dragging progress bar
  if (playerState.isDraggingProgress || !playerState.player || !playerState.isPlaying) return;
  
  try {
    const currentTime = playerState.player.getCurrentTime();
    const duration = playerState.player.getDuration();
    
    // Only update if time actually changed
    if (currentTime !== playerState.lastUpdateTime && !isNaN(currentTime) ){
      document.getElementById('current-time').textContent = formatTime(currentTime);
      document.getElementById('duration').textContent = formatTime(duration);
      
      // Update progress bar if not being interacted with
      const progressBar = document.getElementById('progress-bar');
      if (!progressBar.matches(':active')) {
        progressBar.value = (currentTime / duration) * 100;
      }
      
      playerState.lastUpdateTime = currentTime;
    }
  } catch (error) {
  //   console.error('Timer update error:', error);
  }
}

function formatTime(seconds) {
  if (isNaN(seconds)) return "0:00";
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
}

// Player event handlers
function onPlayerReady(event) {
  console.log('YouTube Player ready');
  playerState.isPlayerReady = true;
  
  // Set up progress bar events
  const progressBar = document.getElementById('progress-bar');
  progressBar.addEventListener('input', () => {
    playerState.isDraggingProgress = true;
  });
  
  progressBar.addEventListener('change', () => {
    if (playerState.isPlayerReady && playerState.playlist.length) {
      const seekTo = (progressBar.value / 100) * playerState.player.getDuration();
      playerState.player.seekTo(seekTo, true);
    }
    playerState.isDraggingProgress = false;
  });

  // Try autoplay
  event.target.playVideo().catch(error => {
    console.log('Autoplay blocked:', error);
    showMessage('Click play button to start music', 'info');
  });
}

function onPlayerStateChange(event) {
  console.log('Player state:', event.data);
  switch(event.data) {
    case YT.PlayerState.PLAYING:
      playerState.isPlaying = true;
      document.getElementById('play-btn').innerHTML = '<i class="fas fa-pause"></i>';
      startTimerUpdates();
      break;
      
    case YT.PlayerState.PAUSED:
      playerState.isPlaying = false;
      document.getElementById('play-btn').innerHTML = '<i class="fas fa-play"></i>';
      stopTimerUpdates();
      break;
      
    case YT.PlayerState.ENDED:
      playNextSong();
      break;
      
    case YT.PlayerState.BUFFERING:
      document.getElementById('current-time').textContent = '0.00';
      break;
      
    case YT.PlayerState.CUED:
      console.log('Video cued');
      break;
  }
}

// ... [Rest of your existing player.js code remains the same] ...
// Timer functions
function startTimerUpdates() {
  stopTimerUpdates(); // Clear any existing interval
  playerState.durationInterval = setInterval(updateTimerDisplay, 500);
  updateTimerDisplay(); // Immediate update
}

function stopTimerUpdates() {
  if (playerState.durationInterval) {
    clearInterval(playerState.durationInterval);
    playerState.durationInterval = null;
  }
}

function updateTimerDisplay() {
  if (!playerState.player) return;
  
  try {
    const currentTime = playerState.player.getCurrentTime();
    const duration = playerState.player.getDuration();
    
    // Only update if time changed (reduces DOM updates)
    if (currentTime !== playerState.lastUpdateTime) {
      document.getElementById('current-time').textContent = formatTime(currentTime);
      document.getElementById('duration').textContent = formatTime(duration);
      document.getElementById('progress-bar').value = (currentTime / duration) * 100;
      playerState.lastUpdateTime = currentTime;
    }
  } catch (error) {
    console.error('Timer update error:', error);
  }
}

function formatTime(seconds) {
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
}

// Queue management
function processPendingQueue() {
  while (playerState.pendingQueue.length > 0) {
    const action = playerState.pendingQueue.shift();
    try {
      action();
    } catch (error) {
      console.error('Queue processing error:', error);
    }
  }
}

// Playback control functions
function playSong(index) {
  if (!playerState.playlist.length || index < 0 || index >= playerState.playlist.length) {
    console.warn('Invalid song index');
    return;
  }
  
  playerState.currentSongIndex = index;
  const song = playerState.playlist[index];
  
  // Update UI
  document.getElementById('song-title').textContent = song.title;
  document.getElementById('song-artist').textContent = song.artist;
  document.getElementById('song-thumbnail').src = `https://img.youtube.com/vi/${song.youtube_id}/mqdefault.jpg`;
  
  const playAction = () => {
    if (playerState.isPlayerReady) {
      playerState.player.loadVideoById({
        videoId: song.youtube_id,
        suggestedQuality: 'small'
      });
      
      // Attempt autoplay with slight delay
      setTimeout(() => {
        playerState.player.playVideo().catch(error => {
          console.log('Autoplay blocked:', error);
          showMessage('Click play button to start music', 'info');
        });
      }, 500);
    }
  };
  
  if (playerState.isPlayerReady) {
    playAction();
  } else {
    playerState.pendingQueue.push(playAction);
  }
  
  updatePlaylistUI();
}

function togglePlayPause() {
  if (!playerState.isPlayerReady) {
    showMessage('Player still loading...', 'info');
    return;
  }
  
  if (playerState.isPlaying) {
    playerState.player.pauseVideo();
  } else {
    playerState.player.playVideo().catch(() => {
      showMessage('Click anywhere to enable audio', 'info');
    });
  }
}

function playNextSong() {
  const nextIndex = (playerState.currentSongIndex + 1) % playerState.playlist.length;
  playSong(nextIndex);
}

function playPreviousSong() {
  const prevIndex = (playerState.currentSongIndex - 1 + playerState.playlist.length) % playerState.playlist.length;
  playSong(prevIndex);
}

// Playlist management
async function loadSongsByMood(mood) {
  try {
    const moodBtn = document.querySelector(`.mood-btn[data-mood="${mood}"]`);
    const originalContent = moodBtn.innerHTML;
    moodBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
    
    const response = await fetch(`php/songs.php?mood=${mood}`);
    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    
    const songs = await response.json();
    moodBtn.innerHTML = originalContent;
    
    if (!songs?.length) {
      showMessage('No songs found for this mood', 'error');
      return;
    }
    
    playerState.playlist = songs;
    playerState.currentSongIndex = 0;
    document.getElementById('player-section').classList.remove('hidden');
    playSong(0);
    
  } catch (error) {
    console.error('Error loading songs:', error);
    showMessage('Failed to load songs. Please try again.', 'error');
  }
}

function updatePlaylistUI() {
  const playlistElement = document.getElementById('playlist');
  playlistElement.innerHTML = '';
  
  playerState.playlist.forEach((song, index) => {
    const li = document.createElement('li');
    li.className = `flex items-center p-2 rounded cursor-pointer ${index === playerState.currentSongIndex ? 'bg-gray-700' : 'hover:bg-gray-700'}`;
    li.innerHTML = `
      <img src="https://img.youtube.com/vi/${song.youtube_id}/default.jpg" class="w-10 h-10 rounded mr-3">
      <div class="flex-1">
        <p class="font-medium">${song.title}</p>
        <p class="text-sm text-gray-400">${song.artist}</p>
      </div>
      <span class="text-sm text-gray-400">${formatTime(180)}</span>
    `;
    li.addEventListener('click', () => playSong(index));
    playlistElement.appendChild(li);
  });
}

// Helper functions
function showMessage(message, type) {
  const messageDiv = document.createElement('div');
  messageDiv.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'error' ? 'bg-red-500' : 'bg-blue-500'} text-white`;
  messageDiv.textContent = message;
  document.body.appendChild(messageDiv);
  
  setTimeout(() => messageDiv.remove(), 3000);
}

// Initialize application
document.addEventListener('DOMContentLoaded', async () => {
  try {
    await initializeYouTubePlayer();
    
    // Mood selection
    document.querySelectorAll('.mood-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const mood = btn.getAttribute('data-mood');
        loadSongsByMood(mood);
      });
    });
    
    // Player controls
    document.getElementById('play-btn').addEventListener('click', togglePlayPause);
    document.getElementById('next-btn').addEventListener('click', playNextSong);
    document.getElementById('prev-btn').addEventListener('click', playPreviousSong);
    
    // Progress bar seeking
    document.getElementById('progress-bar').addEventListener('input', (e) => {
      if (playerState.isPlayerReady && playerState.playlist.length) {
        const seekTo = (e.target.value / 100) * playerState.player.getDuration();
        playerState.player.seekTo(seekTo, true);
      }
    });
    
    // Handle autoplay restrictions
    document.addEventListener('click', function handleFirstInteraction() {
      if (playerState.isPlayerReady && !playerState.isPlaying) {
        playerState.player.playVideo().catch(console.error);
      }
    }, { once: true });
    
  } catch (error) {
    console.error('Initialization failed:', error);
    showMessage('Failed to initialize player. Please refresh.', 'error');
  }
});