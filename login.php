<?php
session_start();
require 'db.php';
$login_error   = "";
$login_success = "";
$reg_error     = "";
$reg_success   = "";
$active_tab    = "login";

// ── HANDLE LOGIN ──
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $active_tab = "login";
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $login_error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            $ip  = $_SERVER['REMOTE_ADDR'];
            $log = $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address) VALUES (?, 'login', ?)");
            $log->execute([$user['id'], $ip]);

            header("Location: index (6).html");
            exit();
        } else {
            $login_error = "Invalid email or password.";
        }
    }
}

// ── HANDLE REGISTER ──
if (isset($_POST['action']) && $_POST['action'] === 'register') {
    $active_tab = "register";
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        $reg_error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $reg_error = "Please enter a valid email like you@gmail.com";
    } elseif (strlen($password) < 6) {
        $reg_error = "Password must be at least 6 characters.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $reg_error = "This email is already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt   = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed]);
            $reg_success = "Account created! You can now sign in.";
            $active_tab  = "login";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SkillSpring — Sign In</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --primary: #6c7cf7;
      --secondary: #7ed3b2;
      --muted: #64748b;
      --shadow: 0 10px 25px rgba(2,6,23,.12);
      --input-border: #e2e8f0;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', system-ui, sans-serif;
      background: #f6f7fb;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* HEADER */
    header {
      position: sticky; top: 0; z-index: 50;
      backdrop-filter: blur(8px);
      background: rgba(255,255,255,.85);
      border-bottom: 1px solid rgba(2,6,23,.06);
    }
    .nav {
      max-width: 1200px; margin: 0 auto; padding: 14px 20px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 700; text-decoration: none; color: #0b1220; }
    .brand .logo {
      width: 36px; height: 36px; border-radius: 10px;
      display: grid; place-items: center;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white; font-weight: 700; font-size: 14px;
    }
    .nav-back {
      color: var(--muted); font-size: 14px; font-weight: 500;
      text-decoration: none; padding: 8px 16px; border-radius: 12px;
      border: 1px solid rgba(2,6,23,.08); transition: all .2s;
    }
    .nav-back:hover { background: #eef2ff; color: var(--primary); }

    /* MAIN */
    main {
      flex: 1; display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: calc(100vh - 65px);
    }

    /* LEFT PANEL */
    .panel-left {
      background: linear-gradient(145deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
      display: flex; flex-direction: column;
      justify-content: center; padding: 60px 56px;
      position: relative; overflow: hidden;
    }
    .panel-left::before {
      content: '';
      position: absolute; width: 420px; height: 420px;
      background: radial-gradient(circle, rgba(108,124,247,.35) 0%, transparent 70%);
      top: -80px; right: -80px; border-radius: 50%;
      animation: pulse 6s ease-in-out infinite;
    }
    .panel-left::after {
      content: '';
      position: absolute; width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(126,211,178,.2) 0%, transparent 70%);
      bottom: -60px; left: -60px; border-radius: 50%;
      animation: pulse 8s ease-in-out infinite reverse;
    }
    @keyframes pulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.15)} }
    .dots-grid {
      position: absolute; inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,.07) 1px, transparent 1px);
      background-size: 32px 32px;
    }
    .panel-content { position: relative; z-index: 1; }
    .panel-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(108,124,247,.25);
      border: 1px solid rgba(108,124,247,.4);
      color: #a5b4fc; font-size: 12px; font-weight: 600;
      letter-spacing: .06em; text-transform: uppercase;
      padding: 6px 14px; border-radius: 999px; margin-bottom: 28px;
    }
    .panel-content h2 {
      font-size: clamp(28px, 3.5vw, 40px); line-height: 1.15;
      color: #fff; font-weight: 700; margin-bottom: 16px;
    }
    .panel-content h2 span { color: #a5b4fc; }
    .panel-content p {
      color: #94a3b8; font-size: 15px; line-height: 1.75;
      max-width: 380px; margin-bottom: 36px; font-weight: 300;
    }
    .features { display: flex; flex-direction: column; gap: 14px; }
    .feat {
      display: flex; align-items: center; gap: 14px;
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 14px; padding: 14px 18px;
      color: #e2e8f0; font-size: 14px; font-weight: 500;
    }
    .feat-icon {
      width: 38px; height: 38px; border-radius: 10px;
      display: grid; place-items: center; font-size: 18px; flex-shrink: 0;
    }
    .fi-p { background: rgba(108,124,247,.25); }
    .fi-g { background: rgba(126,211,178,.25); }
    .fi-k { background: rgba(247,183,195,.25); }
    .fi-y { background: rgba(255,211,105,.25); }

    /* RIGHT PANEL */
    .panel-right {
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      padding: 48px 40px; background: #fff;
    }
    .form-box { width: 100%; max-width: 420px; }

    /* TABS */
    .tabs {
      display: flex; background: #f1f5f9; border-radius: 14px;
      padding: 4px; margin-bottom: 32px;
    }
    .tab-btn {
      flex: 1; padding: 10px; border: none; background: transparent;
      border-radius: 11px; font-family: 'Poppins', sans-serif;
      font-size: 14px; font-weight: 600; cursor: pointer;
      color: var(--muted); transition: all .25s;
    }
    .tab-btn.active {
      background: white; color: var(--primary);
      box-shadow: 0 2px 8px rgba(2,6,23,.1);
    }
    .form-panel { display: none; }
    .form-panel.active { display: block; }

    .form-title { font-size: 22px; font-weight: 700; color: #0b1220; margin-bottom: 4px; }
    .form-sub   { color: var(--muted); font-size: 13px; margin-bottom: 24px; }

    .field { margin-bottom: 16px; }
    .field label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 7px; }
    .field input {
      width: 100%; padding: 12px 16px;
      border: 1.5px solid var(--input-border);
      border-radius: 12px; font-family: 'Poppins', sans-serif;
      font-size: 14px; color: #0b1220; outline: none;
      transition: border-color .2s, box-shadow .2s;
      background: #fafafa;
    }
    .field input:focus {
      border-color: var(--primary); background: #fff;
      box-shadow: 0 0 0 3px rgba(108,124,247,.12);
    }
    .field input::placeholder { color: #b0bac9; }

    .submit-btn {
      width: 100%; padding: 13px;
      background: linear-gradient(135deg, var(--primary), #9aa6ff);
      color: white; border: none; border-radius: 14px;
      font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600;
      cursor: pointer; box-shadow: var(--shadow);
      transition: opacity .2s, transform .2s; margin-top: 4px;
    }
    .submit-btn:hover { opacity: .92; transform: translateY(-2px); }

    .alert {
      padding: 12px 16px; border-radius: 12px;
      font-size: 13px; font-weight: 500; margin-bottom: 16px;
    }
    .alert.error   { background: #fff1f2; border: 1px solid #fecdd3; color: #881337; }
    .alert.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #14532d; }

    .switch-text { text-align: center; margin-top: 22px; font-size: 13px; color: var(--muted); }
    .switch-text a { color: var(--primary); font-weight: 600; text-decoration: none; cursor: pointer; }
    .switch-text a:hover { text-decoration: underline; }

    footer { text-align: center; padding: 16px; color: #94a3b8; font-size: 12px; border-top: 1px solid rgba(2,6,23,.06); }

    @media (max-width: 768px) {
      main { grid-template-columns: 1fr; }
      .panel-left { display: none; }
      .panel-right { padding: 40px 24px; }
    }
  </style>
</head>
<body>

<header>
  <div class="nav">
    <a href="index (6).html" class="brand">
      <div class="logo">SS</div>
      <span>SkillSpring</span>
    </a>
    <a href="index (6).html" class="nav-back">← Back to Home</a>
  </div>
</header>

<main>
  <!-- LEFT -->
  <div class="panel-left">
    <div class="dots-grid"></div>
    <div class="panel-content">
      <div class="panel-badge">✦ Career Guidance Platform</div>
      <h2>Build your future<br>with <span>SkillSpring</span></h2>
      <p>Join thousands of students and professionals who discovered their ideal career path and landed roles they love.</p>
      <div class="features">
        <div class="feat"><div class="feat-icon fi-p">🧭</div><span>Personalized career quiz & roadmaps</span></div>
        <div class="feat"><div class="feat-icon fi-g">📄</div><span>AI-powered resume analyzer</span></div>
        <div class="feat"><div class="feat-icon fi-k">📰</div><span>Latest industry news & insights</span></div>
        <div class="feat"><div class="feat-icon fi-y">🎓</div><span>Skill-building resources & guides</span></div>
      </div>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="panel-right">
    <div class="form-box">

      <div class="tabs">
        <button class="tab-btn <?= $active_tab==='login'?'active':'' ?>" onclick="switchTab('login')">Sign In</button>
        <button class="tab-btn <?= $active_tab==='register'?'active':'' ?>" onclick="switchTab('register')">Create Account</button>
      </div>

      <!-- LOGIN -->
      <div class="form-panel <?= $active_tab==='login'?'active':'' ?>" id="panelLogin">
        <div class="form-title">Welcome back 👋</div>
        <div class="form-sub">Sign in to continue your career journey</div>

        <?php if ($login_error): ?>
          <div class="alert error">❌ <?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>
        <?php if ($reg_success): ?>
          <div class="alert success">✅ <?= htmlspecialchars($reg_success) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <input type="hidden" name="action" value="login">
          <div class="field">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@gmail.com" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Your password" required>
          </div>
          <button type="submit" class="submit-btn">Sign In →</button>
        </form>
        <div class="switch-text">Don't have an account? <a onclick="switchTab('register')">Create one free →</a></div>
      </div>

      <!-- REGISTER -->
      <div class="form-panel <?= $active_tab==='register'?'active':'' ?>" id="panelRegister">
        <div class="form-title">Join SkillSpring 🚀</div>
        <div class="form-sub">Create your free account in seconds</div>

        <?php if ($reg_error): ?>
          <div class="alert error">❌ <?= htmlspecialchars($reg_error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <input type="hidden" name="action" value="register">
          <div class="field">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Your full name" required
                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@gmail.com" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Min. 6 characters" required>
          </div>
          <button type="submit" class="submit-btn">Create Account →</button>
        </form>
        <div class="switch-text">Already have an account? <a onclick="switchTab('login')">Sign in →</a></div>
      </div>

    </div>
  </div>
</main>

<footer>© <?= date('Y') ?> SkillSpring • Build your future with confidence.</footer>

<script>
function switchTab(tab) {
  document.getElementById('panelLogin').classList.toggle('active', tab === 'login');
  document.getElementById('panelRegister').classList.toggle('active', tab === 'register');
  document.querySelectorAll('.tab-btn').forEach((btn, i) => {
    btn.classList.toggle('active', (i===0 && tab==='login') || (i===1 && tab==='register'));
  });
}
</script>
</body>
</html>
