<?php
/**
 * PHP PolyGen v.2.3
 * Base Logic: KCK V2.1 0x6ick Polymorphic
 * Author: 0x6ick - 6ickzone
 */

error_reporting(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300);

// CONFIGURATION
$max_size = 2 * 1024 * 1024;
$contact_link = "https://t.me/Yungx6ick";

$result_code = "";
$msg = "";
$download_zip = "";

// KCK v.2.3
function kck_engine_v21($raw_code) {
    $raw_code = preg_replace('/^<\?php/', '', $raw_code);
    $raw_code = preg_replace('/\?>$/', '', $raw_code);
    $raw_code = trim($raw_code);

    $dynamic_key = bin2hex(random_bytes(15)); 
    $key_len = strlen($dynamic_key);
    $p1 = substr($dynamic_key, 0, 10);
    $p2 = substr($dynamic_key, 10, 10);
    $p3 = substr($dynamic_key, 20, 10);
    
    $step1 = gzcompress($raw_code, 9);
    $step2 = "";
    for ($i = 0; $i < strlen($step1); $i++) {
        $step2 .= $step1[$i] ^ $dynamic_key[$i % $key_len];
    }
    $final_payload = base64_encode(strrev(bin2hex($step2)));

    // Randomized names
    $cls_name   = "Zone_" . ucfirst(substr(md5(rand()), 0, 4)) . "_Library";
    $func_exec  = "execute_handle_" . bin2hex(random_bytes(2));
    $func_entry = "init_" . bin2hex(random_bytes(2));
    $f_k1 = "get_key_" . substr(md5(rand()), 0, 5); 
    $f_k2 = "get_key_" . substr(md5(rand()), 0, 5); 
    $f_k3 = "get_key_" . substr(md5(rand()), 0, 5);
    $f_i1 = "check_i_" . substr(md5(rand()), 0, 5);
    $f_i2 = "check_i_" . substr(md5(rand()), 0, 5);
    $f_i3 = "check_i_" . substr(md5(rand()), 0, 5);
    $v_payload  = "data_" . substr(md5(rand()), 0, 4);
    $v_decoded  = "raw_" . substr(md5(rand()), 0, 4);
    $v_key      = "buffer_" . substr(md5(rand()), 0, 4);
    $v_integ    = "integ_" . substr(md5(rand()), 0, 4);
    $v_final    = "out_" . substr(md5(rand()), 0, 4);
    $c_decoy    = "SYS_CONF_" . strtoupper(substr(md5(rand()), 0, 6));

    return '<?php
/**
 * System Core Library
 * ID: '.uniqid().'
 * Status: Validated
 * Author: poly.6ickzone.site
 */
error_reporting(0);
ini_set("memory_limit", "512M");
define(\''.$c_decoy.'\', \''.substr(md5(rand()),0,20).'\');
class '.$cls_name.' {
    private function '.$f_k1.'() { return \''.$p1.'\'; }
    private function '.$f_k2.'() { return \''.$p2.'\'; }
    private function '.$f_k3.'() { return \''.$p3.'\'; }
    private function '.$f_i1.'() { return \'XpQzLmWvRtNyB1Cx\'; }
    private function '.$f_i2.'() { return \'JkHgFDSaPOiUytRe\'; }
    private function '.$f_i3.'() { return \'MnBvCxZlkJhgFdSa\'; }
    private function '.$func_exec.'($s = \'\') {
        if (empty($s)) return null;
        $s = preg_replace(\'/[\x00-\x08\x0B-\x0C\x0E-\x1F\x7F]/\', \'\', $s);
        try { return eval(trim($s)); } catch (Throwable $e) { return null; }
    }
    public static function '.$func_entry.'() {
        $'.$v_payload.' = \'' . $final_payload . '\';
        $'.$v_decoded.' = hex2bin(strrev(base64_decode($'.$v_payload.')));
        $o = new self();
        $'.$v_key.' = $o->'.$f_k1.'() . $o->'.$f_k2.'() . $o->'.$f_k3.'();
        $'.$v_integ.' = $o->'.$f_i1.'() . $o->'.$f_i2.'() . $o->'.$f_i3.'();
        if (strlen($'.$v_integ.') < 10) { return; }
        $'.$v_final.' = \'\';
        $kl = strlen($'.$v_key.');
        for ($i=0, $len = strlen($'.$v_decoded.'); $i < $len; $i++) {
            $'.$v_final.' .= chr(ord($'.$v_decoded.'[$i]) ^ ord($'.$v_key.'[$i % $kl]));
        }
        $res = @gzuncompress($'.$v_final.');
        if ($res) {
            $a = \'Reflec\'; $b = \'tion\'; $c = \'Method\'; $d = $a.$b.$c;
            $ref = new $d(__CLASS__, \''.$func_exec.'\');
            $ref->setAccessible(true);
            $ref->invoke(new self(), $res);
        }
    }
}
if (!defined(\'_6Z_'.rand(100,999).'\')) { '.$cls_name.'::'.$func_entry.'(); } ?>';
}

// --- [ ZIP BATCH PROCESSING LOGIC ] ---
if (isset($_POST['generate'])) {
    if (!empty($_FILES['file_code']['name'])) {
        $filesize = $_FILES['file_code']['size'];
        if ($filesize > $max_size) {
            $msg = "<div class='alert error'><b>File Terlalu Besar!</b> (Max: 2MB)<br>Gunakan <a href='$contact_link' target='_blank' style='color:#fff;'>Manual Service</a>.</div>";
        } else {
            $filename = $_FILES['file_code']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if ($ext === 'php') {
                $result_code = kck_engine_v21(file_get_contents($_FILES['file_code']['tmp_name']));
            } elseif ($ext === 'zip' && class_exists('ZipArchive')) {
                $zip = new ZipArchive; $workDir = 'work_' . uniqid(); mkdir($workDir);
                if ($zip->open($_FILES['file_code']['tmp_name']) === TRUE) {
                    $zip->extractTo($workDir); $zip->close();
                    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($workDir));
                    foreach ($it as $file) {
                        if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
                            file_put_contents($file->getPathname(), kck_engine_v21(file_get_contents($file->getPathname())));
                        }
                    }
                    $outZipFile = 'protected_' . rand(100, 999) . '.zip';
                    $outZip = new ZipArchive;
                    if ($outZip->open($outZipFile, ZipArchive::CREATE) === TRUE) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($workDir), RecursiveIteratorIterator::LEAVES_ONLY);
                        foreach ($files as $f) {
                            if (!$f->isDir()) {
                                $outZip->addFile($f->getRealPath(), substr($f->getRealPath(), strlen(realpath($workDir)) + 1));
                            }
                        }
                        $outZip->close(); $download_zip = $outZipFile;
                        $msg = "<div class='alert success'>Project ZIP Berhasil Diproses!</div>";
                    }
                }
            } else { $msg = "<div class='alert error'>Format tidak didukung!</div>"; }
        }
    } elseif (!empty($_POST['code'])) { $result_code = kck_engine_v21($_POST['code']); }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PHP PolyGen - 6ickzone</title>
<meta name="description" content="PHP Polymorphic Generator by 6ickzone Secure your code with dynamic signatures.">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #6366f1; --bg: #0f172a; --card: #1e293b; --text: #f8fafc; --accent: #38bdf8; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); padding: 20px; }
        .container { max-width: 900px; margin: 40px auto; background: var(--card); border-radius: 20px; padding: 40px; border: 1px solid #334155; }
        h1 { font-size: 1.8rem; margin-bottom: 30px; display: flex; align-items: center; gap: 15px; color: var(--accent); }
        textarea { width: 100%; height: 200px; background: #0f172a; border: 1px solid #334155; border-radius: 12px; padding: 15px; color: var(--accent); font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; outline: none; box-sizing: border-box; }
        input[type="file"] { width: 100%; padding: 15px; background: #0f172a; border: 1px dashed #334155; border-radius: 12px; color: #fff; margin-bottom: 20px; cursor: pointer; }
        .btn-main { background: var(--primary); color: #fff; border: none; padding: 18px; border-radius: 12px; font-weight: 600; width: 100%; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-main:hover { transform: translateY(-2px); box-shadow: 0 10px 15px rgba(99, 102, 241, 0.4); }
        .result-box { margin-top: 40px; border-top: 2px solid #334155; padding-top: 30px; }
        .btn-sec { flex: 1; padding: 14px; border-radius: 10px; border: 1px solid #334155; background: #1e293b; color: #fff; cursor: pointer; text-decoration: none; text-align: center; }
        .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: 600; line-height: 1.6; }
        .success { background: #10b98133; color: #10b981; border: 1px solid #10b98155; }
        .error { background: #ef444433; color: #f87171; border: 1px solid #ef444455; }
    </style>
</head>
<body>
<div class="container">
    <h1><i class="fa-solid fa-code-merge"></i> PHP PolyGen</h1>
    <?= $msg; ?>
    <form method="POST" enctype="multipart/form-data">
        <label><i class="fa-solid fa-file-zipper"></i> Upload (php/zip Max 2MB)</label>
        <input type="file" name="file_code" accept=".php,.zip">
        <label><i class="fa-solid fa-keyboard"></i> Or Paste Code</label>
        <textarea name="code" placeholder="Paste PHP code di sini..."><?= isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '' ?></textarea>
        <button type="submit" name="generate" class="btn-main" style="margin-top:20px;">Generate</button>
    </form>
    <?php if ($result_code || $download_zip): ?>
    <div class="result-box">
        <?php if ($result_code): ?>
            <label>Single Output</label>
            <textarea id="res" readonly><?= htmlspecialchars($result_code) ?></textarea>
            <div style="display:flex; gap:15px; margin-top:15px;">
                <button class="btn-sec" onclick="copyResult()">Copy Clipboard</button>
            </div>
        <?php endif; ?>
        <?php if ($download_zip): ?>
            <a href="<?= $download_zip ?>" class="btn-main" style="text-decoration:none; margin-top:10px;">DOWNLOAD ZIP</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<script>
    function copyResult() { var c = document.getElementById("res"); c.select(); navigator.clipboard.writeText(c.value); alert("ID: <?= uniqid() ?> Copied!"); }
</script>
</body>
</html>
