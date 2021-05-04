<?php
echo '
<header>
<nav class="navbar navbar-default">
<div class="container-fluid">';

if ($_SESSION['kanri_flg']) {
    echo '<div class="navbar-header"><a class="navbar-brand" href="user_index.php">ユーザー 登録</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="user_select.php">ユーザー 一覧</a></div>';
}

echo '<div class="navbar-header"><a class="navbar-brand" href="index.php">bookmark登録</a></div>
<div class="navbar-header"><a class="navbar-brand" href="select.php">bookmark一覧</a></div>
<div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
<div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
</div>
</nav>
</header>
';
