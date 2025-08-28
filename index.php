<?php
// index.php
 
// Database credentials
$host = 'localhost';
$db = 'dbxujutgwswayt';
$user = 'ur9iyguafpilu';
$pass = '51gssrtsv3ei';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
 
// Fetch statistics
$statistics = [
    'team_members' => 0,
    'students' => 0,
    'campuses' => 0,
];
try {
    $stmt = $pdo->query("SELECT `key`, `value` FROM statistics");
    $statsFromDb = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    if ($statsFromDb) {
        $statistics = array_merge($statistics, $statsFromDb);
    }
} catch (Exception $e) {
    // ignore error, fallback to zeros
}
 
// Fetch testimonials (limit 3)
$testimonials = [];
try {
    $stmt = $pdo->query("SELECT name, message FROM testimonials ORDER BY id DESC LIMIT 3");
    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $testimonials = [];
}
 
// Fetch latest articles (limit 3)
$articles = [];
try {
    $stmt = $pdo->query("SELECT title, link FROM articles ORDER BY published_date DESC LIMIT 3");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $articles = [];
}
 
include 'header.php';
?>
 
<main style="max-width: 1000px; margin: 30px auto; padding: 0 20px;">
 
<section id="intro" style="background: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1350&q=80') center center/cover no-repeat; color: white; padding: 80px 30px; border-radius: 8px; box-shadow: inset 0 0 0 1000px rgba(0,0,0,0.5); text-align: center;">
  <h2 style="font-size: 28px; margin-bottom: 15px;">Innovative AI-Enabled Education for Future Leaders</h2>
  <p style="font-size: 18px;">Empowering students with entrepreneurial skills, holistic development, and cutting-edge technology integration.</p>
</section>
 
<section id="features" style="display: flex; justify-content: space-around; flex-wrap: wrap; margin-top: 40px;">
  <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; flex: 1 1 250px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h3 style="color: #0077cc; margin-bottom: 10px;">AI-Enabled Education</h3>
    <p>Personalized learning experiences using artificial intelligence tailored to each student's needs.</p>
  </div>
  <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; flex: 1 1 250px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h3 style="color: #0077cc; margin-bottom: 10px;">Holistic Development</h3>
    <p>Fostering intellectual, emotional, and social growth for well-rounded individuals.</p>
  </div>
  <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; flex: 1 1 250px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h3 style="color: #0077cc; margin-bottom: 10px;">Entrepreneurial Focus</h3>
    <p>Encouraging creativity and business skills to prepare students for future challenges.</p>
  </div>
</section>
 
<section id="statistics" style="background: #0077cc; color: white; padding: 20px; border-radius: 8px; display: flex; justify-content: space-around; flex-wrap: wrap; margin-top: 40px;">
  <div style="text-align: center; margin: 10px;">
    <h3 style="font-size: 36px;"><?php echo htmlspecialchars($statistics['team_members']); ?></h3>
    <p>Team Members</p>
  </div>
  <div style="text-align: center; margin: 10px;">
    <h3 style="font-size: 36px;"><?php echo htmlspecialchars($statistics['students']); ?></h3>
    <p>Students Enrolled</p>
  </div>
  <div style="text-align: center; margin: 10px;">
    <h3 style="font-size: 36px;"><?php echo htmlspecialchars($statistics['campuses']); ?></h3>
    <p>Campuses</p>
  </div>
</section>
 
<?php if (count($testimonials) > 0): ?>
<section id="testimonials" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 40px;">
  <h2 style="color: #004080; margin-bottom: 20px; border-bottom: 2px solid #0077cc; display: inline-block; padding-bottom: 5px;">What People Say</h2>
  <?php foreach($testimonials as $t): ?>
    <div style="margin-bottom: 15px;">
      <p style="font-style: italic;">"<?php echo htmlspecialchars($t['message']); ?>"</p>
      <div style="text-align: right; font-weight: bold; margin-top: 5px;">- <?php echo htmlspecialchars($t['name']); ?></div>
    </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>
 
<?php if (count($articles) > 0): ?>
<section id="articles" style="margin-top: 40px;">
  <h2 style="color: #004080; margin-bottom: 15px; border-bottom: 2px solid #0077cc; display: inline-block; padding-bottom: 5px;">Latest Articles</h2>
  <ul style="list-style: none; padding-left: 0;">
    <?php foreach($articles as $a): ?>
      <li style="margin-bottom: 10px;"><a href="<?php echo htmlspecialchars($a['link']); ?>"><?php echo htmlspecialchars($a['title']); ?></a></li>
    <?php endforeach; ?>
  </ul>
</section>
<?php endif; ?>
 
</main>
 
<?php include 'footer.php'; ?>
