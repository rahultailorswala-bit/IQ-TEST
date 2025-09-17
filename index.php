<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Home</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .start-btn {
            padding: 15px 30px;
            font-size: 1.2em;
            background: #ff6f61;
            border: none;
            border-radius: 25px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .start-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the IQ Test</h1>
        <p>Test your cognitive abilities with our carefully designed IQ quiz. Assess your logical reasoning, numerical skills, and pattern recognition. Ready to challenge your mind?</p>
        <button class="start-btn" onclick="window.location.href='quiz.php'">Start Test</button>
    </div>
</body>
</html>
