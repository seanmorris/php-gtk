<?php
// Pull some objects passed in from JS
$gi  = vrzno_env('gi');
$Gtk = vrzno_env('Gtk');

// Start GTK
$gi->startLoop();
$Gtk->init();

// Set up the window
$win = new $Gtk->Window;
$win->setTitle('PHP-GTK 2023');
# $win->setDefaultSize(200, 200);
$win->setPosition($Gtk->WindowPosition->CENTER);

// Spawn the controls
$label  = new $Gtk->Label( (object)[ 'label' => 'Hello, PHP-GTK!' ] );
$button = new $Gtk->Button( (object)[ 'label' => 'okay' ] );
$vBox   = new $Gtk->VBox( (object)[ 'spacing' => 0 ] );
$hBox   = new $Gtk->Box( (object)[ 'spacing' => 0 ] );

// Assemble the UI
$vBox->packStart($label, true, true, 20);
$vBox->packStart($button, false, false, 20);
$hBox->packStart($vBox, false, false, 160);
$win->add($hBox);

// Listen for events
$button->on('clicked', fn() => $Gtk->mainQuit());
$win->on('delete-event', fn() => false);
$win->on('destroy', fn() => $Gtk->mainQuit());

// Show the window
$win->showAll();

// Start the main loop
$Gtk->main();
