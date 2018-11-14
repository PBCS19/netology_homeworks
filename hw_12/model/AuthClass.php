<?php
class AuthClass {    
    function checkUser($param) {
        $sth = Di::get()->db()->prepare(
                "SELECT id FROM user WHERE login= ?");
        $sth->execute($param);
        return $sth->fetch();
    }
    
    function regUser($param) {
        $sth = Di::get()->db()->prepare(
                "INSERT INTO user (login, password) VALUES (:login, :password)");
        $sth->execute($param);
    }
    
    function checkLoginPass($param) {
        $sth = Di::get()->db()->prepare(
                "SELECT id FROM user WHERE login= ? AND password= ?");
        $sth->execute($param);
        return $sth->fetch();
    }
    
    function countCaptcha($countCaptcha) {
        $countCaptcha++;
        $_SESSION['countCaptcha'] = $countCaptcha;
        return $countCaptcha;
    }
    
    function checkGoogleCaptcha($gRecaptchaResponse, $ip) {
        $urlToGoogleApi = "https://www.google.com/recaptcha/api/siteverify";
        $secretKey = '6LfASncUAAAAAG9zh38syXzQcqO353hMGUq2ZboX';
        $query = $urlToGoogleApi . '?secret=' . $secretKey . '&response=' . $gRecaptchaResponse . '&remoteip=' . $ip;
        $data = json_decode(file_get_contents($query));
        if ($data->success) {
            // Продолжаем работать с данными для авторизации из POST массива
        } else {
            exit('Извините, но похоже вы робот \(0_0)/');
        }
    }
}
