<?php
// contact.php
 
// Database credentials
$host = 'localhost';
$db = 'dbxujutgwswayt';
$user = 'ur9iyguafpilu';
$pass = '51gssrtsv3ei';
 
$errors = [];
$success = '';
$name = '';
$email = '';
$message = '';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
 
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
 
    if ($name === '') {
        $errors[] = "Please enter your name.";
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if ($message === '') {
        $errors[] = "Please enter your message.";
    }
 
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        $success = "Thank you for your message! We'll get back to you soon.";
        // Clear form inputs
        $name = $email = $message = '';
    }
}
 
include 'header.php';
?>
 
<main style="max-width: 700px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
 
  <h2 style="color: #004080; margin-bottom: 20px; border-bottom: 2px solid #0077cc; display: inline-block; padding-bottom: 5px;">Contact Us</h2>
 
  <div style="margin-bottom: 20px; padding: 15px; background: #e8f0fe; border-radius: 6px;">
    <p><strong>Address:</strong> 123 Innovation Road, Islamabad, Pakistan</p>
    <p><strong>Phone:</strong> +92 300 1234567</p>
    <p><strong>Email:</strong> info@rehanschool.net</p>
  </div>
 
  <?php if (!empty($errors)): ?>
    <div style="background: #fdd; border: 1px solid #d44; padding: 10px; border-radius: 4px; margin-bottom: 15px; color: #900;">
      <?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?>
    </div>
  <?php endif; ?>
 
  <?php if ($success): ?>
    <div style="background: #dfd; border: 1px solid #4a4; padding: 10px; border-radius: 4px; margin-bottom: 15px; color: #060;">
      <?php echo htmlspecialchars($success); ?>
    </div>
  <?php endif; ?>
 
  <form method="post" action="contact.php" novalidate>
    <label for="name">Name *</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;" />
 
    <label for="email">Email *</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;" />
 
    <label for="message">Message *</label>
    <textarea name="message" id="message" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; height: 120px;"><?php echo htmlspecialchars($message); ?></textarea>
 
    <button type="submit" style="background: #004080; color: white; padding: 12px 25px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Send Message</button>
  </form>
 
</main>
 
<?php include 'footer.php'; ?>
 
