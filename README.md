# Team Management
Web platform to create, manage and register in amateur football teams.

## Prerequisites
For Windows: XAMPP Apache distribution v7.3.9 (Apache HTTP Server Apache + MariaDB + PHP v7.3.9).

## Install
- Create a database with the code from the file ```Base_Dados_futebolamador.sql```;
- Create a user and give him read/write access to the new database;
- Place the project in a folder served by APACHE HTTP SERVER (example: xampp\htdocs);
- Write the name and password of the user in ```connect.php``` file.

## Run
To access the browser```localhost/gestaoEquipas/listaEquipas.php```.

## Features
### General
- Register
- Login

### Admin
- Confirm new user
- Kick user
- Give/Take off tournament privileges  

### Player
#### Ask for substitution
- If a player is not able to attend a game he can ask another player to replace him.

#### Accept to substitute
- If a player receive a request ffrom another player for substitution, he can accept or reject it.

### Teams
#### Create Team
- The new team must have a name, a tournament which belongs to, a team strategy (forward, midfield, back).

#### Join team
1) Choose tournement;
2) Choose a team;
3) Choose desired position: Goalkeeper, Defender, Midfielder, Winger or Forward;
4) After click "Send", a message will be sent to the team captain.

#### Exchange captain privileges
- The captain can ask another user to replaceme him as a team captain. 

#### Accept captain privileges

#### Accept team player
- The captain might accept the request and place the new player in the desired position; if that position is already taken, he can place him in another position.

#### Kick team player
- The captain can expel a player from a team; the player receives instantly the notification.

#### Manage player status
- The team captain can change the status of a player (member or substitute) and it's priority in the game (from 1 to 16).

#### Update player account amount
- If a player updated its account or played in a game, the captain will update it in the system as well (sum or subtract).  

#### Add game score
The captain can insert the score of a game.

#### Register player's fault
- When a player commit a fault (not attending a game without asking for substitution) the captain can save that occurrence in record.

#### Create tournement
- Any user can create a tournement. The new tournement will have a name, the field where it will occur and the begin and end date. For each day of the week, they must be stored hours of games begin and end.

#### Accept tournement team
- The user may accept or reject a team in the tournement he created. This page also contains all notifications of created teams and game scores.

#### Accept game result
#### Initiate tournement

#### Give captain management privileges
- The tournement manager will have team captains info and can give them tournement management privileges.

#### Remove captain privileges
- The tournement manager can remove a captain from a team.

#### Edit profile
- Any user is able to edit its personal info.
