document.addEventListener('DOMContentLoaded', async () => {
    // Check if user is logged in
    const username = localStorage.getItem('username');
    if (!username) {
        window.location.href = 'login.html';
        return;
    }
    
    // Load user's songs
    await loadUserSongs();
    
    // Handle add song form submission
    document.getElementById('add-song-form')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const title = document.getElementById('song-title').value;
        const artist = document.getElementById('song-artist').value;
        const youtubeUrl = document.getElementById('youtube-url').value;
        const mood = document.getElementById('song-mood').value;
        const messageDiv = document.getElementById('song-message');
        
        const youtubeId = extractYouTubeId(youtubeUrl);
        if (!youtubeId) {
            messageDiv.textContent = 'Invalid YouTube URL';
            messageDiv.className = 'p-3 bg-red-600 rounded text-white';
            messageDiv.classList.remove('hidden');
            return;
        }
        
        try {
            const response = await fetch('php/songs.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `title=${encodeURIComponent(title)}&artist=${encodeURIComponent(artist)}&youtube_id=${youtubeId}&mood=${mood}&action=add`
            });
            
            const data = await response.json();
            
            if (data.success) {
                messageDiv.textContent = 'Song added successfully!';
                messageDiv.className = 'p-3 bg-green-600 rounded text-white';
                messageDiv.classList.remove('hidden');
                
                // Reset form
                document.getElementById('add-song-form').reset();
                
                // Reload songs
                await loadUserSongs();
            } else {
                messageDiv.textContent = data.message;
                messageDiv.className = 'p-3 bg-red-600 rounded text-white';
                messageDiv.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error:', error);
            messageDiv.textContent = 'An error occurred. Please try again.';
            messageDiv.className = 'p-3 bg-red-600 rounded text-white';
            messageDiv.classList.remove('hidden');
        }
    });
});

// Extract YouTube ID from URL (same as in player.js)
function extractYouTubeId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

// Load user's songs
async function loadUserSongs() {
    try {
        const response = await fetch('php/songs.php?action=get_user_songs');
        const songs = await response.json();
        
        const songsTable = document.getElementById('user-songs');
        songsTable.innerHTML = '';
        
        if (songs.length === 0) {
            songsTable.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-gray-400">You haven\'t added any songs yet.</td></tr>';
            return;
        }
        
        songs.forEach(song => {
            const tr = document.createElement('tr');
            tr.className = 'border-b border-gray-700 hover:bg-gray-700';
            tr.innerHTML = `
                <td class="py-3">${song.title}</td>
                <td class="py-3">${song.artist}</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded-full text-xs 
                        ${getMoodColorClass(song.mood)}">
                        ${song.mood.charAt(0).toUpperCase() + song.mood.slice(1)}
                    </span>
                </td>
                <td class="py-3">
                    <button data-id="${song.id}" class="delete-btn text-red-400 hover:text-red-300 mr-3">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            songsTable.appendChild(tr);
        });
        
        // Add event listeners to delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const songId = btn.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this song?')) {
                    try {
                        const response = await fetch('php/songs.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${songId}&action=delete`
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            await loadUserSongs();
                        } else {
                            alert('Failed to delete song: ' + data.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the song.');
                    }
                }
            });
        });
    } catch (error) {
        console.error('Error loading user songs:', error);
    }
}

// Helper function to get color class based on mood
function getMoodColorClass(mood) {
    switch (mood) {
        case 'happy': return 'bg-yellow-500 bg-opacity-20 text-yellow-300';
        case 'sad': return 'bg-blue-500 bg-opacity-20 text-blue-300';
        case 'energetic': return 'bg-red-500 bg-opacity-20 text-red-300';
        case 'calm': return 'bg-green-500 bg-opacity-20 text-green-300';
        case 'romantic': return 'bg-pink-500 bg-opacity-20 text-pink-300';
        default: return 'bg-gray-500 bg-opacity-20 text-gray-300';
    }
}