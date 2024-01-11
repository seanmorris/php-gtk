import { PhpNode } from './PhpNode.mjs';
import fs from 'node:fs';
import gi from 'node-gtk';
const Gtk = gi.require('Gtk', '3.0');


const php = new PhpNode({Gtk, gi});

// Listen to STDOUT & STDERR
php.addEventListener('output', (event) => event.detail.forEach(line => process.stdout.write(line)));
php.addEventListener('error',  (event) => event.detail.forEach(line => process.stderr.write(line)));

// Run PHP
php.addEventListener('ready', () => php.run(fs.readFileSync('./index.php')));
