<?php
$phone_book = file_get_contents(__DIR__ . '/phone_book.json');
$phone_book_array = json_decode($phone_book, true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №4</title>
  </head>
  <body>
    <div>
      <h1><?php echo $phone_book_array['Name_Phone_Book']; ?> - 1 вариант</h1>
      <table border="1">
        <tr>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Адрес</td>
          <td>Телефонные номера</td>
        </tr>
        <?php
        foreach ($phone_book_array as $keys => $values) {
            if ($keys === 'Contacts') {
                foreach ($values as $array_contacts) {
                    foreach ($array_contacts as $keys_contacts => $values_contacts) {
                        if ($keys_contacts === 'firstName') {
                            echo '<tr>';
                            echo '<td>' . $values_contacts . ' </td>';
                        } elseif ($keys_contacts === 'secondName') {
                            echo '<td>' . $values_contacts . ' </td>';
                        } elseif ($keys_contacts === 'address') {
                            foreach ($values_contacts as $address => $values_address) {
                                if ($address === 'numberRoom') {
                                    $values_address = 'кв.' . $values_address;
                                }
                                if ($address === 'postalCode') {
                                    $values_address = 'индекс:' . $values_address;
                                }
                                $address_array[] = $values_address;
                            }
                            $address = implode(", ", $address_array);
                            echo '<td>' . $address . '</td>';
                            $address_array = [];
                        } elseif ($keys_contacts === 'phoneNumbers') {
                            foreach ($values_contacts as $phoneNumbers => $values_phoneNumbers) {
                                $phoneNumbers_array[] = $values_phoneNumbers;
                            }
                            $phone = implode(", ", $phoneNumbers_array);
                            echo '<td>' . $phone . '</td>';
                            $phoneNumbers_array = [];
                            echo '</tr>';
                        }
                    }
                }
            }
        }
        ?>
      </table>
    </div>
    
    <div>
      <h1><?php echo $phone_book_array['Name_Phone_Book']; ?> - 2 вариант</h1>
      <table border="1">
        <tr>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Адрес</td>
          <td>Телефонные номера</td>
        </tr>
        <?php
        foreach ($phone_book_array as $keys => $values):
            if ($keys === 'Contacts'):
                foreach ($values as $array_contacts):
                    foreach ($array_contacts as $keys_contacts => $values_contacts):
                        if ($keys_contacts === 'firstName') { ?>
                            <tr>
                              <td><?php echo $values_contacts ?></td>
                          <?php } elseif ($keys_contacts === 'secondName') { ?>
                              <td><?php echo $values_contacts ?></td>
                          <?php
                          } elseif ($keys_contacts === 'address') {
                              foreach ($values_contacts as $address => $values_address) {
                                  if ($address === 'numberRoom') {
                                      $values_address = 'кв.' . $values_address;
                                  }
                                  if ($address === 'postalCode') {
                                      $values_address = 'индекс:' . $values_address;
                                  }
                                  $address_array[] = $values_address;
                              }
                              $address = implode(", ", $address_array);
                              $address_array = [];
                              ?>
                              <td><?php echo $address ?></td>
                          <?php
                          } elseif ($keys_contacts === 'phoneNumbers') {
                              foreach ($values_contacts as $phoneNumbers => $values_phoneNumbers) {
                                  $phoneNumbers_array[] = $values_phoneNumbers;
                              }
                              $phone = implode(", ", $phoneNumbers_array);
                              $phoneNumbers_array = [];
                              ?>
                              <td><?php echo $phone ?></td>
                            </tr>
                        <?php
                        }
                    endforeach;
                endforeach;
            endif;
        endforeach;
        ?>
      </table>
    </div>
  </body>
</html>