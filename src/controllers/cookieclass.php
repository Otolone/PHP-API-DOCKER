<?php
class ManageCokies {
    //method to create cookies
    private string $cookie_name;
    private string $cookie_value;

    //method to create a cookie
    // should appear before the html tag
    public function createCookie(string $cookie_name, string $cookie_value) {
        $this->cookie_name = $cookie_name;
        $this->cookie_value = $cookie_value;
        setcookie($this->cookie_name, $this->cookie_value, time() + (8640*30), "/");

    }
    //Method to get cookie
    public function getCookie(): void {
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
          } else {
            echo "Cookie '" . $cookie_name . "' is set!<br>";
            echo "Value is: " . $_COOKIE[$cookie_name];
          }
    }
    //Method to modify a cookie
    public function modifyCookie(srtring $cookie_name, string $cookie_value): void {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

    }
    //Method to delete a ccokie
    public function deleteCookie(string $cookie_name,string $cookie_value): void {
        setcookie($cookie_name, "", time()-3600);
    }
    //Methods to check if cookies are enabled
    public function checkCookieEnabledHeader(): void {
        setcookie("test_cookie");
    }
    public function checkCookieEnabled(): void {
        if (count($_COOKIE) > 0) {
            echo "Cookies are enabled. ";
        } else {
            echo "Cookies are disabled.";
        }
    }
    


}
?>