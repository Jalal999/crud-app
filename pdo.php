<?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=crud1', 
   'jalal', 'jalal123');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

