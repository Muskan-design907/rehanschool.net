<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>RehanSchool - Innovative AI Education</title>
<meta name="description" content="RehanSchool offers innovative AI-enabled education focused on entrepreneurial skills and holistic development." />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
<style>
  body {
    font-family: 'Nunito', Arial, sans-serif;
    background: #f5f8fa;
    color: #333;
    line-height: 1.6;
    margin: 0; padding: 0;
  }
  a {
    text-decoration: none;
    color: #0077cc;
    transition: color 0.3s;
  }
  a:hover {
    text-decoration: underline;
  }
  header {
    background: #004080;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  header h1 {
    font-size: 24px;
  }
  nav a {
    margin-left: 20px;
    color: white;
    font-weight: bold;
  }
  nav a:hover {
    color: #99ccff;
  }
  @media (max-width: 600px) {
    nav a {
      margin-left: 10px;
      font-size: 14px;
    }
    header {
      flex-direction: column;
      align-items: flex-start;
    }
    nav {
      margin-top: 10px;
    }
  }
</style>
</head>
<body>
<header>
  <h1>RehanSchool</h1>
  <nav aria-label="Primary navigation">
    <a href="index.php">Home</a>
    <a href="curriculum.php">Curriculum</a>
    <a href="facilitators.php">Facilitators</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>
 
<script>
// Highlight active nav link
document.querySelectorAll('nav a').forEach(link => {
  if (link.href === window.location.href) {
    link.style.color = '#99ccff';
    link.style.textDecoration = 'underline';
  }
});
</script>
 
