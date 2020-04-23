<?php
  header("Content-Type: text/plain");
  $inputText = getQueryStringParameter('text');
  if ($inputText !== null && strlen($inputText) > 0)
  {
    echo removeExtraBlanks($inputText);
  }
  else
  {
    echo 'Введены некорректные данные';
  }
  function getQueryStringParameter(string $name): ?string
  {
    return isset($_GET[$name]) ? $_GET[$name] : null;
  }
  function removeExtraBlanks(string $text): string
  {
    $formattedString = '';
    $isBlankFound = true;
    for ($i = 0; $i < strlen($text); $i++)
    {
      if ($text[$i] !== ' ')
      {
        $formattedString .= $text[$i];
        $isBlankFound = false;
      }
      else
      {
        if ($isBlankFound == false)
        {
          $isBlankFound = true;
          $formattedString .= $text[$i];
        }
      }
    }
    return $formattedString;
  }