<?php
// Pull the objects passed in from JS
$gi  = vrzno_env('gi');
$Gtk = vrzno_env('Gtk');

// Start GTK
$gi->startLoop();
$Gtk->init();

// Set up the window
$win = new $Gtk->Window;
$win->setTitle('PHP-GTK 2024');
$win->setDefaultSize(320, 200);
$win->setPosition($Gtk->WindowPosition->CENTER);

// Spawn the controls
$label  = new $Gtk->Label( (object)[ 'label' => 'Hello, PHP-GTK!' ] );
$output = new $Gtk->Label( (object)[ 'label' => '' ] );
$entry  = new $Gtk->Entry;
$okay   = new $Gtk->Button( (object)[ 'label' => 'Log Value' ] );
$quit   = new $Gtk->Button( (object)[ 'label' => 'Quit' ] );

$vBox = new $Gtk->VBox( (object)[ 'spacing' => 0 ] );
$hBox = new $Gtk->Box( (object)[ 'spacing' => 0 ] );
$lBox = new $Gtk->VBox( (object)[ 'spacing' => 0 ] );
$bBox = new $Gtk->Box( (object)[ 'spacing' => 0 ] );

// Assemble the UI
$lBox->packStart($label, true, true, 20);
$lBox->packStart($output, true, true, 20);
$vBox->packStart($lBox, true, true, 20);
$vBox->packStart($entry, true, true, 20);
$bBox->packStart($okay, true, true, 10);
$bBox->packStart($quit, true, true, 10);
$vBox->packStart($bBox, false, false, 20);
$hBox->packStart($vBox, false, false, 160);

$win->add($hBox);

// Listen for events
$win->on('delete-event', fn() => false);

$win->on('destroy', function() use($Gtk) {
    $Gtk->mainQuit();
    return false;
});

$okay->on('clicked', function() use($entry, $output) {
    $text = $entry->getText();
    $output->setText($text);
    var_dump($text);
    return false;
});

$quit->on('clicked', function() use($Gtk) {
    $Gtk->mainQuit();
    return false;
});

// Show the window
$win->showAll();

// Start the main loop
$Gtk->main();
