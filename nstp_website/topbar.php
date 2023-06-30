<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Top Bar Example</title>
    <style>
        .topbar {
            background-color: #4CAF50;
            color: #4CAF50;
            padding: 10px;
            height: 25px;
        }

        .logout-btn {
            background-color: grey;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            float: right;
            
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<div class="topbar">
    <button class="logout-btn">Logout</button>
</div>

<!-- Logout functionality -->
<script>
    const logoutButton = document.querySelector('.logout-btn');
    logoutButton.addEventListener('click', () => {
        // Redirect to login page
        window.location.href = 'log-in.php';
    });
</script>
</body>
</html>