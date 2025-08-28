<?php
// facilitators.php
 
// Database credentials
$host = 'localhost';
$db = 'dbxujutgwswayt';
$user = 'ur9iyguafpilu';
$pass = '51gssrtsv3ei';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $stmt = $pdo->query("SELECT * FROM facilitators ORDER BY name ASC");
    $facilitators = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $facilitators = [];
}
 
include 'header.php';
?>
 
<main style="max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
 
<h2 style="color: #004080; margin-bottom: 25px; border-bottom: 2px solid #0077cc; display: inline-block; padding-bottom: 5px;">Meet Our Facilitators</h2>
 
<?php if (count($facilitators) === 0): ?>
  <p>No facilitators found at the moment. Please check back later.</p>
<?php else: ?>
  <div style="display: flex; flex-wrap: wrap; gap: 25px;">
    <?php foreach ($facilitators as $f): ?>
      <div style="flex: 1 1 280px; background: #f9f9f9; border-radius: 8px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
        <?php if (!empty($f['photo_url'])): ?>
          <img src="<?php echo htmlspecialchars($f['photo_url']); ?>" alt="<?php echo htmlspecialchars($f['name']); ?>" style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 8px;" />
        <?php else: ?>
          <div style="width: 100%; height: 220px; background: #ccc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #666;">
            No Photo
          </div>
        <?php endif; ?>
 
        <h3 style="margin-top: 15px; color: #0077cc;"><?php echo htmlspecialchars($f['name']); ?></h3>
        <p style="font-size: 14px; min-height: 70px;"><?php echo nl2br(htmlspecialchars($f['bio'])); ?></p>
        <p>
          <?php if (!empty($f['facebook'])): ?>
            <a href="<?php echo htmlspecialchars($f['facebook']); ?>" target="_blank" rel="noopener" style="margin-right: 10px;">Facebook</a>
          <?php endif; ?>
          <?php if (!empty($f['twitter'])): ?>
            <a href="<?php echo htmlspecialchars($f['twitter']); ?>" target="_blank" rel="noopener" style="margin-right: 10px;">Twitter</a>
          <?php endif; ?>
          <?php if (!empty($f['linkedin'])): ?>
            <a href="<?php echo htmlspecialchars($f['linkedin']); ?>" target="_blank" rel="noopener">LinkedIn</a>
          <?php endif; ?>
        </p>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
 
</main>
 
<?php include 'footer.php'; ?>
 
