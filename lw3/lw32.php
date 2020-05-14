<?php
function getGETParameter(string $name): ?string
{
    return isset($_GET[$name]) ? (string) $_GET[$name] : null;
}
$query = getGETParameter('identifier');
$firstSymbol = substr($query, 0, $length);

if (preg_grep("/^[a-zA-Z]+[a-zA-Z0-9]*$/", array($firstSymbol)) || $query !== null)
{
    echo "true";
}
else
{
    echo "false";
}