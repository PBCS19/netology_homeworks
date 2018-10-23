<?php
$phoneBook = file_get_contents(__DIR__ . '/phone_book.json');
$phoneBookArray = json_decode($phoneBook, true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №4</title>
  </head>
  <body>
<!--
Это старый вариант, ниже новый!
    <div>
      <h1><?php echo $phoneBookArray['NamePhoneBook']; ?> - 1 вариант</h1>
      <table border="1">
        <tr>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Адрес</td>
          <td>Телефонные номера</td>
        </tr>
        <?php
        //$contacts = isset($phoneBookArray['Contacts']) ? $phoneBookArray['Contacts'] : [];
        foreach ($contacts as $arrayContact) {
            foreach ($arrayContact as $keysContacts => $valuesContacts) {
                if ($keysContacts === 'firstName') {
                    echo '<tr>';
                    echo '<td>' . $valuesContacts . ' </td>';
                } elseif ($keysContacts === 'secondName') {
                    echo '<td>' . $valuesContacts . ' </td>';
                } elseif ($keysContacts === 'address') {
                    foreach ($valuesContacts as $address => $valuesAddress) {
                        if ($address === 'numberRoom') {
                            $valuesAddress = 'кв.' . $valuesAddress;
                        }
                        if ($address === 'postalCode') {
                            $valuesAddress = 'индекс:' . $valuesAddress;
                        }
                        $addressArray[] = $valuesAddress;
                    }
                    $address = implode(", ", $addressArray);
                    echo '<td>' . $address . '</td>';
                    $addressArray = [];
                } elseif ($keysContacts === 'phoneNumbers') {
                    foreach ($valuesContacts as $phoneNumbers => $valuesPhoneNumbers) {
                        $phoneNumbersArray[] = $valuesPhoneNumbers;
                    }
                    $phone = implode(", ", $phoneNumbersArray);
                    echo '<td>' . $phone . '</td>';
                    $phoneNumbersArray = [];
                    echo '</tr>';
                }
            }
        }
        ?>
      </table>
    </div>
-->
    
    <div>
      <h1><?php echo $phoneBookArray['NamePhoneBook']; ?> - 2 вариант</h1>
      <table border="1">
        <tr>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Адрес</td>
          <td>Телефонные номера</td>
        </tr>
        <?php
        $contacts = isset($phoneBookArray['Contacts']) ? $phoneBookArray['Contacts'] : [];
        foreach ($contacts as $arrayContact): ?>
                    <tr>
                      <td><?php echo $arrayContact['firstName'] ?></td>
                      <td><?php echo $arrayContact['secondName'] ?></td>
                      <td><?php echo $arrayContact['address']['city'] . ', ' . $arrayContact['address']['street'] . ', ' . $arrayContact['address']['numberHouse'] . ', кв.' . $arrayContact['address']['numberRoom'] . ', индекс:' . $arrayContact['address']['postalCode'] ?></td>
                <?php
                $valuesContacts = isset($arrayContact['phoneNumbers']) ? $arrayContact['phoneNumbers'] : [];
                foreach ($valuesContacts as $phoneNumbers => $valuesPhoneNumbers) {
                    $phoneNumbersArray[] = $valuesPhoneNumbers;
                }
                $phone = implode(", ", $phoneNumbersArray);
                $phoneNumbersArray = [];
                ?>
                      <td><?php echo $phone ?></td>
                    </tr>
                <?php
        endforeach;
        ?>
      </table>
    </div>
  </body>
</html>