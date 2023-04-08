
# TaskBoard

This project is kind of a clone to Trello where the users can create their tasks and manage them either by updating their task, updating its status (`To do`, `Doing`, `Done`) or even removing the task if needed. They can also sort their tasks by the name of the task or the deadline of the task. Search option is also available to filter the tasks for better user experience.


## Run Locally

First of all you need to host the project locally using [XAMPP](https://www.apachefriends.org/) or similar program.

After installing XAMPP, running it and launching both Apache and MySql, in the terminal access the `htdocs` folder, the path is usually the same, if not modify the path to your `htdocs`:

```bash
  cd C:\xampp\htdocs
```

Clone this project in `htdocs`:

```bash
  git clone https://github.com/ThisMSH/TaskBoard.git
```

In `phpMyAdmin` create a new database called `taskboard`. After that import one of the 2 files in database folder in your new database.

| File name | Description                       |
| :-------- | :-------------------------------- |
| `taskboard-empty`      | It'll create new fresh tables with no data in them (just the rooms table will be filled). |
| `taskboard`      | It'll create new tables that have some test data that I was using during the test of this project. |

> Note that the database name have to be `taskboard`, else you'll need to modify the database name in `\TaskBoard\app\config\Config.php`.

Now you should be able to run the project without any issue, this link may lead you to the project if you're using [TaskBoard](http://localhost/TaskBoard).

## Usage

First you'll have to be a user in the website in order to access to the dashboard and start making your tasks, just click on `Sign in / Sign up` button in the top right and create an account, from the same page you can login to your account and you'll automatically access your dashboard. Now you should be able to test all the functionalities of this project.

## Tech Stack

**Frontend:** HTML, CSS, JavaScript, TailwindCSS.

**Backend:** PHP (OOP & MVC), MySQL.
