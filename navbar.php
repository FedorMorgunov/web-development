<style>
    .navbar {
        background-color: blue;
    }

    .navbar-brand {
        font-family: Verdana;
        font-size: 12px;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        font-family: Verdana;
        font-size: 12px;
        font-weight: bold;
    }

    .navbar-nav .nav-link:first-child {
        margin-right: auto;
    }

    .navbar-nav .nav-link:last-child {
        margin-left: auto;
    }

    .avatar {
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar img {
        position: absolute;
        width: 25px;
        height: 25px;
    }

    /* Responsive styles for small screens */
    @media (max-width: 767.98px) {
        .navbar-brand {
            font-size: 10px;
        }

        .navbar-nav .nav-link {
            font-size: 10px;
        }

        .avatar img {
            width: 20px;
            height: 20px;
        }
    }
</style>

<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            session_start();
            if(isset($_SESSION['username'])) {
                echo '<li class="nav-item"><a class="nav-link" href="leaderboard.php">Leaderboard</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="registration.php">Register</a></li>';
            }
            ?>
            <li class="nav-item"><a class="nav-link" href="pairs.php">Play Pairs</a></li>
        </ul>
        <?php
            // Show the avatar if available
            if(isset($_SESSION['avatar'])) {
                // Split the avatar string into an array of eyes, mouth, and skin values
                $avatar_array = explode("_", $_SESSION['avatar']);
                $eyes = $avatar_array[0];
                $mouth = $avatar_array[1];
                $skin = $avatar_array[2];

                // Construct the emoji image tag using the eyes, mouth, and skin values
                echo '<div class="avatar">';
                echo '<img src="emoji assets/skin/'.$skin.'.png" alt="Skin" />';
                echo '<img src="emoji assets/eyes/'.$eyes.'.png" alt="Eyes" />';
                echo '<img src="emoji assets/mouth/'.$mouth.'.png" alt="Mouth" />';
                echo '</div>';
            }
        ?>
    </div>
</nav>