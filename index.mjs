import { PhpNode } from './PhpNode.mjs';
import fs from 'node:fs';
import gi from 'node-gtk';
const Gtk = gi.require('Gtk', '3.0');

const php = new PhpNode({Gtk, gi});

// Listen to STDOUT
php.addEventListener('output', (event) => {
	event.detail.forEach(line => console.log(line));
});

// Listen to STDERR
php.addEventListener('error', (event) => {
	event.detail.forEach(line => console.error(line));
});

php.addEventListener('ready', () => {
	php.run(fs.readFileSync('./index.php'));
});
