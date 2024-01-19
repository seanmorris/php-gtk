# PHP-GTK 2024 Example
*Using PHP 8.2.11*

This project exposes [node-gtk](https://github.com/romgrk/node-gtk) to [php-wasm](https://github.com/seanmorris/php-wasm) via [VRZNO](https://github.com/seanmorris/vrzno).

## Run the simple example
```bash
git clone git@github.com:seanmorris/php-gtk.git
cd php-gtk/
npm install
node .
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
