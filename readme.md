# Simple PHP website

- Windows

  - 运行 `start.bat`。
  - 浏览器打开 `http://127.0.0.1:3000`。

- Linux or OSX

  - 安装 `libxml2-dev` 运行 `apt install libxml2-dev`。
  - 安装 `autoconf` 运行 `apt install autoconf`。
  - `http://php.net/downloads.php` 下载 PHP 源码。
  - `tar -zxvf php-${version}.tar.gz && cd php-${version}`
  - `./configure`
  - `make`
  - `make install`
  - `cp sapi/cli/php .`
  - `cd ext/sqlite3`
  - `mv config0.m4 config.m4`
  - `phpize`
  - `./configure`
  - `make`
  - `cp modules/sqlite3.so .`
  - `touch php.ini`

    ```ini
    [PHP]
    short_open_tag = On
    default_mimetype = "text/html"
    default_charset = "UTF-8"
    extension= ./sqlite3.so
    [Date]
    date.timezone = Asia/Shanghai
    ```

  - `./php -S 127.0.0.1 -t ./www`

  - 浏览器打开 `http://127.0.0.1:3000`。
