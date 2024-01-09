# PHP-GTK 2024 Example
*Using PHP 8.2.11*

This project exposes node-GTK to php-wasm via VRZNO.

## Run the simple example

```bash
git clone git@github.com:seanmorris/php-gtk.git
cd php-gtk/
node .
```

## Updating php-wasm

```bash
npm run update-php
```

## PHP-GTK Browser

You can run the browser demo

```bash
node browser.mjs
```

You may need to install [WebKit2 GTK+](https://webkitgtk.org/)

* **Debian** `apt-get install libwebkit2gtk-3.0`
* **Fedora** `sudo dnf install webkit2gtk3`
* **ArchLinux** `pacman -S --needed webkitgtk`
* **MacOS** `brew install webkitgtk`
* **Windows** https://fujii.github.io/2019/07/05/webkit-on-windows/

