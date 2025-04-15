<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'get_user_songs':
            // In a real app, you'd get the user ID from the session
            // For this example, we'll just get all songs
            $stmt = $pdo->query("SELECT * FROM songs ORDER BY added_at DESC");
            $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($songs);
            break;
            
        case 'add':
            $title = $_POST['title'] ?? '';
            $artist = $_POST['artist'] ?? '';
            $youtube_id = $_POST['youtube_id'] ?? '';
            $mood = $_POST['mood'] ?? '';
            
            if (empty($title) || empty($artist) || empty($youtube_id) || empty($mood)) {
                echo json_encode(['success' => false, 'message' => 'All fields are required']);
                exit;
            }
            
            // In a real app, you'd get the user ID from the session
            // For this example, we'll use a dummy user ID
            $added_by = 1;
            
            $stmt = $pdo->prepare("INSERT INTO songs (title, artist, youtube_id, mood, added_by) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $artist, $youtube_id, $mood, $added_by]);
            
            echo json_encode(['success' => true, 'message' => 'Song added successfully']);
            break;
            
        case 'delete':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id)) {
                echo json_encode(['success' => false, 'message' => 'Invalid song ID']);
                exit;
            }
            
            // In a real app, you'd verify the user owns the song before deleting
            $stmt = $pdo->prepare("DELETE FROM songs WHERE id = ?");
            $stmt->execute([$id]);
            
            echo json_encode(['success' => true, 'message' => 'Song deleted successfully']);
            break;
            
        default:
            // Get songs by mood
            $mood = $_GET['mood'] ?? '';
            
            if (empty($mood)) {
                echo json_encode(['success' => false, 'message' => 'Mood parameter is required']);
                exit;
            }
            
            $stmt = $pdo->prepare("SELECT * FROM songs WHERE mood = ? ORDER BY RAND() LIMIT 10");
            $stmt->execute([$mood]);
            $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($songs);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>