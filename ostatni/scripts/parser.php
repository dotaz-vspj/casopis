<?php 
include '../include/db.php';
loadEnv( '../include/.env');

$HOME_DIR = getenv('HOME_DIR');
$VENV = getenv('VENV');

$command_arg = "$VENV/python3 $HOME_DIR/scripts/parse.py";

$command = escapeshellcmd($command_arg);
$output = shell_exec($command);
