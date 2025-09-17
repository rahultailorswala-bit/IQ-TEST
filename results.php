<?php
session_start();
require_once 'db.php';
 
if (!isset($_SESSION['answers']) || !isset($_SESSION['questions'])) {
    header("Location: quiz.php");
    exit;
}
 
$answers = $_SESSION['answers'];
$questions = $_SESSION['questions'];
$score = 0;
 
foreach ($questions as $q) {
    if (isset($answers[$q['id']]) && $answers[$q['id']] === $q['correct_option']) {
        $score += 20; // Each correct answer gives 20 points (out of 100 for 5 questions)
    }
}
 
$feedback = match (true) {
    $score >= 80 => "Excellent! Your cognitive abilities are outstanding, with strong logical reasoning and pattern recognition.",
    $score >= 60 => "Great job! You have solid cognitive skills, with room to sharpen specific areas.",
    $score >= 40 => "Good effort! Focus on practicing logical and numerical problems to boost your score.",
    default => "Keep practicing! Targeted exercises in reasoning and patterns will help improve your skills."
};
 
$stmt = $conn->prepare("INSERT INTO iq_test_results (user_id, score, answers) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $score, json_encode($answers)]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .results-container {
            max-width: 600px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            color: #ff6f61;
            margin-bottom: 20px;
        }
        .score {
            font-size: 2.5em;
            color: #28a745;
            margin: 20px 0;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 1.1em;
            margin: 10px;
            border: none;
            border-radius: 25px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .retake-btn {
            background: #ff6f61;
        }
        .share-btn {
            background: #007bff;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .results-container {
                padding: 15px;
            }
            h2 {
                font-size: 1.5em;
            }
            .score {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h2>Your IQ Test Results</h2>
        <div class="score"><?php echo $score; ?>/100</div>
        <p><?php echo htmlspecialchars($feedback); ?></p>
        <button class="btn retake-btn" onclick="window.location.href='quiz.php'">Retake Test</button>
        <button class="btn share-btn" onclick="alert('Share your score: <?php echo $score; ?>/100')">Share Results</button>
    </div>
</body>
</html>
