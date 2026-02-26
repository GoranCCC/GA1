<?php
class EnvLoader
{
    public static function load($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("Environment file not found: $filePath");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) continue;

            list($key, $value) = array_map('trim', explode('=', $line, 2));
            if (!empty($key)) {
                putenv("$key=$value");
                $_ENV[$key] = $value;   // optional: so you can access via $_ENV as well
            }
        }
    }
}
?>
