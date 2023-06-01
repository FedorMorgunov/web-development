ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:55188

Throughout all pages, I followed the required CSS as well as the advanced layout features such as Bootstrap for mobile and responsive layout.

Registration:

I took a complex approach that allows the user to select and configure features to assemble an emoji avatar. The username must follow the required format, the website doesn't let the user register until the conditions are met. 

Pairs webpage and emoji matching game:

I took a simple approach however, I added additional features such as a countdown timer, card-flipping animation, and the score is calculated based on both the number of moves and the time taken to complete the game. The cards are shuffled every time the game starts and the board is locked while two cards remain face up so the game is played fair. The user has a limited number of guesses to win the game. If the time or number of moves is exceeded the page will display a message and restart the game. When all pairs are matched, if the user registered it will ask to submit the score or play again. If the user decides to submit the score it will send a post request to the leaderboard page. If the user is not registered it will display the score and restart the game.

Leaderboard:

The leaderboard displays the best scores with corresponding usernames in descending order based on the score. To store submissions from multiple users on different browsers I used a text file 'leaderboard.txt' that stores data in a JSON format. It only has one instance of each user and if the submitted score is worse than the one in the table it won't change it.