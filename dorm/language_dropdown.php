<form action="" method="GET">
    <label for="language">Select Language:</label>
    <select name="lang" id="language" onchange="this.form.submit()">
        <option value="en" <?php if ($_SESSION['lang'] == 'en') echo 'selected'; ?>>English</option>
        <option value="tr" <?php if ($_SESSION['lang'] == 'tr') echo 'selected'; ?>>Türkçe</option>
    </select>
</form>
