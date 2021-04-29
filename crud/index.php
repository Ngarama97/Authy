<?php

include 'crud.php';

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;

  $record = mysqli_query($db, "SELECT * FROM users where id = $id");
  $n = mysqli_fetch_array($record);
  $name = $n['name'];
  $course = $n['course'];
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>title</title>
</head>

<body style="padding: 100px 50px 75px 500px;">

  <h3>Create a course!</h3>

  <p>
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
      echo '<span style = "color: red">' . $_SESSION['error'] . '</span>';
      session_unset();
    }
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
      echo '<span style = "color: green">' . $_SESSION['message'] . '</span>';

      session_unset();
    }
    ?>
  </p>

  <?php $results = mysqli_query($db, "SELECT * FROM users"); ?>

  <table>

    <thead>

      <tr>

        <th>Name</th>

        <th>Course</th>

        <th colspan="2">Action</th>

      </tr>

      <?php while ($row = mysqli_fetch_array($results)) { ?>

        <tr>
          <td><?php echo $row['name']; ?></td>

          <td> <?php echo $row['course']; ?></td>

          <td>
            <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
          </td>

          <td>
            <a href="create.php?delete=<?php echo $row['id']; ?>">Delete</a>
          </td>

        </tr>

    </thead>
  <?php } ?>
  </table>

  <br>

  <form action="crud.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $id ?>">

    <label for="name">Full Name</label><br>
    <input type="text" name="name" placeholder="Full Name" value="<?php echo $name ?>"><br>

    <label for="course">Course</label><br>
    <input type="text" name="course" placeholder="What's your course" value="<?php echo $course ?>"><br>

    <br>

    <?php if ($update == true) : ?>

      <button style="background-color: #ffc996;" type="submit" name="update">Update</button>

    <?php else : ?>

      <button style="background-color:#dbf6e9;" type="submit" name="create">Create</button>

    <?php endif ?>


  </form>

</body>

</html>