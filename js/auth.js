// Handle login form submission
// Handle login form submission
document.getElementById('login-form')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const messageDiv = document.getElementById('login-message');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    try {
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
        
        const response = await fetch('php/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: formData.get('username'),
                password: formData.get('password')
            })
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.success) {
            // Store user data
            localStorage.setItem('username', data.username);
            localStorage.setItem('user_id', data.user_id);
            
            // Show success message
            showMessage(messageDiv, 'Login successful! Redirecting...', 'success');
            
            // Redirect after delay
            setTimeout(() => {
                window.location.href = data.redirect || 'index.html';
            }, 1500);
        } else {
            // Show specific error message from server
            showMessage(messageDiv, data.message || 'Login failed', 'error');
        }
    } catch (error) {
        console.error('Login error:', error);
        showMessage(messageDiv, 'An error occurred. Please try again later.', 'error');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Login';
    }
});

// Improved message display
function showMessage(element, message, type) {
    if (!element) return;
    
    element.innerHTML = `
        <div class="p-3 rounded ${type === 'error' ? 'bg-red-500' : 'bg-green-500'} text-white">
            ${message}
            ${type === 'error' ? '<i class="fas fa-exclamation-circle ml-2"></i>' : '<i class="fas fa-check-circle ml-2"></i>'}
        </div>
    `;
    element.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        element.classList.add('hidden');
    }, 5000);
}

// Handle signup form submission
document.getElementById('signup-form')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const messageDiv = document.getElementById('signup-message');
    
    if (password !== confirmPassword) {
        messageDiv.textContent = 'Passwords do not match!';
        messageDiv.className = 'p-3 bg-red-600 rounded text-white';
        messageDiv.classList.remove('hidden');
        return;
    }
    
    try {
        const response = await fetch('php/signup.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${encodeURIComponent(username)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        });
        
        const data = await response.json();
        
        if (data.success) {
            messageDiv.textContent = 'Signup successful! Redirecting to login...';
            messageDiv.className = 'p-3 bg-green-600 rounded text-white';
            messageDiv.classList.remove('hidden');
            
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1500);
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

// Handle logout
document.getElementById('logout-btn')?.addEventListener('click', () => {
    localStorage.removeItem('username');
    window.location.href = 'index.html';
});

// Display username in dashboard if logged in
document.addEventListener('DOMContentLoaded', () => {
    const usernameDisplay = document.getElementById('username-display');
    if (usernameDisplay) {
        const username = localStorage.getItem('username');
        if (username) {
            usernameDisplay.innerHTML = `
            <img src="profile.gif" alt="Profile" class="inline-block w-10 h-10 rounded-full mr-2">
            Hello, ${username}
            `;
        } else {
            window.location.href = 'login.html';
        }
    }
});