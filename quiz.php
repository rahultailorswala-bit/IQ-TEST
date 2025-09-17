<?php
session_start();
require_once 'db.php';
 
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = uniqid('user_');
    $_SESSION['answers'] = [];
}
 
$stmt = $conn->query("SELECT * FROM iq_questions ORDER BY RAND()");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['questions'] = $questions;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answers'] = $_POST['answers'] ?? [];
    header("Location: results.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Quiz</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
            display: flex;
            justify-content: center;
        }
        .quiz-container {
            max-width: 700px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #ff6f61;
            margin-bottom: 20px;
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
        }
        .question p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .options label {
            display: block;
            margin: 10px 0;
            font-size: 1em;
            cursor: pointer;
        }
        .options input[type="radio"] {
            margin-right: 10px;
        }
        .submit-btn {
            display: block;
            margin: 20px auto;
            padding: 15px 30px;
            font-size: 1.2em;
            background: #ff6f61;
            border: none;
            border-radius: 25px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .submit-btn:hover {
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .quiz-container {
                padding: 15px;
            }
            h2 {
                font-size: 1.5em;
            }
            .question p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h2>IQ Test</h2>
        <form method="POST" id="quiz-form">
            <?php foreach ($questions as $index => $q): ?>
                <div class="question">
                    <p><?php echo ($index + 1) . '. ' . htmlspecialchars($q['question_text']); ?></p>
                    <div class="options">
                        <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="a" required> <?php echo htmlspecialchars($q['option_a']); ?></label>
                        <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="b"> <?php echo htmlspecialchars($q['option_b']); ?></label>
                        <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="c"> <?php echo htmlspecialchars($q['option_c']); ?></label>
                        <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="d"> <?php echo htmlspecialchars($q['option_d']); ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="submit-btn">Submit Test</button>
        </form>
    </div>
</body>
</html>
